<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function showForm(Request $request)
    {
        $typ_id = session('typ_id');
        $usrID = session('usrUuId');
        $sessionAccID = session('accID');
        $searchId = $request->input('search');
        $firstName = session('usrFirstName');
        $middleName = session('usrMiddleName');
        $lastName = session('usrLastName');

        $months = ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
        $schoolDays = array_fill_keys($months, 20);
        $attendance = array_fill_keys($months, 0);
        $students = [];

        // Admin or School Admin can search students
        if (in_array($typ_id, [1, 2])) {
            $studentsQuery = DB::table('users')
                ->select('usrID', DB::raw("CONCAT(usrFirstName, ' ', usrLastName) AS name"));

            if ($typ_id == 2) {
                $studentsQuery->where('accID', $sessionAccID);
            }

            $students = $studentsQuery->orderBy('name')->get()->map(function ($row) {
                return [
                    'id' => $row->usrID,
                    'name' => $row->name,
                ];
            })->toArray();
        }

        // If not admin, user can only view their own report
        if (!in_array($typ_id, [1, 2])) {
            $searchId = $usrID;
        }

        // If no specific user selected, pick the first student (admin only)
        if (!$searchId && count($students) > 0) {
            $searchId = $students[0]['id'];
        }

        $user = trim("{$firstName} {$middleName} {$lastName}");
        $accID = null;
        $readonly = false;

        if ($searchId) {
            $userRow = DB::table('users')
                ->where('usrID', $searchId)
                ->first();

            if ($userRow) {
                $canAccess = (
                    $typ_id == 1 ||
                    ($typ_id == 2 && $userRow->accID == $sessionAccID) ||
                    ($usrID == $userRow->usrID) // All users can view their own
                );

                if (!$canAccess) {
                    abort(403, 'Unauthorized access.');
                }

                $user = [
                    'usrID' => $userRow->usrID,
                    'usrFirstName' => $userRow->usrFirstName,
                    'usrMiddleName' => $userRow->usrMiddleName,
                    'usrLastName' => $userRow->usrLastName,
                    'usrImage' => $userRow->usrImage,
                    'accID' => $userRow->accID,
                ];

                $accID = $userRow->accID;

                // Attendance
                $records = DB::table('dtr_sams_card')
                    ->selectRaw("DATE_FORMAT(tme_date, '%b') as month, COUNT(DISTINCT tme_date) as total")
                    ->where('emp_id', $searchId)
                    ->whereYear('tme_date', now()->year)
                    ->where(function ($q) {
                        $q->whereNotNull('tme_am_in')->orWhereNotNull('tme_pm_in');
                    })
                    ->groupBy(DB::raw("DATE_FORMAT(tme_date, '%b')"))
                    ->pluck('total', 'month')
                    ->toArray();

                foreach ($records as $month => $total) {
                    if (isset($attendance[$month])) {
                        $attendance[$month] = $total;
                    }
                }

                $readonly = ($typ_id == 4 && $usrID == $userRow->usrID);
            }
        }

        if (!$accID) {
            $accID = $sessionAccID;
        }

        $schoolName = DB::table('schoolaccounts')
            ->where('accID', $accID)
            ->value('accName') ?? 'N/A';

        return view('report', compact(
            'students',
            'user',
            'months',
            'schoolDays',
            'attendance',
            'typ_id',
            'schoolName',
            'readonly'
        ));
    }

    public function print(Request $request, $id)
    {
        $typ_id = session('typ_id');
        $usrID = session('usrUuId'); // Correct session key
        $sessionAccID = session('accID');

        // Access control
        $allowed = false;

        if ($typ_id == 1) {
            $allowed = true;
        } elseif ($typ_id == 2) {
            $allowed = DB::table('users')
                ->where('usrID', $id)
                ->where('accID', $sessionAccID)
                ->exists();
        } elseif ($usrID == $id) {
            $allowed = true;
        }

        if (!$allowed) {
            abort(403, 'Unauthorized access.');
        }

        $userRow = DB::table('users')->where('usrID', $id)->first();
        if (!$userRow) {
            abort(404, 'Student not found.');
        }

        $user = (array) $userRow;
        $accID = $userRow->accID;

        $months = ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
        $schoolDays = $request->input('schoolDays', array_fill_keys($months, 20));
        $attendance = array_fill_keys($months, 0);

        $records = DB::table('dtr_sams_card')
            ->selectRaw("DATE_FORMAT(tme_date, '%b') as month, COUNT(DISTINCT tme_date) as total")
            ->where('emp_id', $id)
            ->whereYear('tme_date', now()->year)
            ->where(function ($q) {
                $q->whereNotNull('tme_am_in')->orWhereNotNull('tme_pm_in');
            })
            ->groupBy(DB::raw("DATE_FORMAT(tme_date, '%b')"))
            ->pluck('total', 'month')
            ->toArray();

        foreach ($records as $month => $total) {
            if (isset($attendance[$month])) {
                $attendance[$month] = $total;
            }
        }

        $schoolName = DB::table('schoolaccounts')
            ->where('accID', $accID)
            ->value('accName');

        $readonly = ($typ_id == 4 && $usrID == $id);

        return view('printreport', [
            'user' => $user,
            'months' => $months,
            'schoolDays' => $schoolDays,
            'attendance' => $attendance,
            'typ_id' => $typ_id,
            'schoolName' => $schoolName,
            'age' => $request->input('age', ''),
            'sex' => $request->input('sex', ''),
            'grade' => $request->input('grade', ''),
            'section' => $request->input('section', ''),
            'curriculum' => $request->input('curriculum', ''),
            'school_year' => $request->input('school_year', ''),
            'track_strand' => $request->input('track_strand', ''),
            'lrn' => $request->input('lrn', ''),
            'region' => $request->input('region', ''),
            'division' => $request->input('division', ''),
            'principal' => $request->input('principal', ''),
            'approved_adviser' => $request->input('approved_adviser', ''),
            'readonly' => $readonly,
        ]);
    }

    public function searchStudents(Request $request)
    {
        $typ_id = session('typ_id');
        $accID = session('accID');
        $usrID = session('usrUuId');
        $term = $request->input('q');

        $query = DB::table('users')
            ->select('usrID as id', DB::raw("CONCAT(usrFirstName, ' ', usrLastName) as name"))
            ->where(function ($q) use ($term) {
                $q->where('usrFirstName', 'like', "%$term%")
                    ->orWhere('usrLastName', 'like', "%$term%");
            });

        if ($typ_id == 2) {
            $query->where('accID', $accID);
        } elseif (!in_array($typ_id, [1, 2])) {
            $query->where('usrID', $usrID);
        }

        $students = $query->limit(20)->get()->map(function ($row) {
            return [
                'id' => $row->id,
                'name' => $row->name,
            ];
        });

        return response()->json($students);
    }
}

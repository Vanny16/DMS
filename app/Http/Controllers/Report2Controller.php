<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Report2Controller extends Controller
{
    public function showForm()
    {
        $usrType = session('usrType'); // retrieve from session
        $readOnly = ($usrType == 4);   // make form read-only if usrType is 4

        return view('report2', compact('readOnly'));
    }

    public function store(Request $request)
    {
        $usrType = session('usrType');
        if ($usrType == 4) {
            return back()->with('error', 'You are not authorized to edit this report.');
        }

        $data = $request->all();

        $subjects = [
            'Oral communication',
            'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino',
            'Introduction to the Philosophy of the Human Person Pambungad sa Pilosopiya ng Tao',
            'Physical Education and Health 1',
            'General Mathematics',
            'Earth Science',
            'Empowerment Technology',
            'Pre-Calculus',
            'General Chemistry 1',
            'Reading and Writing',
            'Pagbasa at Pagsusuri ng Ibat-Ibang Teksto Tungo sa Pananaliksik',
            'Personal Development/ Pansariling Kaunlaran',
            'Physical Education and Health 2',
            'Statistics and Probability',
            'Disaster Readiness and Risk Reduction',
            'practical_research1',
            'basic_calculus',
            'General Chemistry 2'
        ];

        foreach ($subjects as $subj) {
            $key = str_replace(' ', '_', strtolower($subj));
            $grades = [
                'q1' => $request->input($key . '_q1'),
                'q2' => $request->input($key . '_q2'),
                'q3' => $request->input($key . '_q3'),
                'q4' => $request->input($key . '_q4'),
                'final' => $request->input($key . '_final'),
            ];
        }

        for ($i = 0; $i < 7; $i++) {
            for ($q = 1; $q <= 4; $q++) {
                $obsKey = "obs_{$i}_q{$q}";
                $obsValue = $request->input($obsKey);
            }
        }

        $gen_avg_sem1 = $request->input('gen_average_1');
        $gen_avg_sem2 = $request->input('genF_average_sem2');

        return back()
            ->with('success', 'Report saved successfully.')
            ->withInput()
            ->with('data', $data);
    }
}
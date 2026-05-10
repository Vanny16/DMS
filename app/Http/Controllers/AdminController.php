<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
public function main()
{
    $totalSip = DB::table('sips')->count();

    $totalProcurements = DB::table('procurements')->count();

    $totalItems = DB::table('procurement_items')
        ->where('delete_flag', 0)
        ->count();

    $totalAmount = DB::table('procurement_items')
        ->where('delete_flag', 0)
        ->sum(DB::raw('CAST(amount AS DECIMAL(15,2))'));

    $quarterAmounts = [
        'Q1' => 0,
        'Q2' => 0,
        'Q3' => 0,
        'Q4' => 0,
    ];

    $items = DB::table('procurement_items')
        ->where('delete_flag', 0)
        ->get();

    foreach ($items as $item) {
        $price = (float) str_replace(',', '', $item->amount);

        $months = DB::table('procurement_item_months')
            ->where('procurement_item_id', $item->procurement_item_id)
            ->get();

        foreach ($months as $month) {
            $amount = $price * $month->quantity;

            if (in_array($month->month_id, [1, 2, 3])) {
                $quarterAmounts['Q1'] += $amount;
            } elseif (in_array($month->month_id, [4, 5, 6])) {
                $quarterAmounts['Q2'] += $amount;
            } elseif (in_array($month->month_id, [7, 8, 9])) {
                $quarterAmounts['Q3'] += $amount;
            } elseif (in_array($month->month_id, [10, 11, 12])) {
                $quarterAmounts['Q4'] += $amount;
            }
        }
    }

    $recentProcurements = DB::table('procurements')
        ->join('codes', 'codes.code_id', '=', 'procurements.code_id')
        ->leftJoin('procurement_components', 'procurement_components.procurement_id', '=', 'procurements.procurement_id')
        ->select(
            'procurements.procurement_id',
            'codes.code',
            'procurement_components.description',
            'procurements.created_at'
        )
        ->orderBy('procurements.procurement_id', 'desc')
        ->limit(5)
        ->get();

    return view('admin.main', compact(
        'totalSip',
        'totalProcurements',
        'totalItems',
        'totalAmount',
        'quarterAmounts',
        'recentProcurements'
    ));
}

    public function members()
    {
        $members = DB::table('members')
        ->join('zones','zones.zone_id','=','members.zone_id')
        ->where('mem_active','=','1')
        ->orderby('mem_last_name','asc')
        ->orderby('mem_first_name','asc')
        ->get();

        return view('admin.members',compact('members'));
    }

    public function migs()
    {
        $members = DB::table('members')
        ->join('zones','zones.zone_id','=','members.zone_id')
        ->where('mem_active','=','1')
        ->where('mem_is_good_standing','=','1')
        ->orderby('mem_last_name','asc')
        ->orderby('mem_first_name','asc')
        ->get();

        return view('admin.migs',compact('members'));
    }

    public function nominated()
    {
        $members = DB::table('members')
        ->join('zones','zones.zone_id','=','members.zone_id')
        ->where('mem_active','=','1')
        ->where('mem_has_nominated','=','1')
        ->orderby('mem_last_name','asc')
        ->orderby('mem_first_name','asc')
        ->get();

        return view('admin.nominated',compact('members'));
    }

    public function voted()
    {
        $members = DB::table('members')
        ->join('zones','zones.zone_id','=','members.zone_id')
        ->where('mem_active','=','1')
        ->where('mem_has_voted1','=','1')
        ->orderby('mem_last_name','asc')
        ->orderby('mem_first_name','asc')
        ->get();

        return view('admin.voted',compact('members'));
    }
}

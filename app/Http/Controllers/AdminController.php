<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function main()
    {
    

        return view('admin.main');
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

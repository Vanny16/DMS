<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
    public function home()
    {
        $banners = DB::table('banners')
        ->where('ban_active', '=', '1')
        ->orderBy('ban_order','ASC')
        ->get();

        $news = DB::table('news')
        ->where('nwsActive', '=', 1)
        ->orderby('nwsDateCreated','DESC')
        ->limit('6')
        ->get();

        $zones = DB::table('zones')
        ->get();

        return view('home',compact('zones','banners','news'));
    }

    public function invalid()
    {
        $zones = DB::table('zones')
        ->get();
        
        return view('invalid',compact('zones'));
    }

    public function imageGallery()
    {
        $zones = DB::table('zones')
            ->get();

        return view('imageGallery', compact('zones'));
    }

    public function officersPage()
    {
        $zones = DB::table('zones')
            ->get();

        return view('officersPage', compact('zones'));
    }
}

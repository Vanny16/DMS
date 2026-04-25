<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $selectedAccID = $request->input('accID');
        $userAccID = session('accID');
        $typ_id = session('typ_id');

        if ($typ_id == 1) {
            $query = DB::table('news');

            if ($selectedAccID) {
                $query->where('accID', $selectedAccID);
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nwsTitle', 'like', '%' . $search . '%')
                        ->orWhere('nwsContent', 'like', '%' . $search . '%');
                });
            }

            $news = $query->orderBy('nwsDateCreated', 'desc')->get();
            $schools = DB::table('schoolaccounts')->get();

        } else {
            $news = DB::table('news')
                ->where('accID', $userAccID)
                ->when($search, function ($query, $search) {
                    $query->where('nwsTitle', 'like', '%' . $search . '%')
                        ->orWhere('nwsContent', 'like', '%' . $search . '%');
                })
                ->orderBy('nwsDateCreated', 'desc')
                ->get();

            $schools = [];
        }

        return view('news', compact('news', 'schools'));
    }

    public function store(Request $request)
    {
        $action = $request->input('action');
        $typ_id = session('typ_id');
        $userAccID = session('accID');

        if ($action === 'create') {
            $imageName = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/news'), $imageName);
            }

            $accID = ($typ_id == 1) ? $request->input('accID') : $userAccID;

            DB::table('news')->insert([
                'nwsTitle' => $request->input('title'),
                'nwsContent' => $request->input('content'),
                'nwsImage' => $imageName,
                'nwsDateCreated' => now(),
                'nwsActive' => 1,
                'accID' => $accID,
            ]);

            return redirect('/news')->with('success', 'News added successfully!');
        }

        if ($action === 'update') {
            $news = DB::table('news')->where('nwsID', $request->input('id'))->first();

            if (!$news) {
                return redirect('/news')->with('error', 'News not found.');
            }

            if ($typ_id != 1 && $news->accID != $userAccID) {
                return redirect('/news')->with('error', 'Unauthorized action.');
            }

            $imageName = $news->nwsImage;

            if ($request->hasFile('nwsImage')) {
                if ($news->nwsImage && File::exists(public_path('uploads/news/' . $news->nwsImage))) {
                    File::delete(public_path('uploads/news/' . $news->nwsImage));
                }

                $image = $request->file('nwsImage');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/news'), $imageName);
            }

            $accID = ($typ_id == 1) ? $request->input('accID') : $userAccID;

            DB::table('news')->where('nwsID', $request->input('id'))->update([
                'nwsTitle' => $request->input('nwsTitle'),
                'nwsContent' => $request->input('nwsContent'),
                'nwsImage' => $imageName,
                'accID' => $accID,
            ]);

            return redirect('/news')->with('success', 'News updated successfully!');
        }

        if ($action === 'delete') {
            $news = DB::table('news')->where('nwsID', $request->input('id'))->first();

            if (!$news) {
                return redirect('/news')->with('error', 'News not found.');
            }

            if ($typ_id != 1 && $news->accID != $userAccID) {
                return redirect('/news')->with('error', 'Unauthorized action.');
            }

            if ($news->nwsImage && File::exists(public_path('uploads/news/' . $news->nwsImage))) {
                File::delete(public_path('uploads/news/' . $news->nwsImage));
            }

            DB::table('news')->where('nwsID', $request->input('id'))->delete();

            return redirect('/news')->with('success', 'News deleted successfully!');
        }

        return redirect('/news')->with('error', 'Invalid action.');
    }
}

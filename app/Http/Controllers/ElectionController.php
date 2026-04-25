<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ElectionController extends Controller
{
    public function nominate()
    {
        $member = DB::table('members')
        ->where('mem_id' ,'=', session('mem_id'))
        ->first();

        $members = DB::table('members')
        ->where('mem_active' ,'=', '1')
        ->where('mem_is_good_standing' ,'=', '1')
        ->where('mem_can_be_nominated' ,'=', '1')
        ->orderby('mem_last_name','asc')
        ->get();

        $zone_members = DB::table('members')
        ->where('mem_active' ,'=', '1')
        ->where('mem_is_good_standing' ,'=', '1')
        ->where('mem_can_be_nominated' ,'=', '1')
        ->where('zone_id' ,'=', $member->zone_id)
        ->orderby('mem_last_name','asc')
        ->get();

        $nominations = DB::table('nominations')
        ->join('members','members.mem_id','=','nominations.mem_nominated_id')
        ->where('nominations.mem_id' ,'=', session('mem_id'))
        ->where('nominations.nom_active' ,'=', '1')
        ->orderby('members.mem_last_name','asc')
        ->get();

        $zone_nominations = DB::table('zone_nominations')
        ->join('members','members.mem_id','=','zone_nominations.mem_nominated_id')
        ->where('zone_nominations.mem_id' ,'=', session('mem_id'))
        ->where('zone_nominations.nom_active' ,'=', '1')
        ->orderby('members.mem_last_name','asc')
        ->get();

        return view('election.nominate',compact('member','members','nominations','zone_members','zone_nominations'));
    }

    public function nominateSubmit(Request $request)
    {
        $nom_nominated_id = $request->nom_nominated_id;
        $zone_nominated_id = $request->zone_nominated_id;
        $count = count($nom_nominated_id);

        if($count < 1){

            session()->flash('errorMessage',  "You must select at least 1 nominee.");
            return redirect()->back()->withInput();

        }elseif($count < 10){

            foreach($nom_nominated_id as $mem_id){

                DB::table('nominations')
                ->insert([
                    'mem_nominated_id' => $mem_id,
                    'nom_date_created' => \Carbon\Carbon::now(),
                    'mem_id' => session('mem_id'),
                    'nom_active' => '1'
                ]); 

                $member = DB::table('members')
                ->where('mem_id' ,'=', $mem_id)
                ->first();
        
                $mem_mobile = $member->mem_mobile;
                $mem_email = $member->mem_email;
        
                $message = 'PIEP' . ': ' . 'You have been nominated for the position of Board of Trustees. If you decide to decline this nomination, you may do so by logging at www.piepdvo.com before the nomination period ends.';
                //sendSMS((int)$mem_mobile,$message,'5');
        
                if($mem_email <> '')
                {
                    $message = 'PIEP' . ': ' . 'You have been nominated for the position of Board of Trustees. If you decide to decline this nomination, you may do so by logging at www.piepdvo.com before the nomination period ends.';
                    //sendEmail('PIEP Nomination',$message,$mem_email);
                }

                DB::table('members')
                ->where('mem_id','=',session('mem_id'))
                ->update([
                    'mem_has_nominated' => '1',
                    'mem_date_nominated' => \Carbon\Carbon::now()
                ]); 
            }

            DB::table('zone_nominations')
            ->insert([
                'mem_nominated_id' => $zone_nominated_id,
                'nom_date_created' => \Carbon\Carbon::now(),
                'mem_id' => session('mem_id'),
                'nom_active' => '1'
            ]); 

            session()->flash('successMessage',  "You have successfully cast your nomination.");
            return redirect()->action('ElectionController@nominate');

        }else{

            session()->flash('errorMessage',  "Maximum of 9 nominees allowed.");
            return redirect()->back()->withInput();

        }
    }

    public function elect()
    {
        $member = DB::table('members')
        ->where('mem_id' ,'=', session('mem_id'))
        ->first();

        $members = DB::table('nominations')
        ->join('members','members.mem_id','=','nominations.mem_nominated_id')
        ->select('nominations.mem_nominated_id','members.mem_last_name','members.mem_first_name','members.mem_sector')
        ->where('nominations.nom_active' ,'=', '1')
        ->orderby('members.mem_last_name','asc')
        ->orderby('members.mem_first_name','asc')
        ->distinct()
        ->get(['nominations.mem_nominated_id']);

        $zone_members = DB::table('zone_nominations')
        ->join('members','members.mem_id','=','zone_nominations.mem_nominated_id')
        ->select('zone_nominations.mem_nominated_id','members.mem_last_name','members.mem_first_name','members.mem_sector')
        ->where('zone_nominations.nom_active' ,'=', '1')
        ->orderby('members.mem_last_name','asc')
        ->orderby('members.mem_first_name','asc')
        ->distinct()
        ->get(['zone_nominations.mem_nominated_id']);

        $elections = DB::table('elections')
        ->join('members','members.mem_id','=','elections.mem_elected_id')
        ->where('elections.mem_id' ,'=', session('mem_id'))
        ->where('elections.elect_active' ,'=', '1')
        ->get();

        $zone_elections = DB::table('zone_elections')
        ->join('members','members.mem_id','=','zone_elections.mem_elected_id')
        ->where('zone_elections.mem_id' ,'=', session('mem_id'))
        ->where('zone_elections.elect_active' ,'=', '1')
        ->get();

        return view('election.elect',compact('member','members','elections','zone_members','zone_elections'));
    }

    public function electSubmit(Request $request)
    {
        $mem_elect_id = $request->mem_elect_id;
        $zone_elect_id = $request->zone_elect_id;
        $count = count($mem_elect_id);

       if($count < 1){

            session()->flash('errorMessage',  "You must select at least 1 candidate.");
            return redirect()->back()->withInput();

        }elseif($count < 10){

            foreach($mem_elect_id as $mem_id){

                DB::table('elections')
                ->insert([
                    'mem_elected_id' => $mem_id,
                    'elect_date_created' => \Carbon\Carbon::now(),
                    'mem_id' => session('mem_id'),
                    'elect_active' => '1'
                ]); 

                DB::table('members')
                ->where('mem_id','=',session('mem_id'))
                ->update([
                    'mem_has_voted1' => '1',
                    'mem_date_voted1' => \Carbon\Carbon::now()
                ]); 
            }

            DB::table('zone_elections')
            ->insert([
                'mem_elected_id' => $zone_elect_id,
                'elect_date_created' => \Carbon\Carbon::now(),
                'mem_id' => session('mem_id'),
                'elect_active' => '1'
            ]); 

            session()->flash('successMessage',  "You have successfully cast your vote.");
            return redirect()->action('ElectionController@elect');

        }else{

            session()->flash('errorMessage',  "Maximum of 9 candidates allowed.");
            return redirect()->back()->withInput();

        }
    }

    public function elect2()
    {
        $member = DB::table('members')
        ->where('mem_id' ,'=', session('mem_id'))
        ->first();

        $members = DB::table('elections')
        ->join('members','members.mem_id','=','elections.mem_elected_id')
        ->where('elections.elect_active' ,'=', '1')
        ->select(DB::raw('count(*) as total'),'elections.mem_elected_id')
        ->groupBy('elections.mem_elected_id')
        ->orderby('total','desc')
        ->take('9')
        ->get();

        $officers = DB::table('officers')
        ->join('members','members.mem_id','=','officers.mem_officer_id')
        ->join('positions','positions.pos_id','=','officers.pos_id')
        ->where('officers.mem_id' ,'=', session('mem_id'))
        ->where('officers.off_active' ,'=', '1')
        ->orderby('officers.pos_id')
        ->get();

        $positions = DB::table('positions')
        ->where('pos_active' ,'=', 1)
        ->get();

        return view('election.elect2',compact('member','members','officers','positions'));
    }

    public function elect2Submit(Request $request)
    {
        $mem_elected_id = $request->mem_elected_id;
        $mem_position = $request->mem_position;

        foreach($mem_elected_id as $indexKey=>$mem_id){

            $pos_id = $mem_position[$indexKey];

            DB::table('officers')
            ->insert([
                'mem_id' => session('mem_id'), 
                'mem_officer_id' => $mem_id, 
                'pos_id' => $pos_id,  
                'off_date_created' => \Carbon\Carbon::now(), 
                'off_active' => '1'
            ]);
        }

        DB::table('members')
        ->where('mem_id','=',session('mem_id'))
        ->update([
            'mem_has_voted2' => '1',
            'mem_date_voted2' => \Carbon\Carbon::now()
        ]); 

        session()->flash('successMessage',  "You have successfully cast your vote.");
        return redirect()->action('ElectionController@elect2');

    }

    public function declineNomination(Request $request)
    {
        $mem_decline_reason = $request->mem_decline_reason;
      
        DB::table('members')
        ->where('mem_id','=',session('mem_id'))
        ->update([
            'mem_decline_reason' => $mem_decline_reason,
            'mem_can_be_nominated' => '0'
        ]); 

        DB::table('nominations')
        ->where('mem_nominated_id','=',session('mem_id'))
        ->update([
            'nom_active' => '0'
        ]); 

        return redirect()->action('AdminController@main');

    }
}

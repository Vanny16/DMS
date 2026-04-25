<?php
    function sendSMS($sms_number,  $sms_content, $sms_priority)
    {
        if(session()->has('usrID')){
            $usrID = session('usrID');
        }else{
            $usrID = '0';
        }

        DB::connection('sms')
        ->table('sms_queue')
        ->insert([
            'sms_number' => $sms_number, 
            'sms_content' => $sms_content, 
            'sms_priority' => $sms_priority, 
            'sms_created_by' => $usrID, 
            'sms_date_created' => \Carbon\Carbon::now()
        ]);
    }

    function sendEmail($emailSubject,$emailContent,$emailTo)
    {
        session()->put('emailTo', $emailTo);
        session()->put('emailSubject', $emailSubject);

        Mail::raw($emailContent, function($message) {
            $message
                ->to(session()->get('emailTo'), 'PIEP')
                ->subject(session()->get('emailSubject'));
            $message->from('mailer@piepdvo.com','PIEP Davao');
        });
    }

    function isNominated()
    {
        $nominations = DB::table('nominations')
        ->where('mem_nominated_id','=', session('mem_id'))
        ->where('nom_active','=', '1')
        ->first();

        if($nominations){
            return true;
        }else{
            return false;
        }
    }

    function getRandomString($length) 
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
    
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
    
        return $string;
    }

    function get_approval_count()
    {
        $count = DB::table('members')
        ->where('mem_active','=','-1')
        ->count();

        return $count;
    }

    function get_member_name($mem_id)
    {
        $member = DB::table('members')
        ->where('mem_id','=',$mem_id)
        ->first();

        return $member->mem_last_name . ' ' . $member->mem_first_name;
    }

    function get_member_sector($mem_id)
    {
        $member = DB::table('members')
        ->where('mem_id','=',$mem_id)
        ->first();

        return $member->mem_sector;
    }

    function is_nomination_start()
    {
        $settings = DB::table('settings')
        ->where('id','=','1')
        ->first();

        $now = date_create()->format('Y-m-d H:i:s');

        if($now >= $settings->nomination_start){
            return true;
        }else{
            return false;
        }
    }

    function is_nomination_end()
    {
        $settings = DB::table('settings')
        ->where('id','=','1')
        ->first();

        $now = date_create()->format('Y-m-d H:i:s');

        if($now >= $settings->nomination_end){
            return true;
        }else{
            return false;
        }
    }

    function is_election_start()
    {
        $settings = DB::table('settings')
        ->where('id','=','1')
        ->first();

        $now = date_create()->format('Y-m-d H:i:s');

        if($now >= $settings->election_start){
            return true;
        }else{
            return false;
        }
    }

    function is_election_end()
    {
        $settings = DB::table('settings')
        ->where('id','=','1')
        ->first();

        $now = date_create()->format('Y-m-d H:i:s');

        if($now >= $settings->election_end){
            return true;
        }else{
            return false;
        }
    }

    function is_election2_start()
    {
        $settings = DB::table('settings')
        ->where('id','=','1')
        ->first();

        $now = date_create()->format('Y-m-d H:i:s');

        if($now >= $settings->election2_start){
            return true;
        }else{
            return false;
        }
    }

    function is_election2_end()
    {
        $settings = DB::table('settings')
        ->where('id','=','1')
        ->first();

        $now = date_create()->format('Y-m-d H:i:s');

        if($now >= $settings->election2_end){
            return true;
        }else{
            return false;
        }
    }

    function is_board_member()
    {
        $members = DB::table('elections')
        ->where('elect_active' ,'=', '1')
        ->select(DB::raw('count(*) as total'),'mem_elected_id')
        ->groupBy('mem_elected_id')
        ->orderby('total','desc')
        ->take('9')
        ->get();

        $return_value = false;

        foreach($members as $member)
        {
            $mem_elected_id = $member->mem_elected_id;

            if($mem_elected_id == session('mem_id')){
                $return_value = true;
            }
        }

        return $return_value;
    }

    // ? IN NEWS
    function getUserName($usr_id)
    {
        $user = DB::table('users')
            ->where('usr_id', '=', $usr_id)
            ->first();

        if ($user) {
            $last_name = $user->usr_last_name;
            $first_name = $user->usr_first_name;
            $display_name = $first_name . ' ' . $last_name;
            return $display_name;
        } else {
            return '';
        }
    }

    function generateNewsID()
    {
        $news = DB::table('news')->orderby('news_id', 'desc')->first();

        if ($news) {
            $code = $news->news_id + 1;
        } else {
            $code = 1;
        }

        return $code;
    }
?>
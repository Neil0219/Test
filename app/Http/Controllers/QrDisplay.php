<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Partys;
use App\Models\Guestz;
use App\Models\Users;
use App\Models\Barcode;
use Carbon\Carbon;

use Auth;

class QrDisplay extends Controller
{

   public function scanqr($g_id){

        //return view('party.qrcode', ['g_id' => $g_id]);
        $temp = Guestz::where('g_id', $g_id)->get();
        foreach($temp as $temp){
            $temp2 = Partys::where('p_id', $temp->p_id)->get();
            foreach($temp2 as $temp2){
                $temp3 = Users::where('id', $temp2->u_id)->get();
                foreach($temp3 as $temp3){
                    return view('party.qrcode',[
                    'name'    => $temp->name,
                    'e_type'  => $temp2->event_type,
                    'e_theme' => $temp2->event_theme,
                    'e_time'  => $temp2->event_time,
                    'e_date'  => $temp2->event_date,
                    'e_venue' => $temp2->event_venue,
                    'g_role'  => $temp->role,
                    'host'    => $temp3->name
                    ]);
                }
            }
        }
    }

}

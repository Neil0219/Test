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

class PartyController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function party(){
        
        //return view('party.addpartyinfo');
        return view('party.addpartyinfo');
    }

    public function viewevent(){
             
       $user_login_id = Auth::user()->id;
        
       $holder = Partys::where('u_id', $user_login_id)->get();
       
            return view('party.viewparty', [
                'holdzz'  => $holder
            ]);
            
    }

    public function viewguest(request $request){
             
            $geturl = request('ids');
            $holder2 = Guestz::where('p_id', $geturl)->get();


             return view('party.viewguest', [
                 'holdzz2'  => $holder2
             ]);
         
     }

    public function guest(){
        
        return view('party.addguestinfo');
        
    }

    public function inputz(){
        
        $guest_num = request('gnum');
        $id_party = request('p_idholder');
        return view('party.addguestnum', [
            'guest' => $guest_num,
            'part_id' => $id_party
        ]);
        //return redirect('/home');
        
    }

    public function store(){
        
       $partydata = new partys();
       $user_login_id = Auth::user()->id;
    
       $partydata->event_type = request('title');
       $partydata->event_theme = request('theme');
       $partydata->event_time = request('time');
       $partydata->event_date = request('date');
       $partydata->event_venue = request('location');
       $partydata->u_id = $user_login_id;

       $partydata->save(); 

       Session::flash('message', 'Success Adding Event !');
       Session::flash('alert-class', 'alert-success');
       return redirect('/home');
        
    }

    public function store_guest(request $request){
        
       $partydata = new Guestz();
 
       $frname = $request->fname;
       $gender = $request->gender;
       $c_num = $request->c_num;
       $email = $request->email;
       $role = $request->role;
       $party_id = $request->p_id;
       //$b_code = Hash::make($frname);

        for($x=0; $x < count($frname); $x++){
            $datasave = [
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'name' => $frname[$x],
                'gender' => $gender[$x],
                'contact_num' => $c_num[$x],
                'email' => $email[$x],
                'role' => $role[$x],
                'p_id' => $party_id,
                //'barcode' => Hash::make($frname[$x])
            ];

            $partydata->insert($datasave); 

        }

             
       Session::flash('message', 'Success Adding Guests !');
       Session::flash('alert-class', 'alert-success');
       //return redirect()->back();
       return redirect('/home');
         
    }

    public function get(){
        
        $partydata = new barcode();
        $user_login_id = Auth::user()->id;
        
        if(!empty($_GET['idg']) && !empty($_GET['name'])){
        $hash = hash::make($_GET['name']);
        $guest_id = $_GET['idg'];

        $check = barcode::where('g_id', $guest_id)->get();
        foreach($check as $check2){
        if($guest_id == $check2->g_id){
            
        return view('party.viewbarcode');
        
        }}

        $partydata->hash = $hash;
        $partydata->g_id = $guest_id;

        $partydata->save(); 
           
        return view('party.viewbarcode');
        }else{
        return redirect('/home');
        }
    }

    
}

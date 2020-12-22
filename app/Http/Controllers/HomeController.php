<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UserHelp;
use DB;
use CekLengkap;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //dd(UserHelp::datauser()[0]->NIM);


        if(isset(UserHelp::datauser()[0]->NIM)){
            $nim = UserHelp::datauser()[0]->NIM;
            

            $t = DB::select(DB::raw
                      ("select a.* from proposal a
                      join anggota_proposal b on a.id = b.id_proposal
                      join lpj c on a.id = c.id_proposal where a.status=1 and c.status = 0 and b.NIM = '".$nim."' and CURRENT_DATE between DATE_ADD(tglselesai, INTERVAL 30 day) and  DATE_ADD(tglselesai, INTERVAL 60 day) "));
            $ada = false;
            $u = [];
            foreach ($t as $key => $value) {
                    if(Ceklengkap::cek($value->id) == false){
                        $ada = true;
                        $u = DB::select(DB::raw
                      ("select *, DATE_ADD(tglselesai, interval 60 day) as tglakhir from proposal where id =".$value->id." "));
                    }
            }

            
            return view('home', compact('u','ada'));
        }   else {

            $ada = false;
            return view('home', compact('ada'));
        }
        
        
    }
}
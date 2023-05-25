<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use Cookie;

class HomeController extends Controller
{
    public function index(){
        $campus = Campus::orderBy('id')->get('key');

        return view('welcome', [
            'campus' => $campus,
        ]);
    }

    public function home(){
        $backTo = Cookie::get('back-to');
        if($backTo){
            Cookie::forget('asscess-token');
        }

        return view('home');
    }

    public function campus(){
        $campus = Campus::all();

        return response()->json($campus);
    }
}

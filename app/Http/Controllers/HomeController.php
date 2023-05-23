<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;

class HomeController extends Controller
{
    public function home(){
        $campus = Campus::orderBy('id')->get('key');

        return view('welcome', [
            'campus' => $campus,
        ]);
    }

    public function campus(){
        $campus = Campus::all();

        return response()->json($campus);
    }
}

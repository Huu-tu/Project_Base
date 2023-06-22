<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService){
        $this->homeService = $homeService;
    } 

    public function index(){
        return view('welcome');
    }

    public function home(){
        return view('home');
    }

    public function campus(){
        $campus = $this->homeService->campus();  
        return [
            "status" => 200,
            "data" => $campus
        ];
    }
     
    public function inFoUser(){
        $inFoUser = $this->homeService->inFoUser();  
        return [
            "status" => 200,
            "data" => $inFoUser
        ];
    }
}

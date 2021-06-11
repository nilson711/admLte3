<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \ DB;

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
        $tasks = DB::SELECT("SELECT * FROM tarefas WHERE visible = 1 ");

        return view('home', ['tasks'=> $tasks]);
    }
}

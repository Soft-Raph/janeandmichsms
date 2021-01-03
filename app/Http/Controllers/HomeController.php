<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;

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
        $mes = Message::find(1);
        $clients = Client::all();
        return view('home', [
            'clients' => $clients,
            'mes' => $mes
        ]);
    }
}

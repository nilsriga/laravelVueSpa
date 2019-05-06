<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\UserEnteredChat;

use Jenssegers\Agent\Agent;


class HomeController extends Controller
{
   
    public function index()
    {
        $agent = new Agent();
        $userIdentifiers = [
            'browser' => $agent->browser(),
            'os' => $agent->device(),
            'device' => $agent->device(),
        ];

        event(new UserEnteredChat($userIdentifiers));

        return view('welcome');
    }
}

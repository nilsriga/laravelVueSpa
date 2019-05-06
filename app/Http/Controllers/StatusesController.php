<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

use App\User;
use App\Events\PostSubmitted;

use Jenssegers\Agent\Agent;
// use Illuminate\Support\Facades\Redis;


class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Status::with('user')->latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // middleware for authentication

        // validation 
        $this->validate($request, ['body' => 'required']);

        $agent = new Agent();
        $agentBrowser = $agent->browser();
        $agentDevice = $agent->device();

        $request->request->add([
            'browser' => $agentBrowser,
            'device' => $agentDevice,
            ]);

        // craete status
        $status = User::find(1)
            ->statuses()
            ->create($request->only(['body', 'browser', 'device']));

        // $publishData = [
        //     'event' => 'newPost',
        //     'request' => 'body',
        //     'browser' => 'browser',
        //     'device' => 'device', 
        // ]; 

        event(new PostSubmitted($status->load('user')));

        // Redis::publish('post-channel', json_encode('something'));

        // return and include user
        return $status->load('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}

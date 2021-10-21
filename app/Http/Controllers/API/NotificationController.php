<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::where('company', request()->user()->company)->whereRaw('user = ' .  request()->user()->id . ' OR user = null ')->orderByDesc('created_at')->get();
        $count = Notification::where('company', request()->user()->company)->whereRaw('user = ' .  request()->user()->id . ' OR user = null ')->orderByDesc('created_at')->count();
        $notifications3 = Notification::where('company', request()->user()->company)->whereRaw('user = ' .  request()->user()->id . ' OR user = null ')->take(3)->orderByDesc('created_at')->get();

        return response()->json(['status' => 'success', 'notifications' => $notifications3, 'notifications3' => $notifications3, 'count' => $count]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

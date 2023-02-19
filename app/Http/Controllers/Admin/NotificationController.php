<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Trait\NotificationTrait;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::orderBy('id', 'DESC')->paginate(5);
        return view('dashboard.notifications.index',compact('notifications'));
    }

//    public function getAll(){
//        $notifications = Notification::latest()->take(5)->get();
//        return view('dashboard.layouts.header',compact('notifications'));
//    }
    public function make_read($id){
      $notification =  Notification::findOrFail($id);
        $notification->update([
            'status' => 1
        ]);
        return redirect()->back();
    }



}

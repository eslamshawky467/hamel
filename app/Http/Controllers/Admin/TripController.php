<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Trip;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class TripController extends Controller
{
 

    public function finished_index(){
        return view('dashboard.finished_trips.index');
    }
    public function getFinished(Request $request)
    {
        if ($request->ajax()) {
            $data = Trip::with('clients')->where('trip_status','finished');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('client', function (Trip $trip) {
                    return $trip->clients->name;
                })
                ->addColumn('phonenumber', function (Trip $trip) {
                    return $trip->clients->phonenumber;
                })
                ->addColumn('id_number', function (Trip $trip) {
                    return $trip->clients->id_number;
                })
                ->addColumn('email', function (Trip $trip) {
                    return $trip->clients->email;
                })
               ->addColumn('action', function (Trip $row) {
                   return $row->trip_status;
                })
                ->rawColumns(['client','phonenumber','id_number','email','action'])
                ->toJson();
        }
    }

//    public function finished_trips_index($id){
//        $trip = Trip::where('id',$id)->first();
//        return view('dashboard.finished_trips.trip_index',compact('trip'));
//    }






    public function inTrip_index(){
        return view('dashboard.in_trip_trips.index');
    }

    public function getInTrip(Request $request)
    {
        if ($request->ajax()) {
            $data = Trip::with('clients')->where('trip_status','in-trip');
//            $new= Trip::where('trip_status','=','in-trip');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('client', function (Trip $trip) {
                    return $trip->clients->name;
                })
                ->addColumn('phonenumber', function (Trip $trip) {
                    return $trip->clients->phonenumber;
                })
                ->addColumn('id_number', function (Trip $trip) {
                    return $trip->clients->id_number;
                })
                ->addColumn('email', function (Trip $trip) {
                    return $trip->clients->email;
                })
             ->addColumn('action', function (Trip $row) {
                   return $row->trip_status;
                })
                ->rawColumns(['client','phonenumber','id_number','email','action'])
                ->toJson();
        }
    }

//    public function inTrip_trips_index($id){
//        $trip = Trip::where('id',$id)->first();
//        return view('dashboard.in_trip_trips.trip_index',compact('trip'));
//    }

public function successpay (Request $request){
   if ($request->ajax()) {
            $data = Payment::with('clients')->where('pay_status','paid');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('client', function (Payment $pay) {
                    return $pay->clients->name;
                })
                ->addColumn('phonenumber', function (Payment $pay) {
                    return $pay->clients->phonenumber;
                })
                ->addColumn('id_number', function (Payment $pay) {
                    return $pay->clients->id_number;
                })
                ->addColumn('email', function (Payment $pay) {
                    return $pay->clients->email;
                })
                ->rawColumns(['client','phonenumber','id_number','email'])
                ->toJson(); 
   }
}
public function nonpaidall(){
    return view('dashboard.finished_trips.nopaid');
}






public function nonpaidtrips (Request $request){
   if ($request->ajax()) {
            $data = Trip::with('clients')->where('trip_status','finished')->where('is_transfered','false');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('client', function (Trip $trip) {
                    return $trip->clients->name;
                })
                ->addColumn('phonenumber', function (Trip $trip) {
                    return $trip->clients->phonenumber;
                })
                ->addColumn('id_number', function (Trip $trip) {
                    return $trip->clients->id_number;
                })
                ->addColumn('email', function (Trip $trip) {
                    return $trip->clients->email;
                })
               ->addColumn('action', function (Trip $row) {
                   return $row->trip_status;
                })
                ->rawColumns(['client','phonenumber','id_number','email','action'])
                ->toJson();
        }
}
public function all(){
    return view('dashboard.payment.all');
}














}

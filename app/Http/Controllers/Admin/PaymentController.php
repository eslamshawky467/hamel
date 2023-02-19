<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Trip;
use App\Models\TripDetails;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Notification;
class PaymentController extends Controller

{
    public function thanks($idn)
    {
         $trips = Trip::where('id', $idn)->first();
         $idclient=$trips->client_id;
        if(Payment::where('pay_status','paid')->where('client_id',$idclient)->where('trip_id',$idn)->exists()){
            return view('dashboard.payment.success'); 
        }
         $id=request()->query('id');
       $token='sk_test_iwJeL5ZxvsiK6q5ktB8bgBzBLjtL7EV1pGebFrQC';
       $response = Http::baseUrl('https://api.moyasar.com/v1')->withBasicAuth("sk_test_iwJeL5ZxvsiK6q5ktB8bgBzBLjtL7EV1pGebFrQC","")->get("payments/{$id}")->json();
       if(isset($response['type']) && $response['type']=='invalid_request_error'){
        $msg=$response['message'];
        return view('dashboard.payment.failed', compact('msg'));
       }
       
       if($response['status']=='paid')
       {
          $sco = Trip::where('id', $idn)->update([
                'is_transfered' => 'true',
            ]);
        $all = Trip::where('id', $idn)->first();
         $idc=$all->client_id;
        $name=Client::where('id',$idc)->first()->name;
        Payment::create([
            'client_id' => $all->client_id,
            'pay_status'=>$response['status'],
            'price' => $all->price,
             'price' => $all->price,
             'trip_id'=>$idn,
        ]);
             $notify = Notification::create([
                'body' => "Trip Paid  By",
                'name' =>$name,
                'status' => 0,
            ]);
          
        return view('dashboard.payment.success');
    }
    else{
         $r=$response['source'];
         $m=$r['message'];
          return view('dashboard.payment.failed',compact('m'));
    }
    
    }
       public function pay($code,$id)
    {
        
       if(Trip::where('id', $id)->exists()){
           if(TripDetails::where('trip_id', $id)->exists()){   
        $trip=TripDetails::where('trip_id',$id)->first();
        $coding=$trip->code;
      if($code===$coding) {
        $price=Trip::where('id',$id)->first();
        $cost=round($price->price);
        $idc=$price->client_id;
        $name=Client::where('id',$idc)->first()->name;
        return view('dashboard.payment.create',compact('cost','name','id'));
        }
          else{
          return view('errors.404');
    
      }
        }
         else{
          return view('errors.404');
    
      }
       }
          else{
            return view('errors.404');
    
      }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

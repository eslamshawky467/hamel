<?php

namespace App\Http\Controllers\Api\Trip;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\TripDetails;
use Illuminate\Http\Request;
use App\Models\Scotter;
use App\Models\Trip;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ScotterResource;
use App\Http\Resources\TripResource;
use Laravel\Ui\Presets\React;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class ScotterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client-api');
    }
    public function index()
    {

        $scotters = Scotter::where('status','active')->get();
        if (!$scotters) {
            return response()->json([
                'message' => 'Success',
                'data' =>  trans('apimsg.Found'),
            ], 200);
        }
        $scotters = ScotterResource::collection($scotters);
        return response()->json([
            'message' => 'Success',
            'data' => $scotters
        ], 200);

    }

    public function starttrip(Request $request)
    {
        
    DB::beginTransaction();
    $id = auth('client-api')->user()->id;
        if (Trip::where('client_id',$id)->where('is_transfered','false')->where('trip_status','finished')->exists()){
            return response()->json([
                'message' => trans('apimsg.recharge'),
            ], 401);
        }
        $scotter = Scotter::where('id', $request->scotter_id)->first();
        $lang = $scotter->lang;
        $lat = $scotter->lat;
        $location = $scotter->location;
        $status = $scotter->status;
        if ($status !== 'active') {
            return response()->json([
                'message' => trans('apimsg.trip'),
            ], 401);
        } else {
            // $account=Account::where('user_id',$id)->where('user_type','App\Models\Client')->first();
            // $balance=$account->balance;
            $data = Trip::create(array_merge(
                ['trip_status' => 'in-trip'],
                ['client_id' => $id],
                ['lang' => $lang],
                ['lat' => $lat],
                ['location' => $location],
                ['is_transfered' => 'false'],
                ['scotter_id' => $request->scotter_id],
            ));
            $sco = Scotter::where('id', $request->scotter_id)->update([
                'status' => 'in-request',
            ]);
            $notify = Notification::create([
                'body' => "Trip Start Now By",
                'name' => auth('client-api')->user()->name,
                'status' => 0,
            ]);
            DB::commit();
            return response()->json([
                'message' => trans('apimsg.Successfully'),////////////////////////
                'trip_id' =>$data['id'],
            ], 200);
        }

    }
    public function endtrip(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = auth('client-api')->user()->id;
            
if(Trip::where('client_id',$id)->where('id', $request->trip_id)->where('trip_status','finished')->where('is_transfered','true')->exists()) {
                 return response()->json([
                    'message' => trans('apimsg.alreadyfinished'),
                ], 401);
             }
              else {
                 $code=Crypt::encryptString(Str::random(30));
                  $data = TripDetails::create(array_merge(
                      ['client_id' => $id],
                      ['lang' => $request->langt],
                      ['lat' => $request->lat],
                      ['location' => $request->location],
                      ['distance' => $request->distance],
                      ['price' =>round($request->price)],
                      ['qrcode' => $request->qrcode],
                      ['trip_id' => $request->trip_id],
                      ['scotter_id' => $request->scotter_id],
                    ['code' => $code],
                  ));
                  $sco = Scotter::where('id', $request->scotter_id)->update([
                      'status' => 'active',
                      'lang' => $request->langt,
                      'lat' => $request->lat,
                      'location' => $request->location,
                  ]);
                  $sco = Trip::where('id', $request->trip_id)->update([
                      'price'=>round($request->price),
                      'trip_status'=>'finished',
                      'to_location'=>$request->location,
                  ]);
                  $notify= Notification::create([
                      'body'  =>"Trip end Now By",
                      'name'=>auth('client-api')->user()->name,
                      'status'=>0,
                  ]);
                  DB::commit();
                
                  return response()->json([
                      'message' => trans('apimsg.successfully'),
                      'link'=>'https://ghazala.efada-academy.com/payments/pay/'.$code."/".$request->trip_id,
                      ////////////////////////
                  ], 200);
              }
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                    'message' => trans('apimsg.wrong'),
                ], 401);
        }
    }
    public function getalltrips()
    {
        $id = auth('client-api')->user()->id;
        $trips = Trip::where('client_id',$id)->where('trip_status','finished')->where('is_transfered','true')->select('id','location','trip_status','created_at','price','to_location')->get();
        if (!$trips) {
            return response()->json([
                'message' => 'Success',
                'data' => trans('apimsg.tfound'),
            ], 200);
        }
        return response()->json([
            'message' => 'Success',
            'data' => $trips,
        ], 200);

    }
     public function getallNonPaytrips()
    {
        $id = auth('client-api')->user()->id;
        $trips = Trip::where('client_id',$id)->where('trip_status','finished')->where('is_transfered','false')->select('id','location','trip_status','created_at','price','to_location')->get();
        if (!$trips) {
            return response()->json([
                'message' => 'Success',
                'data' => trans('apimsg.tfound'),
            ], 200);
        }
        return response()->json([
            'message' => 'Success',
            'data' => $trips,
        ], 200);

    }
      public function paynow(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = auth('client-api')->user()->id;
            
       if(Trip::where('client_id',$id)->where('id', $request->trip_id)->where('trip_status','finished')->where('is_transfered','true')->exists()) {
                 return response()->json([
                    'message' => trans('apimsg.alreadyfinished'),
                ], 401);
             }
              else {
                 $code=Crypt::encryptString(Str::random(30));
                  $data = TripDetails::where('trip_id',$request->trip_id)->first();
                  $code=$data->code;
                  $sco = Trip::where('id', $request->trip_id)->update([
                      'trip_status'=>'finished',
                  ]);
                  DB::commit();
                  return response()->json([
                      'message' => trans('apimsg.successfully'),
                      'link'=>'https://ghazala.efada-academy.com/payments/pay/'.$code."/".$request->trip_id,
                      ////////////////////////
                  ], 200);
              }
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                    'message' => trans('apimsg.wrong'),
                ], 401);
        }
    }
}

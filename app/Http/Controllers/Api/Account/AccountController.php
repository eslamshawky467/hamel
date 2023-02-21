<?php

namespace App\Http\Controllers\Api\Account;
use App\Models\File;
use App\Models\Account;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Trait\AuthTrait;
use App\Http\Trait\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Trait\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    use ApiResponseTrait;
    use FileTrait;
    public function __construct() {
        $this->middleware('auth:client-api');
    }
    public function has_account()
    {
        $account = Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->first();
       if (Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->exists()) {
    if ($account->status == 'approved') {
        return response()->json([
            'message' => 'Success',
            'balance' => $account->balance,
            'account_number'=>$account->id,
        ], 200);
    }elseif($account->status=='pending') {
        return response()->json([
            'message' => trans('apimsg.pending'),
            'account_number'=>$account->id,
        ], 200);
    }else{

        return response()->json([
            'message' =>  trans('apimsg.reject'),
        ], 200);
    }
}        else {
           return response()->json([
               'message' => trans('apimsg.create'),
           ], 200);
        }
    }
    // create account cash
    public function make_account(Request $request){

    $validator = Validator::make($request->all(), [
        'balance'=>'numeric|min:0',
        'front_id'=>'required',
         'back_id_id'=>'required',
    ], [
        'balance.numeric' => trans('apimsg.numeric'),
        'balance.min' =>trans('apimsg.balancemin'),
        'front_id.required'=>trans('auth.filereq'),
        'back_id.required'=>trans('auth.filereqs'),
        
    ]);
    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors(),
        ], 422);
    }
    try {
        DB::beginTransaction();
    if (Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status','!=','canceled')->exists()) {
        return $this->apiResponse(null, trans('admin.exist'), 401);
    } else {
        $acc= Account::create([
            'balance'  => 0,
            'status'   => 'pending',
            'user_id'  => auth('client-api')->user()->id,
            'user_type'=>'App\Models\Client',
        ]);
        foreach($request->file('front_id') as $index=> $file)
        {
            $type= $this->FileType($file->getClientOriginalExtension());
            $name= $this->saveImage($file,$index,'Accounts',$acc->id);
            // insert in image_table
            $files= new File();   //files
            $files->file_name=$name;
            $files->Fileable_id= $acc->id;
            $files->Fileable_type ='App\Models\Account';
            $files->type=$type;
            $files->save();
        }

        foreach($request->file('back_id') as $index=> $file)
        {
            $type= $this->FileType($file->getClientOriginalExtension());
            $name= $this->saveImage($file,$index,'Accounts',$acc->id);
            // insert in image_table
            $files= new File();   //files
            $files->file_name=$name;
            $files->Fileable_id= $acc->id;
            $files->Fileable_type ='App\Models\Account';
            $files->type=$type;
            $files->save();
        }
        $notify= Notification::create([
            'body'  =>"Send Request to Make Account by",
            'name'=>auth('client-api')->user()->name,
            'status'=>0,
        ]);
        DB::commit();
        return response()->json([
            'message' => trans('apimsg.success1'),
        ], 200);
    }
}catch (\Exception $ex) {
    DB::rollback();
   return Response::json(array(
          'status'=>500,
           'message'=>trans('apimsg.wrong'),

        ));
}
    }
    // create
   public function make_transaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ], [
            'amount.required' => trans('apimsg.requireamount'),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();
        if (Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status', 'approved')->exists()) {
            $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status', 'approved')->first();
            $status = $account->status;
            $amount = $account->balance;
            $id = $account->id;
            if ($status == "approved") {
                $total = $request->amount + $amount;
                $updated = Account::where('id', $id)
                    ->update(['balance' => $total]);
                DB::commit();
                return response()->json([
                    'message' => trans('apimsg.successfully'),////////////////
                ], 200);
            }
        }else {
                return response()->json([
                    'message' => trans('auth.accno'),
                ], 401);
            }

        }
}
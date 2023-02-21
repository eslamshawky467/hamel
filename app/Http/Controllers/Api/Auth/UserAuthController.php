<?php

namespace App\Http\Controllers\Api\Auth;
use App\Http\Resources\NationalResource;
use App\Mail\code;
use App\Models\Country;
use App\Models\Provider;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\SendCodeRsePassword;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:client-api', ['except' => ['login', 'register','index','checkcode','forget','code']]);
    }
    public function index(){
        $nationalties =Country::all();
        if ($nationalties->isEmpty()) {
            return response()->json([
                'status' => true,
                'errNum' => "S000",
            ]);
        }
        $nationalties=  NationalResource::collection($nationalties);
        return response()->json([
            'status' => true,
            'message' => "Success",
            'data'=>$nationalties
        ]);

    }
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
                'name'=> 'required|string|max:20',
                'email' =>'required|email|unique:clients',
                'password' => 'required|string|min:5',
                'phonenumber'=>'required',
                'id_number' =>'required',
                'gender'=>'required',
                'country_id'=>'required',
            ],[
                'email.required'=>trans('auth.email.register'),
                'email.unique'=>trans('auth.email.unique.register'),
                'name.required'=>trans('auth.nameRegister'),
                'name.string'=>trans('auth.string.register'),
                'phonenumber.required'=>trans('auth.phone.register'),
                'password.required'=>trans('auth.password.register'),
                'password.min'=>trans('auth.password.min.register'),
                'password.max'=>trans('auth.password.max.register'),
                 'id_number.required'=>trans('auth.id_number.register'),
                 'country_id.required'=>trans('Nationality is Required'),
             ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first()],422);
        }
        /////////  if ($validator->fails()) {
        // return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);
        // }
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images/profile'), $filename);
            $image_file = $request->file('image')->getClientOriginalName();
        $user = Client::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)],
            ['status'=>'active'],
            ['phonenumber'=>$request->phonenumber],
            ['gender'=>$request->gender],
            ['image'=>$image_file],
            ['forget'=>0 ],
        ));
        }
        else
        $user = Client::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)],
            ['status'=>'active'],
            ['phonenumber'=>$request->phonenumber],
            ['gender'=>$request->gender],
            ['forget'=>0 ],
        ));
        $notify= Notification::create([
            'body'  =>"New User Registered his Name is ",
            'name'=>$request->name,
            'status'=>0,
        ]);
        return response()->json([
            'message' =>trans('auth.register.success'),
            'user' => $user,
        ], 200);
    }











    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|exists:clients,email' ,
            'password' => 'required|string|max:50|min:5' ,
        ] ,[
            'email.required'=>trans('auth.email.register'),
            'email.unique'=>trans('auth.email.unique.register'),
            'password.required'=>trans('auth.password.register'),
            'password.min'=>trans('auth.password.min.register'),
            'password.max'=>trans('auth.password.max.register'),
            'email.exists'=>trans('auth.login.exists')
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first()],422);
        }

        if (!$token = auth()->guard('client-api')->attempt($validator->validated())) {
            return response()->json(['message' =>trans('auth.login.faileding')], 401);
        }
        if (Client::where('email', $request->email)->exists()){
            $provider=Client::where('email', $request->email)->first();
            $status=$provider->status;
            $pass=$provider->password;
            if(Hash::check($request->password,$pass)==false) {
                return response()->json(['message' =>trans('admin.unooooo')], 401);
            }
            if($status=='inactive') {
                return response()->json(['message' =>trans('admin.unoooooo')], 401);
            }
            else{
                $code=mt_rand(100000, 999999);
                $otp = Client::where('email', $request->email)
                    ->update(['code' => $code]);
                Mail::to($request->email)->send(new code($code));
                return response()->json(['message' => trans('admin.successnesskkkk'),
                    'email'=>$request->email,
                    'password'=>$request->password,
                ], 200);}

        }else{
            return response()->json(['message' => trans('admin.mustregisterbeforeeeee')], 401);
        }
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',

            'user' => auth('client-api')->user(),
        ]);
    }

    public function checkcode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required|',
            'password'=>'required|string|min:8'
        ], [
            'email.required' => trans('admin.requiremail'),
            'email.email' => trans('admin.emailemsg'),
            'code.required' => trans('admin.requirecode'),
            'password.required' =>trans('admin.requirepass'),
            'password.min'=>trans('admin.passwordmin'),
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $check = Client::where('email', $request->email)->first();
        $code = $check->code;
        $status=$check->status;
        $updated_at = $check->updated_at;
        $date=Carbon::now();
        $result= $date->gte($updated_at->addMinutes(5));
        if ($result==true) {
            return response(['message' => trans('admin.expirecode')], 422);
        } else {
            if ($request->code == $code) {
                Client::where('email',$request->email)->update([
                    'forget'=>0,
                    ]);
                $token= auth()->guard('client-api')->login($check);
                return $this->respondWithToken($token);
            }else {
                return response()->json(['message' => trans('admin.invalidcode')],
                    422);
            }
        }
    }
    public function logout()
    {
        auth('client-api')->logout();
        return response()->json(['message' =>trans('auth.logout.success')]);
    }

    // public function refresh()
    // {
    //     return $this->respondWithToken(auth('client-api')->refresh());
    // }

    public function me()
    {
        return response()->json(auth('client-api')->user());
    }



    public function update_profile(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
             'phonenumber'=>'required',
             'email' => 'required|email|unique:clients,email,' .auth('client-api')->user()->id,
         ]
     ,[
         'name.required'=>trans('editProfile.nameRequired'),
         'name.string'=>trans('editProfile.nameString'),
         'phonenumber.required'=>trans('editProfile.phoneRequired'),
         'email.required'=>trans('editProfile.emailRequired'),
         'email.unique'=>trans('editProfile.emailUnique'),
     ]);
     if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first()],422);
        }

        $user=$request->user();
        $image_file = $user->image;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images/profile'), $filename);
            $image_file = $request->file('image')->getClientOriginalName();
        }
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phonenumber'=>$request->phonenumber,
            'image'=>$image_file,
        ]);

        return response()->json([
            'message'=>trans('msg.updateSuccess'),
        ],200);
    }


    public function change_password(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password'=>'required',
            'password'=>'required|min:6|max:100',
            'confirm_password'=>'required|same:password'
        ],[

            'password.required' =>trans('editProfile.passwordRequired'),
            'confirm_password.required'=>trans('editProfile.confirm_passwordRequired'),
            'confirm_password.same'=>trans('editProfile.confirm_passwordSame'),
        ]);
        if ($validator->fails()) {

                return response()->json(['message'=>$validator->errors()->first()],422);

        }
        $user=$request->user();
        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->password),
                'forget'=>1
            ]);
            return response()->json([
                'message'=>trans('msg.pwSuccess'),
            ],200);
        }else{
            return response()->json([
                'message'=>trans('msg.pwError'),
            ],422);
        }

    }

    public function code(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'code' => 'required|exists:reset_code_passwords',
             'password' => 'required|string|max:50|min:5' ,
             'password_confirmation' => 'required|same:password'
         ]
         ,[
             'code.required'=>trans('auth.code.required'),
             'code.exists'=>trans('auth.code.exists'),
            'password.required'=>trans('auth.password.register'),
            'password.min'=>trans('auth.password.min.register'),
            'password.max'=>trans('auth.password.max.register'),
            'confirm_password.same'=>trans('editProfile.confirm_passwordSame'),
          ]);
         if ($validator->fails()) {
         return response()->json(['message'=>$validator->errors()->first()]);

     }
        // find the code
        if(ResetCodePassword::where('code', $request->code)->exists()){
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);
            // check if it does not expired: the time is one hour
            $updated_at = $passwordReset->created_at;
            $date = Carbon::now();
            $result = $date->gte($updated_at->addMinutes(60));

            if ($result == true) {
                return response(['message' => trans('passwords.code_is_expire')], 422);
            } else {

                // find user's email
                $user = Client::firstWhere('email', $passwordReset->email);

                // update user password
                $user->update([
                    'password' => Hash::make($request->password),
                    'forget'=>1,
                ]);

                // delete current code
                $passwordReset->delete();

                return response(['message' =>trans('passwords.reset')], 200);
        }


        }
        else{
            return response(['message' => trans('auth.code.exists')], );
        }
    }
    public function forget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:clients',
            ]
            ,[
                'email.required'=>trans('auth.email.register'),

               'email.exists'=>trans('auth.login.exists')
             ]);
             if ($validator->fails()) {

                return response()->json(['message'=>$validator->errors()->first()],422);

        }

        if( Client::where('email', $request->email)->exists()){
            $data['email']=$request->email;
            ResetCodePassword::where('email', $request->email)->delete();
            $data['code'] = mt_rand(100000, 999999);
            $codeData = ResetCodePassword::create($data);

            // Send email to user
            Mail::to($request->email)->send(new SendCodeRsePassword($codeData->code));

            return response(['message' => trans('passwords.sent')], 200);
        }
        else{
            return response(['message' => trans('auth.login.exists')], 422);
        }


    }

}

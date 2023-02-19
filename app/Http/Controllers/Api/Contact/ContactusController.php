<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cost;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Resources\SettingResource;


class ContactusController extends Controller
{
    public function about_us(){
        $about_us=SettingResource::collection(Setting::where('type','about_us')->get());
        $price=Cost::select('id','kilo_cost')->get();
        return response()->json([
            'message' => 'success',
            'data' => $about_us,
            'priceofkilo'=>$price,
        ],200);

    }
    public function contact_us(){
        $contact_us=SettingResource::collection(Setting::where('type','contact_us')->get());
        return response()->json([
            'message' => 'success',
            'data' => $contact_us,
        ],200);

    }
    public function faq(){
        $qa=SettingResource::collection(Setting::where('type','qa')->get());
        return response()->json([
            'message' => 'success',
            'data' => $qa,
        ],200);

    }

    public function banner(){
        $banners=Banner::all();
        {
            return response()->json([
                'message' => 'True',
                'Image'=>$banners
            ], 200);
        }
    }

}

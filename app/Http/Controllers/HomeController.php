<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Trip;
use Barryvdh\DomPDF\Facade\Pdf;
class HomeController extends Controller
{
    public function index($type='admin')
    {
        return view('dashboard.login',compact('type'));
    }
    public function home()
    {
        return view('home');
    }

   public function dashboard()
    {

          //  $admins=Accounts::where('id',0)->first();
           // $money=$admins->balance;
           // $onhold=$admins->on_hold_balance;
           // $accs=Request::where('status','approved')->count();
           // $pros=Product::where('quantity',0)->count();
            $users = Client::latest()->take(5)->get();
            return view('dashboard.welcome',compact('users'));
    }

    public function createPDF() {
        // retreive all records from db
        $count=Trip::where('trip_status','finished')->count();
        $admins=Account::where('id',0)->first();
        $money=$admins->balance;
        $countclient=Client::count();
        $countrequest=Trip::count();
        // share data to view
        $data = [
            'money'=> $money,
            'count'=>$count,
          
            'countclient'=>$countclient,
         
            'countrequest'=>$countrequest,
        ];
        $pdf = PDF::loadView('dashboard.pdf_view', $data);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }

    }

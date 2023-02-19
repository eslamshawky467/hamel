<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PendingAccountController extends Controller
{
    public function index()
    {
        return view('dashboard.accounts.pending');
    }
    public function getPendingAccounts(Request $request)
    {
        if ($request->ajax()) {
            $data = Account::with('User')->where('id','>',0)->where('status','pending');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('User', function (Account $user) {
                    return $user->User->name;
                })
                ->addColumn('phonenumber', function (Account $user) {
                    return $user->User->phonenumber;
                })
                ->addColumn('id_number', function (Account $user) {
                    return $user->User->id_number;
                })
                ->addColumn('email', function (Account $user) {
                    return $user->User->email;
                })
                ->addColumn('action', function (Account $row) {
                    $actionBtn = '<a href="accountspending/showdetails/' . $row->id . '" class="edit btn btn-success btn-sm">Show Details</a>  <br> <br> <a href="accountspending/canceled/' . $row->id . '" class="delete btn btn-danger btn-sm">Cancel Account</a>
<a href="accountspending/canceled/' . $row->id . '" class="delete btn btn-success btn-sm">Approve Account</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','User','phonenumber','id_number','email'])
                ->toJson();
        }
    }


    public function store(Request $request)
    {
        //
    }

    public function showdetails($id)
    {
        $files=Account::with('file')->findorfail($id);
        return view('dashboard.accounts.show',compact('files'));
    }


    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function approve($id)
    {
        Account::where('id',$id)->update([
            'status'=>'approved'
        ]);
        return redirect()->back();
    }
    public function cancel($id)
    {
        Account::where('id',$id)->update([
            'status'=>'canceled'
        ]);
        return redirect()->back();
    }

}

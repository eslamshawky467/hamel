<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CanceledAccountController extends Controller
{
    public function index()
    {
        return view('dashboard.accounts.canceled');
    }
    public function getCanceledAccounts(Request $request)
    {
        if ($request->ajax()) {
            $data = Account::with('User')->where('id','>',0)->where('status','canceled');
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
                    $actionBtn = '<a href="accountscanceled/showdetails/' . $row->id . '" class="edit btn btn-success btn-sm">'.trans('admin.showdetails').'</a>  <br> <br> <a href="accounts/approve/' . $row->id . '" class="delete btn btn-danger btn-sm">'.trans('admin.approve').'</a>';
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
}

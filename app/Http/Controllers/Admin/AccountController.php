<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Trait\FileTrait;
use App\Models\Account;
use App\Models\Client;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    use FileTrait;
    public function index()
    {
        return view('dashboard.accounts.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createacc($id)
    {
         $users=Client::findorfail($id);
        return view('dashboard.accounts.create',compact('users'));
    }
    public function getAccounts(Request $request)
    {
        if ($request->ajax()) {
            $data = Account::with('User')->where('id','>',0)->where('status','approved');
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
                    $actionBtn = '<a href="accounts/showdetails/' . $row->id . '" class="edit btn btn-success btn-sm">'.trans('admin.showdetails').'</a>  <br> <br> <a href="accounts/delete/' . $row->id . '" class="delete btn btn-danger btn-sm">'.trans('admin.block').'</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','User','phonenumber','id_number','email'])
                ->toJson();
        }
    }
    public function showdetails($id)
    {
        $files=Account::with('file')->findorfail($id);
        return view('dashboard.accounts.show',compact('files'));
    }
    public function store(Request $request)
    {

            if (Account::where('user_type', 'App\Models\Client')->where('user_id', $request->user_id)->where('status','!=','canceled')->exists()){
                session()->flash('delete', trans('admin.Account_Exist'));
                return redirect()->back();
            }
            else
                $acc= Account::create([
                    'status' =>'approved',
                    'user_type'=>'App\Models\Client',
                    'balance'=>0,
                    'user_id'=>$request->user_id,
                ]);
            foreach($request->file('image') as $index=> $image)
            {
                $name= $this->saveImage($image,$index,'Accounts',$request->user_id);
                // insert in image_table
                $images= new File();
                $images->file_name=$name;
                $images->Fileable_id= $acc->id;
                $images->Fileable_type = 'App\Models\Account';
                $images->type=$this->FileType($image->getClientOriginalExtension());
                $images->save();
            }

            session()->flash('Add', trans('admin.addmsg'));
            return redirect()->back();


    }


    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function block($id)
    {
        Account::where('id',$id)->update([
           'status'=>'canceled'
        ]);
        return redirect()->back();
    }
    public function deletefile($id){
        $accounts = File::find($id);
        $accounts->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->back();
    }
}

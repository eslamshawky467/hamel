<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.create');
    }


    public function getAdmins(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('id','>',1)->select();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="admins/edit/' . $row->id . '" class="edit btn btn-success btn-sm">Edit</a>
<a href="admins/remove/' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
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
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|max:255|email|unique:clients',
            'password' => 'required|max:255',

        ],[
            'name.required' =>'please enter  name ',
            'email.required' =>'please enter  email',
            'email.unique' =>' this Email is used  Enter Another Email ',
            'password.required' =>'please enter  Password',
        ]);
        User::create([
            'name' => $request->name,
            'password'=>  Hash::make($request->password),
            'email' => $request->email,
        ]);
        session()->flash('Add','User Added Successfully !');
        return redirect()->route('admins.index');
        // creat fn user
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
        $user=User::findorfail($id);
        return view('dashboard.admins.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $admins = User::findOrFail($request->id);
        if (!empty($request->password)){
            $validatedData = $request->validate([
                'name' => 'required|max:18|string',
                'email' => 'required|max:255|unique:users,email,'.$request->id,
                'password' => 'required|max:25|min:8',
            ], [
                'email.email' => trans('admin.emailemsg'),
                'email.required' =>trans('admin.requiremail') ,
                'email.unique' => trans('admin.uniqueemail'),
                'password.required' => trans('admin.requirepass'),
                'name.required' => trans('admin.requirename'),
                'password.min' => trans('admin.passwordmin'),
                'password.max' => trans('admin.passwordmax'),
                'name.max' => trans('admin.namemax'),
            ]);

            $admins->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:users,email,' . $request->id,
            ], [
                'email.email' => 'admin.emailmsg',
                'email.required' => 'admin.requiremail',
                'email.unique' => 'admin.uniqueemail',
                'name.required' => 'admin.rquirename',
                'name.max' => 'admin.namemax',
            ]);
            $admins->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
         session()->flash('Add',trans('users.edit.messaga'));
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $admins = User::find($id);
        $admins->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('admins.index');
    }
}

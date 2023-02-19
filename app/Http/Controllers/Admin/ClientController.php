<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getUsers(Request $request)
     {
        if ($request->ajax()) {
            $data = Client::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                        $actionBtn ='</a><br><br><a href="users/edit/' . $row->id . '"   class="edit btn btn-success btn-sm">'.trans('users.edit').'</a>
                        <a href="users/delete/' . $row->id . '"
                         class="delete btn btn-danger btn-sm">'.trans('admin.block').'</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
}

    public function create()
    {
        return view('dashboard.users.create');
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
            'phonenumber' => 'required|max:255',
            'status' => 'required|max:255',
            'id_number' => 'required|max:255',
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
            'image.image'=>trans('auth.image.register'),
        ]);
        Client::create([
            'name' => $request->name,
            'password'=>  Hash::make($request->password),
            'email' => $request->email,
            'status' => $request->status,
            'id_number' => $request->id_number,
            'phonenumber' => $request->phonenumber,

        ]);
          Mail::to($request->email)->send(new UserMail($request->email,$request->password));
        session()->flash('Add',trans('users.add.message'));
        return redirect()->route('users.index');
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
    public function editClient($id)
    {
        $users=Client::find($id);
        return view('dashboard.users.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateClient (Request $request, $id)
    {

        $client = Client::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,'.$id,
            'status' => 'required',
            'phonenumber' => 'required',
        ],[
            'name.required'=>trans('editProfile.nameRequired'),
            'name.string'=>trans('editProfile.nameString'),
            'phonenumber.required'=>trans('editProfile.phoneRequired'),
            'email.required'=>trans('editProfile.emailRequired'),
            'email.unique'=>trans('editProfile.emailUnique'),
        ]);

        DB::beginTransaction();
        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,

            'phonenumber' => $request->phonenumber,
        ]);
        DB::commit();

        // session()->flash('Add','تم التعديل بنج);
        session()->flash('Add',trans('users.edit.messaga'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {

            $client = Client::find($id);

            if (!$client)

                return redirect()->route('users.index')->with(['error' => 'هذا المستخدم غير موجود']);

                 DB::beginTransaction();

                 $client->update(['status'=>'inactive']);
                DB::commit();
                // session()->flash('delete','تم الحذف بنجاح');
                session()->flash('delete',trans('admin.blockmsg'));
                return redirect()->route('users.index');



        } catch (\Exception $ex) {
            return redirect()->route('users.index')->with(['error' => 'حدث خطأ برجاء المحاولة مرة اخري']);
        }

    }
}

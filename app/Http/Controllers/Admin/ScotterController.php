<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scotter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ScotterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.scotters.index');
    }

    public function getScotters(Request $request)
    {
        if ($request->ajax()) {
            $data = Scotter::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="scotters/edit/' . $row->id . '" class="edit btn btn-success btn-sm">'. trans('dash.edit').'</a> <a href="scotters/delete/' . $row->id . '" class="delete btn btn-danger btn-sm">'. trans('dash.delete').'</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.scotters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'lat' => 'required',
            'lang' => 'required',
            'qrcode' => 'required',
            'status' =>'required'
        ],[
            'location.required' => 'Location is Required',
            'lat.required' => 'Lat is Required',
            'lang.required' => 'Lang is Required',
            'qrcode.required' => 'Qrcode is Required',
            'status.required' => 'Status is Required',
        ]);
        DB::beginTransaction();
        Scotter::create([
            'location' => $request->location,
            'lat' => $request->lat,
            'lang' => $request->lang,
            'qrcode' => $request->qrcode,
            'status' => $request->status,
        ]);
        DB::commit();
           session()->flash('Add',trans('users.add.message'));
        return redirect()->route('scotters.index');
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
        $scotter = Scotter::findOrFail($id);
        return view('dashboard.scotters.edit',compact('scotter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $scotter = Scotter::findOrFail($id);
        $request->validate([
            'location' => 'required',
            'lat' => 'required',
            'lang' => 'required',
            'qrcode' => 'required',
            'status' =>'required'
        ],[
            'location.required' => 'Location is Required',
            'lat.required' => 'Lat is Required',
            'lang.required' => 'Lang is Required',
            'qrcode.required' => 'Qrcode is Required',
            'status.required' => 'Status is Required',
        ]);
        DB::beginTransaction();
        $scotter->update([
            'location' => $request->location,
            'lat' => $request->lat,
            'lang' => $request->lang,
            'qrcode' => $request->qrcode,
            'status' => $request->status,
        ]);
        DB::commit();
        // session()->flash('Edit','Scotter Updated Successfully !');
        session()->flash('Add',trans('users.edit.messaga'));
        return redirect()->route('scotters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $scotter = Scotter::findOrFail($id);
       $scotter->update([
           'status' => 'inactive'
       ]);
          session()->flash('Delete',trans('users.delete.message'));
        return redirect()->route('scotters.index');
    }

}

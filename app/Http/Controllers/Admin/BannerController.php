<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.banners.create');
    }
    public function getBanners(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="banners/delete/' . $row->id . '"
                    class="delete btn btn-danger btn-sm">'.trans('admin.delete').'</a>';
                    return $actionBtn;
                })->editColumn('file_name', function ($image) {
                    $url=asset("/bannerFolder/$image->file_name");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                })
                ->rawColumns(['file_name','action'])
                ->make(true);
        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file_name' => 'required|image',
        ],[
            'file_name.required' =>'please enter Image ',
        ]);
        try{
            $banners = new Banner();
            if($request->file_name != null)
            {
                $banner = $request->file_name;
                $imagename =time().'.'.$banner->getClientOriginalExtension();
                $banner->move('bannerFolder',$imagename);
                $banners->file_name = $imagename;
            }
            $banners->save();
            session()->flash('Add',trans('users.add.message'));
            return redirect()->route('banners.index');
        }catch(\Exception $e){

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $image=Banner::find($id);
       $filename=$image->file_name;
        if($filename!==null)
        {
            unlink(public_path('bannerFolder/').$filename);
        }
        DB::beginTransaction();

        $image->delete();
       DB::commit();
       session()->flash('delete',trans('users.delete.message'));
       return redirect()->route('banners.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingsController extends Controller
{
    public function about_us(){
        $about = Setting::where('type','about_us')->first();
        return view('dashboard.setting_view.about_us.about_us',compact('about'));
    }
    public function about_us_store (Request $request){
        $request->validate([
            'title_en'=>'required|string',
            'title_ar'=>'required|string',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
        ],[
            'title_en.required' => trans('dash.titrequired'),
            'title_ar.required' =>  trans('dash.titrequired'),
            'description_ar.required' =>  trans('dash.desrequired'),
            'description_en.required' =>  trans('dash.desrequired'),
        ]);
        $about = Setting::where('type','about_us')->first();
        $about->title_en=$request->title_en;
        $about->title_ar=$request->title_ar;
        $about->description_en=$request->description_en;
        $about->description_ar=$request->description_ar;
        $about->save();
        return redirect()->back()->with('edit',trans('admin.editmsg'));
    }
    public function contact_us_index(){
//        $contact_us=Setting::where('type','contact_us')->get();
        return view('dashboard.setting_view.contact_us.index');
    }

    public function getContact(Request $request)
    {
        if ($request->ajax()) {
            $data = Setting::where('type','contact_us')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="contact-us/update/' . $row->id . '" class="edit btn btn-success btn-sm">'. trans('dash.edit').'</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function contact_us_create(){
        return view('dashboard.setting_view.contact_us.create');
    }
    public function contact_us_store(Request $request){
        $request->validate([
            'title_en'=>'required|string',
            'title_ar'=>'required|string',
            'url'=>'required|string',
//            'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000',
        ],[
            'title_en.required' =>  trans('dash.titrequired'),
            'title_ar.required' => trans('dash.titrequired'),
            'url.required'      => trans('dash.urlrequired'),
//            'image.required'    => 'الصورة مطلوبة',
        ]);
//        if($request->file('image')) {
//            $file = $request->file('image');
//            $ext = $file->getClientOriginalName();
//            $filename = "setting-" . uniqid() . ".$ext";
//            $file->move(public_path('images/settings'), $filename);
            Setting::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->url,
                'description_en' => $request->url,
//                'icon' => $filename,
                'type' => 'contact_us'
            ]);
//        }
        return redirect()->route('contact_us.index')->with('Add',trans('admin.addmsg'));
    }
    public function contact_us_update($id){
        $contact=Setting::findOrFail($id);
        if($contact->type!='contact_us'){
            return redirect()->back()->with('message',trans('admin.noedit'));
        }
        return view('dashboard.setting_view.contact_us.edit',compact('contact'));

    }
    public function about_us_edit(Request $request){
        $contact=Setting::findOrFail($request->id);
        if($contact->type!='contact_us'){
            return redirect()->route('contact_us.index')->with('message',trans('admin.noedit'));
        }
        $request->validate([
            'title_en'=>'required|string',
            'title_ar'=>'required|string',
            'url'=>'required|string',
            'icon'=>'required|string',
        ],[
            'title_en.required' => trans('dash.titrequired'),
            'title_ar.required' => trans('dash.titrequired'),
            'url.required'      => trans('dash.urlrequired'),
//            'image.required'    => 'الصورة مطلوبة',
        ]);
        $contact->title_ar=$request->title_ar;
        $contact->title_en=$request->title_en;
        $contact->description_ar=$request->url;
        $contact->description_en=$request->url;
//        $contact->icon=$request->icon;
        $contact->save();
        return redirect()->route('contact_us.index')->with('edit',trans('admin.editmsg'));
    }
    public function destroy($id){
        $setting=Setting::findOrFail($id);
        if($setting->type=='about_us'){
            return redirect()->route('contact_us.index')->with('message',trans('admin.nodelete'));
        }
        $setting->delete();
        return redirect()->back()->with('delete',trans('admin.deletemsg'));

    }
    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {
            if(Setting::FindOrFail($recordId)->type=='about_us'){
                continue;
            }

            $settings = Setting::FindOrFail($recordId);
            $this->delete($settings);

        }
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->back();
    }

    private function delete(Setting $settings)
    {
        $settings->delete();

    }

    public function qa_index(){
//        $qa=Setting::where('type','qa')->get();
        return view('dashboard.setting_view.qa.index');
    }

    public function qa_create(){
        return view('dashboard.setting_view.qa.create');
    }
    public function qa_store(Request $request){
        $request->validate([
            'title_en'=>'required|string',
            'title_ar'=>'required|string',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
        ],[
            'title_en.required' => trans('dash.titrequired'),
            'title_ar.required' => trans('dash.titrequired'),
            'description_ar.required' => trans('dash.desrequired'),
            'description_en.required' =>  trans('dash.desrequired'),
        ]);
        Setting::create([
            'title_en'=>$request->title_en,
            'title_ar'=>$request->title_ar,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'type'=>'qa',
        ]);
        return redirect()->route('qa.index')->with('Add',trans('admin.addmsg'));
    }
    public function qa_update($id){

        $qa=Setting::findOrFail($id);
        if($qa->type!='qa'){
            return redirect()->back()->with('message',trans('admin.noedit'));
        }
        return view('dashboard.setting_view.qa.edit',compact('qa'));
    }
    public function qa_edit(Request $request){
        $qa=Setting::findOrFail($request->id);
        if($qa->type!='qa'){
            return redirect()->back()->with('message',trans('admin.noedit'));
        }
        $request->validate([
            'title_en'=>'required|string',
            'title_ar'=>'required|string',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
        ],[
            'title_en.required' => trans('dash.titrequired'),
            'title_ar.required' => trans('dash.titrequired'),
            'description_ar.required' =>  trans('dash.desrequired'),
            'description_en.required' =>  trans('dash.desrequired'),
        ]);
        $qa->title_en=$request->title_en;
        $qa->title_ar=$request->title_ar;
        $qa->description_ar=$request->description_ar;
        $qa->description_en=$request->description_en;
        $qa->save();
        return redirect()->route('qa.index')->with('Edit',trans('admin.editmsg'));
    }
    public function ContactUs_edit(Request $request,$id)
    {
        $request->validate([
            'title_en'=>'required|string',
            'title_ar'=>'required|string',
            'url'=>'required|string',
//            'image'=>'mimes:jpeg,jpg,png,gif|nullable|max:10000',
        ],[
            'title_en.required' => trans('dash.titrequired'),
            'title_ar.required' => trans('dash.titrequired'),
            'url.required'      => trans('dash.urlrequired'),
        ]);
        $contact=Setting::find($id);

//        $filename=$contact->icon;
//        if($request->image) {
//
//            if($filename!==null)
//            {
//                unlink(public_path('images/settings/').$filename);
//            }
//            $file = $request->file('image');
//            $ext = $file->getClientOriginalName();
//            $filename = "setting-" . uniqid() . ".$ext";
//            $file->move(public_path('images/settings'), $filename);
//
//        }
        Setting::where('id',$id)->update([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->url,
            'description_en' => $request->url,
//            'icon' => $filename,
            'type' => 'contact_us'
        ]);
        return redirect(route('contact_us.index'))->with(['Edit' => 'تم التحديث بنجاح']);

    }

    public function getQa(Request $request)
    {
        if ($request->ajax()) {
            $data = Setting::where('type','qa')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="qa/update/' . $row->id . '" class="edit btn btn-success btn-sm">'. trans('dash.edit').'</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}

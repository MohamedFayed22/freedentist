<?php

namespace App\Http\Controllers\backstage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\per_user;
use DB;
use Auth;
use Session;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //    $this->middleware('permission')->except('permission','store','update','search');

    }

    public function index()
    {
        $objects = Service::paginate(20);
        return view('backstage.services.index', compact('objects'));

    }

    public function add($id = null)
    {
        if ($id) {
            $object = Service::find($id);
            return view('backstage.services.edit', compact('object'));
        }
        return view('backstage.services.edit');
    }

    public function store(request $request)
    {
        $this->validate($request, [
            'service_name_ar' => 'required|string|max:255',
            'service_name_en' => 'required|string|max:255',

        ]);
        $service = new Service;
        $service->service_name_ar = $request->service_name_ar;
        $service->service_name_en = $request->service_name_en;

        // $user->created_by ='0';
        $service->save();
        $request->session()->flash("message", "Services added successfully");

        return redirect('/home/services');
    }

    public function update(request $request, $id)
    {
        $this->validate($request, [
            'service_name_ar' => 'required|string|max:255',


            'service_name_en' => 'required|string|max:255',

        ]);
        $service = Service::find($id);
        $service->service_name_ar = $request->service_name_ar;
        $service->service_name_en = $request->service_name_en;


        $service->update();
        $request->session()->flash("message", "Service updated succesfully");

        return redirect('/home/services');

    }

    public function destroy($id)
    {
        Service::find($id)->delete();
        Session::flash("message", "Item delete");

        return redirect()->back();
    }
}

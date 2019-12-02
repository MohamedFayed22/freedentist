<?php

namespace App\Http\Controllers\backstage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\per_user;
use DB;
use Auth;
use Session;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //  $this->middleware('permission')->except('permission','store','update','search');

    }

    public function index()
    {
        $objects = Offer::orderBy('id', 'Desc')->paginate(20);
        return view('backstage.offers.index', compact('objects'));

    }

    public function add($id = null)
    {
        if ($id) {
            $object = Offer::find($id);
            return view('backstage.offers.edit', compact('object'));
        }
        return view('backstage.offers.edit');
    }

    public function store(request $request)
    {
        $this->validate($request, [
            'link'=>'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $offer = new offer;

        $offer->link = $request->link;

        if ($request->photo) {
            $name = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/images'), $name);
            $offer->photo = $name;
        }


        // $user->created_by ='0';
       $save =  $offer->save();
        if ($save){
            Session::flash("message", "Offers added successfully");
            return redirect('/home/offers');
        }
        return redirect()->back();

    }

    public function update(request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $offer = Offer::find($id);
        $offer->link = $request->link;
        if ($request->photo) {
            $name = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/images'), $name);
            $offer->photo = $name;
        }

        $offer->update();
        Session::flash("message", "Offers Edit successfully");

        return redirect('/home/offers');

    }

    public function destroy($id)
    {
        Offer::find($id)->delete();
        Session::flash("message", "Offers Deleted");

        return redirect()->back();
    }
}

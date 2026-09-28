<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OfferDetail;
use Validator;
use App\State;

class OfferDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = OfferDetail::paginate(5);
        $states = State::get();
        return view('admin.offer-details.index',['offers' => $offers,'states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'state' => 'required',
            'model' => 'required|unique:offer_details,model',
            'offer' => 'required|numeric'
        ]);
        $offer = new OfferDetail;
        $offer->state_id = $request->state;
        $offer->model = $request->model;
        $offer->offer = $request->offer;
        $offer->status = 1;
        $statedata = State::find($request->state);
        if($statedata->name == 'Kerala') {
            $offer->slug = str_slug('Kerala Offers' , "-");
        }
        if($statedata->name == 'Tamilnadu') {
            $offer->slug = str_slug('Chennai Offers' , "-");
        }
        $res = $offer->save();
        if($res){
            return redirect()->back()->with('success', 'Offer Added successfully');
        } else {
            return redirect()->back()->with('error', ' Please try again.');
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
        $states = State::get();
        $offer = OfferDetail::findOrFail($id);
        return view('admin.offer-details.edit', ['offer' => $offer,'states' => $states]);
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
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'state' => 'required',
            'model' => 'required|unique:offer_details,model,' . $id,
            'offer' => 'required|numeric'
        ]);
        $offer = OfferDetail::findOrFail($id);
        $offer->state_id = $request->state;
        $offer->model = $request->model;
        $offer->offer = $request->offer;
        $offer->status = 1;
        $statedata = State::find($request->state);
        if($statedata->name == 'Kerala') {
            $offer->slug = str_slug('Kerala Offers' , "-");
        }
        if($statedata->name == 'Tamilnadu') {
            $offer->slug = str_slug('Chennai Offers' , "-");
        }
        $res = $offer->save();
        if ($res) {
            activity('admin')->performedOn($offer)->causedBy($user)->withProperties(['data' => $request])->log('Updated Offer.');
            return redirect()->back()->with('success', 'Successfully updated offer.');
        } else {
            return redirect()->back()->with('error', 'Failed to update. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, request $request)
    {
        $user = auth()->guard('admin')->user();
        $offer = OfferDetail::findOrFail($id);
        $res = $offer->delete();
        if ($res) {
            activity('admin')->performedOn($offer)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Offer.');
            return redirect()->back()->with('success', 'Successfully deleted the offer.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the message. Please try again.');
        }
    }
}

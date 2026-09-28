<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Country;
use App\Booking;
use App\Payment;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class CheckoutController extends Controller
{
    use SEOToolsTrait;

    public function show(Request $request, $slug)
    {
        // dd($slug);
        $vehicle = Vehicle::where('slug', $slug)->where('status', 1)->firstorFail();
        

        if ($request->session()->has('vehicle-data')) {
            $this->seo()->setTitle(($vehicle->seo) ? $vehicle->seo->title : 'Car' . ' Checkout');
            $this->seo()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
            SEOMeta::setKeywords(($vehicle->seo) ? [$vehicle->seo->keywords] : ['']);
            $this->seo()->opengraph()->setTitle(($vehicle->seo) ? $vehicle->seo->title : 'Car' . ' Checkout');
            $this->seo()->opengraph()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
            $this->seo()->twitter()->setTitle(($vehicle->seo) ? $vehicle->seo->title : 'Car' . ' Checkout');
            $this->seo()->twitter()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');

            // $old = $request->session()->get('booking-data');
            // dd($old);
            $booking = $request->session()->get('vehicle-data');
            $request->session()->put('slug-data', $slug);
           
            $countries = Country::orderBy('name')->get();
            // dd($countries);
            $location = $request->session()->get('location');
            // dd($booking);
            $redirect_url=app_path('ccavenue/ccavResponseHandler.php');
            //  dd($redirect_url);
            return view('checkout.show', ['vehicle' => $vehicle, 'countries' => $countries, 'booking' => $booking, 'location' => $location,'redirect_url' => $redirect_url]);
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request, $slug)
    {

        $vehicle = Vehicle::where('slug', $slug)->where('status', 1)->firstorFail();
            if ($request->session()->has('vehicle-data')) {
            $validated = $request->validate([
                'first_name' => 'required|min:3|string|max:255',
                'last_name' => 'required|min:1|string|max:255',
                'email' => 'required|string|email|max:255',
                'order_id' => 'required|unique:payments,payable_id',
                'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
                'billing_address' => 'required',
                'country' => 'nullable|string|max:255',
                'state' => 'required|min:3|string|max:255',
                'city' => 'required|min:3|string|max:255',
                'location' => 'required|min:3|string|max:255',
                'postcode' => 'required|min:3|string|max:255',
                'payment' => 'required',
                'comment' => 'nullable',
                'amount' => 'nullable',
                'terms' => 'required',
                'proof.*' => 'required|mimes:jpg,jpeg,png|max:2000'
            ],
            [
                'proof.max'  => 'The proof may not be greater than 2 MB.',
            ]);

            if ($request->hasFile('proof')) {
                $path = $request->file('proof')->storeAs(
                    'upload/vehicle/proof',
                    $request->proof->getClientOriginalName(),
                    'public'
                );
                $validated['proof'] = $path;
            }
            $vehicleData = $request->session()->get('vehicle-data');
            $dataToEncode = [
                'vehicle-data' => $vehicleData,
                'proof' => $validated['proof'],
            ];
            $booking = new Booking;
            $booking->vehicle_id = $vehicle->id;
            $booking->first_name = $validated['first_name'];
            $booking->last_name = $validated['last_name'];
            $booking->email = $validated['email'];
            $booking->phone = $validated['phone'];
            $booking->billing_address = $validated['billing_address'];
            $booking->country_id = $validated['country'];
            $booking->state = $validated['state'];
            $booking->city = $validated['city'];
            $booking->location_id = $validated['location'];
            $booking->postcode = $validated['postcode'];
            $booking->payment = $validated['payment'];
            $booking->comment = $validated['comment'];
            $booking->amount = @$vehicle->booking_amount;
            $booking->status = "pending";
            $booking->vehicle_details = json_encode($dataToEncode);
            $booking->booking_id = 'ABR-'.$slug . rand(0, 99999);
            $booking->save();
            $request->session()->put('booking-data', $booking);
            switch ($booking->payment) {
                case 'cod':
                    return redirect()->route('cod.payment');
                    break;
                case 'ccavenue':
                    return view('ccavenue.ccavRequestHandler');
                    break;
                default:
                    return redirect()->route('cod.payment');
                    break;
            }
        } else {
            return redirect()->route('booking.show', $vehicle->slug);
        }
    }

    // public function success(Request $request, $slug)
    // {
    //     $vehicle = Vehicle::where('slug', $slug)->where('status', 1)->firstorFail();
    //     $request->session()->forget(['booking-data', 'vehicle-data', 'location','slug-data']);
    //     return view('checkout.success');
    // }

    public function success(Request $request, $slug)
    {
        $payment=Payment::where('id',$slug)->first();
        $request->session()->forget(['booking-data', 'vehicle-data', 'location','slug-data']);
        return view('checkout.success',compact('payment'));
    }
    public function failure(Request $request, $slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->where('status', 1)->firstorFail();
        // $request->session()->forget(['booking-data', 'vehicle-data', 'location','slug-data']);
        return view('checkout.failure');
    }
}

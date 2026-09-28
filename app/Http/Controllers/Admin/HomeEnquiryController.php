<?php

namespace App\Http\Controllers\Admin;

use App\Career;
use App\CareerEnquiry;
use App\ContactUs;
use App\HomeEnquiry;
use App\Http\Controllers\Controller;
use App\InsuranceEnquiry;
use App\LocateUsEnquiry;
use App\OfferEnquiry;
use App\ServiceEnquiry;
use App\SubscriptionEnquiry;
use App\TalkToCEO;
use App\TestDriveEnquiry;
use App\UsedcarEnquiry;
use App\VehicleEnquiry;
use Illuminate\Http\Request;

class HomeEnquiryController extends Controller
{
    public function index(Request $request)
    {
        // $search = ($request->search) ? $request->search : null;
        // $enquiries = HomeEnquiry::search($search)->latest("updated_at")->paginate(10);

        $enquiries = VehicleEnquiry::latest("updated_at");

    
        if ($request->date_from) {
            $enquiries = $enquiries->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $enquiries = $enquiries->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $enquiries = $enquiries->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $enquiries = $enquiries->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
    
        $enquiries = $enquiries->get();

        $ServiceEnquiry = ServiceEnquiry::latest("updated_at");
        if ($request->date_from) {
            $ServiceEnquiry = $ServiceEnquiry->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $ServiceEnquiry = $ServiceEnquiry->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $ServiceEnquiry = $ServiceEnquiry->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $ServiceEnquiry = $ServiceEnquiry->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        
        $ServiceEnquiry = $ServiceEnquiry->get();

        $InsuranceEnquiry = InsuranceEnquiry::latest("updated_at");

        if ($request->date_from) {
            $InsuranceEnquiry = $InsuranceEnquiry->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $InsuranceEnquiry = $InsuranceEnquiry->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $InsuranceEnquiry = $InsuranceEnquiry->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $InsuranceEnquiry = $InsuranceEnquiry->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        
        $InsuranceEnquiry = $InsuranceEnquiry->get();

        $exchange = TestDriveEnquiry::latest("updated_at");
        if ($request->date_from) {
            $exchange = $exchange->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $exchange = $exchange->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $exchange = $exchange->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $exchange = $exchange->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        
        $exchange = $exchange->get();

        return view('admin.home-enquries.index', [ 'enquiries' => $enquiries,'ServiceEnquiry' => $ServiceEnquiry,'InsuranceEnquiry' => $InsuranceEnquiry,'exchange' => $exchange]);
    }

    public function all(Request $request)
    {
        // $search = ($request->search) ? $request->search : null;
        // $enquiries = HomeEnquiry::search($search)->latest("updated_at")->paginate(10);

        $enquiries = VehicleEnquiry::latest("updated_at");

    
        if ($request->date_from) {
            $enquiries = $enquiries->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $enquiries = $enquiries->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $enquiries = $enquiries->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $enquiries = $enquiries->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
    
        $enquiries = $enquiries->get();

        $ServiceEnquiry = ServiceEnquiry::latest("updated_at");
        if ($request->date_from) {
            $ServiceEnquiry = $ServiceEnquiry->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $ServiceEnquiry = $ServiceEnquiry->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $ServiceEnquiry = $ServiceEnquiry->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $ServiceEnquiry = $ServiceEnquiry->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        
        $ServiceEnquiry = $ServiceEnquiry->get();

        $InsuranceEnquiry = InsuranceEnquiry::latest("updated_at");

        if ($request->date_from) {
            $InsuranceEnquiry = $InsuranceEnquiry->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $InsuranceEnquiry = $InsuranceEnquiry->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $InsuranceEnquiry = $InsuranceEnquiry->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $InsuranceEnquiry = $InsuranceEnquiry->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        
        $InsuranceEnquiry = $InsuranceEnquiry->get();

        $exchange = TestDriveEnquiry::latest("updated_at");
        if ($request->date_from) {
            $exchange = $exchange->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $exchange = $exchange->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $exchange = $exchange->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $exchange = $exchange->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        
        $exchange = $exchange->get();

        $career = CareerEnquiry::latest("updated_at");
        if ($request->date_from) {
            $career = $career->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $career = $career->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $career = $career->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $career = $career->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        $career = $career->get();

        $offers =  OfferEnquiry::latest("updated_at");
        if ($request->date_from) {
            $offers = $offers->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $offers = $offers->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $offers = $offers->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $offers = $offers->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        $offers = $offers->get();
        // dd($offers);

        $locate = LocateUsEnquiry::latest("updated_at");
        if ($request->date_from) {
            $locate = $locate->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $locate = $locate->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $locate = $locate->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $locate = $locate->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        $locate = $locate->get();

        $subscribe = SubscriptionEnquiry::latest("updated_at");
        if ($request->date_from) {
            $subscribe = $subscribe->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $subscribe = $subscribe->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $subscribe = $subscribe->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $subscribe = $subscribe->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        $subscribe = $subscribe->get();

        $talk = TalkToCEO::latest("updated_at");
        if ($request->date_from) {
            $talk = $talk->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $talk = $talk->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $talk = $talk->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $talk = $talk->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        $talk = $talk->get();
        return view('admin.home-enquries.all', [ 'talk' => $talk,'subscribe' => $subscribe,'locate' => $locate,'offers' => $offers , 'career' => $career ,'enquiries' => $enquiries,'ServiceEnquiry' => $ServiceEnquiry,'InsuranceEnquiry' => $InsuranceEnquiry,'exchange' => $exchange]);
    }

    // public function contact()
    // {
    //     $contacts = ContactUs::get();
    //     //  dd($contacts);
    //     return view('admin.contact.show',['contacts' => $contacts]);
    // }
    public function contact(Request $request)
    {
        $contacts = ContactUs::query();
    
        if ($request->has('date_from')) {
            $contacts->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
        }
    
        if ($request->has('date_to')) {
            $contacts->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
        }
    
        // Additional filters and sorting if needed
    
        $contacts = $contacts->get();
    
        return view('admin.contact.show', ['contacts' => $contacts]);
    }
}

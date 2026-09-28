<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\VehicleEnquiry;
use App\TestDriveEnquiry;
use App\ServiceEnquiry;
use App\Vehicle;
use App\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at')->get();
        $vEnquiries = VehicleEnquiry::count();
        $tdEnquiries = TestDriveEnquiry::count();
        $sEnquiries = ServiceEnquiry::count();
        $vehicles = Vehicle::count();
        $locations = Location::count();
        $location = Location::orderBy('created_at')->get();
        $book = Booking::count();


        return view('admin.home', ['locations' => $locations, 'vehicles' => $vehicles, 'bookings' => $bookings, 'vEnquiries' => $vEnquiries, 'tdEnquiries' => $tdEnquiries, 'sEnquiries' => $sEnquiries,'book'=> $book,'location'=> $location]);
    }
}

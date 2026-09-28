<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\VehicleCategory;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class VehicleCategorieController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        // $locations = VehicleCategory::with([''])->search($search)->latest("updated_at")->get();
        $locations=VehicleCategory::with('categories','subCategories','vehicle','vehicleVerient','categoryTypes')->latest("updated_at")->get();
        return view('admin.vehicle-categories.index', ['locations' => $locations]);
    }

    public function destroy(Request $request)
    {
        $requestedId= $request->id;
        $location = VehicleCategory::find($requestedId);
        
        $user = auth()->guard('admin')->user();
        $res = $location->delete();
        if ($res) {
            activity('admin')->performedOn($location)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Location #' . $location->id . '.');
            return redirect()->back()->with('success', 'Successfully deleted the vehicle category.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the vehicle category. Please try again.');
        }
    }
}

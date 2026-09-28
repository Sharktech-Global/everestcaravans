<?php


namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\MainNetwork;
use App\NetworkBranch;
use App\SubNetwork;
use App\Http\Controllers\Controller;


class NetworkBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = NetworkBranch::with('main', 'sub')->get();
        $main_networks = MainNetwork::get();
        $sub_networks = SubNetwork::get();
        $brands = Brand::get();
        return view('admin.network_page.branches.index', compact('datas', 'main_networks', 'sub_networks','brands'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_network' => 'required',
            'sub_network' => 'required',
            'branch_name' => 'required',
            'branch_head' => 'nullable',
            'head_mobile' => 'nullable',
            'head_email' => 'nullable',
            'branch_address' => 'nullable',
            'address_mobile' => 'nullable',
            'address_email' => 'nullable',
            'location' => 'nullable',
            'link' => 'nullable',
            'wm_name' => 'nullable',
            'brand' => 'nullable'
        ]);
        $result = new NetworkBranch();
        $result->main_id = $validated['main_network'];
        $result->sub_id = $validated['sub_network'];
        $result->branch_name = $validated['branch_name'];
        $result->branch_address = $validated['branch_address'];
        $result->address_mobile = $validated['address_mobile'];
        $result->address_email = $validated['address_email'];
        $result->branch_head = $validated['branch_head'];
        $result->head_mobile = $validated['head_mobile'];
        $result->head_email = $validated['head_email'];
        $result->location = $validated['location'];
        $result->website_link = $validated['link'];
        $result->wm_name = $validated['wm_name'];
        $result->brand_id = $validated['brand'];
        $res = $result->save();
        if ($res) {
            return redirect()->back()->with('success', 'Network Branches Added successfully');
        } else {
            return redirect()->back()->with('error', 'Your details creation was not successful. Please try again.');
        }
    }
    public function edit($id)
    {
        $data = NetworkBranch::with('main','brand')->findOrFail($id);
        $main_networks = MainNetwork::get();
        $sub_networks = SubNetwork::get();
        $brands = Brand::get();

        return view('admin.network_page.branches.edit', ['data' => $data, 'main_networks' => $main_networks, 'sub_networks' => $sub_networks,'brands' => $brands]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'main_network' => 'required',
            'sub_network' => 'required',
            'branch_name' => 'required',
            'branch_head' => 'nullable',
            'head_mobile' => 'nullable',
            'head_email' => 'nullable',
            'branch_address' => 'nullable',
            'address_mobile' => 'nullable',
            'address_email' => 'nullable',
            'location' => 'nullable',
            'link' => 'nullable',
            'wm_name' => 'nullable',
            'brand' => 'nullable'
        ]);
        $result = NetworkBranch::findOrFail($id);
        $result->main_id = $validated['main_network'];
        $result->sub_id = $validated['sub_network'];
        $result->branch_name = $validated['branch_name'];
        $result->branch_address = $validated['branch_address'];
        $result->address_mobile = $validated['address_mobile'];
        $result->address_email = $validated['address_email'];
        $result->branch_head = $validated['branch_head'];
        $result->head_mobile = $validated['head_mobile'];
        $result->head_email = $validated['head_email'];
        $result->location = $validated['location'];
        $result->website_link = $validated['link'];
        $result->wm_name = $validated['wm_name'];
        $result->brand_id = $validated['brand'];
        $res = $result->save();
        if ($res) {
            return redirect()->back()->with('success', 'Network Branches Updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update Network Branches . Please try again.');
        }
    }
    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $result = NetworkBranch::findOrFail($id);
        $res = $result->delete();
        if ($res) {
            activity('admin')->performedOn($result)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Sub Network #' . $result->title . '.');
            return redirect()->back()->with('success', 'Successfully deleted the Network Branch.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the Network Branch. Please try again.');
        }
    }
    public function change(Request $request)
    {
        $sub_network=SubNetwork::where('main_id',$request->id)->get();
        return response()->json(['data' => $sub_network]);
    }


    public function brands()
    {
        $brands = Brand::get();
        return view('admin.network_page.brands.index',compact('brands'));
    }

    public function  brands_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        $result = new Brand;
        $result->brand = $validated['name'];
        $res = $result->save();
        if ($res) {
            return redirect()->back()->with('success', 'Brand added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add Brand. Please try again.');
        }
    }


    public function brand_destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $result = Brand::findOrFail($id);
        $res = $result->delete();
        if ($res) {
            activity('admin')->performedOn($result)->causedBy($user)->withProperties(['data' => $request])->log('Deleted brnad #' . $result->brand . '.');
            return redirect()->back()->with('success', 'Successfully deleted the brand.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the brand. Please try again.');
        }
    }
}

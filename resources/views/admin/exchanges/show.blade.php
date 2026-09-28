@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Exchanges</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.exchanges.index') }}">Exchanges</a>
        <span class="breadcrumb-item active">Show</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Exchange Details</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th >Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Name</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Email</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->email}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Phone</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->phone}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Location</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->location->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Time of contact</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->time_of_contact}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Model</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->model}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Varient</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->varient}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Condition</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->condition->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Color</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->color}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Condition</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->condition->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Emissions</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->emission->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>KM Run</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->kms_run}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Insurance</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->insurance}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Register Number</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->reg_number}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Reg Year</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->reg_year}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Reg Month</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->reg_month}}</td>
                        </tr>
                        <tr>
                            <td class="font-w600 font-size-sm">
                                <b>Register City</b>
                            </td>
                            <td class="font-size-sm">{{@$enquiries->reg_city}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

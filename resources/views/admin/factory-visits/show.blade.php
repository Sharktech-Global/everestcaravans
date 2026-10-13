
@extends('admin.layouts.app')

@section('css_after')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="content">

    <h2 class="content-heading">Factory Visit Enquiries</h2>

    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">
            Dashboard
        </a>
        <span class="breadcrumb-item active">
            Factory Visit Enquiries
        </span>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form method="GET" class="px-5 mx-5 mt-4 mb-5">
                        <div class="row">

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="text"
                                           name="date_from"
                                           id="date_from"
                                           class="form-control"
                                           placeholder="Date From"
                                           autocomplete="off"
                                           value="{{ request('date_from') }}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="text"
                                           name="date_to"
                                           id="date_to"
                                           class="form-control"
                                           placeholder="Date To"
                                           autocomplete="off"
                                           value="{{ request('date_to') }}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>

                                <a href="{{ route('admin.factory-visits.index') }}"
                                   class="btn btn-secondary">
                                    Reset
                                </a>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="block">

        <div class="block-header block-header-default">
            <h3 class="block-title">View Factory Visit Enquiries</h3>
        </div>

        <div class="block-content">

            <div class="table-responsive">

                <table class="table table-striped table-vcenter"
                       id="factory-visit-enquiries">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Created</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Visit Date</th>
                            <th>Visit Time</th>
                            <th>Suburb</th>
                            <th>State</th>
                            <th>Postcode</th>
                            <th>Caravan Type</th>
                            <th>Requirements</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($visits as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $data->created_at->format('d-m-Y h:i A') }}
                                </td>

                                <td class="font-w600">
                                    {{ $data->name }}
                                </td>

                                <td>{{ $data->phone }}</td>

                                <td>{{ $data->email }}</td>

                                <td>
                                    {{ $data->visit_date->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('H:i', substr($data->visit_time, 0, 5))->format('g:i A') }}
                                </td>

                                <td>{{ $data->suburb ?: '-' }}</td>

                                <td>{{ $data->state ?: '-' }}</td>

                                <td>{{ $data->postcode ?: '-' }}</td>

                                <td class="font-w600">
                                    {{ $data->vehicle_name ?: '-' }}
                                </td>

                                <td>
                                    @if ($data->additional_requirements)
                                        <button type="button"
                                                class="btn btn-sm btn-success openPop"
                                                data-toggle="modal"
                                                data-target="#factoryVisitPopup"
                                                data-message="{{ $data->additional_requirements }}">
                                            View
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</div>

<div class="modal enq-popup fade"
     id="factoryVisitPopup"
     tabindex="-1"
     role="dialog"
     aria-labelledby="factoryVisitPopupTitle"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-vehicle-form contact-form"
         role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="factoryVisitPopupTitle">
                    Additional Requirements
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <textarea class="form-control"
                          name="message"
                          rows="8"
                          readonly></textarea>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js_after')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function () {

        $('#date_from, #date_to').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $('#factory-visit-enquiries').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download'
                }
            ],
            order: [[1, 'desc']]
        });

        $('.openPop').on('click', function () {
            var message = $(this).attr('data-message');

            $('#factoryVisitPopup textarea[name="message"]')
                .val(message);
        });

    });
</script>
@endsection

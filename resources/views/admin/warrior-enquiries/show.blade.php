@extends('admin.layouts.app')

@section('content')
<div class="content">

    <h2 class="content-heading">Warrior Enquiry Details</h2>

    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item"
           href="{{ route('admin.home') }}">
            Dashboard
        </a>

        <a class="breadcrumb-item"
           href="{{ route('admin.warrior-enquiries.index') }}">
            Warrior Enquiries
        </a>

        <span class="breadcrumb-item active">
            Enquiry #{{ $enquiry->id }}
        </span>
    </nav>

    <div class="mb-4">
        <a href="{{ route('admin.warrior-enquiries.index') }}"
           class="btn btn-secondary">
            &larr; Back to Enquiries
        </a>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Caravan Preferences</h3>
                </div>

                <div class="block-content pb-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="45%">Interested Caravan</th>
                                <td>{{ $enquiry->modelLabel() }}</td>
                            </tr>

                            <tr>
                                <th>Next Action</th>
                                <td>
                                    {{ $enquiry->next_action ?? $enquiry->enquiry_type ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Purchase Timeframe</th>
                                <td>
                                    {{ $enquiry->purchase_timeframe ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Location</th>
                                <td>{{ $enquiry->location ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Contact Information</h3>
                </div>

                <div class="block-content pb-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="40%">Full Name</th>
                                <td>{{ $enquiry->name }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>
                                    <a href="mailto:{{ $enquiry->email }}">
                                        {{ $enquiry->email }}
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th>Phone</th>
                                <td>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $enquiry->phone) }}">
                                        {{ $enquiry->phone }}
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th>WhatsApp</th>
                                <td>
                                    {{ $enquiry->whatsapp_number ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Postcode</th>
                                <td>{{ $enquiry->postcode }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Submission Information</h3>
        </div>

        <div class="block-content pb-3">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="25%">Enquiry ID</th>
                        <td>#{{ $enquiry->id }}</td>
                    </tr>

                    <tr>
                        <th>Submitted On</th>
                        <td>
                            {{ $enquiry->created_at?->format('d-m-Y h:i A') ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Source URL</th>
                        <td>{{ $enquiry->source_url ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
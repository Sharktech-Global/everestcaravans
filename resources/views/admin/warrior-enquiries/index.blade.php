@extends('admin.layouts.app')

@section('content')
<div class="content">

    <h2 class="content-heading">Warrior Enquiries</h2>

    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item"
           href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Warrior Enquiries</span>
    </nav>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET"
                  action="{{ route('admin.warrior-enquiries.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="date_from">Date From</label>
                        <input type="date"
                               name="date_from"
                               id="date_from"
                               class="form-control"
                               value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="date_to">Date To</label>
                        <input type="date"
                               name="date_to"
                               id="date_to"
                               class="form-control"
                               value="{{ request('date_to') }}">
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit"
                                class="btn btn-primary mr-2">
                            Search
                        </button>
                        <a href="{{ route('admin.warrior-enquiries.index') }}"
                           class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </div>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                View Warrior Enquiries
            </h3>
            <span class="badge badge-primary">
                {{ $enquiries->total() }} Enquiries
            </span>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Submitted</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Caravan</th>
                            <th>Next Action</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($enquiries as $enquiry)
                            <tr>
                                <td>
                                    {{ $enquiries->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $enquiry->created_at?->format('d-m-Y h:i A') ?? '-' }}
                                </td>

                                <td class="font-w600">
                                    {{ $enquiry->name }}
                                </td>

                                <td>{{ $enquiry->phone }}</td>

                                <td>{{ $enquiry->email }}</td>

                                <td>{{ $enquiry->modelLabel() }}</td>

                                <td>
                                    {{ $enquiry->next_action ?? $enquiry->enquiry_type ?? '-' }}
                                </td>

                                <td>{{ $enquiry->location ?? '-' }}</td>

                                <td>
                                    <a href="{{ route('admin.warrior-enquiries.show', $enquiry->id) }}"
                                       class="btn btn-sm btn-success">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    No Warrior enquiries found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($enquiries->hasPages())
            <div class="block-content pb-3">
                {{ $enquiries->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>

</div>
@endsection
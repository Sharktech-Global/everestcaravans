@extends('admin.layouts.app')
@section('css_after')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datepicker/datepicker.min.css') }}">

@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Forms Submissions</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Forms Submissions</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Forms Submissions</h3>
        </div>
        <div class="block-content">
            <form class="js-validation-Category-Types" method="post" action="{{ route('admin.form_export_data') }}">
                @csrf
           <div class="row">
            <div class="col-lg-4">
                <lable>Forms</lable>
                <select id="form_select" name="form" class="form-control">
                    <option value="All">ALL</option>
                    <option value="Career">Career Enquiries</option>
                    <option value="Exit Popup">Exit Popup Enquiries</option>
                    <option value="Offer">Offer Enquiries</option>
                    <option value="Home">Home Enquiries</option>
                    <option value="Insurance">Insurance Enquiries</option>
                    <option value="Locate">Locate Us</option>
                    <option value="Service">Service Enquiries</option>
                    <option value="Service Product">Service Product Enquiries</option>
                    <option value="Subscription">Subscription Enquiries</option>
                    <option value="Used Car">Used Car Enquiries</option>
                    <option value="Vehicle">Vehicle Enquiries</option>
                </select>
            </div>
            <div class="col-lg-2">
                <lable>From</lable>
                <input type="text" class="form-control" value="{{$start}}" name="from" id='from'>
             </div>
             <div class="col-lg-2">
                <lable>To</lable>
                <input type="text" class="form-control" value="{{$end}}" name="to" id='to'>
             </div>
             <div class="col-lg-2 p-4">
                <a onclick="search_data();"  class="btn btn-alt-primary">Search</a>
             </div>

                <div class="col-lg-2 p-4">             
                    <button type="submit" id="export_data" class="btn btn-alt-primary">Export</button>
                </div>
            </form>

           </div>

            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Form</th>
                            <th>Page</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody id="export_data_table">
                        @if($results->count())
                        @foreach ($results as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ @$data->form_name }}</td>
                            <td class="font-w600">{{ @$data->page_name }}</td>
                            <td class="font-w600">{{ @$data->name }}</td>
                            <td class="font-w600">{{ @$data->phone }}</td>
                            <td class="font-w600">{{ @$data->email}}</td>
                            <td class="font-w600">{{ @$data->created_at}}</td>
                           
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="9" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        {{-- <div class="block-content">{{ $results->links() }}</div> --}}
    </div>
</div>
@endsection
@section('js_after')
<script src="{{ asset('assets/libs/datepicker/datepicker.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $("#from").datepicker({
        dateFormat: 'mm-dd-yy',
        autoSize: true,
        changeMonth: true,
        changeYear: true,
        onClose: function() {
            $(this).parsley().validate();
        }
    });
$("#to").datepicker({
    dateFormat: 'mm-dd-yy',
    autoSize: true,
    changeMonth: true,
    changeYear: true,
    onClose: function() {
        $(this).parsley().validate();
    }
});
function search_data(){
    var form=$('#form_select').val();
    var from=$('#from').val();
    var to=$('#to').val();
    if(to < from){
        swal("Please check your end date!");
        return;
    }
    $.ajax({
         type:'POST',
         url: "{{ route('admin.form_export_search') }}",
         data:{"form":form,"from":from,"to":to,"_token": "{{ csrf_token() }}"},
         success: function(response){
                $("#export_data_table").empty();
                $.each(response.data,function(index,value){
                    ++index;
                    if(value.form_name == null){
                        var form_name="";
                    }
                    else{
                        var form_name=value.form_name;
                        
                    }
                    if(value.page_name == null){
                        var page_name="";
                    }
                    else{
                        var page_name=value.page_name;
                       
                    }
                    var d=moment(value.created_at).format('YYYY-MM-DD h:mm:ss');
                    $("#export_data_table").append('<tr><td class="font-w600">'+index+'</td><td class="font-w600">'+form_name+'</td><td class="font-w600">'+page_name+'</td><td class="font-w600">'+value.name+'</td><td class="font-w600">'+value.phone+'</td><td class="font-w600">'+value.email+'</td><td class="font-w600">'+d+'</td></tr>');
                });
            }
        });
}

// function export_data(){
//     var form=$('#form_select').val();
//     var from=$('#from').val();
//     var to=$('#to').val();
//     $.ajax({
//          type:'GET',
//          url: "{{ route('admin.form_export_data') }}",
//          data:{"form":form,"from":from,"to":to,"_token": "{{ csrf_token() }}"},
//          success: function(response){
               
//             }
//         });
// }

    </script>
@endsection
@extends('admin.layouts.app')

@section('title')
    {{ __('Create Gallery') }}
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        /* For style on codepen */
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }


        #uploads {
            text-align: center
        }

        .div-upload {
            margin: 0 auto;
        }


        .btn-center {
            text-align: center;
        }

        .img-wrap {
            position: relative;
            display: inline-block;
            border: 1px red solid;
            font-size: 0;
        }

        .img-wrap .close {
            position: absolute;
            top: 2px;
            right: 2px;
            z-index: 100;
            background-color: #FFF;
            padding: 5px 2px 2px;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            opacity: .2;
            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
        }

        .img-wrap:hover .close {
            opacity: 1;
        }
      
    </style>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Gallery') }}</h4>
                <div class="page-title-right">

                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start administrator create form -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="mt-2 row p-5">
                        <div class="col-lg-12">
                            <form action="{{ route('admin.gallery.store') }}" method="post" class="custom-validation"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="field div-upload" align="center">
                                    <h3>Upload your images</h3>
                                    <input class="form-control" type="file" id="files" name="files[]" multiple />

                                    dimension(1400 × 850px)<br>
                                    width- 309, height- 188
                                </div>
                                <div class="row justify-content-end mt-5 btn-center">
                                    <div class="col-sm-12" style="padding: 30px";>
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                    <div class="row">
                        @if ($galleries->count() > 0)
                            @foreach ($galleries as $gallery)
                                <div class="col-3">

                                    <div class="img-wrap">
                                        <button onclick="delete_image('{{ $gallery->uuid }}');"
                                            class="close">&times;</button>
                                        <img src="{{ asset('storage/' . $gallery->images) }}" width="250px">
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end administrator create form -->
@endsection

@section('js_after')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            var imgWidth = 500; 
                            var imgHeight = 350;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target
                                .result + "\" title=\"" + file.name + "\" width=\"" + imgWidth + "\" height=\"" + imgHeight + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span><br>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                              class: "imageThumb",
                              src: e.target.result,
                              title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }


        });

        function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.gallery.image_delete') }}",
                    type: "get",
                    dataType: 'json',
                    data: {
                        uuid: uuid,
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            swal("success!", "Image deleted successfully!", "success")
                        } else {
                            sweetAlert("Oops...", "Something went wrong!", "error");
                        }
                        location.reload()
                    }
                });
            }
            return false;
        }
    </script>
@endsection

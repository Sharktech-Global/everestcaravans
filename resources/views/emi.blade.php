@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-160 bg-c3c3c3 pt-150"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">EMI Calculator</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>EMI</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="bg-black">
            <!-- PRIVACY POLICY -->
            <div class="container py-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="col-md-8 offset-md-2">
                            <div class="row" style="background: #44444478;">
                                <div class="col-md-12">
                                    <p class="text-center sub-heading" style="margin-top: 50px;"> </p>
                                </div>
                                <div class="text-white col-md-6">

                                    EMI Calculator<br><br>

                                    Enter the Amount and Interest Rate to Calculate the EMI.
                                    <div class="col-md-12"><br>
                                        <label><i> Amount (Rs.) <span class="redtext">*</span></i></label>
                                        <input type="text" id="total" class="form-control"
                                            placeholder="Please enter the Amount">
                                    </div>
                                    <div class="col-md-12"><br>
                                        <label><i>Interest<span class="redtext">*</span></i></label>
                                        <input type="text" id="interest" class="form-control"
                                            placeholder="Please enter the Interest">
                                    </div>
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <button type="button" class="btn btn-success" style="
                                            background:#da1f28;
                                            border: none;
                                            border-radius: 0px;
                                            font-weight: 700;
                                            " id="calculate" onclick="cal()">
                                            Calculate
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Months</th>
                                                <th>EMI (Rs)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>6</td>
                                                <td id="halfyear">...</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td id="oneyear">...</td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td id="twoyear">...</td>
                                            </tr>
                                            <tr>
                                                <td>36</td>
                                                <td id="threeyear">...</td>
                                            </tr>
                                            <tr>
                                                <td>48</td>
                                                <td id="fouryear">...</td>
                                            </tr>
                                            <tr>
                                                <td>60</td>
                                                <td id="fiveyear">...</td>
                                            </tr>
                                            <tr>
                                                <td>72</td>
                                                <td id="sixyear">...</td>
                                            </tr>
                                            <tr>
                                                <td>84</td>
                                                <td id="sevenyear">...</td>
                                            </tr>
                                            <tr>
                                                <td>96</td>
                                                <td id="eightyear">...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PRIVACY POLICY -->

        </section>
    </main>
@endsection
@section('js_after')
    <script>
        function intrest(amount, duration, interest) {
            emi = amount * (interest / 1200) / (1 - (Math.pow(1 / (1 + (interest / 1200)), duration)));
            return Math.round(emi);
        }

        function cal() {
            var total = $("#total").val();
            var interest = $("#interest").val();
            var emi = intrest(total, 12, interest);
            $("#halfyear").html(intrest(total, 6, interest));
            $("#oneyear").html(intrest(total, 12, interest));
            $("#twoyear").html(intrest(total, 24, interest));
            $("#threeyear").html(intrest(total, 36, interest));
            $("#fouryear").html(intrest(total, 48, interest));
            $("#fiveyear").html(intrest(total, 60, interest));
            $("#sixyear").html(intrest(total, 72, interest));
            $("#sevenyear").html(intrest(total, 84, interest));
            $("#eightyear").html(intrest(total, 96, interest));

            console.log(Math.round(emi));

        }
    </script>

@endsection

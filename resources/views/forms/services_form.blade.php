    <form action="{{ route('services.store') }}" method="POST">

        @csrf
        @if (session('error'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>{{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>{{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name *" class="form-control" required
                        value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" name="model" placeholder="Vehicle Name *" class="form-control" required
                        value="{{ old('model') }}">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="tel" name="phone" placeholder="Phone Number *" class="form-control" required
                        value="{{ old('phone') }}">
                </div>
            </div>
            {{-- <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" id="datepicker" placeholder="Pick your date" class="form-control" required>
                </div>
            </div> --}}
             <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Id *" class="form-control" required
                        value="{{ old('email') }}">
                </div>
            </div>
            
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <select name="location_id" id="location_id" class="form-control" required>
                        <option value="">Select Location</option>
                        @foreach ($locations as $location)
                            <option
                                value="{{ $location->id }}"{{ old('location_id') == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Id *" class="form-control" required
                        value="{{ old('email') }}">
                </div>
            </div> --}}
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <!-- <input type="date" name="date" placeholder="Service Date" class="form-control"
                        value="{{ old('date') }}"> -->
                        <input type="text" required name="date" placeholder="Service Date" id="datepicker" class="form-control" value="{{ old('date') }}">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 order-575-2">
                <div class="form-group">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Type your Message....">{{ old('message') }}</textarea>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 order-575-1">
                <div class="form-group">
                    <input type="text" name="service_name" class="form-control" value="{{ $service->title }}"
                        readonly>
                </div>
            </div>

            {{-- <div class="form-group col-lg-4 text-center" style="overflow: hidden;">
               
                <!-- <input type="submit" name="submit" class="form-control submit-btn" value="Submit Form" required> -->
                <button type="submit" name="submit" class="form-control  pull-right submit-btn new-btn-style">
                    <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                        viewBox="0 0 21 14" fill="none">
                        <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <img src="{{asset('assets/abreco/images/shapes/right-white.webp')}}" class="d-none white" alt="">
                    Submit Form
                </button>
            </div>
            <div class="col-lg-4 col-md-12 ">
                <div class="form-group">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display(['data-theme' => 'light', 'required' => 'required']) !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <label style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                        </span>
                    @endif
                </div>

            </div> --}}
            <div class="col-lg-4 col-md-12 order-575-3">
                <div class="">
                    <div class="form-group">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display(['data-theme' => 'light', 'required' => 'required']) !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <label style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 order-575-4">
                <div class="form-group form-btn-style">
                    <!-- <input type="submit" name="submit" class="form-control submit-btn" value="Submit Form" required> -->
                    <button type="submit" name="submit" class="form-control submit-btn new-btn-style">
                        <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                            viewBox="0 0 21 14" fill="none">
                            <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <img src="{{asset('assets/abreco/images/shapes/right-white.webp')}}" class="d-none white" alt="">
                        Submit Form
                    </button>
                </div>

            </div>
        </div>
    </form>

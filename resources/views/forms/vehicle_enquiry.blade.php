    <form class="js-validation-exchange"  action="{{ route('enquiry.store') }}" method="post">
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
                    <input type="hidden" name="popup" value="0">
                    <input type="text" name="name" value="{{ @old('name') }}" placeholder="Your Name *" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                        <option value="">Select Vehicle *</option>
                        @foreach ($vehicles_list as $vehicle_data)
                            <option @if($vehicle_data->id == $vehicle->id) selected @endif value="{{ $vehicle_data->id }}">{{ $vehicle_data->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="tel" name="phone"  value="{{ @old('phone') }}" placeholder="Phone Number *" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="email" value="{{ @old('email') }}" name="email" placeholder="Email Id *" class="form-control" required>
                </div>
            </div>
           
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <textarea name="message"  cols="30" rows="10" placeholder="Type your Message...." required>{{ @old('message') }}</textarea>
                </div>
            </div>
            <input type="hidden" name='formPageName' class='formPageName' value=''>
            <input type="hidden" name="refer" value='{{@$refer}}'>
           
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <select name="location_id" id="location_id" class="form-control" required>
                        <option value="">Select Location *</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">
                                {{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-6" style="overflow: hidden;">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display(['data-theme' => 'light', 'required' => 'required']) !!}
                @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                        <label
                            style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                    </span>
                @endif
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="form-group">
                    <button type="submit" name="submit" class="form-control submit-btn new-btn-style">
                        <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="none">
                            <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> 
                        <img src="{{asset('assets/abreco/images/shapes/right-white.png')}}" class="d-none white" alt="">
                        Submit Form
                    </button>
                </div>
            </div>
        </div>
    </form>
   


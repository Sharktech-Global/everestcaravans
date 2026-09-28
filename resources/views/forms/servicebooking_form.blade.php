<form class="js-validation-service"  action="{{ route('sent_otp_service') }}" method="post">
    @csrf
    <div class="form-row">
        {{-- <input type="hidden" class="form-control" id="service_name" value="{{$slug}}" name="service_name" required> --}}
        <div class="form-group col-md-12">
            <label class="form-label  @error('model') is-invalid @enderror"
                for="reg_no">SERVICES *</label>
                <select required name="service_name" autocomplete="off" >
                    <option value="">Select Service</option>
                    @foreach ($our_services as $service)
                        <option value="{{ $service->slug }}">
                        {{ $service->title }}</option>       
                    @endforeach
                </select>
                @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('model') is-invalid @enderror" for="model">MODEL
                *</label>
            <input type="text" class="form-control" value="{{ @old('model') }}" id="model" name="model" required>
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label" for="reg_no">REGISTRATION NUMBER *</label>
            <input type="text" class="form-control" value="{{ @old('reg_no') }}" id="reg_no" name="reg_no" required>
            @error('reg_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label" for="service_date">SERVICE DATE *</label>
            <input type="date" class="form-control service_date" value="{{ @old('service_date') }}" id="service_date"
                name="service_date" required autocomplete="off">
            @error('service_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('name') is-invalid @enderror"
                for="your-name">YOUR NAME *</label>
            <input type="text" class="form-control" value="{{ @old('name') }}" id="name" name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('mobile') is-invalid @enderror"
                for="your-phone">YOUR PHONE *</label>
            <input type="text" class="form-control phone" value="{{ @old('mobile') }}" id="phone" name="mobile" required>
            @error('mobile')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label" for="select-location">SERVICE LOCATION *</label>
            <select
                class="form-control @error('service_location') is-invalid @enderror location  service-book-select" value="{{ @old('service_location') }}"
                id="service_location" name="service_location" data-parsley-errors-container="#select-errors" required>
                <option value="">Select location</option>
                @foreach ($service_locations as $service_location)
                    <option value="{{ $service_location->id }}">
                        {{ $service_location->name }}</option>
                @endforeach
            </select>
            @error('service_location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="select-errors"></div>

        </div>
        <input type="hidden" name='formPageName' class='formPageName' value=''>
        <div class="mb-0 form-group form-check col-md-12">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">
                I agree to the <a target="_blank" href="{{route('terms.show')}}" class="primaryColor">Terms & Conditions</a> and
                <a target="_blank" href="{{ route('privacy.show') }}" class="primaryColor">Privacy
                    Policy</a>.</label>
        </div>
        <input type="hidden" name="refer" value='{{@$refer}}'>
        <div class="form-group col-lg-12 mt-3" style="overflow: hidden;">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-theme' => 'dark', 'required' => 'required']) !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <label
                        style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                </span>
            @endif
        </div>
        <div class="form-group col-md-12 text-center">
            <button type="submit" class="button contact-btn">SEND</button>
        </div>
    </div>
</form>


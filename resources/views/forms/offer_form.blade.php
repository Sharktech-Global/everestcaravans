<form class="js-validation-service" action="{{ route('sent_otp_offer') }}" method="post">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="form-label" for="select-model">SELECT OFFER *</label>
            <select class="form-control @error('model') is-invalid @enderror" 
                id="select-model" name="model[]" required multiple data-parsley-errors-container="#model-error-block">
                @foreach ($offerdetails as $details)
                    <option value="{{ $details->model }}">{{ $details->model }} - {{'₹'.$details->offer}}</option>
                @endforeach
            </select>
            <div class="margin-top10" id="model-error-block"></div>
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label class="form-label @error('name') is-invalid @enderror" for="your-name">YOUR NAME *</label>
            <input type="text" class="form-control" value="{{ @old('name') }}" id="name" name="name" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label class="form-label @error('mobile') is-invalid @enderror" for="your-phone">YOUR PHONE *</label>
            <input type="text" class="form-control phone" value="{{ @old('mobile') }}" id="phone" name="mobile" required>
            @error('mobile')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label class="form-label" for="location">SELECT LOCATION *</label>
            <select class="form-control @error('location') is-invalid @enderror location" value="{{ @old('location') }}" id="location" name="location" required>
                @foreach ($areas_sales as $area)
                <option value="{{ $area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
            @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group form-check col-md-12">
            <input type="hidden" name="refer" value='{{@$refer}}'>

            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">
            I agree to the <a target="_blank" href="{{route('terms.show')}}" class="primaryColor">Terms & Conditions</a> and <a target="_blank" href="{{route('privacy.show')}}" class="primaryColor">Privacy Policy</a>.</label>
        </div>
        <div class="form-group col-lg-12">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-theme' => 'dark', 'required' => 'required']) !!}
            @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                <label style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
            </span>
            @endif
        </div>
        <div class="form-group col-md-12 text-right">
            <button type="submit" class="text-uppercase text-right">SEND</button>
        </div>
    </div>
</form>

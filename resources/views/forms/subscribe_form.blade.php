<form class="js-validation-subscribe" action="{{ route('sent_otp_subscribe') }}" method="post">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-3">
            <label class="form-label" for="select-model">SELECT MODEL *</label>
            <select class="form-control @error('model') is-invalid @enderror" value="{{ @old('model') }}" id="select-model" name="model" required>
                <option value="">SELECT MODEL</option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" @if (@$search == $vehicle->slug) selected @endif>
                        {{ $vehicle->name }}</option>
                @endforeach
            </select>
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label class="form-label @error('name') is-invalid @enderror" for="your-name">YOUR NAME *</label>
            <input type="text" class="form-control" value="{{ @old('name') }}" id="your-name" name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label class="form-label @error('phone') is-invalid @enderror" for="your-phone"
                data-parsley-length="[4, 16]">YOUR PHONE *</label>
            <input type="text" class="form-control phone" value="{{ @old('phone') }}" id="phone" name="phone" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3 locationdiv">
            <label class="form-label" for="select-location">SELECT LOCATION *</label>
            <select class="form-control location" value="{{ @old('location') }}" id="location" name="location" required>
                <option value="">Select location</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-0 form-group form-check col-md-12">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">
                I agree to the <a target="_blank" href="{{route('terms.show')}}" class="primaryColor">Terms & Conditions</a> and
                <a target="_blank" href="{{ route('privacy.show') }}" class="primaryColor">Privacy
                    Policy</a>.</label>
        </div>
        <div class="mt-3 form-group col-lg-12" style="overflow: hidden;">
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

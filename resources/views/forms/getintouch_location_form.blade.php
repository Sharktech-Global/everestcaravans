<form  action="{{route('sent_otp_getintouch_location')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-12">
            <select class="form-control @error('model') is-invalid @enderror" id="select-model" name="model" required>
                <option value="">SELECT MODEL</option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" @if (@$search == $vehicle->slug) selected @endif>
                        {{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <label class="form-label @error('name') is-invalid @enderror"
                for="your-name">YOUR NAME *</label>
            <input type="text" class="form-control" value="{{ @old('name') }}" id="your-name" name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <label class="form-label @error('phone') is-invalid @enderror" for="your-phone"
                data-parsley-length="[4, 16]">YOUR PHONE *</label>
            <input type="text" class="form-control phone" value="{{ @old('phone') }}" id="phone" name="phone" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="form-group col-md-12">
            <input type="hidden" name="location" id="location" value="{{ $location->id}}">
        </div> --}}
        <div class="form-group col-md-12">
            <label class="form-label" for="select-location">SELECT LOCATION *</label>
            <select class="form-control location" value="{{ @old('location') }}"id="buynewcarloc" name="location" required>
                <option value="">Select location</option>
                @foreach ($areas_sales as $areas)
                    <option @if($areas->name == @$area->name) selected @endif value="{{ $areas->id }}">{{ $areas->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name='formPageName' class='formPageName' value=''>
        <input type="hidden" name='formPageAdd' class='formPageAdd' value=''>
        <div class="mb-0 form-group form-check col-md-12">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <span class="form-check-label ml-20 text-white" for="exampleCheck1">I agree to the <a target="_blank"
                    href="{{ route('terms.show') }}" class="text-primary">Terms & Conditions</a> and
            <a target="_blank" href="{{ route('privacy.show') }}" class="text-primary">Privacy Policy</a></span>
        </div>
        <div class="form-group col-md-12 mt-3" style="overflow: hidden;">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-theme' => 'dark', 'required' => 'required']) !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <label
                        style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                </span>
            @endif
        </div>
        <div class="field-wrap text-right">
            <button type="submit" class="button button-block">SEND</button>
        </div>
    </div>
</form>
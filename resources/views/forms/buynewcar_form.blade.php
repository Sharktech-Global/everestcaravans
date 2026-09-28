<form  action="{{ route('sent_otp_buy_new_car') }}" method="post">
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
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </ul>
        </div>
    @endif
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="form-label  @error('model') is-invalid @enderror"
                for="reg_no">MODEL *</label>
                <select required name="model" autocomplete="off" >
                    @foreach ($vehicle_types as $vehicle)
                        <optgroup label="{{$vehicle->name}}">
                            @foreach ($vehicle->vehicles as $data)
                                <option @if( app('request')->input('id') == $data->id) selected @endif value="{{ $data->id }}" @if (@$search == $data->slug) selected @endif>
                                {{ $data->name }}</option>
        
                            @endforeach
        
                        </optgroup>
                    @endforeach
                </select>
                @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
        <div class="form-group col-md-12">
            <label class="form-label @error('name') is-invalid @enderror"
                for="your-name">YOUR NAME *</label>
            <input type="text" class="form-control"value="{{@old('name')}}" id="your-name" name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <label class="form-label @error('mobile') is-invalid @enderror" for="your-phone"
                data-parsley-length="[4, 16]">YOUR MOBILE *</label>
            <input type="tel" class="form-control phone" placeholder="+91" value="{{@old('phone')}}" id="phone" name="phone" required>
            @error('mobile')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <label class="form-label" for="select-location">LOCATION *</label>
            <select name="location" required autocomplete="off">
                <option value="">Select location</option>
                @foreach ($areas_sales as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <input type="hidden" name='formPageName' class='formPageName' value=''>
    <input type="hidden" name="refer" value='{{@$refer}}'>
    <div class="form-row">
        <div class="mt-3 form-group col-lg-12" style="overflow: hidden;">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-theme' => 'dark', 'required' => 'required']) !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <label style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                </span>
            @endif
        </div>
    </div>
     <div class="field-wrap text-center">
        <button type="submit" class="button button-block">SEND</button>
    </div>
</form>
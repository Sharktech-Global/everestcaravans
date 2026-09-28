<form class="js-validation-insurance" action="{{ route('sent_otp_insurance') }}" method="post">
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
            <label class="form-label" for="select-location">LOCATION *</label>
            <select class="form-control insurance-location" value="{{ @old('location') }}" id="insurance-location" name="location" required>
                <option value="">Select location</option>
                @foreach ($areas_sales as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label  @error('reg_no') is-invalid @enderror" for="reg_no">REGISTRATION NUMBER *</label>
            <input type="text" class="form-control" value="{{ @old('reg_no') }}" id="reg_no" name="reg_no" required>
            @error('reg_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('name') is-invalid @enderror" for="your-name">YOUR NAME *</label>
            <input type="text" class="form-control" value="{{ @old('name') }}"  id="your-name" name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('email') is-invalid @enderror" for="your-email">YOUR EMAIL *</label>
            <input type="email" class="form-control" value="{{ @old('email') }}" id="your-email" name="email" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('mobile') is-invalid @enderror" for="your-phone"
                data-parsley-length="[4, 16]">YOUR MOBILE *</label>
            <input type="text" class="form-control phone" value="{{ @old('mobile') }}" id="phone" name="mobile" required>
            @error('mobile')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-0 form-group form-check col-md-12">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <span class="form-check-label ml-20" for="exampleCheck1"> <span style="color: #FFFFFF">I agree to the <a target="_blank"
                    href="{{ route('terms.show') }}" class="primaryColor"><span style="color:#ff0000">Terms &
                        Conditions</a><span style="color: #FFFFFF"> and
            <a target="_blank" href="{{ route('privacy.show') }}" class="primaryColor"><span style="color:#ff0000">Privacy Policy</a></span>
        </div>
        <input type="hidden" name='formPageName' class='formPageName' value=''>
        <input type="hidden" name="refer" value='{{ @$refer }}'>
        <div class="mt-3 form-group col-lg-12" style="overflow: hidden;">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-theme' => 'dark', 'required' => 'required']) !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <label style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                </span>
            @endif
        </div>
        <div class="col text-center">
            <button type="submit" class="button button-block">SEND</button>
        </div>
    </div>
</form>

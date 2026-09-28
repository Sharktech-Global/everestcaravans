<form  action="{{ route('sent_otp_test_drive') }}" method="post">
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
    <div class="field-wrap">
        <label>
            MODEL<span class="req">*</span>
        </label>
        <input type="text" name="model" value="{{@old('model')}}" required autocomplete="off" />
        @error('model')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="field-wrap">
        <label>
            YOUR NAME<span class="req">*</span>
        </label>
        <input type="text" name="name" value="{{@old('name')}}" required autocomplete="off" />
    </div>
    <div class="field-wrap">
        <label>
            YOUR PHONE<span class="req">*</span>
        </label>
        <input type="tel" name="phone" class="phone"  placeholder="+91"value="{{@old('phone')}}" required autocomplete="off" />
    </div>
    <div class="field-wrap">
        <label>
            YOUR LOCATION<span class="req">*</span>
        </label>
        <select name="location" required autocomplete="off">
            <option value="">Select location</option>
            @foreach ($areas_sales as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name='formPageName' class='formPageName' value='book-a-test-drive-tab'>
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
    <button type="submit"  class="button button-block">SEND</button>
</form>

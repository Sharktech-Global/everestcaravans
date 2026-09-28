<form class="js-validation-talktoceo" action="{{ route('talk-to-ceo-send') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-12">
            {{-- <input type="hidden" name="model" value="{{ $vehicle->id}}"> --}}
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('name') is-invalid @enderror"
                for="your-name">YOUR NAME *</label>
            <input type="text" class="form-control" value="{{ @old('name') }}" id="your-name" name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label @error('email') is-invalid @enderror"
                for="your-email">Email *</label>
            <input type="text" class="form-control" value="{{ @old('email') }}" id="your-email" name="email" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label class="form-label @error('phone') is-invalid @enderror" for="your-phone"
                data-parsley-length="[4, 16]">YOUR PHONE *</label>
            <input type="text" class="form-control phone" value="{{ @old('phone') }}" id="phone" name="phone" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label class="form-label @error('subject') is-invalid @enderror"
                for="your-subject">Subject *</label>
            <input type="text" class="form-control"  value="{{ @old('subject') }}" id="your-subject" name="subject" required>
            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label class="form-label  @error('location') is-invalid @enderror" for="location">SELECT LOCATION *</label>
            <select class="form-control location  service-book-select" value="{{ @old('location') }}" id="location" name="location" data-parsley-errors-container="#select-errors" required>
                <option value="">Select location</option>
                @foreach($locations as $location)
                <option value="{{ $location->id}}">{{ $location->name}}</option>
                @endforeach
            </select>
            @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="select-errors"></div>
        </div>
        <div class="form-group col-md-12">
            <label class="form-label @error('message') is-invalid @enderror"
                for="your-message">Message *</label>
            <input type="text" class="form-control" value="{{ @old('message') }}" id="your-message" name="message" required>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-12 mb-0">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">
                I agree to the <a target="_blank" href="{{route('terms.show')}}" class="primaryColor">Terms & Conditions</a> and
                <a target="_blank" href="{{ route('privacy.show') }}" class="primaryColor">Privacy
                    Policy</a>.</label>
        </div>
        <input type="hidden" name="refer" value='{{@$refer}}'>

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
        <div class="text-right form-group col-md-12">
            <button type="submit" class="text-right text-uppercase">SEND</button>
        </div>
    </div>
</form>

<form action="{{ route('contact-us') }}" method="post">
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
        <div class="col-sm-12">
            <div class="form-group">
                <label class="text-white" class="form-label @error('name') is-invalid @enderror"
                    for="name">Name*</label>
                <input type="text" value="{{ @old('name') }}" class="form-control" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="text-white" class="form-label @error('email') is-invalid @enderror"
                    for="email">Email*</label>
                <input type="email" value="{{ @old('email') }}" class="form-control" name="email" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="text-white" class="form-label @error('phone') is-invalid @enderror"
                    for="phone">Phone*</label>
                <input type="text" value="{{ @old('phone') }}" placeholder="+91" class="form-control phone"
                    name="phone" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="text-white" class="form-label @error('message') is-invalid @enderror"
                    for="message">Message</label>
                <textarea style="height:100px;" type="textarea" class="form-control" name="message" row="4">{{ @old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
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
        <div class="col text-center">
            <button type="submit" class="button button-block">SUBMIT</button>
        </div>
    </div>

</form>

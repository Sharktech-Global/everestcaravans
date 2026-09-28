<form action="{{ route('career') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
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
    <div class="row">
        <div class="col-lg-6 pb-1 form-group">
            <label class="form-label" for="select-model">Select Opening *</label>
            <select id="career_openings" class="form-control bg-F4F4F4 @error('career') is-invalid @enderror" value="{{@old('career')}}"
                name="career" required>
                <option value="">Select Opening *</option>
                @foreach ($careers as $career)
                    <option value="{{ $career->id }}"
                        {{ @old('career') == $career->id ? 'selected' : '' }}>
                        {{ $career->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 pb-1 form-group">
            <label class="form-label" for="select-model">Name *</label>
            <input type="text"
                class="form-control bg-F4F4F4 @error('name') is-invalid @enderror"
                placeholder="" name="name" value="{{ @old('name') }}" required
                pattern="^[a-zA-Z\s]+$" minlength="3">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6 pb-1 form-group">
            <label class="form-label" for="select-model">Email Address *</label>
            <input type="email"
                class="form-control bg-F4F4F4 @error('email') is-invalid @enderror"
                placeholder="" name="email" value="{{ @old('email') }}" required
                pattern="^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6 pb-1 form-group">
            <label class="form-label" for="select-model">Phone Number *</label>
            <input type="text"
                class="form-control bg-F4F4F4 phone @error('phone') is-invalid @enderror"
                placeholder="" name="phone" value="{{ @old('phone') }}" required
                pattern="\+(?:[0-9] ?){6,14}[0-9]$">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6 pb-1 form-group">
            <label class="form-label" for="select-model">Educational Qualification *</label>
            <textarea
                class="form-control bg-F4F4F4 pt-3 @error('educational_qualification') is-invalid @enderror"
                rows="4" placeholder="" name="educational_qualification"
                required>{{ @old('educational_qualification') }}</textarea>
            @error('educational_qualification')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6 pb-1 form-group">
            <label class="form-label" for="select-model">Upload CV *</label>
            <input type="file"
                class="form-control bg-F4F4F4 m-0 @error('cv') is-invalid @enderror"
                placeholder='Upload Your CV *' name="cv" required />
            <small style="color:rgb(107, 107, 107)">
                {{-- <button class="btn btn-default btn-choose" type="button">Choose
                File</button> --}}
                PDF only*
            </small>
            @error('cv')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-lg-12">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-theme' => 'dark', 'required' => 'required']) !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <label
                        style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                </span>
            @endif
        </div>
    </div>
    <div class="field-wrap text-center">
        <button type="submit" class="button button-block">SEND</button>
    </div>
</form>
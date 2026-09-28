<form action="{{ route('locate-us.store') }}" class="py-5 my-5 call__form js-validation-home" id='locate-us' method="post"
    data-parsley-validate>
    @csrf
    <div class="row">
        <div class="pb-1 form-group col-lg-12 locationradio">
            <label class="float-left text-left checkbox-inline w-50">
                <input type="radio" value="buynewcar" name="service" required>NEW CAR SHOWROOM
            </label>
            <label class="float-left text-left checkbox-inline w-50">
                <input type="radio" value="service" name="service" required>SERVICE
            </label>
            <label class="float-left text-left checkbox-inline w-50">
                <input type="radio" value="usedcar" name="service" required>POPULAR USEDCARS
            </label>
            <label class="float-left text-left checkbox-inline w-50">
                <input type="radio" value="drivingschool" name="service" required>MARUTI DRIVING SCHOOLS
            </label>
        </div>
        <div class="pb-1 form-group col-lg-6 mb-2">
            <input type="text" class="form-control bg-F4F4F4 @error('name') is-invalid @enderror"
                placeholder="Your Name *" name="name" value="{{ @old('name') }}" required pattern="^[a-zA-Z\s]+$"
                minlength="3">
        </div>
        <div class="pb-1 form-group col-lg-6 mb-2">
            <input type="text" class="form-control bg-F4F4F4 phone @error('phone') is-invalid @enderror"
                placeholder="Your Number *" name="phone" id="phone" value="{{ @old('phone') }}" required
                pattern="\+(?:[0-9] ?){6,14}[0-9]$">
        </div>
        <div class="form-group col-lg-12 mb-2">
            <select class="form-control h-48 bg-F4F4F4 @error('location') is-invalid @enderror" name="location"
                required>
                <option value="">Select location *</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ @old('location') == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="text-left mt-2"><button type="submit" class="site-btn">LOCATE US <img class="d-inline-block"
                src="{{ asset('assets/images/logo/plain.png') }}" alt="locate us"></button>
    </div>
</form>

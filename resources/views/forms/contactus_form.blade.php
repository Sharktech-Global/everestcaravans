@php
    // The Contact and Factory Visit controllers pass $caravanTypes, but this
    // form is also included by the FAQ, Exchange and Services pages, whose
    // controllers do not — and the missing variable 500'd those three pages.
    // Falling back here keeps the form usable wherever it is dropped in.
    $caravanTypes = $caravanTypes ?? \App\VehicleType::where('status', 1)
        ->orderBy('name')
        ->get(['id', 'name']);
@endphp

<div class="order-2-991">
    <div class="ev-contact-form">
        <form action="{{ route('contact.store') }}"
        method="POST"
        id="fotcont">
        @csrf
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact-name">Full Name</label>
                    <input type="text" id="contact-name"
                        name="name" class="form-control"
                        placeholder="Enter your full name"
                        value="{{ old('name') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="contact-email">Email</label>
                    <input type="email" id="contact-email"
                        name="email" class="form-control"
                        placeholder="your@email.com"
                        value="{{ old('email') }}" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact-phone">Phone</label>
                    <input type="tel" id="contact-phone"
                        name="phone" class="form-control"
                        placeholder="+61 400 000 000"
                        value="{{ old('phone') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="contact-suburb">Suburb</label>
                    <input type="text" id="contact-suburb"
                        name="suburb" class="form-control"
                        placeholder="Enter your suburb"
                        value="{{ old('suburb') }}" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact-state">Select your state</label>
                    <select id="contact-state" name="state"
                            class="form-control" required>
                        <option value="">Select</option>
                        @foreach ([
                            'ACT' => 'Australian Capital Territory',
                            'NSW' => 'New South Wales',
                            'NT' => 'Northern Territory',
                            'QLD' => 'Queensland',
                            'SA' => 'South Australia',
                            'TAS' => 'Tasmania',
                            'VIC' => 'Victoria',
                            'WA' => 'Western Australia'
                        ] as $code => $state)
                            <option value="{{ $code }}"
                                @selected(old('state') == $code)>
                                {{ $state }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="vehicle_name">
                        Preferred Caravan Type <span class="text-danger">*</span>
                    </label>

                    <select name="vehicle_name" id="vehicle_name" class="form-control" required>
                        <option value="">Select Your Caravan Type</option>

                        @foreach ($caravanTypes as $type)
                            <option value="{{ $type->name }}"
                                @selected(old('vehicle_name') == $type->name)>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="contact-message">Message (optional)</label>
                    <textarea name="message"
                            id="contact-message"
                            class="form-control"
                            rows="4"
                            placeholder="Tell us how we can help">{{ old('message') }}</textarea>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                    @error('g-recaptcha-response')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="ev-contact-submit"
                            id="submitButton">Submit Now<svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg></button>
                </div>
            </div>
        </form>
    </div>
</div>
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
                    <label for="contact-vehicle">
                        Preferred Caravan Type
                    </label>
                    <select name="vehicle_name"
                            id="contact-vehicle"
                            class="form-control" required>
                        <option value="">Select</option>
                        @foreach (($vehicles ?? collect()) as $data)
                            <option value="{{ $data->name }}"
                                @selected(
                                    old('vehicle_name', $vehicle->name ?? '') == $data->name
                                )>
                                {{ $data->name }}
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
                <div class="form-group col-md-6">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                    @error('g-recaptcha-response')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 text-center">
                    <button type="submit" class="ev-contact-submit"
                            id="submitButton"> Submit </button>
                </div>
            </div>

            <div class="form-row">
            </div>
        </form>
    </div>
</div>

<div class="ev-contact-form">
    <form action="{{ route('factory-visit.store') }}"
          method="POST"
          id="factory-visit-form">

        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="visit-name">Full Name *</label>
                <input type="text" id="visit-name"
                       name="name" class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Enter your full name" required>
            </div>

            <div class="form-group col-md-6">
                <label for="visit-email">Email *</label>
                <input type="email" id="visit-email"
                       name="email" class="form-control"
                       value="{{ old('email') }}"
                       placeholder="your@email.com" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="visit-phone">Phone *</label>
                <input type="tel" id="visit-phone"
                       name="phone" class="form-control"
                       value="{{ old('phone') }}"
                       placeholder="+61 400 000 000" required>
            </div>

            <div class="form-group col-md-6">
                <label for="visit-date">Preferred Visit Date *</label>
                <input type="date" id="visit-date"
                       name="visit_date" class="form-control"
                       min="{{ now()->toDateString() }}"
                       value="{{ old('visit_date') }}" required>
            </div>
        </div>

        <div class="form-row">
            
            <div class="form-group col-md-6">
                <label for="visit-time">Preferred Time *</label>

                <select id="visit-time"
                        name="visit_time"
                        class="form-control"
                        required>

                    <option value="">Please Select Time</option>

                    @for ($hour = 9; $hour <= 14; $hour++)
                        @foreach ([0, 15, 30, 45] as $minute)

                            @if ($hour == 14 && $minute > 0)
                                @break
                            @endif

                            @php
                                $value = sprintf('%02d:%02d', $hour, $minute);
                                $label = date('g:i A', strtotime($value));
                            @endphp

                            <option value="{{ $value }}"
                                @selected(old('visit_time') == $value)>
                                {{ $label }}
                            </option>

                        @endforeach
                    @endfor

                </select>
            </div>


            <div class="form-group col-md-6">
                <label for="visit-suburb">Suburb *</label>
                <input type="text" id="visit-suburb"
                       name="suburb" class="form-control"
                       value="{{ old('suburb') }}"
                       placeholder="Enter your suburb" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="visit-state">State *</label>
                <select id="visit-state" name="state"
                        class="form-control" required>
                    <option value="">Select your state</option>

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
                <label for="visit-postcode">Postcode *</label>
                <input type="text" id="visit-postcode"
                       name="postcode" class="form-control"
                       inputmode="numeric" maxlength="4"
                       pattern="[0-9]{4}"
                       value="{{ old('postcode') }}"
                       placeholder="Enter 4-digit postcode" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="visit-vehicle">Caravan Type *</label>

                <select id="visit-vehicle"
                        name="vehicle_name"
                        class="form-control"
                        required>

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
                <label for="visit-requirements">
                    Additional Requirements (optional)
                </label>
                <textarea id="visit-requirements"
                          name="additional_requirements"
                          class="form-control"
                          rows="4"
                          placeholder="Tell us about any special requirements">{{ old('additional_requirements') }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display(['data-theme' => 'light']) !!}

                @error('g-recaptcha-response')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="ev-contact-submit">
            Request Factory Visit <svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
        </button>

        <p class="mt-3">
            <small>
                Your preferred date and time are subject to confirmation
                by the Everest Caravans team.
            </small>
        </p>
    </form>
</div>

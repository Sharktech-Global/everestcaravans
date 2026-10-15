<form action="{{ route('vehicles.booking-enquiry', $vehicle->slug) }}"
                                    method="POST"
                                    id="vehicle-booking-enquiry-form"
                                    class="w-100">
                                    @csrf

                                    <div class="row">
                                        <div class="col first">
                                            <input type="text" class="form-control"
                                                name="name" placeholder="Your Name"
                                                value="{{ old('name') }}" required>
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col second">
                                            <input type="email" class="form-control"
                                                name="email" placeholder="Email Address"
                                                value="{{ old('email') }}" required>
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col first">
                                            <input type="tel" class="form-control"
                                                name="phone" placeholder="Phone Number"
                                                value="{{ old('phone') }}" required>
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col second">
                                            <input type="hidden" class="form-control"
                                                value="{{ $vehicle->name }}"
                                                aria-label="Vehicle Name" readonly>
                                            <input type="text" class="form-control"
                                                name="suburb" placeholder="Suburb"
                                                value="{{ old('suburb') }}" required>
                                            @error('suburb') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col first">
                                            <select name="state" class="form-control" required>
                                                <option value="" disabled {{ old('state') ? '' : 'selected' }}>Select State</option>
                                                @foreach ([
                                                    'NSW' => 'New South Wales',
                                                    'VIC' => 'Victoria',
                                                    'QLD' => 'Queensland',
                                                    'WA'  => 'Western Australia',
                                                    'SA'  => 'South Australia',
                                                    'TAS' => 'Tasmania',
                                                    'ACT' => 'Australian Capital Territory',
                                                    'NT'  => 'Northern Territory'
                                                ] as $code => $state)
                                                    <option value="{{ $code }}" {{ old('state') === $code ? 'selected' : '' }}>
                                                        {{ $state }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col second">
                                            <input type="text" class="form-control"
                                                name="postcode" placeholder="Postcode"
                                                value="{{ old('postcode') }}"
                                                inputmode="numeric" maxlength="4" required>
                                            @error('postcode') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <textarea name="additional_details"
                                                    class="form-control"
                                                    rows="4"
                                                    placeholder="Additional Details (Optional)">{{ old('additional_details') }}</textarea>
                                            @error('additional_details')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display(['data-theme' => 'light']) !!}

                                            @error('g-recaptcha-response')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 button-wrapper text-center">
                                            @if (session('booking_enquiry_success'))
                                                <div class="alert alert-success">
                                                    {{ session('booking_enquiry_success') }}
                                                </div>
                                            @endif
                                            <button type="submit" class="ev-contact-submit ev-contact-submit--light">Submit Enquiry <svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg></button>
                                        </div>
                                    </div>
                                </form>
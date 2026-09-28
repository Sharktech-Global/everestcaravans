  <div class="col-lg-8 order-2-991">
      <div class="contact-form">
          <form action="{{ route('contact.store ') }}" method="POST" name="form1" id='fotcont'>
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
                  <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                          <input type="text" name="name" placeholder="Your Name *" class="form-control" required
                              value="{{ old('name') }}">
                          {{--  @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  --}}
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                          <select name="vehicle_name" id="vehicle_name" class="form-control" required>
                              <option disabled selected>Vehicle Name *</option>
                              @foreach ($vehicles as $data)
                                @if(@$vehicle)
                                  <option
                                      value="{{ @$data->name }}"{{ $vehicle->id == $data->id ? 'selected' : '' }}>
                                      {{ @$data->name }}</option>
                                @else
                                    <option
                                      value="{{ @$data->name }}"{{ old('vehicle_name') == $data->name ? 'selected' : '' }}>
                                      {{ @$data->name }}</option>
                                @endif
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                          <input type="tel" name="phone" id="phone" placeholder="Phone Number *"
                              class="form-control" required value="{{ old('phone') }}">
                          {{--  @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  --}}
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                          <input type="email" name="email" id="email" placeholder="Email Id *"
                              class="form-control" required value="{{ old('email') }}">
                          {{--  @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  --}}
                      </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                          <textarea name="message" id="message" cols="30" rows="10" placeholder="Type your Message....">{{ old('message') }}</textarea >
                          {{--  @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  --}}
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                      <div class="">
                          <div class="form-group">
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display(['data-theme' => 'light', 'required' => 'required']) !!}
                              @if ($errors->has('g-recaptcha-response'))
                                  <span class="help-block">
                                      <label style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                                  </span>
                              @endif
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-8 col-md-12">
                      <div class="form-group form-btn-style">
                          <!-- <input type="submit" name="submit" class="form-control submit-btn" value="Submit Form" required> -->
                          <button type="submit" name="submit" id='submitButton' class="form-control submit-btn new-btn-style" >
                              <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                  viewBox="0 0 21 14" fill="none">
                                  <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                      stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                              <img src="{{ asset('assets/abreco/images/shapes/right.svg') }}" class="d-none white"
                                  alt="">
                              Submit Form
                          </button>
                      </div>

                  </div>
              </div>

          </form>
      </div>
  </div>

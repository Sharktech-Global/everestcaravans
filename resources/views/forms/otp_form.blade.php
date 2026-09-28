<form class="js-validation-testdrive" id="enterotp-form"
                                        action="{{ route('verify_otp') }}" method="post" data-parsley-validate>
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label" for="your-name">ENTER OTP *</label>
                                                <input type="text" class="form-control otp" id="otp" name="otp" required
                                                    data-parsley-type="digits" minlength="6">
                                            </div>
                                            <input type="hidden" class="form-control mode" id="mode" name="mode">
                                            <input type="hidden" class="form-control enquiry_id" id="enquiry_id"
                                                name="enquiry_id">
                                            <div class="form-group col-md-12 text-right">
                                                <button type="submit" class="text-uppercase text-right">Submit</button>
                                            </div>
                                        </div>
                                    </form>
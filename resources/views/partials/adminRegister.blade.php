
<div class="modal fade" id="adregisterModal" tabindex="-1" role="dialog" aria-labelledby="adregisterModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adregisterModal">{{ __('Admin Registration') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <form class="" action="{{ route('admin.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="userName" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="userName" type="text" class="form-control" name="userName" value="{{ old('userName') }}"  autocomplete="userName" autofocus>

                            <span class="invalid-feedback" role="alert" id="nameError">
                                <strong></strong>
                            </span>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">

                            <span class="invalid-feedback" role="alert" id="emailError">
                                <strong></strong>
                            </span>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                            <span class="invalid-feedback" role="alert" id="passwordError">
                                <strong></strong>
                            </span>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" required autocomplete="name">
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="job" class="col-md-4 col-form-label text-md-right">{{ __('Job') }}</label>

                        <div class="col-md-6">
                            <input id="job" type="job" class="form-control" name="job" required autocomplete="firstName">
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="address" class="form-control" name="address" required autocomplete="lastName">
                        </div>
                    </div><br>

                    <input type="hidden" id="rolee" name="role" value="Admin">

                    
                    <div class="form-group row">
                        <label for="phonenumber" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <input id="phonenumber" type="phonenumber" class="form-control" name="phonenumber" required autocomplete="phonenumber">
                        </div>
                    </div><br>

                    <div class="form-group">
                      <label for="imagePath">Upload Photo: </label>
                      <input type="file" name="uploads" id="imagePath" class="form-control">
                  </div><br>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Admin Registration') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

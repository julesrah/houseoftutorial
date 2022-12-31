@extends('layouts.base')
@extends('layouts.app')
@section('content')

<body>
<div class="col-lg-4 col-md-4">
          <form action="{{ route('login') }}" method="POST"  id="login_form" class="request-form ">
                @csrf
                <h2>Login</h2>
                <div id="show_error" style="color: red"> </div>

                <div class="form-group mr-2">
                    <label for="" class="label">Email</label>
                    <input type="email" name="email" class="form-control" >
                    <span class="text-danger error-text email_error" 
                    style="color: red"></span>
                </div>

                <div class="form-group mr-2">
                    <label for="" class="label">Password</label>
                    <input type="password" name="password" class="form-control" 
                    >
                    <span class="text-danger error-text password_error" 
                    style="color: red"></span>
                </div>

                <div class="form-group">
                <input type="submit" value="Login" class="btn  py-3 px-4" 
                style="background-color: #5f76e8; color:#ffffff">
                </div>
                </form>
</div>

@endsection
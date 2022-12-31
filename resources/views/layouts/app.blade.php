<!DOCTYPE html>
<html>
<head>
<title>House of Tutorial</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
  height: 100%;
  font-family: "Inconsolata", sans-serif;
}

.bgimg {
  background-position: center;
  background-size: cover;
  background-image: url("storage/images/background.jpg");
  min-height: 75%;
}

.menu {
  display: none;
}
</style>
</head>
<body>
                        @guest

                        <div class="w3-top">
                            <div class="w3-row w3-padding w3-black">
                                <div class="w3-col s2">
                                <a href="{{ url('/') }}" class="w3-button w3-block w3-black">HOME</a>
                                </div>
                                <div class="w3-col s2">
                                <a href="{{ url('/instrument') }}" class="w3-button w3-block w3-black">SHOW INSTRUMENT</a>
                                </div>
                                <div class="w3-col s2">
                                <a href="{{ url('/instructor') }}" class="w3-button w3-block w3-black">SHOW INSTRUCTORS</a>
                                </div>
                                <div class="w3-col s2">
                                <a href="{{ url('/client') }}" class="w3-button w3-block w3-black">SHOW CLIENT</a>
                                </div>
                                <div class="w3-col s2">
                                <a href="{{ url('/service') }}" class="w3-button w3-block w3-black">SHOW SERVICES</a>
                                </div>
                            </div>
                            </div>



                        <li class="nav-item">   
                          <a class="nav-link" style="font-size:50px;color:white;">|</a>
                        </li>

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact; font-size:20px;color:whitesmoke;" href="#">{{ __('Login') }}</a>
                                </li>
                            @endif
           

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact; font-size:20px;color:whitesmoke;" href="#">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @endguest
                    </ul>
                <!-- </div> -->
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
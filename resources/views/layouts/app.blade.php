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
                        @auth

                        <div class="w3-top">
                            <div class="w3-row w3-padding w3-black">
                                <div class="w3-col s2">
                                <a href="{{ url('/') }}" class="w3-button w3-block w3-black">HOME</a>
                                </div>

                                <div class="w3-col s2">
                                <a href="{{ url('/shop') }}" class="w3-button w3-block w3-black">MAKE AN APPOINTMENT</a>
                                </div>

                                <div class="w3-col s3 w3-dropdown-hover">
                                    <button class="w3-button w3-block w3-black">SHOW</button>
                                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                                    <a href="{{ url('/instrument') }}" id= "SHinstrument" class="w3-button w3-block w3-black">SHOW INSTRUMENT</a>
                                    <a href="{{ url('/instructor') }}" id= "SHinstructor" class="w3-button w3-block w3-black">SHOW INSTRUCTORS</a>
                                    <a href="{{ url('/client') }}" id= "SHclient" class="w3-button w3-block w3-black">SHOW CLIENT</a>
                                    <a href="{{ url('/service') }}" id= "SHservice" class="w3-button w3-block w3-black">SHOW SERVICES</a>
                                    <!-- <a href="{{ url('/record') }}" id= "SHservice" class="w3-button w3-block w3-black">SHOW RECORDS</a> -->
                                    </div>
                                </div>

                                <div class="w3-col s3">
                                    <a class="w3-button w3-block w3-black" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('LOGOUT') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            </div>



                        <li class="nav-item">   
                          <a class="nav-link" style="font-size:25px;color:white;"></a>
                        </li>
                        @else

                        <div class="w3-top">
                            <div class="w3-row w3-padding w3-black">
                                <div class="w3-col s2">
                                <a href="{{ url('/') }}" class="w3-button w3-block w3-black">HOME</a>
                                </div>
                            </div>
                        </div>

                        @endauth
                    </ul>
                <!-- </div> -->
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @yield('scripts')
        </main>
    </div>
</body>
</html>
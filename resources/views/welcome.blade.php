@include('partials.clientRegister')
@include('partials.login')
@include('partials.adminRegister')

<!DOCTYPE html>
<html>
<head>
<title>House of Tutorial</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>
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


<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="w3-col s3">
      <a href="#home" class="w3-button w3-block w3-black">Home</a>
    </div>
    <div class="w3-col s3">
      <a href="#about" class="w3-button w3-block w3-black">About</a>
    </div>
    <div class="w3-col s3">
    <a href="{{ url('/dashboard') }}"class="w3-button w3-block w3-black">Dashboard</a>
    </div>
    

        <div class="w3-col s3 w3-dropdown-hover">
        <button class="w3-button">Login/ Signup</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          
          <a class="w3-bar-item w3-button" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#loginModal">{{ __('Login') }}</a>
          <a class="w3-bar-item w3-button" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#clregisterModal">{{ __('Client Registration') }}</a>
          <a class="w3-bar-item w3-button" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#adregisterModal">{{ __('Admin Registration') }}</a>
        </div>


    </div>  
  </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Opens from 8am to 5pm</span>
  </div>
  <div class="w3-display-middle w3-center">
  </div>
  <div class="w3-display-bottomright w3-center w3-padding-large">
    <span class="w3-tag">Km. 14, East Service Road, S Luzon Expy, Taguig, 1630 Metro Manila</span>
  </div>
</header>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

<!-- About Container -->
<div class="w3-container" id="about">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">ABOUT HOUSE OF TUTORIAL</span></h5>
    <p>The House of Tutorial is transforming how the world learns music by providing personal music lessons through live interactions between instructors and students.</p>
    <p>In addition, we provide high-quality music lessons 1-on-1 personally. Professional music teachers and tutors help you achieve your musical goals.</p>
    <div class="w3-panel w3-leftbar w3-light-grey">
      <p><i>"I was scared of playing guitar at first but with House of Tutorial, they made it very easy to learn."</i></p>
      <p>Guitarist and Student: Jake Heavens</p>
    </div>
    <img src="storage/images/music.png" style="width:100%;max-width:1000px" class="w3-margin-top">
    <p><strong>Opening hours:</strong> everyday from 8am to 5pm.</p>
    <p><strong>Address:</strong> Km. 14, East Service Road, S Luzon Expy, Taguig, 1630 Metro Manila</p>
  </div>
</div>

<!-- Menu Container -->
<div class="w3-container" id="menu">
  <div class="w3-content" style="max-width:700px">
 
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">INFORMATION</span></h5>
  
    <div class="w3-row w3-center w3-card w3-padding">
      <a href="javascript:void(0)" onclick="openMenu(event, 'Instructors');" id="myLink">
        <div class="w3-col s6 tablink">Our Instructors</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'Branches');">
        <div class="w3-col s6 tablink">Our Branches</div>
      </a>
    </div>

    <div id="Instructors" class="w3-container menu w3-padding-48 w3-card">
      <h5>Andy Lim</h5>
      <p class="w3-text-grey">Guitar Professional</p><br>
    
      <h5>Angcul Lang</h5>
      <p class="w3-text-grey">Piano Professional</p><br>
    
      <h5>Mae Chizmiz</h5>
      <p class="w3-text-grey">Violin Professional</p><br>
    
      <h5>Dilly Man</h5>
      <p class="w3-text-grey">Drums Professional</p><br>
    
      <h5>etc..</h5>
      <p class="w3-text-grey">and others</p>
    </div>

    <div id="Branches" class="w3-container menu w3-padding-48 w3-card">
      <h5>Taguig, Metro Manila</h5>
      <p class="w3-text-grey">main branch</p><br>
    
      <h5>Bacoor, Cavite</h5>
      <p class="w3-text-grey">Managed by Jules Horca</p><br>
    
      <h5>Makati, Metro Manila</h5>
      <p class="w3-text-grey">Managed by Meantonette Medalla</p><br>
    
      <h5>Nasugbu, Batangas</h5>
      <p class="w3-text-grey">Managed by Allanis Grace</p><br>
    
    </div>  
    <img src="storage/images/note.jpg" style="width:100%;max-width:1000px;margin-top:32px;">
  </div>
</div>

<!-- Contact/Area Container -->
<div class="w3-container" id="where" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">WHERE TO FIND US</span></h5>
    <p>Find us at some address at some place.</p>
    <img src="storage/images/loc.png" class="w3-image" style="width:100%">
    <p><span class="w3-tag">FYI!</span> We offer full-service tutorial for any time, weekdays or weekends. We understand your needs and we will give quality service to satisfy the biggest criteria of them all.</p>


<script>
// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-dark-grey";
}
document.getElementById("myLink").click();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>


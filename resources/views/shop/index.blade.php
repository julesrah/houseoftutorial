@extends('layouts.service')
@extends('layouts.app')
@section('content')

<h1>Make an Appointment</h1>
    <div id="cart-container">
      <div id="cart">
        <i class="fa fa-shopping-cart fa-2x openCloseCart" aria-hidden="true"></i>
        <button id="emptyCart">Empty Cart</button>
      </div>
      <span id="serviceCount"></span>
    </div>
 

  <div id="shoppingCart">
    <div id="cartServicesContainer">
      <h2>Items in your cart</h2>
      <i class="fa fa-times-circle-o fa-3x openCloseCart" aria-hidden="true"></i>
      <div id="cartServices">
      </div>
      <button class="btn btn-primary" id="checkout">Checkout</button>
      <span id="cartTotal"></span>
  	</div>
  </div>

  <nav>
  	<ul>
  		<li><a href="index.html">Shopping Cart</a></li>
  	</ul>
  </nav>
  <div class="container container-fluid" id="services">
  	
  </div>


@endsection
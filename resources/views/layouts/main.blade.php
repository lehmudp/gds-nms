
<!DOCTYPE html>
<html>
<head>
	<title>GDS Notification</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,800" rel="stylesheet">
	<!-- Bootstrap Package-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!-- Moment -->	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
	<!-- VueJS -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<!-- Axios -->
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<!-- Main CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
  	@section('script')
  	@show
</head>
<body>
	<div class="container-fluid main-div" id="app" v-cloak>
		@if (Route::currentRouteName() == "index")
			<div class="side-menu">
				<div class="menu-item unselectable-text" data-toggle="tooltip" data-placement="right" title="Carrier" v-on:click="showCarriers = !showCarriers" v-bind:class="{ active: showCarriers }">
					<svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					    <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
					</svg>
				</div>
				<div class="menu-item">
					<img class="logo" src="{{ asset('img/gds.png') }}"/>
				</div>
				<div class="menu-item unselectable-text"  data-toggle="tooltip" data-placement="right" title="NTT">
					<svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-broadcast" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					    <path fill-rule="evenodd" d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707zm2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 0 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708zm5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708zm2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707z"/>
					    <path d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
					</svg>
				</div>
			</div>
			<transition name="slide">
				<div class="side-menu carrier-menu" v-if="showCarriers">
					<!-- TO DO: Carrier list display -->
				</div>
			</transition>
		@else
			<div class="side-menu">
				<div class="menu-item unselectable-text" data-toggle="tooltip" data-placement="right" title="Customer">
					<svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-person-badge-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
					</svg>
				</div>
				<div class="menu-item">
					<img class="logo" src="{{ asset('img/gds.png') }}"/>
				</div>
				<div class="menu-item unselectable-text"  data-toggle="tooltip" data-placement="right" title="Supplier">
					<svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-reception-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					    <path d="M0 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-8zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-11z"/>
					</svg>
				</div>
			</div>
		@endif
	    @section('content')
	  	@show
	</div>	
</body>
</html>



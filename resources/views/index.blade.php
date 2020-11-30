@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/index.css')}}">
<script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')
<div class="side-menu">
	<div class="menu-item unselectable-text" data-toggle="tooltip" data-placement="right" title="Carrier" v-on:click="showCarrierMenu()" v-bind:class="{ active: showCarriers }">
		<svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		    <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
		</svg>
	</div>
	<div class="menu-item">
		<img class="logo" src="{{ asset('img/gds.png') }}" onclick="window.location='/customer'"/>
	</div>
	<div class="menu-item unselectable-text"  data-toggle="tooltip" data-placement="right" title="NTT" v-on:click="showModal('NTT')">
		<svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-broadcast" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		    <path fill-rule="evenodd" d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707zm2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 0 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708zm5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708zm2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707z"/>
		    <path d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
		</svg>
	</div>
</div>
<transition name="slide">
	<div class="side-menu carrier-menu" v-if="showCarriers">
		<div class="menu-item unselectable-text" v-for="carrier in carrierList">
			<p v-on:click="showModal(carrier)">@{{carrier}}</p>
		</div>
	</div>
</transition>
<transition name="slide">
	<div class="supplier-content" v-if="showSupplier" v-bind:class="{ wide: wideContent }">
		<div v-for="(value, propertyName) in modalContent">
			<h3>@{{ propertyName }}</h3>
			<table class="table table-bordered">
			    <thead>
				    <tr>
				        <th scope="col"><pre>Item</pre></th>
				        <th scope="col" v-for="item in value" class="table-align">
				        	<pre>@{{formatText(item.level)}}</pre>
				    	</th>
				    </tr>
			    </thead>
			    <tbody>
				    <tr>
				        <th scope="row"><pre>Name</pre></th>
				        <th scope="col" v-for="item in value">
				        	<pre>@{{item.contact_name}}</pre>
				        </th>
				    </tr>
				    <tr>
				        <th scope="row"><pre>Title</pre></th>
				        <th scope="col" v-for="item in value">
				        	<pre>@{{formatText(item.contact_title)}}</pre>
				    	</th>
				    </tr>
				    <tr>
				        <th scope="row"><pre>Email</pre></th>
				        <th scope="col" v-for="item in value">
				        	<pre>@{{formatText(item.contact_email)}}</pre>
				    	</th>
				    </tr>
				    <tr>
				        <th scope="row"><pre>Phone Number</pre></th>
				        <th scope="col-md-3"  v-for="item in value">
				        	<pre>@{{formatText(item.contact_phone_number)}}</pre>
				        </th>
				    </tr>
			    </tbody>
			</table>
			<div v-for="item in value">
				<p class="carrier-note">@{{formatText(item.note)}}</p>
			</div>
    	</div>
		
	</div>
</transition>
<div class="content-wrapper" v-on:click="showCarriers = false" v-bind:class="{ dim: showCarriers == true }">
    <div class="row circuit-selection">
		<div class="company-input col-md-4 offset-md-1">
		  	<div class="circuit-input-prepend">
		    	<label class="input-group-text" for="company-name">Company Name</label>
		  	</div>
		  	<select class="custom-select circuit-select" id="company-name" v-model="formData.companyName" @change="companySelected()">
		    <option 
		    v-for="item in customerList"
		    v-bind:value="item.customer">
		    @{{item.customer}}
		    </option>
		  </select>
		</div>
		<div class="circuit-input col-md-6">
		  	<div class="circuit-input-prepend">
		    	<label class="input-group-text" for="circuit-name">Circuit Name</label>
		  	</div>
		  	<select class="custom-select circuit-select" id="circuit-name" v-model="selectedCircuit" @change="circuitSelected()">
		    	<option v-for="circuit in circuitList" v-bind:value="circuit">@{{circuit.name}}</option>
		  	</select>
		</div>
	</div>
	<!-- Form Input Section -->
	<div class="row custoner-component">
		<div class="col-md-3 noselect" 
		v-for="type in types"
	    v-bind:key="type"
	    v-bind:class="['type-button', { active: currentType === type }]"
	    v-on:click="currentType = type"
		><h4 class="unselectable-text">@{{ type }}</h4></div>
		<div class="col-md-12 email-content">
			<form>
				<div class="form-group">
				  	<div class="col-md-4 offset-md-4">
				  		<label class="float-left font-weight-light unselectable-text" for="form-number">Company</label>
				    	<input type="text" v-model="formData.companyName" class="form-control" id="form-number" readonly>
				  	</div>
				</div>
				<div class="form-group">
				  	<div class="col-md-4 offset-md-4">
					    <label class="float-left font-weight-light unselectable-text" for="form-ticket">Trouble Ticket Number</label>
					    <input type="text" v-model="formData.ticketNumber" class="form-control" id="form-ticket">
				  	</div>
				</div>
				<div class="form-group">
				  	<div class="col-md-4 offset-md-4">
					    <label class="float-left font-weight-light unselectable-text" for="form-circuit">Affected Circuit</label>
					    <input type="text" v-model="formData.circuitName" class="form-control" id="form-circuit" readonly>
				  	</div>
				</div>
			    <div class="form-group">
				  	<div class="col-md-4 offset-md-4">
					    <label class="float-left font-weight-light unselectable-text" for="form-start-time">Start Time</label>
					    <input type="text" v-model="formData.startTime" class="form-control" id="form-start-time">
				  	</div>
			    </div>
			    <div class="form-group" v-if="recovered">
				  	<div class="col-md-4 offset-md-4">
					    <label class="float-left font-weight-light unselectable-text" for="form-end-time">End Time</label>
					    <input type="text" v-model="formData.endTime" class="form-control" id="form-end-time">
				  	</div>
			    </div>
			    <div class="form-group" v-if="!recovered">
				  	<div class="col-md-4 offset-md-4">
					    <label class="float-left font-weight-light unselectable-text" for="form-status">Current Status</label>
					    <textarea  type="text" v-model="formData.status" class="form-control" id="form-status" rows="3">Down</textarea>
				    </div>
			    </div>
			    <div class="form-group" v-if="!recovered">
				  	<div class="col-md-4 offset-md-4">
					    <label class="float-left font-weight-light unselectable-text" for="form-action">Current Action</label>
					    <textarea  type="text" v-model="formData.actionText" class="form-control" id="form-action" rows="3">
						</textarea>
				    </div>
				</div>
			    <div class="form-group">
				  	<div class="col-md-4 offset-md-4">
					    <label class="float-left font-weight-light unselectable-text" for="form-reason">Reason for Outage</label>
					    <textarea  type="text" v-model="formData.reasonText" class="form-control" id="form-reason" rows="3"></textarea>
			    	</div>
			    </div>
			  	<div class="form-group"><button type="button" v-on:click="compose()" class="btn btn-primary">Compose Email</button></div>
			</form>
		</div>
	</div>
</div>
@endsection

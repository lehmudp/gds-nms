@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/index.css')}}">
<script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper" v-on:click="showCarriers = false" v-bind:class="{ dim: showCarriers == true }">
    <div class="row circuit-selection">
		<div class="company-input col-md-4 offset-md-1">
		  	<div class="circuit-input-prepend">
		    	<label class="input-group-text" for="company-name">Company Name</label>
		  	</div>
		  	<select class="custom-select circuit-select" id="company-name" v-model="formData.companyName" @change="companySelected()">
		    <option selected v-bind:value="''">Choose...</option>
		    <option 
		    v-for="(company,key) in circuits"
		    v-bind:value="key">
		    @{{key}}
		    </option>
		  </select>
		</div>
		<div class="circuit-input col-md-6">
		  	<div class="circuit-input-prepend">
		    	<label class="input-group-text" for="circuit-name">Circuit Name</label>
		  	</div>
		  	<select class="custom-select circuit-select" id="circuit-name" v-model="formData.circuitName">
		    	<option v-for="(circuit,value) in circuitList" v-bind:value="circuit.Line">@{{circuit.Line}}</option>
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

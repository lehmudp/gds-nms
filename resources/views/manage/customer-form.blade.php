@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer.css')}}">
<script src="{{ asset('js/customer-form.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper circuit-form" v-cloak>
	<div v-if="this.currentRoute == 'new'"><h4>Add New Circuit</h4></div>
	<div v-else><h4>@{{title}}</h4></div>
	<div class="alert update-message" v-if="showUpdateMessage"  v-bind:class="[updateSuccess ? 'alert-success' : 'alert-danger']" role="alert">@{{updateMessage}}</div>
	<form class="needs-validation">
		<div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">NTT's CID</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.ntt_cid" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.ntt_cid)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Circuit Name</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.name" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.name)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Customer</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.customer" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.customer)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Carrier Name</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.carrier_name" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.carrier_name)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Service Name</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.service_name" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.service_name)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">TT2 ID</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.tt2_id">
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Province</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.province" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.province)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Site Description</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="circuit.site_description" aria-describedby="helpBlock"></textarea>
		    	<small v-if="validateField(circuit.site_description)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Address</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="circuit.address"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Al Type</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.al_type" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.al_type)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Type of Cable</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.cable_type" aria-describedby="helpBlock">
		    	<small v-if="validateField(circuit.cable_type)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Customer Contact</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="circuit.customer_contact" aria-describedby="helpBlock"></textarea>
		    	<small v-if="validateField(circuit.customer_contact)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="circuit.recipient_to" aria-describedby="helpBlock"></textarea>
		    	<small v-if="validateField(circuit.recipient_to)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Email CC</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="circuit.recipient_cc"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Email BCC</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="circuit.recipient_bcc"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">PO Number</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="circuit.po_number">
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">PO Description</label>
		    <div class="col-sm-4">
		    	<textarea type="text" class="form-control" id="colFormLabel" v-model="circuit.po_description"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Config</label>
		    <div class="col-sm-4">
		    	<textarea type="text" class="form-control" id="colFormLabel" v-model="circuit.config"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Note</label>
		    <div class="col-sm-4">
		    	<textarea type="text" class="form-control" id="colFormLabel" v-model="circuit.note"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Last Updated</label>
		    <div class="col-sm-4">
		    	<textarea type="text" class="form-control" id="colFormLabel" v-model="circuit.update_note"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<button type="button" v-on:click="updateCircuit()" class="btn btn-primary">
			    <span v-if="this.currentRoute == 'new'">Create New Circuit</span>
			    <span v-else>Update Circuit</span>
			</button>
		</div>
	</form>
</div>
@endsection

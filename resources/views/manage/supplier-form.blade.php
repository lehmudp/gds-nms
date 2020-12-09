@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/supplier.css')}}">
<script src="{{ asset('js/supplier-form.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper supplier-form" v-cloak>
	<div v-if="this.currentRoute == 'new'"><h4>Add New Supplier</h4></div>
	<div v-else><h4>@{{title}}</h4></div>
	<div class="alert update-message" v-if="showUpdateMessage"  v-bind:class="[updateSuccess ? 'alert-success' : 'alert-danger']" role="alert">@{{updateMessage}}</div>
	<form class="needs-validation" novalidate>
		<div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Supplier Name</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="supplier.supplier_name">
		    	<small v-if="validateField(supplier.supplier_name)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Supplier Level</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="supplier.level" aria-describedby="helpBlock">
		    	<small v-if="validateField(supplier.level)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Contact Name</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="supplier.contact_name" aria-describedby="helpBlock">
		    	<small v-if="validateField(supplier.contact_name)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Contact Title</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="supplier.contact_title" aria-describedby="helpBlock">
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Contact Phone Number</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="supplier.contact_phone_number" aria-describedby="helpBlock">
		    	<small v-if="validateField(supplier.contact_phone_number)" id="helpBlock" class="form-text text-danger"> This field is required</small>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Contact Email</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="supplier.contact_email">
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Group Key</label>
		    <div class="col-sm-4">
		    	<input type="text" class="form-control" id="colFormLabel" v-model="supplier.group_key">
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Group Value</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="supplier.group_value"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<label for="colFormLabel" class="col-sm-2 col-form-label">Note</label>
		    <div class="col-sm-4">
		    	<textarea type="text" row="3" class="form-control" id="colFormLabel" v-model="supplier.note"></textarea>
		    </div>
	    </div>
	    <div class="form-group row form-item">
	    	<button type="button" v-on:click="updateSupplier()" class="btn btn-primary">
			    <span v-if="this.currentRoute == 'new'">Create New</span>
			    <span v-else>Update Supplier</span>
			</button>
		</div>
	</form>
</div>
@endsection

@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/supplier.css')}}">
<script src="{{ asset('js/supplier.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
	<div class="row supplier-selection">
		<div class="col-md-4">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
		    		<label class="input-group-text" for="inputGroupSelect01">Supplier Selection</label>
		    	</div>
		    	<select class="custom-select" id="inputGroupSelect01" v-model="selectedSupplier">
		    		<option v-for="(supplier, key) in suppliers" v-bind:value="supplier">
		    			@{{key}}
		    		</option>
		    	</select>
			</div>
		</div>
		<div class="cold-md-2">
			<button type="button" class="btn btn-outline-primary" @click="addNew()">Add</button>
		</div>
	</div>
	<div class="supplier-list">
		<table class="table">
			<tr>
				<th scope="col">Supplier Name</th>
				<th scope="col">Level</th>
				<th scope="col">Contact Name</th>
				<th scope="col">Contact Title</th>
				<th scope="col">Group</th>
				<th scope="col"></th>
			</tr>
			<tr v-for="item in selectedSupplier">
				<td>@{{ item.supplier_name }}</td>
				<td>@{{ formatText(item.level) }}</td>
				<td>@{{ item.contact_name }}</td>
				<td>@{{ item.contact_title }}</td>
				<td>@{{ item.group_value }}</td>
				<td>
					<button type="button" class="btn btn-outline-dark" v-on:click="edit(item.id)">Edit</button>
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection

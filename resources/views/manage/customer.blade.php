@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer.css')}}">
<script src="{{ asset('js/customer.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
	<div class="row create-new">
		<div class="align-text input-group">
			<button type="button" class="btn btn-outline-secondary" @click="addItem()">Add New</button>
			<div class="button-separator">Or</div>
			<div>
				<input type="file" ref="file" @change="handleFileUpload($event)" style="display: none">
				<button type="button" @click="$refs.file.click()" v-bind:class="[hasFile ? 'btn-success' : 'btn-outline-success', 'btn']">@{{fileStatus}}</button>
			</div>
			<button type="button" class="btn btn-outline-primary" @click="uploadFile()" style="margin-left: 10px;">Upload</button>
		</div>
	</div>
	<div class="row upload-dialog-box" v-if="showDialogMessage">
		@{{uploadDialog}}
	</div>
	<div class="row circuit-list">
		<table class="table">
			<tr>
				<th scope="col">NTT CID</th>
				<th scope="col">Circuit Name</th>
				<th scope="col">Customer</th>
				<th scope="col">Carrier Name</th>
				<th scope="col">Service Name</th>				
				<th scope="col">Site Description</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
			<tr v-for="circuit in circuitData">
				<td>@{{ circuit.ntt_cid }}</td>
				<td>@{{ circuit.name }}</td>
				<td>@{{ circuit.customer }}</td>
				<td>@{{ circuit.carrier_name }}</td>
				<td>@{{ circuit.service_name }}</td>
				<td>@{{ circuit.site_description }}</td>
				<td>
					<button type="button" class="btn btn-outline-info" v-on:click="editItem(circuit.id)">Edit</button>
				</td>
				<td>
					<button type="button" class="btn btn-outline-danger" v-on:click="deleteItem(circuit.id)">Delete</button>
				</td>
			</tr>
		</table>
	</div>
</div>

@endsection

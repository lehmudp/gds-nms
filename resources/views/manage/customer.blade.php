@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer.css')}}">
<script src="{{ asset('js/customer.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
	<div class="row create-new">
		<div class="col-md-1 offset-md-4 align-text">
			<button type="button" class="btn btn-outline-dark">Add Circuit</button>
		</div>
		<div class="col-md-1 align-text" style="line-height: 38px;">Or</div>
		<div class="input-group col-md-3">
			<div class="custom-file">
			    <input type="file" class="custom-file-input" id="file-input" @change="handleFileUpload($event)">
			    <label class="custom-file-label" for="file-input">@{{ fileName }}</label>
			</div>
			<div class="input-group-append">
			    <span class="input-group-text default-cursor" @click="uploadFile()">Upload</span>
			</div>
		</div>
	</div>
	<div class="circuit-list">
		<table class="table">
			<tr>
				<th scope="col">NTT CID</th>
				<th scope="col">Circuit Name</th>
				<th scope="col">Customer</th>
				<th scope="col">Site Description</th>
				<th scope="col">AL Type</th>
				<th scope="col">Button</th>
			</tr>
			<tr v-for="circuit in circuitData">
				<td>@{{ circuit.ntt_cid }}</td>
				<td>@{{ circuit.name }}</td>
				<td>@{{ circuit.customer }}</td>
				<td>@{{ circuit.site_description }}</td>
				<td>@{{ circuit.al_type }}</td>
				<td>@Button</td>
			</tr>
		</table>
	</div>
</div>

@endsection

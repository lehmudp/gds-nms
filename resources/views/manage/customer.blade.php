@extends('layouts.main')

@section('script')
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer.css')}}">
<script src="{{ asset('js/customer.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
	<div class="customer-tools">
		<button type="button" v-bind:class="[isFilter ? 'btn-primary' : 'btn-secondary', 'btn']" @click="isFilter = true">Filter</button>
		<button type="button" v-bind:class="[isFilter ? 'btn-secondary' : 'btn-primary', 'btn']" @click="isFilter = false">Add & Import</button>
	</div>
	<div class="sub-tools" v-if="isFilter">
	  	<select class="custom-select" v-model="selectedCustomer">
		    <option v-for="(item, key) in customerList" v-bind:value="item">@{{key}}</option>
	    </select>
	</div>
	<div class="sub-tools" v-if="!isFilter">
		<div class="input-group">
			<button type="button" class="btn btn-outline-primary" @click="addItem()">Add New</button>
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
				<th scope="col">Site Description</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
			<tr v-for="(circuit, index) in selectedCustomer">
				<td>@{{ circuit.ntt_cid }}</td>
				<td>@{{ circuit.name }}</td>
				<td>@{{ circuit.site_description }}</td>
				<td>
					<button type="button" class="btn btn-outline-info" v-on:click="editItem(circuit.id)">Edit</button>
				</td>
				<td>
					<button type="button" class="btn btn-outline-danger" v-on:click="deleteItem(circuit.id, index)">Delete</button>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- Delete confirmation modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please confirm deletion for this item.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" @click="confirmDelete()">Confirm</button>
        <button type="button" class="btn btn-secondary" @click="cancelDelete()">Cancel</button>
      </div>
    </div>
  </div>
</div>
@endsection

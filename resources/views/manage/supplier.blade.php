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
			<button type="button" class="btn btn-outline-primary" @click="addItem()">Add</button>
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
				<th scope="col"></th>
			</tr>
			<tr v-for="(item, index) in selectedSupplier">
				<td>@{{ item.supplier_name }}</td>
				<td>@{{ formatText(item.level) }}</td>
				<td>@{{ item.contact_name }}</td>
				<td>@{{ item.contact_title }}</td>
				<td>@{{ item.group_value }}</td>
				<td>
					<button type="button" class="btn btn-outline-info" v-on:click="editItem(item.id)">Edit</button>
				</td>
				<td>
					<button type="button" class="btn btn-outline-danger" v-on:click="deleteItem(item.id, index)">Delete</button>
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

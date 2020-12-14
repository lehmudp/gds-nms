window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			currentRoute: '',
		    suppliers: {},
		    selectedSupplier: [],
		    itemForDelete: {
		    	id: '',
		    	index: ''
		    }
	    },
	    methods: {
	    	initializePage() {
	    		axios.get('api/supplier/group')
	    		.then(response => {
                   this.suppliers = response.data;
                })
				.catch(response => {
                   console.log(response);
                });
	    	},
	    	formatText(str) {
	    		return str.replaceAll(">", " ");
	    	},
	    	editItem(id) {
	    		window.location = '/supplier/edit/' + id; 
	    	},
	    	addItem() {
	    		window.location = '/supplier/new'; 
	    	},
	    	deleteItem(id, index) {
	    		this.itemForDelete.id = id;
	    		this.itemForDelete.index = index;
	    		$('#deleteModal').modal('show');
	    	},
	    	cancelDelete() {
	    		this.itemForDelete.id = '';
	    		this.itemForDelete.index = '';
	    		$('#deleteModal').modal('hide');
	    	},
	    	confirmDelete() {
                axios.delete('api/supplier/delete/' + this.itemForDelete.id)
	    		.then(response => {
                   this.selectedSupplier.splice(this.itemForDelete.index, 1);
                   $('#deleteModal').modal('hide');
                })
				.catch(response => {
                   console.log(response);
                });
	    	}
	    },
	    created() {
	    	this.currentRoute = window.location.pathname;
	    	this.initializePage();	
	    },
	})

	$(function () {
	    $('[data-toggle="tooltip"]').tooltip();
	});
}
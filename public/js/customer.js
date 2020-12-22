window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			currentRoute: '',
			isFilter: true,
			customerList: [],
			selectedCustomer: {},
			fileStatus: 'Select File',
	  		file: '',
	  		hasFile: false,
	  		showDialogMessage: false,
	  		uploadDialog: '',
	  		circuitData: [],
		    itemForDelete: {
		    	id: '',
		    	index: ''
		    }
	    },
	    methods: {
	    	handleFileUpload: function(event) {
	    		if (event.target.files.length !== 0) {
		    		this.file = event.target.files[0];
		    		this.fileName = this.file.name.substring(0,10) + "...";
		    		this.hasFile = true;
		    		this.fileStatus = 'File Loaded'
	    		}
		    },
	    	uploadFile: function() {
	    		let formData = new FormData();
	    		formData.append('file', this.file);
	    		axios.post('/import', formData)
	    		.then(response => {
                   this.showDialogMessage = true;
                   this.uploadDialog = "Data file uploaded successfully."
                   setTimeout(function() {
                		this.showDialogMessage = false;
                		location.reload();   
    			   }, 2000); 
                })
				.catch(response => {
                   console.log(response);
                });
	    	},
	    	editItem(id) {
	    		window.location = '/circuit/edit/' + id; 
	    	},
	    	addItem() {
	    		window.location = '/circuit/new'; 
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
                axios.delete('api/circuit/delete/' + this.itemForDelete.id)
	    		.then(response => {
                   this.selectedCustomer.splice(this.itemForDelete.index, 1);
                   $('#deleteModal').modal('hide');
                })
				.catch(response => {
                   console.log(response);
                });
	    	}
	    },
	    created() {
	    		this.currentRoute = window.location.pathname;
	    		axios.get('api/circuit/group')
	    		.then(response => {
                   this.customerList = response.data;
                   console.log(this.customerList);
                })
				.catch(response => {
                   console.log(response);
                });
	    },
	})

	$(function () {
	    $('[data-toggle="tooltip"]').tooltip();
	});
}
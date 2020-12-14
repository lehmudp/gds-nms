window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			currentRoute: '',
			isFilter: true,
			customerList: [],
			selectedCustomer: {},
			deleteArray: [],
			fileStatus: 'Select File',
	  		file: '',
	  		hasFile: false,
	  		showDialogMessage: false,
	  		uploadDialog: '',
	  		circuitData: [],
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
	    	deleteItem() {
	    		
	    	}
	    },
	    computed: {
	    	hasItemsForDelete() {
	    		return this.deleteArray.length > 0;
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
window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			currentRoute: '',
			fileName: 'Import file',
	  		file: '',
	  		showDialogMessage: false,
	  		uploadDialog: '',
	  		circuitData: [],
	  		pagination: {
	  			nextPage: '',
	  			previousPage: ''
	  		}
	    },
	    methods: {
	    	handleFileUpload: function(event) {
	    		this.file = event.target.files[0];
	    		this.fileName = "File loaded"; 
		    },
	    	uploadFile: function() {
	    		let formData = new FormData();
	    		formData.append('file', this.file);
	    		console.log('Here');
	    		axios.post('/import', formData)
	    		.then(response => {
	    			console.log(response);
                   this.showDialogMessage = true;
                   this.uploadDialog = "Data file uploaded successfully."
                   setTimeout(function() {
                		this.showDialogMessage = false;
                		location.reload();   
    			   }, 3000); 
                })
				.catch(response => {
                   console.log(response);
                });
	    	},
	    	edit(id) {
	    		// window.location = '/supplier/edit/' + id; 
	    	}
	    },
	    created() {
	    		this.currentRoute = window.location.pathname;
	    		axios.get('api/circuit/all')
	    		.then(response => {
                   this.circuitData = response.data.data;
                   this.pagination.nextPage = response.data.next_page_url;
                   this.pagination.previousPage = response.data.prev_page_url;
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
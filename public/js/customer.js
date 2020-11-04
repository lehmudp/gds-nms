window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			fileName: 'Import file',
	  		file: '',
	  		circuitData: [],
	  		pagination: {
	  			nextPage: '',
	  			previousPage: ''
	  		}
	    },
	    methods: {
	    	handleFileUpload: function(event) {
	    		this.file = event.target.files[0];
	    		this.fileName = this.file.name; 
		    },
	    	uploadFile: function() {
	    		let formData = new FormData();
	    		formData.append('file', this.file);
	    		axios.post('/import', formData)
	    		.then(response => {
                   console.log(response);
                })
				.catch(response => {
                   console.log(response);
                });
	    	}
	    },
	    created() {
	    		axios.get('api/circuit/all')
	    		.then(response => {
                   this.circuitData = response.data.data;
                   this.pagination.nextPage = response.data.next_page_url;
                   this.pagination.previousPage = response.data.prev_page_url;
                   console.log(this.circuitData);
                   console.log(this.pagination);
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
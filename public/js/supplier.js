window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			currentRoute: '',
		    suppliers: {},
		    selectedSupplier: {},
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
	    	deleteItem() {
    //             axios.get('api/supplier/delete')
	   //  		.then(response => {
    //                this.suppliers = response.data;
    //                console.log(this.suppliers)
    //             })
				// .catch(response => {
    //                console.log(response);
    //             });
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
window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			currentRoute: '',
		    suppliers: {},
		    selectedSupplier: {},
	    },
	    methods: {
	    	formatText(str) {
	    		return str.replaceAll(">", " ");
	    	},
	    	edit(id) {
	    		window.location = '/supplier/edit/' + id; 
	    	}
	    },
	    created() {
	    		this.currentRoute = window.location.pathname;
	    		axios.get('api/supplier/group')
	    		.then(response => {
                   this.suppliers = response.data;
                   console.log(this.suppliers)
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
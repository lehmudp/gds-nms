window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			title: '',
			supplier: {
				id: '',
				supplier_name: '',
				level: '',
				contact_name: '',
				contact_title: '',
				contact_phone_number: '',
				contact_email: '',
				group_key: '',
				group_value: '',
				note: '',
			},
			showUpdateMessage: false,
			updateSuccess: true,
			updateMessage: '',
			validated: true,
	    },
	    methods: {
	    	updateSupplier() {
	    		this.showUpdateMessage = false;
	    		validationFields = [this.supplier.supplier_name, this.supplier.level, this.supplier.contact_name, this.supplier.contact_phone_number]
	    		for ( i=0; i<validationFields.length; i++) {
					if (validationFields[i] == '' || validationFields[i] == null) {
    					this.validated = false;
    					return;
					}
					this.validated = true;
				}
	    		if (this.validated == true) {
		    		axios.post('/api/supplier/update', {
		    			supplier: this.supplier
		    		})
		    		.then(response => {
		    		this.title = this.supplier.supplier_name + ' ' + this.supplier.level;
	                   if (this.supplier.group_value !== '' && this.supplier.group_value !== null) {
	                   		this.title = this.title + ' - ' + this.supplier.group_value;
	                   }  
		    			this.showMessage(response.status);
	                })
					.catch(response => {
	                   this.showMessage(response.status);
	                });
	    		}
	    	},
	    	showMessage(code) {
    			window.scrollTo({ top: 0, behavior: 'smooth' });
	    		this.showUpdateMessage = true;
	    		if (code == '200') {
	    			this.updateMessage = 'Supplier data updated successfully'
	    			this.updateSuccess = true;
	    		}  
	    		else {
	    			this.updateMessage = 'Supplier data update failed';
	    			this.updateSuccess = false;
	    		}
	    	},
	    	validateField(data){
	    		return data == '';
	    	}
	    },
	    created() {
    		this.currentRoute = window.location.pathname;
    		this.currentRoute = this.currentRoute.split('supplier/')[1];
	    	if (this.currentRoute !== 'new') {
	    		id = this.currentRoute = this.currentRoute.split('edit/')[1];
	    		axios.get('/api/supplier/' + id)
	    		.then(response => {
                   this.supplier = response.data[0];
                   this.title = this.supplier.supplier_name + ' ' + this.supplier.level;
                   if (this.supplier.group_value !== '' && this.supplier.group_value !== null) {
                   		this.title = this.title + ' - ' + this.supplier.group_value;
                   }  
                })
				.catch(response => {
                   console.log(response);
                });
	    	}
	    },
	})

	$(function () {
	    $('[data-toggle="tooltip"]').tooltip();
	});
}
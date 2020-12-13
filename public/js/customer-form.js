window.onload = function () {
	var app = new Vue({
		el: '#app',
		data: {
			title: '',
			circuit: {
				id: '',
				address: '',
				al_type: '',
				cable_type: '',
				carrier_name: '',
				config: '',
				customer: '',
				customer_contact: '',
				name: '',
				note: '',
				ntt_cid: '',
				po_description: '',
				po_number: '',
				province: '',
				recipient_bcc: '',
				recipient_cc: '',
				recipient_to: '',
				service_name: '',
				site_description: '',
				tt2_id: '',
				update_note: ''
			},
			showUpdateMessage: false,
			updateSuccess: true,
			updateMessage: '',
			validated: true,
	    },
	    methods: {
	    	updateCircuit() {
	    		this.showUpdateMessage = false;
	    		validationFields = [this.circuit.ntt_cid, this.circuit.name, this.circuit.customer, this.circuit.service_name, this.circuit.carrier_name, this.circuit.province, this.circuit.site_description, this.circuit.al_type, this.circuit.cable_type, this.circuit.customer_contact]
	    		for ( i=0; i<validationFields.length; i++) {
					if (validationFields[i] == '' || validationFields[i] == null) {
    					this.validated = false;
    					return;
					}
					this.validated = true;
				}
	    		if (this.validated == true) {
		    		axios.post('/api/circuit/update', {
		    			circuit: this.circuit
		    		})
		    		.then(response => {
                   		this.title = this.circuit.customer + ' (' + this.circuit.carrier_name + ' - ' + this.circuit.service_name + ') - site: ' + this.circuit.province;  
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
	    			this.updateMessage = 'Circuit updated successfully'
	    			this.updateSuccess = true;
	    		}  
	    		else {
	    			this.updateMessage = 'Circuit update failed';
	    			this.updateSuccess = false;
	    		}
	    	},
	    	validateField(data){
	    		return data == '';
	    	}
	    },
	    created() {
    		this.currentRoute = window.location.pathname;
    		this.currentRoute = this.currentRoute.split('circuit/')[1];
	    	if (this.currentRoute !== 'new') {
	    		id = this.currentRoute = this.currentRoute.split('edit/')[1];
	    		axios.get('/api/circuit/' + id)
	    		.then(response => {
                   this.circuit = response.data[0];
                   this.title = this.circuit.customer + ' (' + this.circuit.carrier_name + ' - ' + this.circuit.service_name + ') - site: ' + this.circuit.province;  
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
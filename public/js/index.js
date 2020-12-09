window.onload = function () {
	var app = new Vue({
	    el: '#app',
	    data: {
		    currentType: 'Occurrence',
		    types: ['Occurrence', 'Status', 'Recovery', 'RFO'],
		    // Modal Toggle Bool
		    showCarriers: false,
		    showSupplier: false,
		    carrierTitle: '',
		    modalContent: {},
		    wideContent: false,
		    hasCircuitInfo: false,
		    // Carrier & NTT information for Side Menu
		    supplier: {},
		    carrierList: [],
		    // Circuit information for Form Submission
		    customerList: [],
		    circuitList: [],
		    selectedCircuit: '',
		    formData: {
		    	companyName: '',
		    	ticketNumber: '',
		    	circuitName: '',
		    	status: 'Down',
		    	actionText: 'Now Investigating',
		    	reasonText: 'Under investigation',
		    	circuitSite: 'Default',
		    	startTime: '',
		    	endTime: '',
	    	},
	    },
	    computed: {
	    // Check circuit status tab to hide elements, returns true if circuit is Down 
	    	recovered: function () {
	    		return this.currentType === 'Recovery' || this.currentType === 'RFO';
	    	},
	  	},
	    methods: {
	    	dismissAll() {
				this.showCarriers = false;
		    	this.showSupplier = false;
	    	},
	    	formatText(str) {
	    		if (str == null) {
	    			return;
	    		}
	    		str = str.trim();
	    		return str.replaceAll(">", "\n");
	    	},
	    	showCarrierMenu: function () {
	    		this.wideContent = false;
				this.showSupplier = false;
				this.showCarriers = !this.showCarriers;
	    	},
		  	showModal: function(currentSupplier) {
		  		if (currentSupplier == "NTT") {
		  			if (this.wideContent) {
			  			this.showSupplier = false;
			  			this.wideContent = false;
			  			return
			  		} else {
			  			this.wideContent = true;
			  			this.showCarriers = false;
			  		}
		  		} else {
		  			this.wideContent = false;
			  		this.carrierTitle = currentSupplier;

		  		}
	  			this.showSupplier = true;
		  		this.modalContent = this.suppliers[currentSupplier];
		  	},
	  		// Display drop down list for circuits once a company is selected
		  	companySelected: function() {
		  		axios.get('api/circuit/company/' + this.formData.companyName)
		    		.then(response => {
			    		this.circuitList = response.data;
			    		this.hasCircuitInfo = false;
		            })
					.catch(response => {
		               console.log(response);
	            })
		  	},
		  	circuitSelected: function() {
		  		this.hasCircuitInfo = true;
		  		this.formData.companyName = this.selectedCircuit.customer;
		  		this.formData.circuitName = this.selectedCircuit.carrier_name + ' - ' + this.selectedCircuit.service_name;
		  		this.formData.circuitSite = this.selectedCircuit.province;
		  	},
		  	durationCalculator: function() {
		  		diffMs = (new Date(this.formData.endTime) - new Date(this.formData.startTime));
		  		diffDays = Math.floor(diffMs / 86400000); // days
				diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
				diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
				
		  		this.formData.startTime = moment(this.formData.startTime).format('DD/MMM/YYYY hh:mm A');
		  		this.formData.endTime = moment(this.formData.endTime).format('DD/MMM/YYYY hh:mm A');

				if (diffDays > 0) {
					return diffDays + ' days ' + diffHrs + ' hours ' + diffMins + ' minutes'
				} else if (diffDays == 0 && diffHrs > 0) {
					return diffHrs + ' hours ' + diffMins + ' minutes'				
				} else if (diffDays == 0 && diffHrs == 0 && diffMins > 0) {
					return diffMins + ' minutes'				
				}
		  	},
		    // Email body based on notification type
		    emailBody: function () {
		  		duration = this.durationCalculator();
		    	bodyText = {
		    		"Occurrence": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe regret to inform you that there is an outage on your network.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D Site: ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0ACurrent Status: ' + this.formData.status + '%0D%0ACurrent Action: ' + this.formData.actionText + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',
		    		"Status": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe would like to update status of your network outage.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D Site: ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0ACurrent Status: ' + this.formData.status + '%0D%0ACurrent Action: ' + this.formData.actionText + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',
		    		"Recovery": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe would like to update status of your network outage.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D Site: ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0AEnd Time: ' + this.formData.endTime + '%0D%0ADuration: ' + duration + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',
		    		"RFO": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe would like to update status of your network outage.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D Site: ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0AEnd Time: ' + this.formData.endTime + '%0D%0ADuration: ' + duration + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',		
		    	}
		    	return bodyText[this.currentType]
		    },
		    getRecipient: function () {
				email = "mailto:" + this.selectedCircuit['recipient_to'] + "?";
		  		if (this.selectedCircuit['recipient_cc'] !== '' && this.selectedCircuit['recipient_cc'] !== null) {
		  					  		console.log(this.selectedCircuit['recipient_cc'])
			  		email = email + "cc=" + this.selectedCircuit['recipient_cc'] + "&";
		  		}
		  		if (this.selectedCircuit['recipient_bcc'] !== '' && this.selectedCircuit['recipient_bcc'] !== null) {
			  		console.log(this.selectedCircuit['recipient_bcc']);
		  			email = email + "bcc=" + this.selectedCircuit['recipient_bcc'] + "&";
		  		}
		  		return email;
		    },
		  	compose: function() {
		  		email = this.getRecipient();
		  		this.formData.companyName = this.formData.companyName.replace("&", "%26");
	         	subject = '[Outage report - ' + this.currentType + '] ' + this.formData.companyName + ' ( ' + this.formData.circuitName + ' ) (Ticket No: ' + this.formData.ticketNumber + ') %2D site ' + this.formData.circuitSite;
	         	body = this.emailBody();
	        	document.location = email + "subject=" + subject + "&body=" + body;
		  	},
		},
		created() {
    		axios.get('api/supplier/all')
    		.then(response => {
    			this.suppliers = response.data;
               	for (var item in response.data) {
               		if (item  != "NTT") {
               			this.carrierList.push(item);
               		}
               	}
            })
			.catch(response => {
               console.log(response);
            }),
            axios.get('api/customer/all')
    		.then(response => {
    			this.customerList = response.data;
            })
			.catch(response => {
               console.log(response);
            })
	    },
	})

	$(function () {
	    $('[data-toggle="tooltip"]').tooltip();
	});

	$('#circuitInformationModal').on('shown.bs.modal', function () {
  		$('#myInput').trigger('focus')
	});
}
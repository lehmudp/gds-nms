const circuitData = { 
    "circuit": {
        "Acecook": [
            {"Line":"Line Name - VNPT"},
            {"Line":"Line Name - FPT"},
            {"Line":"Line Name - Viettel"}
        ],
        "Boramtek": [
            {"Line":"Line Name - CMC"}
        ],
        "Uniqlo": [
            {"Line":"Line Name - Viettel"},
            {"Line":"Line Name - NetNam"},
        ]
    }
}


window.onload = function () {
	var app = new Vue({
	  el: '#app',
	  data: {
	    currentType: 'Occurrence',
	    types: ['Occurrence', 'Status', 'Recovery', 'RFO'],
	    circuits: circuitData.circuit,
	    circuitList: [],
	    formData: {
	    	companyName: '',
	    	ticketNumber: '',
	    	circuitName: '',
	    	status: 'Down',
	    	actionText: '',
	    	reasonText: '',
	    	circuitSite: 'Default',
	    	startTime: '',
	    	endTime: '',
	    }
	  },
	  computed: {
	    // Default value for "Current Action" field
		actionTextComputed: function () {
	    	return this.currentType === 'Occurrence' ? 'Now Investigating' : "-	List task which is done\n-	List task which is doing\n-	List task which will do (if possible)"
	    },
	    // Default value for "Reason for Outage" field
	    reasonTextComputed: function () {
	    	return this.currentType === 'RFO' ? 'Detail of reason' : "Under investigation";
	    },
	    // Check circuit status tab to hide elements, returns true if circuit is Down 
	    recovered: function () {
	    	return this.currentType === 'Occurrence' || this.currentType === 'Status';
	    },
	  },
	  methods: {
	  	// Display drop down list for circuits once a company is selected
	  	companySelected: function() {
	  		if (this.formData.companyName == '') {
	  			this.formData.circuitName = '';
	  			this.circuitList = [];
	  		} 
	  		else this.circuitList = this.circuits[this.formData.companyName];
	  	},
	    // Email body based on notification type
	    emailBody: function () {
	  		this.formData.actionText = this.actionTextComputed;
	  		this.formData.reasonText = this.reasonTextComputed;
	    	bodyText = {
	    		"Occurrence": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe regret to inform you that there is an outage on your network.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0ACurrent Status: ' + this.formData.status + '%0D%0ACurrent Action: ' + this.formData.actionText + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',
	    		"Status": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe would like to update status of your network outage.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0ACurrent Status: ' + this.formData.status + '%0D%0ACurrent Action: ' + this.formData.actionText + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',
	    		"Recovery": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe would like to update status of your network outage.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0AEnd Time: ' + this.formData.endTime + '%0D%0ADuration: ' + this.formData.endTime + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',
	    		"RFO": 'OUTAGE %2D ' + this.currentType.toUpperCase() + '%0D%0A%0D%0ADear Mr/Ms,%0D%0ACompany: ' + this.formData.companyName + '.%0D%0AThank you for using our service.%0D%0AWe would like to update status of your network outage.%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0ATrouble Ticket No: ' + this.formData.ticketNumber + '%0D%0AAffected Circuit: ' + this.formData.circuitName + ' %2D ' + this.formData.circuitSite + '%0D%0AStart Time: ' + this.formData.startTime + '%0D%0AEnd Time: ' + this.formData.endTime + '%0D%0ADuration: ' + this.formData.endTime + '%0D%0AReason for Outage: ' + this.formData.reasonText + '%0D%0A%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%2D%0D%0A%0D%0ABest Regards%0D%0A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A Please do NOT reply to this mail %2A%2A%2A%2A%2A%2A%2A%2A%2A%2A',		
	    	}
	    	return bodyText[this.currentType]
	    },
	  	compose: function() {
	  		email = 'sample@gmail.com';
         	subject = '[Outage report - ' + this.currentType + '] ' + this.formData.companyName + ' ( ' + this.formData.circuitName + ' ) (Ticket No: ' + this.formData.ticketNumber + ') %2D site ' + this.formData.circuitSite;
        	document.location = "mailto:" + email + "?subject=" + subject + "&body=" + this.emailBody();
	  	},
	  },
	})
}
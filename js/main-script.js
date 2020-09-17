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
	    currentType: 'Occurance',
	    types: ['Occurance', 'Status', 'Recovery', 'RFO'],
	    circuits: circuitData.circuit,
	    circuitList: [],
	    formData: {
	    	companyName: '',
	    	ticketNumber: '',
	    	circuitName: '',
	    	status: 'Down',
	    	actionText: '',
	    	reasonText: '',
	    }
	  },
	  computed: {
	    // Default value for "Current Action" field
		actionTextComputed: function () {
	    	return this.currentType === 'Occurance' ? 'Now Investigating' : "-	List task which is done\n-	List task which is doing\n-	List task which will do (if possible)"
	    },
	    // Default value for "Reason for Outage" field
	    reasonTextComputed: function () {
	    	return this.currentType === 'RFO' ? 'Detail of reason' : "Under investigation";
	    },
	    // Check circuit status tab to hide elements, returns true if circuit is Down 
	    recovered: function () {
	    	return this.currentType === 'Occurance' || this.currentType === 'Status';
	    }
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
	  	compose: function() {
	  		this.formData.actionText = this.actionTextComputed;
	  		this.formData.reasonText = this.reasonTextComputed;
	  		console.log(this.formData);
	  	},
	  },
	})
}
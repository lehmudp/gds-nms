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
	    companyName: '',
	    circuitList: [],
	    circuitName: '',
	  },
	  computed: {
	    actionText: function () {
	    	if (this.currentType === 'Occurance') {
	        	return 'Now Investigating'
	    	}
	    	else {
	    		return "-	List task which is done\n-	List task which is doing\n-	List task which will do (if possible)"
	    	}
	    },
	    reasonText: function () {
	    	if (this.currentType === 'RFO') {
	        	return 'Detail of reason'
	    	}
	    	else {
	    		return "Under investigation"
	    	}
	    },
	    recovered: function () {
	    	return this.currentType === 'Occurance' || this.currentType === 'Status';
	    }
	  },
	  methods: {
	  	companySelected: function () {
	  		if (this.companyName == '') {
	  			this.circuitName = '';
	  			this.circuitList = [];
	  		} 
	  		else this.circuitList = this.circuits[this.companyName];
	  	},
	  },
	})
}
Vue.component('type-occurance', { 
	template: '<div>Occurance component</div>' 
})
Vue.component('type-status', { 
	template: '<div>Status component</div>' 
})
Vue.component('type-recovery', { 
	template: '<div>Recovery component</div>' 
})
Vue.component('type-rfo', { 
	template: '<div>RFO component</div>' 
})

window.onload = function () {
	var app = new Vue({
	  el: '#app',
	  data: {
	    currentType: 'Occurance',
	    types: ['Occurance', 'Status', 'Recovery', 'RFO']
	  },
	  computed: {
	    currentTypeComponent: function () {
	      return 'type-' + this.currentType.toLowerCase()
	    }
	  }
	})
}
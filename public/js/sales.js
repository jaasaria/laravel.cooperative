

	var vm =  new Vue({
	  el: '#appDirect',
	  data: {
	    isProcessing: false,
	    errors: {},
	    withErrors:false,
	    form: {
				id:'',
				crudstat:''

			},
	    selected: 0
    	
	  },

	  created: function () {
	    Vue.set(this.$data, 'form', _form);
	  },

	  methods: {           

	    onSubmit: function() {
	      this.isProcessing = true;
	      this.withErrors = false;
	      this.errors = {};
	      this.$http.post('/sales',  this.form).then(function (response) {

	          if(response.data.created) {
	            
	            swal({
	              title: "Success",
	              text: "Record was successfully saved.",
	              type: "success",
	              closeOnConfirm: true,
	              showLoaderOnConfirm: true,
	            },
	            function(){
	              window.location = '/sales/';
	            });

	          } else {
	            this.isProcessing = false;
	            this.withErrors = true;
	          }

	      }, function (response) {
	          console.log('Error!:', response.data);
	          this.isProcessing = false;
	          this.withErrors = true;
	          Vue.set(this.$data, 'errors', response.data);
	      });
	    },


	    addRow: function(){
	        try {
	                this.form.rows.push({item_id: '',qty: 1, cost: 0,subtotal:0 });
	            } catch(e)
	            {
	                console.log(e);
	                alert('error');
	            }
	    },

	    deleteRow: function(row){
	      try {
	      	  	var index = this.form.rows.indexOf(row)
	            this.form.rows.splice(index,1);
	          } catch(e)
	          {
	              console.log(e);
	              alert('error');
	          }
	      },

	    onChangeSubTotal:function(row){
	          row.subtotal = row.qty * row.cost;
	      },

	      onChange:function(row){
	        var ItemId = row.item_id;

	        // GET /someUrl
	        this.$http.get('/api/item/' + ItemId).then((response) => {
	          var obj = JSON.parse(response.body);
	          row.cost = obj[0]['cost'];
	        }, (response) => {
	          console.log(response);
	          alert('error');
	        });
	      }

	  },

	  computed: {

	     trsubtotal:function () {
	            var tot =  0 ;
	            tot =  this.form.rows.reduce(function(carry, row) {
	              return carry + (parseFloat(row.qty) * parseFloat(row.cost));
	            }, 0);

	            this.form.trsubtotal = tot;
	            return tot;
	      },


	     //  rowtotal: function () {
		    //   return (
		    //   	this.price + 
		    //     this.shipping +
		    //     this.handling - 
		    //     this.discount 
		    //   )
		    // },

	      trtotal () {
	            var tot = parseFloat(this.trsubtotal) - parseFloat(this.form.trdiscount);
	            this.form.trtotal = tot;
	            return tot;
	        }

	  },

	  watch: {    
	  }
	});

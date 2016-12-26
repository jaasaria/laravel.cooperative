

// require('./bootstrap');

Vue.component('date-range-picker', {
  props:['id'],
  template: '<input type="text" :id="id" :name="id" />',
  mounted: function(){
    var self = this;
    var input = $('input[name="'+ this.id +'"]');
    input.daterangepicker();
    input.on('apply.daterangepicker', function(ev, picker) {
      self.$emit('daterangechanged',picker);
    });
  } 
});

Vue.directive('selecttwo', {
  twoWay: true,
  bind: function () {
    $(this.el).select2()
    .on("select2:select", function(e) {
      this.set($(this.el).val());
    }.bind(this));
  },
  update: function(nv, ov) {
    $(this.el).trigger("change");
  }
});





var vm =  new Vue({
  el: '#app',
  data: {
    isProcessing: false,
    errors: {},
    withErrors:false,
    form: {}
  },

  created: function () {
    // Vue.set(this.$data, 'form', _form);
  },

  methods: {           

    onSubmit: function() {
      this.isProcessing = true;
      this.withErrors = false;
      this.errors = {};
      this.$http.post('/purchase',  this.form).then(function (response) {

          if(response.data.created) {
            
            swal({
              title: "Success",
              text: "Record was successfully saved.",
              type: "success",
              closeOnConfirm: true,
              showLoaderOnConfirm: true,
            },
            function(){
              window.location = '/purchase/';
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
            this.form.rows.$remove(row);
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

      trtotal () {
            var tot = parseFloat(this.trsubtotal) - parseFloat(this.form.trdiscount);
            this.form.trtotal = tot;
            return tot;
        }

  },


  watch: {    
  }


});




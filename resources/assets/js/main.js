// Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');

var VueResource = require('vue-resource');
Vue.use(VueResource);


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

    // form: {
    //   rows: [
    //         {item_id: '', qty: 1,cost: 0,subtotal: 0}
    //   ],

    //   trcode:'',
    //   supplier_id:'',
    //   datePurchase:'',
    //   dateDelivery:'',
    //   description:'',
    //   trsubtotal:0,
    //   trdiscount:0,
    //   trtotal:0

    // }

    form: {}

  },
  created: function () {
    Vue.set(this.$data, 'form', _form);

    // console.logs(_form);
  },

  methods: {

    CheckDate:function(){
      console.log(this.dt);
    },

    // CheckError: function(val, oldVal){
    //     if (Object.keys(this.errors).length > 0){
    //       this.withErrors = true;  
    //     }else{
    //       this.withErrors = false;  
    //     }
    // },

    onSubmit: function() {

      // e.preventDefault();
      this.isProcessing = true;
      this.withErrors = false;
      this.errors = {};

      // GET request
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
            // toastr["success"]("Record was successfully deleted.", "Success")

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

             // $.each(this.form.rows, function (i, e) {
             //   tot += e.rows.qty * e.rows.cost;
             // });
        
            tot =  this.form.rows.reduce(function(carry, row) {
              return carry + (parseFloat(row.qty) * parseFloat(row.cost));
            }, 0);

            this.form.trsubtotal = tot;
            return tot;

            // var tt = 0;
            // $.each(this.form, function (i, e) {
            //     tt += e.rows.qty * e.rows.cost;
            // });
            // return tt;
      },

      trtotal () {

            var tot = parseFloat(this.trsubtotal) - parseFloat(this.form.trdiscount);
            this.form.trtotal = tot;
            return tot;
        }

  },

  watch: {
      // 'errors': function(val, oldVal){
      //     if (Object.keys(this.errors).length > 0){
      //       this.withErrors = true;  
      //     }else{
      //       this.withErrors = false;  
      //     }
      // }
    
    }





});




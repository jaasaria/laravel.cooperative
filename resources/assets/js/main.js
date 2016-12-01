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

    form: {
      rows: [
            {itemid: '', qty: 1,cost: 0,subtotal: 0}
      ],

      trcode:'',
      supplier_id:'',
      datePurchase:'',
      dateDelivery:'',
      description:'',
      trsubtotal:0,
      trdiscount:0,
      trtotal:0
 
    }

  },
  created: function () {
    // Vue.set(this.$data, 'form', _form);
  },

  methods: {


    CheckDate:function(){
      console.log(this.dt);
    },


    onSubmit: function() {

      // e.preventDefault();
      this.isProcessing = true;


      // var data = this.rows;

      // GET request
      this.$http.post('/purchase',  this.form).then(function (response) {

          if(response.data.created) {
            // window.location = '/invoices/' + response.data.id;
            alert('success');
          } else {
            this.isProcessing = false;
            this.withErrors = true;
            alert('validate call');
          }


          // console.log('Success!:', response);
          // this.isProcessing = false;



      }, function (response) {
          console.log('Error!:', response.data);
          this.isProcessing = false;
          Vue.set(this.$data, 'errors', response.data);
      });





      // // this.$http.post('/api/item/' + ItemId).then((response) => {
      // this.$http.post('/purchase',{body:'testing js'}).then((response) => {

      //   alert('success');

      // }, (response) => {
      //   console.log(response);
      //   alert('error');
      // });

// this.$http.post('/purchase', {payload: this.rows}).then(function(response) { // do something }, function(response) { // do something });


//       // this.$http.post('/purchase',{item: this.rows})
//       //   .then(function(response) {

//           // if(response.data.created) {
//           //   window.location = '/invoices/' + response.data.id;
//           // } else {
//           //   this.isProcessing = false;
//           // }
//           alert('success');

//         })
//         .catch(function(response) {
//           // console.log('error');
//           alert('error');
//           this.isProcessing = false;
//           Vue.set(this.$data, 'errors', response.data);
//         })





    },


      addRow: function(){
        try {
                this.form.rows.push({itemid: '',qty: 1, cost: 0,subtotal:0 });
            } catch(e)
            {
                console.log(e);
                alert('error');
            }
      },

      deleteRow: function(row){
      try {
            // this.rows.splice(row, 1);
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
      // onChangeCalendar1:function(){
      //     row.subtotal = row.qty * row.cost;
      //     datePurchase = 
      // },


      onChange:function(row){
        var ItemId = row.itemid;

        // var resource = this.$resource('/api/item{/id}');
        // // GET someItem/1
        // resource.get({id: ItemId}).then((response) => {
        //   this.$set('someData', response.body());
        // });

        // var self = this;

  
        // GET /someUrl
        this.$http.get('/api/item/' + ItemId).then((response) => {

          // console.log(response.data.id);

          // this.$set('list', response.body);

          var obj = JSON.parse(response.body);
          row.cost = obj[0]['cost'];
          
          // this.onChangeSubTotal(row);

          //use this for looping
          // Object.keys(obj).forEach(function(key) {
          //   console.log(key, obj[key]['cost']);
          // });

        }, (response) => {
          console.log(response);
          alert('error');
        });
      }

  },

  computed: {

     trsubtotal:function () {

            return this.form.rows.reduce(function(carry, row) {
              return carry + (parseFloat(row.qty) * parseFloat(row.cost));
            }, 0);

            // var tt = 0;
            // $.each(this.form, function (i, e) {
            //     tt += e.rows.qty * e.rows.cost;
            // });
            // return tt;
      
      },

      trtotal () {

        // - this.form.trdiscount
            return parseFloat(this.trsubtotal) - parseFloat(this.form.trdiscount) ;
            // return 0;
            // this.subTotal - parseFloat(this.form.discount);
        }

  },

  watch: {
      'errors': function(val, oldVal){


        if (Object.keys(this.errors).length > 0){
          this.withErrors = true;  
        }else{
          this.withErrors = false;  
        }
       


      }
    }





});




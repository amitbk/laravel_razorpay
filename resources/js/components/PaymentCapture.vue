<template>
    <div class="payment_capture__container">
        <slot></slot>
    </div>
</template>

<script>
require('../utils/razorpay.js');
export default {
  name: "PaymentCapture",
  props: ['order_id' ,'payment_id', 'amount', 'key'],
  data() {
    return {
      paymentSuccess: null
    };
  },
  computed: {},
  mounted() {

    var options = {
      key: this.key,
      amount: this.amount, /// The amount is shown in currency subunits. Actual amount is ₹599.
      notes: {
        order_id: this.order_id
      },
      name: "test name",
      currency: 'INR', // Optional. Same as the Order currency
      description: "Purchase Description",
      image: "https://jolly-volhard-bc2f0b.netlify.com/favicon.ico",
      handler:  (response) =>{
        this.callback(response);
      },
      prefill: {
          name: "Rohan Lamb",
          email: "lambrohan@gmail.com",
          phone_number: "9552015542",
          mobile: "7020227842"
      },
      notes: {
          address: "Hello World"
      },
      theme: {
          color: "#00ffff"
      }
    };

    var rzp1 = new Razorpay({...options, order_id: this.payment_id});
    rzp1.open();
  },
  methods: {

    callback: function(response){
      axios.post('/callback', response )
      .then((res)=>{
        console.log("PAYMENT RESPONSE",res)
        this.paymentSuccess = res.data.payment_success == true ? true : false;
      })
      .catch((err)=>{
        console.log('error');
        this.paymentSuccess = false;
      })
    }

  }, // methods
};
</script>

<style lang="css" scoped>
</style>

$("#paymentModal").on('show', function() {
  // Fix StripeButton sizing bug on Firefox and IE
  $(".stripe-button-inner, .stripe-button-inner iframe").width(132).height(36);
  // ensure button scrolls with the rest of the page
  $(".stripe-button-inner iframe").css('position', 'relative');
});

// Stripe Button Triggers formDomElement.submit().
// We intercept it and notify user we have received the token
var paymentForm = $('#employer1')[0];
paymentForm.original_submit = paymentForm.submit;
paymentForm.submit = function() {
  $("#stripe-button-holder .stripe-button-inner").html('<span class="label label-success"><i class="icon-ok"></i> Card Added</span>');
  return false;
};

$('#employer3').validate({
  rules: {
    'first-name': {
      minlength: 1,
      required: true
    },
    'last-name': {
      minlength: 1,
      required: true
    },
    email: {
      required: true,
      email: true
    },
    amount: {
      required: true,
      min: 10,
    },
    'tos-agreed': {
      required: true
    }
  },
  messages: {
    'tos-agreed': 'You need to agree to the Terms of Service',
    'first-name': 'Please give us your first name',
    'last-name' : 'Please give us your last name',
    'email'     : 'Please give us your email so that we can contact you',
    'amount'    : 'Please pledge at least $10.'
  },
  errorPlacement: function (error, input) {
    $(input).closest('.controls').append(error);
  },
  highlight: function(el) {
    $(el).closest('.control-group').addClass('error');
  },
  unhighlight: function(el) {
    $(el).closest('.control-group').removeClass('error');
  },
  submitHandler: function(form) {
    // ensure CC info has been entered
    if (! $('[name=stripeToken]').val()) {
      $("#stripe-button-holder").closest('.control-group').addClass('error');
      $("#stripe-button-holder").append('<label class="error">Please Add Payment Information</span>')
    } else {
      form.original_submit();
    }
  }
});

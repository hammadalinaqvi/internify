$(document).ready(function() {
	$('#paymentNumber').payment('formatCardNumber');
	$('#paymentExpiry').payment('formatCardExpiry');
	
	
	
	$('#country').change(function(){
		var country_name = $('#country').val();
		if(country_name=='US')
		{
			$('#province').hide()
			$('.us').show();
			
			$('#postcode').hide()
			$('.us').show();
		}else{
			
				$('#province').show()
				$('#postcode').show()
				$('.us').hide();		
			}
		
		
		});
	$("#payment-form").submit(function(event) {
		//Clear any prior errors while authorizing
		
		var error ='';
		if ( $('#paymentName').val()==null || $('#paymentName').val()=="" )	{
			error = "The Full Name from the Card is required<br />";
			document.getElementById('paymentName').select();
			
		}
		
		if ( $('#paymentNumber').val()==null || $('#paymentNumber').val()=="" )	{
			error += "Credit Card  Number is required<br />";
			
		}
		
		if ( $('#paymentExpiry').val()==null || $('#paymentExpiry').val()=="" )	{
			error += "Expiry Date is required<br />";
			
		}
		if ( $('#paymentCVC').val()==null || $('#paymentCVC').val()=="" )	{
			error += "Security Code is required<br />";
			
		}
		
		if(error)
		{
			$('.submit-button').show();
			$('.payment_loading_image').hide();
		  	$(".payment-errors").html(error);
			return false;
		}
		// disable the submit button to prevent repeated clicks
		if(error == '')
		{
			
			
			/*$('.submit-button').attr("disabled", "disabled");*/
			$('.submit-button').hide();
			$('.payment_loading_image').show();
			
		 // createToken returns immediately - the supplied callback submits the form if there are no errors
		
			 var expirydate=$('#paymentExpiry').val();
			 var date=expirydate.split("/"); 
			 Stripe.createToken({
				name: $('#paymentName').val(),
				address_line1: $('#line_1').val(),
				address_city: $('#city').val(),
				address_zip: $('#zip').val(),
				address_state: $('#state').val(),
				number: $('#paymentNumber').val(),
				cvc: $('#paymentCVC').val(),
				exp_month: parseInt(date[0]),
				exp_year: parseInt(date[1])
			}, function(status, response) {
				 if (response.error) {
			$('.submit-button').show();
			$('.payment_loading_image').hide();
			$(".payment-errors").html(response.error.message);
		} else {
			var form$ = $("#payment-form");
			var token = response['id'];
			/*form$.append("<input type='hidden' name='stripe-amount' value='" + chargeAmount + "' />");*/
			form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
			form$.append("<input type='hidden' name='card_number' value='" + $('#paymentNumber').val() + "' />");
			form$.append("<input type='hidden' name='card_cvc' value='" + $('#paymentCVC').val() + "' />");
			form$.append("<input type='hidden' name='payment' id='payment' value='1' />");
			
			$('#strip_form').modal('hide')
			$(".payment-errors").html(' ');
			//form$.get(0).submit();
				}
			});
		}
			//return false; // submit from callback
	});
});


						

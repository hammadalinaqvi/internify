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
			
			$('.submit-button').hide();
			$('.payment_loading_image').show();
		
			 var expirydate=$('#paymentExpiry').val();
			 var date=expirydate.split("/"); 
			 Stripe.createToken({
				name: $('#paymentName').val(),
				address_line1: $('#line_1').val(),
				number: $('#paymentNumber').val(),
				cvc: $('#paymentCVC').val(),
				exp_month: parseInt(date[0]),
				exp_year: parseInt(date[1])
			}, function(status, response) {
				 if (response.error) 
				 {
					$('.submit-button').show();
					$('.payment_loading_image').hide();
					$(".payment-errors").html(response.error.message);
				} else {
					var form$ = $("form#tab");
					var token = response['id'];
					/*form$.append("<input type='hidden' name='stripe-amount' value='" + chargeAmount + "' />");*/
					//form$.append("<input type='hidden' name='stripeToken1' value='" + token + "' />");
					//form$.append("<input type='hidden' name='payment1' id='payment1' value='1' />");
					
					
					
					$('#strip_form').modal('hide')
					$(".payment-errors").html('');
					var empid=$('#empid').val();
					var url =web_path + '/employer/gettabcontent/?id=4&empid='+empid;
					get_response(url,'','#content_container');
					$('#stripeToken1').val(token);
					$('#payment1').val(1);
					
			//form$.get(0).submit();
				}
			});
		}
			return false; // submit from callback
	});
});


						

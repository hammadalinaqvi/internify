<div class="span9 tab-pane active" id="settings">

   <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/css/validation.css" type="text/css" />
  <script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/js/livevalidation_standalone.compressed.js"></script>
	     	<div class="well">
			    <ul class="nav nav-tabs">
			      <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
			      <li><a href="#profile" data-toggle="tab">Password</a></li>
                     <li><a href="#billing" data-toggle="tab">Billing</a></li>
			    </ul>
			    <div id="myTabContent" class="tab-content">
                 <?php 
				  if(count($emp_data) >0){
					  
					  					  ?>
                  
                  
			      <div class="tab-pane active in" id="home">
                  <div id="loading_img" style="display:none;" class="loading"></div>
                   <span style="color:#3C3; font-size:12px; font-weight:bold; "  id="msg_success1"></span>
                      <span style="color:#F00; font-size:12px; font-weight:bold; "  id="msg_error1"></span>
			       <?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'tab',
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ update_profile(); } "),
				)); ?>
                   
                      <div class="span4">
                    <input type="hidden" name="emp_id" value="<?php echo   $emp_data['employer']['employer_id'];?>"  />
                     <input type="hidden" name="emp_login_id" value="<?php echo   $emp_data['emp_login'][0]['id'];?>"  />
			            <label>Username</label>
			            <input type="text" name="username" id="username" value="<?php echo  $emp_data['emp_login'][0]['username'];?>" class="input-xlarge">
                          <script type="text/javascript">
		     	var username = new LiveValidation('username',  {onlyOnSubmit: true});
		     	username.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>  
			            <label>First Name</label>
			            <input type="text" name="firstname" id="firstname" value="<?php echo  $emp_data['employer']['firstname'];?>" class="input-xlarge">
                          <script type="text/javascript">
		     	var firstname = new LiveValidation('firstname',  {onlyOnSubmit: true});
		     	firstname.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>  
			            <label>Last Name</label>
			            <input type="text"  name="lastname"  id="lastname" value="<?php echo  $emp_data['employer']['lastname'];?>" class="input-xlarge">
                          <script type="text/javascript">
		     	var lastname = new LiveValidation('lastname',  {onlyOnSubmit: true});
		     	lastname.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>  
                
                </div>
                <div class="span4">
			            <label>Email</label>
			            <input type="text" name="email" id="email" value="<?php echo  $emp_data['employer']['email'];?>" class="input-xlarge">
                          <script type="text/javascript">
		     	var email = new LiveValidation('email', {onlyOnBlur: true});
		     	email.add(Validate.Presence,{ failureMessage: 'Required' });
				email.add( Validate.Email );
		   		</script>  
			            <label>Address</label>
                         <input  name="address" id="company_address" type="text" value="<?php echo  $emp_data['employer']['address'];?>" placeholder="" class="input-xlarge">
                          <script type="text/javascript">
		     	var company_address = new LiveValidation('company_address',  {onlyOnSubmit: true});
		     	company_address.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>  
			            <label>Time Zone</label>
                        <?php //print_r($timezone_data);?>
			            <select name="timezone" id="DropDownTimezone" class="input-xlarge">
                        <?php 
					//	print_r($timezone_data[);
						for($i=0; $i<count($timezone_data); $i++){?>
							
						<option value="<?php echo $timezone_data[$i][0];?>" <?php if( $emp_data['employer']['timezone']==$timezone_data[$i][0]){?> selected="selected" <?php }?>><?php echo $timezone_data[$i][1];?></option>
					 <?php	}?>
			             
			        	</select>
                          <script type="text/javascript">
		     	var DropDownTimezone = new LiveValidation('DropDownTimezone',  {onlyOnSubmit: true});
		     	DropDownTimezone.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>  
						</div>
			          
                      <div class="clearfix"></div>
				        	<div>
			        	     <?php
					
			       echo CHtml::SubmitButton('Update',array('onclick'=>'update_profile();',"class"=>"btn btn-primary")); ?>
			        	</div>
			    	
               <?php $this->endWidget(); ?>
			     
                  </div>
			      <div class="tab-pane fade" id="profile">
			    	
                      <?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'tab2',
					
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } "),
				)); ?>
                     <div id="loading_img2" style="display:none;" class="loading2"></div>
                     <span style="color:#3C3; font-size:12px; font-weight:bold; "  id="msg_success"></span>
                     <span style="color:#F00; font-size:12px; font-weight:bold;" id="msg_error"></span>
                      <input type="hidden" name="emp_id" value="<?php echo  $emp_data['employer']['employer_id'];?>"  />
                       <input type="hidden" name="emp_login_id" value="<?php echo   $emp_data['emp_login'][0]['id'];?>"  />
                      	<label>Old Password</label>
			        	<input type="password" name="old_password" id="old_password" class="input-xlarge">
                          <script type="text/javascript">
		     	var old_password = new LiveValidation('old_password',  {onlyOnSubmit: true});
		     	old_password.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>  
			        	<label>New Password</label>
			        	<input type="password" name="password" id="password" class="input-xlarge">
                          <script type="text/javascript">
		     	var password = new LiveValidation('password',  {onlyOnSubmit: true});
		     	password.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>  
                <label>New Password Again</label>
			        	<input type="password" name="again_password" id="again_password" class="input-xlarge">
                          <script type="text/javascript">
		     	var again_password = new LiveValidation('again_password');
		     	again_password.add(Validate.Presence,{ failureMessage: 'Required' });
				again_password.add( Validate.Confirmation, { match: 'password' } );
		   		</script>  
			        	<div>
                             <?php echo CHtml::SubmitButton('Update',array('onclick'=>'update_password();',"class"=>"btn btn-primary")); ?>
			        	</div>
			    	
               <?php $this->endWidget(); ?>
			      </div>
                  
                  
                  <div class="tab-pane fade" id="billing">
                   <span style="color:#3C3; font-size:12px; font-weight:bold; "  id="msg_success3"></span>
                     <span style="color:#F00; font-size:12px; font-weight:bold;" id="msg_error3"></span>
				    	 <?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'tab3',
					
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } "),
				));
				
			//	print_r($emp_data['card_array']);
				
?>
                <div id="loading_img4" style="display:none;" class="loading4"></div>
               
                	 <input type="hidden" name="emp_id" value="<?php echo  $emp_data['employer']['employer_id'];?>"  />
                      <input type="hidden" name="payment_id" value="<?php echo  $emp_data['card_array'][0]['id'];?>"  />
			        	<div class="span4">
				        	<label>Full Name</label>
			            <input type="text" value="<?php echo  $emp_data['card_array'][0]['card_holder_name'];?>" name="card_holder_name" id="card_holder_name" class="input-xlarge">
						<script type="text/javascript">
                        var card_holder_name = new LiveValidation('card_holder_name',  {onlyOnSubmit: true});
                        card_holder_name.add(Validate.Presence,{ failureMessage: 'Required' });
                        </script>  
			           <!-- <label>Last Name</label>
			            <input type="text" value="<?php //echo  $fullname[1];?>" name="lname" id="lname" class="input-xlarge">
                        						<script type="text/javascript">
                        var lname = new LiveValidation('lname',  {onlyOnSubmit: true});
                        lname.add(Validate.Presence,{ failureMessage: 'Required' });
                        </script>  
-->
			          <!--  <label>Address</label>
			            <input id="addresspick" name="address" type="text" placeholder="" value="<?php echo  $emp_data['employer']['address'];?>" class="input-xlarge">
                        						<script type="text/javascript">
                        var addresspick = new LiveValidation('addresspick',  {onlyOnSubmit: true});
                        addresspick.add(Validate.Presence,{ failureMessage: 'Required' });
                        </script>  
-->

                    <label>Street</label>
                                            <input id="address_street" name="address_street" type="text" placeholder="" value="<?php echo  $emp_data['card_array'][0]['address_line1'];?>" class="input-xlarge">
                                                                    <script type="text/javascript">
                                            var address_street = new LiveValidation('address_street',  {onlyOnSubmit: true});
                                            address_street.add(Validate.Presence,{ failureMessage: 'Required' });
                                            </script>  
                         <label>City</label>
			            <input id="address_city" name="city" type="text" placeholder="" value="<?php echo  $emp_data['card_array'][0]['address_city'];?>" class="input-xlarge">
                        						<script type="text/javascript">
                        var address_city = new LiveValidation('address_city',  {onlyOnSubmit: true});
                        address_city.add(Validate.Presence,{ failureMessage: 'Required' });
                        </script> 
                        <label>State</label>
                         <select name="state" placeholder="State" id="address_state" autocompletetype="state" required="">
														<option value="">State:</option>
                       <?php  
                        for($i=0; $i<count($state_data); $i++){?>
							
						<option value="<?php echo $state_data[$i];?>" <?php if( $emp_data['card_array'][0]['address_state']==$state_data[$i]){?> selected="selected" <?php }?>><?php echo $state_data[$i];?></option>
					 <?php	}?>
			          
														
													</select>
                        						
                         <label>Zip</label>
                                            <input id="address_zip" name="zip" type="text" placeholder="" value="<?php echo  $emp_data['card_array'][0]['address_zip'];?>" class="input-xlarge">
                                                                    <script type="text/javascript">
                                            var address_zip = new LiveValidation('address_zip',  {onlyOnSubmit: true});
                                            address_zip.add(Validate.Presence,{ failureMessage: 'Required' });
                                            </script>                      
			        	</div>
			        	<div class="span4">
			            <label>Card number</label>
			            <input type="text" id="card_number" name="card_number" value="<?php echo  $emp_data['card_array'][0]['card_number'];?>" placeholder = "xxxx" class="input-xlarge">
                        						<script type="text/javascript">
                        var card_number = new LiveValidation('card_number',  {onlyOnSubmit: true});
                        card_number.add(Validate.Presence,{ failureMessage: 'Required' });
                        </script>  

			            <label>Card Exp</label>
			            <input type="text" id="card_expiry" name="card_expiry" value="<?php echo  $emp_data['card_array'][0]['card_exp_month']."/".$emp_data['card_array'][0]['card_exp_year'];?>" placeholder="mm/yy" class="input-xlarge">
                        						<script type="text/javascript">
                        var card_expiry = new LiveValidation('card_expiry',  {onlyOnSubmit: true});
                        card_expiry.add(Validate.Presence,{ failureMessage: 'Required' });
                        </script>  

			            <label>Card CVC</label>
			            <input type="text" id="card_ccv" name="card_ccv" value="<?php echo  $emp_data['card_array'][0]['card_cvc'];?>" placeholder="xxx" class="input-xlarge">
                        						<script type="text/javascript">
                        var card_ccv = new LiveValidation('card_ccv',  {onlyOnSubmit: true});
                        card_ccv.add(Validate.Presence,{ failureMessage: 'Required' });
                        </script>  
						  <label>Country</label>
			             United States
			        	</div>
			        	<div class="clearfix"></div>
				        <div>
				        	<!--    <button class="btn btn-primary">Update</button>-->
                                 <?php echo CHtml::SubmitButton('Update',array('onclick'=>'update_payment();',"class"=>"btn btn-primary")); ?>
				        	</div>
				    	  <?php $this->endWidget(); ?>
			      </div>
                  
                  <?php }?>
			  </div>
	     </div>
	     
    </div>
    <?php  //require_once($_SERVER['DOCUMENT_ROOT'].'internify_local/protected/views/layouts/include_js.php'); ?>
    
    <script>
	
	jQuery(document).ready(
		function(){
			 
		$('#card_number').payment('formatCardNumber');
		$('#card_expiry').payment('formatCardExpiry');
		$('#card_ccv').payment('formatCardCVC');
		$( "#company_address" ).addressPicker();
		});
		
	function validateEmail(email)
	 {
  		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  		if( !emailReg.test( email ) ) 
		{
    		return false;
  		} else 
		{
    		return true;
  		}
  	}
	function update_profile()
        {
            if(($('#username').val() && $('#firstname').val() && $('#lastname').val() && $('#company_address').val() && $('#email').val() && $('#DropDownTimezone').val()) && validateEmail($('#email').val())  )
            {
				
				
						
			
                $.each($('form#tab'), function(index) { 
           		var sData = $('form#tab').serialize();
				$.ajax({
					type: "POST",
					 beforeSend: function(){$('#loading_img').show();},
					url: web_path+ '/employer/updateprofile',
					data: sData,
					success: function(data) {
						/*alert(data);
						return false;*/
					if(data==1)
					{
						$('#loading_img').hide();
						$('#msg_success1').show();
						$('#msg_success1').html("Update Profile Successfully");
						setInterval(function(){
					$('#msg_success1').hide();
					},6000);
					}
					if(data==2)
					{
						$('#loading_img').hide();
						$('#msg_error1').show();
           				 $('#msg_error1').html("This Username Already exists");
           				 $('#msg_success1').hide();
						setInterval(function(){
					$('#msg_success1').hide();
					},6000);
					}
					
					if(data==3)
					{
						$('#loading_img').hide();
						$('#msg_error1').show();
            			$('#msg_error1').html("This Email Already exists");
            			$('#msg_success1').hide();
						setInterval(function(){
						$('#msg_success1').hide();
						},6000);
					}
					if(data==5)
					{
						$('#loading_img').hide();
						$('#msg_error1').show();
            			$('#msg_error1').html("Please enter correct value in fields");
            			$('#msg_success1').hide();
						setInterval(function(){
						$('#msg_success1').hide();
						},6000);
					}
					
				 }
			 });
    	 });
       }
		}
	function update_password()
	{
		
    if($('#old_password').val() && $('#password').val() && ($('#password').val()==$('#again_password').val()))
    {	 
	   
        $.each($('form#tab2'), function(index) { 
        var sData = $('form#tab2').serialize();
    	$.ajax({
        type: "POST",
         beforeSend: function(){$('#loading_img2').show();},
        url: web_path+ '/employer/updatepassword',
        data: sData,
        success: function(data) 
		{
         /*  alert(data);
            return false;*/
				if(data==1)
				{
					$('#loading_img2').hide();
					$('#msg_success').show();
					$('#msg_success').html("Update Password Successfully");
					$('#msg_error').hide();
					$('#old_password').val(''); $('#password').val('')
					setInterval(function(){
						$('#msg_success').hide();
						},5000);
				}else if(data==2)
				{
					$('#loading_img2').fadeOut("slow");
					$('#msg_error').show();
					$('#msg_error').html("Please enter the correct Current password");
					$('#msg_success').hide();
					$('#old_password').val(''); $('#password').val('')
					setInterval(function(){
						$('#msg_error').fadeOut("slow");
						},5000);
				 }else
				 {
						$('#loading_img2').fadeOut("slow");
						$('#msg_error').show();
						$('#msg_success').hide();
					   $('#msg_error').html("Please enter the correct Current password");
					   $('#old_password').val(''); $('#password').val('')
					setInterval(function(){
						$('#msg_error').fadeOut("slow");
						},5000);
						
				 }
            // $('#loading_img').hide();
          }
    	});
    });
   }
 	}
function update_payment()
        {
			
            if($('#card_holder_name').val() && $('#card_number').val() && $('#card_expiry').val() && $('#card_ccv').val() && $('#address_street').val() && $('#address_city').val() && $('#address_state').val() && $('#address_zip').val() )
            {
				
				
				 var expirydate=$('#card_expiry').val();
				 var date=expirydate.split("/"); 
				 Stripe.createToken({
					name: $('#card_holder_name').val(),
					address_line1: $('#address_street').val(),
					address_city: $('#address_city').val(),
					address_zip: $('#address_zip').val(),
					address_state: $('#address_state').val(),
					number: $('#card_number').val(),
					cvc: $('#card_ccv').val(),
					exp_month: parseInt(date[0]),
					exp_year: parseInt(date[1])
				}, function(status, response) {
					 if (response.error) {
				$("#msg_error3").html(response.error.message);
			} else {
				var form$ = $("form#tab3");
				var token = response['id'];
				/*form$.append("<input type='hidden' name='stripe-amount' value='" + chargeAmount + "' />");*/
				//form$.append("<input type='hidden' name='stripeToken1' id='stripeToken1' value='" + token + "' />");
				var sData = $('form#tab3').serialize()+'&'+'stripeToken1='+token;
				$.ajax({
					type: "POST",
					 beforeSend: function(){$('#loading_img4').show();},
					url: web_path+ '/employer/updatepayment',
					data: sData,
					success: function(data) {
						/*alert(data);
						return false;*/
					if(data==1)
					{
						$('#loading_img4').hide();
						$('#msg_success3').show();
						$('#msg_success3').html("Billing Updated Successfully");
						setInterval(function(){
					$('#msg_success1').hide();
					},6000);
					}
					
					if(data==5)
					{
						$('#loading_img4').hide();
						$('#msg_error3').show();
            			$('#msg_error3').html("Please enter correct value in fields");
            			$('#msg_success3').hide();
						setInterval(function(){
						$('#msg_success3').hide();
						},6000);
					}
					
				 }
			 });
				
				//$(".payment-errors").html(' ');
				//form$.get(0).submit();
					}
				});	
				
               
           		
    	
       }
		}		
    
    </script>
   

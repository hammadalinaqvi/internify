<div class="container">
	<div class="row global-content">
<style>
input[type="text"] {
	padding: 8px 5px 7px;
	
	}

</style>
		<div class="span8">
        
			<h2>Contact Us</h2>
			<form class="well" method="post" action="" id="contact-us">
            <?php if(Yii::app()->user->hasFlash('contact')){ ?>

                <div class="flash-success" style="color:#75ED63;font-weight: bold; padding-bottom: 15px;">
                    <?php echo Yii::app()->user->getFlash('contact'); ?>
                </div>
                <?php } ?>
			  <div class="row">
					<div class="span3">
						<label>First Name</label>
                       
						<input type="text" class="span3" id="f_name" placeholder="Your First Name" name="f_name">
                         <script type="text/javascript">
								var f_name = new LiveValidation('f_name',  {onlyOnSubmit: true});
								f_name.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
						<label>Last Name</label>
						<input type="text" class="span3" placeholder="Your Last Name" name="l_name" id="l_name">
                         <script type="text/javascript">
								var l_name = new LiveValidation('l_name',  {onlyOnSubmit: true});
								l_name.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
						<label>Email Address</label>
						<input type="text" class="span3" placeholder="Your email address" id="email" name="email">
                          <script type="text/javascript">
								var email = new LiveValidation('email',  {onlyOnSubmit: true});
								email.add(Validate.Presence,{ failureMessage: 'Required' });
								email.add(Validate.Email );
							</script> 
						<label>Subject</label>
                        <select id="subject" name="subject" class="span3">
							<option value="Choose One:" selected="">Choose One:</option>
							<option value="General Customer Service">General Customer Service</option>
							<option value="Suggestions">Suggestions</option>
							<option value="Product Support">Product Support</option>
						</select>
                         <script type="text/javascript">
								var subject = new LiveValidation('subject',  {onlyOnSubmit: true});
								subject.add(Validate.Exclusion, { within: ['Choose One:'], failureMessage: "Required"});
								</script> 
					</div>
					<div class="span4">
						<label>Message</label>
						<textarea name="message" id="message" class="input-xlarge span4" rows="11"></textarea>
                         <script type="text/javascript">
								var message = new LiveValidation('message',  {onlyOnSubmit: true});
								message.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Send">
					</div>
					<div class="row">
					
					</div>
				</div>
			</form>
		</div>
		
		<!--<div class="span4">
			<p>Sidebar</p>
		</div>-->
		
	</div>
</div>

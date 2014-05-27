<!--<script type="text/javascript" src="http://platform.linkedin.com/in.js">
	  api_key: q947kgror7de
	  authorize: true
	</script>
<script type="text/javascript">
	function onLinkedInAuth() {
	  IN.API.Profile("me")
		.result( function(me) {
		  var id = me.values[0].id;
		
		});
	}
	</script>-->
	
<div id="findinternship" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel">Allow access through Linkedin</h3>
							</div>
							<div class="modal-body"> You will be redirected to Linked-In Authorization Page. There you might need to give access for the mentioned information to our website. Please do so.<br />
								<br />
								<?php if (!isset($session['linkedin_info']['email'])) {?>
								<input class="btn btn-primary btn-block" type="button" onClick="window.location = '<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/index.php/posting/linkedin'; " id="sign-in-linkedin" value="Sign In with Linkedin">
								<?php }?>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
							</div>
						</div>
						<!-- end modal -->	

<div class="home-intro">
	<div class="home-intro-bkgd">
		<div class="container">
			<h1>Forward thinking internships.</h1>
			<h5>CHOOSE A PATH</h5>
			<button href="#" class="btn btn-circle slidelink" id="showintern"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/student.png"/>
			<p>Intern</p>
			</button>
			<button href="#" class="btn btn-circle leftsidelink" id="showemployer"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/employer.png"/>
			<p>Company</p>
			</button>
		</div>
	</div>
</div>
<div class="container">
	<div class="madlib-wrap">
		<div id="page" class="madlib-inner">
			<div id="intern-step1">
				<div class="content">
					<form id="intern" name="intern" action="#findinternship" method="POST">
						<h1> I am a
							<input id="position" name="position" class="line"  type="text" data-provide="typeahead" data-items="3" autocomplete="off" placeholder="Student">
                            <script type="text/javascript">
								var position = new LiveValidation('position',  {onlyOnSubmit: true});
								position.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
							at
							<input id="universities" name="univesity" class="line span5" type="text" data-provide="typeahead" data-items="5" autocomplete="off" placeholder="University">
                            <script type="text/javascript">
								var universities = new LiveValidation('universities',  {onlyOnSubmit: true});
								universities.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
							looking for an internship in
							<input id="industries1" name="indsutry" class="line span4" style="width: 286px;" type="text" data-provide="typeahead" autocomplete="off" placeholder="Industry">
                            <script type="text/javascript">
								var industries1 = new LiveValidation('industries1',  {onlyOnSubmit: true});
								industries1.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
						</h1>
						
						<button href="#" class="find-btn btn btn-block btn-large btn-primary" role="button"  type="submit" onclick="intern_form();">Find me an internship</button> <!--href="#findinternship"-->
		        	
		        	<div class="authcopy">LinkedIn & OAuth</div>
					
						
					</form>
					<!-- </form>--> 
				</div>
			</div>
			<!-- /end #content-login --> 
			<!-- <form id="employer1" name="login" class="employer1" action="" method="post">-->
			<div id="employer-step1">
				<div class="content">
					<form id="employer1" name="login" action="" method="post">
						<h1>
							<input class="line span5" type="text" name="post_date" id="daterange" placeholder="During"/>
							<span id="span_message_date" style="color:#CF0000; font-size:12px; font-weight:bold;"></span> 
							<script type="text/javascript">
								var daterange = new LiveValidation('daterange',  {onlyOnSubmit: true});
								daterange.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
							your internship, you will need an amazing
							<input class="line span6"  name="post_title" id="post_title" type="text" placeholder="Internship job title">
							<script type="text/javascript">
								var post_title = new LiveValidation('post_title', {onlyOnSubmit: true });
								post_title.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> , 
							with a strong work ethic to: </h1>
						<textarea rows="2" class="span9" name="post_description" id="post_description" placeholder="Enter your description..."></textarea>
						<script type="text/javascript">
							var post_description = new LiveValidation('post_description', {onlyOnSubmit: true });
							post_description.add(Validate.Presence,{ failureMessage: 'Required' });
						</script>
						<button href="#" id="showemployer2"  class="btn btn-block btn-large btn-inverse">Next</button>
					</form>
				</div>
			</div>
			<!-- /end #content-register -->
			
			<div id="employer-step2" style="min-height:500px">
				<div class="content">
					<form id="employer2" name="login" action="" method="post">
						<h1> While we are in the
							<input id="industries2" class="line span4" name="job_type"  type="text" data-provide="typeahead" autocomplete="off"  placeholder="Industry">
							<script type="text/javascript">
								var industries2 = new LiveValidation('industries2',  {onlyOnSubmit: true });
								industries2.add(Validate.Presence,{ failureMessage: 'Required' });
							</script> 
							industry, the skills required for this internship are:
							<div style="clear:both;"></div>
							<input type="text" id="skills" name="skilltags" placeholder="Enter, some, tags..." class="skilltags  line span10" />
							<script type="text/javascript">
					   		</script> 
							Some bundled perks with this internship are:
							<?php foreach($data['perk'] as $perk_row){?>
							<label class="checkbox inline">
								<input type="checkbox"  name="perk[]" id="inlineCheckbox1" value="<?php echo $perk_row['id']?>">
								<?php echo $perk_row['name'];?></label>
							<?php }?>
						</h1>
						<button href="#" id="showemployer3"  class="btn btn-block btn-large btn-inverse madlib-btns">Next</button>
					</form>
				</div>
			</div>
			<!-- /end #content-register -->
			
			<div id="employer-step3" style="min-height: 860px;">
				<div class="content">
					<form id="employer3" name="login" action="" method="post">
						<h5>Please review your first order</h5>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Internship Title</th>
									<th>Number of Interns</th>
									<th>Price per Interns</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td id="internship_title">Front-end developer</td>
									<td id="interns">1</td>
									<td id="price">$30</td>
									<td id="total_price"><span>$30</span></td>
								</tr>
							</tbody>
						</table>
						<h5>Company & Payment information</h5>
						<label id="error_message" class="error"></label>
						<div class="payment-wrap">
							<div class="row-fluid">
								<div class="span6">
									<div class="control-group">
										<label class="control-label" for="first-name">First Name</label>
										<div class="controls">
											<input class="span12" id="firstname" name="first-name" type="text" />
											<script type="text/javascript">
												var firstname = new LiveValidation('firstname', {onlyOnSubmit: true });
												firstname.add(Validate.Presence,{ failureMessage: 'Required' });
											</script> 
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="last-name">Last Name</label>
										<div class="controls">
											<input class="span12" id="lastname" name="last-name" type="text"  />
											<script type="text/javascript">
												var lastname = new LiveValidation('lastname', {onlyOnSubmit: true });
												lastname.add(Validate.Presence,{ failureMessage: 'Required' });
											</script> 
										</div>
									</div>
								</div>
								<div class="span6">
									<div class="control-group">
										<label class="control-label" for="company">Company</label>
										<div class="controls">
											<input class="span12" id="company_name" name="company_name" type="text"  />
											<script type="text/javascript">
												var company_name = new LiveValidation('company_name', {onlyOnSubmit: true });
												company_name.add(Validate.Presence,{ failureMessage: 'Required' });
											</script> 
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="address">Established In:</label>
										<div class="controls">
											
                                              <div class="input-append date" id="dpYears" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                <input class="span2" size="16" type="text" name="company_starting_date" value="12-02-2012" style="border-radius: 5px 5px 5px 5px;
    width: 322px; background-color:#fff;" readonly>
                                              
                                              </div>
         
										</div>
									</div>
									
								</div>
							</div>
                             <div id="reg_img" style="display:none;"></div>
							<div class="row-fluid">
                           
								<div class="span6">
									<div class="control-group">
										<label class="control-label" for="email">Email</label>
										<div class="controls">
											<div class="input-prepend"> <span class="add-on"><i class="icon-envelope"></i></span>
												<input class="span11" id="employer_email" name="employer_email" type="text"/>
											</div>
											<script type="text/javascript">
												var employer_email = new LiveValidation('employer_email', {onlyOnSubmit: true });
												employer_email.add(Validate.Presence,{ failureMessage: 'Required' });
												employer_email.add(Validate.Email ,{ failureMessage: 'Invalid Email Format!!' });
											</script> 
										</div>
									</div>
									<div class="control-group btm">
										<label class="control-label" for="website">Website</label>
										<div class="controls">
											<div class="input-prepend"> <span class="add-on"><i class="icon-globe"></i></span>
												<input class="span11" id="website" name="website" type="text"  placeholder="http://www.yoursite.com" />
											</div>
											<script type="text/javascript">
												var website = new LiveValidation('website', {onlyOnSubmit: true });
												website.add(Validate.Presence,{ failureMessage: 'Required' });
											</script> 
										</div>
									</div>
								</div>
								<div class="span6">
                                <div class="control-group" >
										<label class="control-label" for="address">Address</label>
										<div class="controls">
											<textarea class="span12 employer_address" id="employeraddress" style="height:37px;" name="employer_address" ></textarea>
											<script type="text/javascript">
												var employeraddress = new LiveValidation('employeraddress', {onlyOnSubmit: true });
												employeraddress.add(Validate.Presence,{ failureMessage: 'Required' });
											</script> 
										</div>
									</div>
									<div class="control-group" >
										<label class="control-label" for="amount">Number of interns</label>
										<div class="controls">
											<div class="input-prepend"> <span class="add-on">#</span>
												<input  id="interns_limit" readonly="readonly" name="total_interns" type="text" class="span11 " value="1" />
												<div class="dec button"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/arrow_down.png"  /></div>
												<div class="inc button"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/arrow_up.png"  /></div>
												<!--  <input  id="amount" name="total_interns" type="number" class="span11 input-mini" value="1" />--> 
											</div>
										</div>
                                        
									</div>
									
								</div>
                                
                                    
							</div>
                            <div class="row-fluid">
                           
                            <div class="span6">
                               
										<input type="hidden" id="total_price" name="total_price" value=""  />
										<input type="hidden" id="intern_price" name="intern_price" value=""  />
										<label class="control-label" id="strip-label" for="card">Payment Information</label>
										<div class="controls" id="stripe-button-holder"> <a href="#strip_form" class="stripe-button-el pull-left" id="stripe_button" data-toggle="modal"><span>Add Card</span></a>
											<label class="checkbox pull-left" style="margin-left:10px;">
											<input id="tosagreed" name="tos-agreed" type="checkbox" value="1"  />
											I Agree to the <a href="#tos-modal" data-toggle="modal">Terms of Service</a>
											<div id="accept_required" style="margin-left:12px;"></div>
											</label>
										</div>
										<script type="text/javascript">
										var tosagreed = new LiveValidation('tosagreed', {onlyOnSubmit: true, insertAfterWhatNode: "accept_required" });//insertAfterWhatNode: "accept_required"  
										tosagreed.add(Validate.Acceptance ,{ failureMessage: 'Required' });
							   		</script> 
									</div>
                                    </div>
						</div>
						<!-- end payment wrap -->
						<button href="#" id="showemployer4"  onclick="send()" class="find-btn btn btn-block btn-primary">Pay Now!</button>
						<?php //$this->endWidget(); ?>
						
					</form>
				</div>
			</div>
			<!-- /end #content-register -->
			<div style="clear:both;"></div>
		</div>
		<!-- /end #page --> 
		
	</div>
	<div class="global-content">
		<div class="row-fluid">
			<div class="span4">
				<h3>Structured for growth</h3>
				<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. </p>
			</div>
			<div class="span4">
				<h3>Benifits up the Wazoo</h3>
				<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. </p>
			</div>
			<div class="span4">
				<h3>Career-centric</h3>
				<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum.</p>
			</div>
		</div>
		<hr>
		<div class="row-fluid">
			<div class="span4">
				<h2>Watch the demo!</h2>
				<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa </p>
				<ul class="global-list">
					<li>Intuitive</li>
					<li>Structure</li>
					<li>Focused</li>
					<li>Fast</li>
					<li>Fun</li>
				</ul>
			</div>
			<div class="span8"> 
				<!--<img src="holder.js/100%x300/internify">--> 
			</div>
		</div>
	</div>
</div>
<div id="strip_form" class="hide fade" style="top:0px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<!--<script type="text/javascript" src="https://js.stripe.com/v1/"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_guOskqsm83u56mz3eECGpo1i');
	</script>
	<link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/index.css" />
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/payment.js"></script>
	<style type="text/css">
	 input.invalid {
		  border: 2px solid red;
		}
	</style>
	<div class="app">
		<div class="overlay active">
			<div class="cover"></div>
			<div class="yield">
				<div class="panel" style="margin-top: -280.8px;">
					<header>
						<section class="">
							<div class="logo">Stripe</div>
							<div class="info"> </div>
						</section>
						<nav> <a class="close" data-dismiss="modal" aria-hidden="true">Close</a> </nav>
					</header>
					<form novalidate="" autocomplete="on" method="post" id="payment-form">
						<div class="yield">
							<div class="payment">
								<article>
									<div class="message"></div>
									<span class="payment-errors" style="color:#F00;font-size:12px;"></span>
									<div class="number">
										<label for="paymentNumber">Card number</label>
										<input id="paymentNumber" style="" placeholder="•••• •••• •••• ••••" data-placeholder="Card number"   x-autocompletetype="cc-number" type="text" >
										<div class="placeholder"></div>
										<div class="type"></div>
									</div>
									<div class="expiry">
										<label for="paymentExpiry">Expires</label>
										<input id="paymentExpiry" placeholder="MM / YY" pattern="\d*" x-autocompletetype="cc-exp" maxlength="9"  data-numeric="" required="" type="text">
									</div>
									<div class="name">
										<label for="paymentName">Name on card</label>
										<input id="paymentName" data-placeholder="Name on card" autocompletetype="name" autocapitalize="words" autocorrect="off" spellcheck="off" required="" type="text">
									</div>
									<div class="cvc">
										<label for="paymentCVC">Card code</label>
										<input id="paymentCVC" placeholder="CVC" autocompletetype="cc-csc" maxlength="4" pattern="\d*" autocomplete="off" data-numeric="" required="" type="text">
									</div>
								</article>
								<div class="preloaded-images"></div>
							</div>
							<div class="address international">
								<article>
									<label for="line_1">Billing address</label>
									<fieldset>
										<div class="line_1">
											<input name="line_1" id="line_1" placeholder="Street" autocompletetype="address-line1" required="" type="text">
										</div>
										<div class="hbox">
											<div class="city">
												<input name="city" placeholder="City" id="city" autocompletetype="city" required="" type="text">
											</div>
											<div class="state ">
												<div class="select" data-placeholder="State"> <span>State</span>
													<select name="state" placeholder="State" id="state" autocompletetype="state" required="">
														<option value="">State:</option>
														<option value="AL">AL</option>
														<option value="AK">AK</option>
														<option value="AS">AS</option>
														<option value="AZ">AZ</option>
														<option value="CA">CA</option>
														<option value="CO">CO</option>
														<option value="CT">CT</option>
														<option value="DE">DE</option>
														<option value="DC">DC</option>
														<option value="FM">FM</option>
														<option value="FL">FL</option>
														<option value="AR">AR</option>
														<option value="GA">GA</option>
														<option value="GU">GU</option>
														<option value="HI">HI</option>
														<option value="ID">ID</option>
														<option value="IL">IL</option>
														<option value="IN">IN</option>
														<option value="IA">IA</option>
														<option value="KS">KS</option>
														<option value="KY">KY</option>
														<option value="LA">LA</option>
														<option value="ME">ME</option>
														<option value="MH">MH</option>
														<option value="MD">MD</option>
														<option value="MA">MA</option>
														<option value="MI">MI</option>
														<option value="MN">MN</option>
														<option value="MS">MS</option>
														<option value="MO">MO</option>
														<option value="MT">MT</option>
														<option value="NE">NE</option>
														<option value="NV">NV</option>
														<option value="NH">NH</option>
														<option value="NJ">NJ</option>
														<option value="NM">NM</option>
														<option value="NY">NY</option>
														<option value="NC">NC</option>
														<option value="ND">ND</option>
														<option value="MP">MP</option>
														<option value="OH">OH</option>
														<option value="OK">OK</option>
														<option value="OR">OR</option>
														<option value="PW">PW</option>
														<option value="PA">PA</option>
														<option value="PR">PR</option>
														<option value="RI">RI</option>
														<option value="SC">SC</option>
														<option value="SD">SD</option>
														<option value="TN">TN</option>
														<option value="TX">TX</option>
														<option value="UT">UT</option>
														<option value="VT">VT</option>
														<option value="VI">VI</option>
														<option value="VA">VA</option>
														<option value="WA">WA</option>
														<option value="WV">WV</option>
														<option value="WI">WI</option>
														<option value="WY">WY</option>
													</select>
												</div>
											</div>
											<!--<div class="province international">
												<input name="province" id="province" placeholder="Province" autocompletetype="province" type="text">
											</div>-->
										</div>
										<div class="hbox">
											<div class="zip">
												<input name="zip" id="zip" placeholder="Zip" autocompletetype="postal-code" required="" type="text">
											</div>
										<!--	<div class="postalcode international">
												<input name="postalcode" id="postcode" placeholder="Postal code" autocompletetype="postal-code" required="" type="text">
											</div>-->
											<div class="country">
												<div class="select changed" data-placeholder="Country"> 
													  <span>United States</span>
													
												<!--	<select name="country" id="country" placeholder="Country" x-autocomplete="country" >
														<option value="">Country:</option>
														<option value="AF">Afghanistan</option>
														<option value="AL">Albania</option>
														<option value="DZ">Algeria</option>
														<option value="AD">Andorra</option>
														<option value="AO">Angola</option>
														<option value="AI">Anguilla</option>
														<option value="AG">Antigua and Barbuda</option>
														<option value="AR">Argentina</option>
														<option value="AM">Armenia</option>
														<option value="AW">Aruba</option>
														<option value="AU">Australia</option>
														<option value="AT">Austria</option>
														<option value="AZ">Azerbaijan</option>
														<option value="BS">Bahamas</option>
														<option value="BH">Bahrain</option>
														<option value="BD">Bangladesh</option>
														<option value="BB">Barbados</option>
														<option value="BY">Belarus</option>
														<option value="BE">Belgium</option>
														<option value="BZ">Belize</option>
														<option value="BJ">Benin</option>
														<option value="BM">Bermuda</option>
														<option value="BT">Bhutan</option>
														<option value="BO">Bolivia</option>
														<option value="BA">Bosnia Herzegovina</option>
														<option value="BW">Botswana</option>
														<option value="BV">Bouvet Island</option>
														<option value="BR">Brazil</option>
														<option value="IO">British Indian Ocean Territory</option>
														<option value="VG">British Virgin Islands</option>
														<option value="BN">Brunei Darussalam</option>
														<option value="BG">Bulgaria</option>
														<option value="BF">Burkina Faso</option>
														<option value="BI">Burundi</option>
														<option value="KH">Cambodia</option>
														<option value="CM">Cameroon</option>
														<option value="CA">Canada</option>
														<option value="CV">Cape Verde</option>
														<option value="KY">Cayman Islands</option>
														<option value="CF">Central African Republic</option>
														<option value="TD">Chad</option>
														<option value="CL">Chile</option>
														<option value="CN">China</option>
														<option value="CX">Christmas Island</option>
														<option value="CC">Cocos (Keeling) Islands</option>
														<option value="CO">Colombia</option>
														<option value="KM">Comoros</option>
														<option value="CG">Congo</option>
														<option value="CD">Congo (The Democratic Republic of the)</option>
														<option value="CK">Cook Islands</option>
														<option value="CR">Costa Rica</option>
														<option value="CI">Cote d Ivoire (Ivory Coast)</option>
														<option value="HR">Croatia</option>
														<option value="CU">Cuba</option>
														<option value="CY">Cyprus</option>
														<option value="CZ">Czech Republic</option>
														<option value="DK">Denmark</option>
														<option value="DJ">Djibouti</option>
														<option value="DM">Dominica</option>
														<option value="DO">Dominican Republic</option>
														<option value="TL">East Timor</option>
														<option value="EC">Ecuador</option>
														<option value="EG">Egypt</option>
														<option value="SV">El Salvador</option>
														<option value="GQ">Equatorial Guinea</option>
														<option value="ER">Eritrea</option>
														<option value="EE">Estonia</option>
														<option value="ET">Ethiopia</option>
														<option value="FK">Falkland Islands (Malvinas)</option>
														<option value="FO">Faroe Islands</option>
														<option value="FJ">Fiji</option>
														<option value="FI">Finland</option>
														<option value="FR">France</option>
														<option value="GF">French Guiana</option>
														<option value="PF">French Polynesia</option>
														<option value="TF">French Southern Territories</option>
														<option value="GA">Gabon</option>
														<option value="GM">Gambia</option>
														<option value="GE">Georgia</option>
														<option value="DE">Germany</option>
														<option value="GH">Ghana</option>
														<option value="GI">Gibraltar</option>
														<option value="GR">Greece</option>
														<option value="GL">Greenland</option>
														<option value="GD">Grenada</option>
														<option value="GP">Guadeloupe</option>
														<option value="GT">Guatemala</option>
														<option value="GN">Guinea</option>
														<option value="GW">Guinea-Bissau</option>
														<option value="GY">Guyana</option>
														<option value="HT">Haiti</option>
														<option value="HM">Heard Island and McDonald Islands</option>
														<option value="VA">Holy See (Vatican City State)</option>
														<option value="HN">Honduras</option>
														<option value="HK">Hong Kong</option>
														<option value="HU">Hungary</option>
														<option value="IS">Iceland</option>
														<option value="IN">India</option>
														<option value="ID">Indonesia</option>
														<option value="IQ">Iraq</option>
														<option value="IE">Ireland</option>
														<option value="IR">Islamic Republic of Iran</option>
														<option value="IL">Israel</option>
														<option value="IT">Italy</option>
														<option value="JM">Jamaica</option>
														<option value="JP">Japan</option>
														<option value="JO">Jordan</option>
														<option value="KZ">Kazakhstan</option>
														<option value="KE">Kenya</option>
														<option value="KI">Kiribati</option>
														<option value="KP">Korea (Democratic People s Republic of)</option>
														<option value="KR">Korea (Republic of)</option>
														<option value="KW">Kuwait</option>
														<option value="KG">Kyrgzstan</option>
														<option value="LA">Lao People s Democratic Republic</option>
														<option value="LV">Latvia</option>
														<option value="LB">Lebanon</option>
														<option value="LS">Lesotho</option>
														<option value="LR">Liberia</option>
														<option value="LY">Libyan Arab Jamahiriya</option>
														<option value="LI">Liechtenstein</option>
														<option value="LT">Lithuania</option>
														<option value="LU">Luxembourg</option>
														<option value="MO">Macao</option>
														<option value="MK">Macedonia (The Former Yugoslav Republic of)</option>
														<option value="MG">Madagascar</option>
														<option value="MW">Malawi</option>
														<option value="MY">Malaysia</option>
														<option value="MV">Maldives</option>
														<option value="ML">Mali</option>
														<option value="MT">Malta</option>
														<option value="MH">Marshall Islands</option>
														<option value="MQ">Martinique</option>
														<option value="MR">Mauritania</option>
														<option value="MU">Mauritius</option>
														<option value="YT">Mayotte</option>
														<option value="MX">Mexico</option>
														<option value="MD">Moldova</option>
														<option value="MC">Monaco</option>
														<option value="MN">Mongolia</option>
														<option value="MS">Montserrat</option>
														<option value="MA">Morocco</option>
														<option value="MZ">Mozambique</option>
														<option value="MM">Myanmar</option>
														<option value="NA">Namibia</option>
														<option value="NR">Nauru</option>
														<option value="NP">Nepal</option>
														<option value="NL">Netherlands</option>
														<option value="AN">Netherlands Antilles</option>
														<option value="NC">New Caledonia</option>
														<option value="NZ">New Zealand</option>
														<option value="NI">Nicaragua</option>
														<option value="NE">Niger</option>
														<option value="NG">Nigeria</option>
														<option value="NU">Niue</option>
														<option value="NF">Norfolk Island</option>
														<option value="NO">Norway</option>
														<option value="OM">Oman</option>
														<option value="PK">Pakistan</option>
														<option value="PW">Palau</option>
														<option value="PA">Panama</option>
														<option value="PG">Papua New Guinea</option>
														<option value="PY">Paraguay</option>
														<option value="PE">Peru</option>
														<option value="PH">Philippines</option>
														<option value="PN">Pitcairn</option>
														<option value="PL">Poland</option>
														<option value="PT">Portugal</option>
														<option value="QA">Qatar</option>
														<option value="RE">Reunion</option>
														<option value="RO">Romania</option>
														<option value="RU">Russian Federation</option>
														<option value="RW">Rwanda</option>
														<option value="SH">Saint Helena</option>
														<option value="KN">Saint Kitts and Nevis</option>
														<option value="LC">Saint Lucia</option>
														<option value="PM">Saint Pierre and Miquelon</option>
														<option value="VC">Saint Vincent and the Grenadines</option>
														<option value="WS">Samoa</option>
														<option value="SM">San Marino</option>
														<option value="ST">Sao Tome and Principe</option>
														<option value="SA">Saudi Arabia</option>
														<option value="SN">Senegal</option>
														<option value="RS">Serbia</option>
														<option value="SC">Seychelles</option>
														<option value="SL">Sierra Leone</option>
														<option value="SG">Singapore</option>
														<option value="SK">Slovakia</option>
														<option value="SI">Slovenia</option>
														<option value="SB">Solomon Islands</option>
														<option value="SO">Somalia</option>
														<option value="ZA">South Africa</option>
														<option value="GS">South Georgia and the South Sandwich Islands</option>
														<option value="ES">Spain</option>
														<option value="LK">Sri Lanka</option>
														<option value="SD">Sudan</option>
														<option value="SR">Suriname</option>
														<option value="SJ">Svalbard and Jan Mayen</option>
														<option value="SZ">Swaziland</option>
														<option value="SE">Sweden</option>
														<option value="CH">Switzerland</option>
														<option value="SY">Syrian Arab Republic</option>
														<option value="TW">Taiwan</option>
														<option value="TJ">Tajikstan</option>
														<option value="TZ">Tanzania United Republic</option>
														<option value="TH">Thailand</option>
														<option value="TG">Togo</option>
														<option value="TK">Tokelau</option>
														<option value="TO">Tonga</option>
														<option value="TT">Trinidad and Tobago</option>
														<option value="TN">Tunisia</option>
														<option value="TR">Turkey</option>
														<option value="TM">Turkmenistan</option>
														<option value="TC">Turks and Caicos Islands</option>
														<option value="TV">Tuvalu</option>
														<option value="UG">Uganda</option>
														<option value="UA">Ukraine</option>
														<option value="AE">United Arab Emirates</option>
														<option value="GB">United Kingdom</option>
														<option value="US">United States</option>
														<option value="UY">Uruguay</option>
														<option value="UZ">Uzbekistan</option>
														<option value="VU">Vanuatu</option>
														<option value="VE">Venezuela</option>
														<option value="VN">Vietnam</option>
														<option value="WF">Wallis and Futuna</option>
														<option value="EH">Western Sahara</option>
														<option value="YE">Yemen</option>
														<option value="ZM">Zambia</option>
														<option value="ZW">Zimbabwe</option>
													</select>-->
												</div>
											</div>
										</div>
									</fieldset>
								</article>
							</div>
						</div>
						<footer>
							<button type="submit"  class="blue submit submit-button"><span>Save</span></button>
							<div class="payment_loading_image" style="display:none;"></div>
						</footer>
					</form>
					<div class="success">
						<div class="check"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="jobpost" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<h3 id="myModalLabel">Your Registration process has been completed successfully. The Confirmation message is sent to you. Kindly check your inbox.</h3>
		
		<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Your Post has been submitted successfully</h3>
                                <p>This is your Internship Post Details:</p><br />
                                <p><strong>Duration:</strong> <span id="duration"></span></p> <br />
                                <p><strong>Post Title:</strong>  <span id="title"></span></p><br />
                                <p><strong>Description: </strong><span id="description"></span></p> <br />
                                <p><strong>Industry:</strong> <span id="industry"></span> </p> <br />
                                <p><strong>Skills:</strong> <span id="skills_tag"></span></p> <br />--> 
		
	</div>
</div>

<script type="text/javascript">

function intern_form()
{
  if($('#position').val && $('#universities').val() && $('#industries1').val())	
  {
	$('#findinternship').modal('show');
	var sData = $("form#intern").serialize();
	//alert(sData);
	$.ajax(
		{
			type: "POST",
			data: sData,
			url: web_path+ 'posting/interninfo',
			success:function(data){
				/*alert(data);
				return false;*/
			}
		});
  }
}
</script>
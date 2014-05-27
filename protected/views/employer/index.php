<?php $session = Yii::app()->session;?>
<form >
<input type="hidden" name="emp_id" id="status" value="<?php echo $session['emp_array']['status'];?>"  />
<input type="hidden" name="company_logo" id="company_logo" value="<?php if($session['emp_array']['company_logo']){echo $session['emp_array']['company_logo'];}?>"  />
  <input type="hidden" name="stripeToken1" id="stripeToken1" value=""  />
      <input type="hidden" name="payment1" id="payment1" value=""  />
      </form>
<div id="strip_form" class="hide fade" data-backdrop="false" style="top:0px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/index.css" />
 <!-- <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/payment_post.js"></script>-->
  <style type="text/css">
 input.invalid {
      border: 2px solid red;
    }
</style>
  <div class="app">
    <div class="overlay active">
      <div class="cover"></div>
      <div class="yield">
        <div class="panel" style="margin-top: -279.08px;">
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
                        <input name="city" id="city" placeholder="City" autocompletetype="city" required="" type="text">
                      </div>
                      <div class="state us">
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
                      <div class="province international">
                        <input name="province" id="province" placeholder="Province" autocompletetype="province" type="text">
                      </div>
                    </div>
                    <div class="hbox">
                      <div class="zip us">
                        <input name="zip" id="zip" placeholder="Zip" autocompletetype="postal-code" required="" type="text">
                      </div>
                      <div class="postalcode international">
                        <input name="postalcode" id="postcode" placeholder="Postal code" autocompletetype="postal-code" required="" type="text">
                      </div>
                      <div class="country">
                        <div class="select changed" data-placeholder="Country"> 
                          <!--  <span>Pakistan</span>-->
                          
                          <select name="country" id="country" placeholder="Country" x-autocomplete="country" >
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
                          </select>
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
<div class="modal hide fade" id="internship-payment" style="width:600px;">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Internship payment</h3>
  </div>
  <div class="modal-body">
		    <div class="content">
		    	<form id="employer3" name="login" action="#" method="post">
		    	
		    		<h4>You will be charged $30.00 for your new internship</h4>
		      	
		      	<p>As soon as you finish your payment a new internship block will need to be filled out.</p>
											
						<div class="payment-wrap">			
							<div class="row-fluid">		
							
								<div class="span6">
				          <input id="tos-agreed1" name="tos-agreed" type="checkbox" required />
				          I Agree to the <a href="#tos-modal" data-toggle="modal">Terms of Service</a>     
								</div>
													    
								<div class="span6">
							    <button class="btn btn-primary"  onclick="internship_modal();">Use card ending with xxxx.</button>
								</div>
								
							</div>
						</div> <!-- end payment wrap -->
		        
		      </form>
		    </div>
		     
  </div>
</div>
<div class="modal hide fade" id="finishprofile2">
  <div class="modal-header">
    <!-- <a class="close" data-dismiss="modal">×</a> -->
    <h3>Finish your profile</h3>
  </div>
    <form name="form" id="imageform" enctype="multipart/form-data">  
  <div class="modal-body">
  <span style="color:#F00; font-size:12px; font-weight:bold; "  id="error_image"></span>
    <div class="modal-left" style="width:160px;">
			 
        
            <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-new thumbnail" style="width: 120px; height: 120px;"><img src="holder.js/120x120/internify/text:Add your logo"></div>
  <div class="fileupload-preview fileupload-exists" style="max-width: 120px; max-height: 120px; line-height: 20px;"></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file"  name="companylogo" id="companylogo" value=""/></span>
    <a href="#" class="btn fileupload-exists"  data-dismiss="fileupload">Remove</a>
  </div>
</div> 
    	<div class="clearfix"></div>
    </div>
    <div class="modal-right">
    	<h1><?php echo $session['emp_array']['company_name'];?></h1>
    	<h2>is within the <span>Technology</span> industry</h2>
    	<h3>&amp; and started Interning differently on <span><?php echo date('m/d/Y',strtotime($session['emp_array']['company_starting_date']));?></span></h3>
    	<div class="clearfix"></div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" onclick="uploadimage()" class="btn btn-primary">Save changes</a>
  </div>
  </form>
</div>

<input type="hidden" name="emp_id" id="empid" value="<?php echo $session['emp_array']['employer_id'];?>"  />

<div class="container">
  <div class="row">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/validation.css" type="text/css" />
  	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/livevalidation_standalone.compressed.js"></script>
  
    <div class="span3">
      <div class="well sidebar-nav nav-tabs" id="employer-tabs">
        <ul class="nav nav-list">
          <li class="nav-header navlist-top">Company Information</li>
          <li class="navlist-info">
            <h3><?php echo $session['emp_array']['company_name'];?></h3>
            <p>Established: <span><?php echo date('m.d.Y',strtotime($session['emp_array']['company_starting_date']));?></span></p>
          </li>
          <li class="active">
          
          <a href="#current"   data-toggle="tab" id="1">Current Posts <div class="tab-counter">
	          		<span id="count_post">0</span>
	          	</div></span><div id="loaderp1" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" />
               
                </div></a></li>
          <li><a href="#past" data-toggle="tab" id="2">Past posts <div class="tab-counter">
	          		<span id="count_past_post">0</span>
	          	</div> <div id="loaderp2" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" /></div></a></li>
          
		  <li><a href="#settings" data-toggle="tab" id="3"  >Settings<div id="loaderp3" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" /></div></a></li> 
       
	    </ul>
        <button class="btm-btn btn btn-block" href="#internship-payment" role="button" data-toggle="modal" >Add new Internship<div id="loaderp4" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" /></div></button>
      </div><!--/.well -->
    </div><!--/span-->
    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
	?>
    <div class="tab-content" id="content_container">
    
  </div><!--/row-->

</div><!--/.fluid-container-->

	
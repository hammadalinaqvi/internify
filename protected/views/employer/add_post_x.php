<?php 
$session = Yii::app()->session;
 ?>
<div id="strip_form" class="hide fade" data-backdrop="false" style="top:0px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/index.css" />
  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/payment_post.js"></script>
  <style type="text/css">
 input.invalid {
      border: 2px solid red;
    }
</style>
  <div class="app">
    <div class="overlay active">
      <div class="cover"></div>
      <div class="yield">
        <div class="panel" style="margin-top: -185.08px;">
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
                        <input name="city" placeholder="City" autocompletetype="city" required="" type="text">
                      </div>
                      <div class="state us">
                        <div class="select" data-placeholder="State"> <span>State</span>
                          <select name="state" placeholder="State" autocompletetype="state" required="">
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

<div class="span9 tab-pane active" id="settings">

<!-- <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/css/validation.css" type="text/css" />
  <script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/js/livevalidation_standalone.compressed.js"></script>-->

<div class="well">
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">New Internship</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane active in" id="home">
    <div id="loading_img" style="display:none;" class="loading"></div>
    <?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'tab',
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ new_post() } "),
				)); ?>
    <span style="color:#3C3; font-size:12px; font-weight:bold; "  id="msg_success1"></span> <span style="color:#F00; font-size:12px; font-weight:bold; "  id="msg_error1"></span>
    <input type="hidden" name="emp_id" value="<?php echo $session['emp_array']['employer_id'];?>"  />
    <label>Duration</label>
    <input type="text" name="date" id="daterange" value="" placeholder="During" class="input-xlarge">
    <script type="text/javascript">
		     	var daterange = new LiveValidation('daterange',  {onlyOnSubmit: true});
		     	daterange.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>
    <label>Internship Title</label>
    <input type="text" name="title" id="title" value="" class="input-xlarge">
    <script type="text/javascript">
		     	var title = new LiveValidation('title',  {onlyOnSubmit: true});
		     	title.add(Validate.Presence,{ failureMessage: 'Required' });
		   		</script>
    <label> Description</label>
    <textarea  name="description" id="description" value="" rows="3" class="input-xlarge"></textarea>
    <script type="text/javascript">
		     			  var description = new LiveValidation('description',  {onlyOnSubmit: true});
		     			  description.add(Validate.Presence,{ failureMessage: 'Required' });
		   				  </script>
    <label>Industry</label>
    <input type="text" name="job_type" id="industries1" value=""   data-provide="typeahead" autocomplete="off"  placeholder="Industry">
    <script type="text/javascript">
		     			var industries1 = new LiveValidation('industries1',  {onlyOnSubmit: true});
		     			industries1.add(Validate.Presence,{ failureMessage: 'Required' });
		   				</script>
    <label>Skills</label>
    <input type="text" id="skillid"  name="skilltags"  autocomplete="off" data-items="6" data-provide="typeahead"   placeholder="Enter, some, tags..."  />
    <label>Perks</label>
    <?php foreach($data['perk'] as $perk_row){?>
    <label class="checkbox inline">
      <input type="checkbox"  name="perk[]" id="inlineCheckbox1" value="<?php echo $perk_row['id']?>">
      <?php echo $perk_row['name'];?></label>
    <?php }?>
    <br />
    <label>Number of Interns</label>
    <input  id="interns_limit" name="total_interns" type="text" class="input-xlarge" readonly="readonly" value="1" />
    <div class="dec button" style="position:relative;
  right:34px;
  top:9px;
  z-index:999;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/arrow_down.png"  /></div>
    <div class="inc button" style="position:relative;
  right:70px;
  top:-11px;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/arrow_up.png"  /></div>
    <label>Prices Per Interns</label>
    <input type="text" name="price" id="intern_price" value="$30"  readonly="readonly" class="input-xlarge">
    <label>Total Price</label>
    <input type="text" name="total" id="total_price" value="$30" readonly="readonly" class="input-xlarge">
    <input type="hidden" id="total_price" name="total_price" value=""  />
    <input type="hidden" id="intern_price" name="intern_price" value=""  />
    <label class="control-label" id="strip-label" for="card">Payment Information</label>
    <!-- <a href="#strip" class="stripe-button " id="" data-toggle="modal"  >Add Payment</a>-->
    <div class="controls" id="stripe-button-holder" > 
      
      <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>--> 
      <a href="#strip_form"  class="stripe-button-el pull-left" id="stripe_button" data-toggle="modal"  ><span>Add Card</span></a>
      <div> <br>
      </div>
    </div>
    <br />
    <?php
					
			       echo CHtml::SubmitButton('Save',array('onclick'=>'new_post();',"class"=>"btn btn-primary")); ?>
    <?php $this->endWidget(); ?>
  </div>
</div>

<?php  //require_once($_SERVER['DOCUMENT_ROOT'].'internify_local/protected/views/layouts/include_js.php'); ?>
<!--<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-typeahead.js"></script> 
<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-tagmanager.js"></script> 
<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-editable.js"></script> 
<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/select2.js"></script> 
<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/date.js"></script> 
<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/daterangepicker.js"></script> -->
<script>
	
	   
	  $(function() {
		   $('#stripe_button').click(function(){
			 	$('.submit-button').show();
				$('.payment_loading_image').hide();
			 });
		  
	       $('#daterange').daterangepicker();
		 
		
			 $('#industries1').typeahead({
        source: function (query, process) {
    return $.post(web_path+ '/posting/getindustry', function (data) {
	    process(JSON.parse(data));
    	});
    }});
		   
		   
		  
		   		$("#skillid").tagsManager({
				preventSubmitOnEnter: true,
				typeahead: true,
				typeaheadSource: show_skills(),
				delimeters: [44, 188, 13],
				backspace: [8],
				blinkBGColor_1: '#FFFF9C',
				blinkBGColor_2: '#CDE69C'
			 });
			 
					
			incrementVar = 0;
			$('.inc.button').click(function(){
				
				var $this = $(this),
					$input = $this.prev('input'),
					$parent = $input.closest('div'),
					newValue = parseInt($('#interns_limit').val())+1;
				//$parent.find('.inc').addClass('a'+newValue);
				$('#interns_limit').val(newValue);
				$('#total_price').val('$'+newValue*30);
				incrementVar += newValue;
			});
			$('.dec.button').click(function(){
				var $this = $(this),
					$input = $this.next('input'),
					$parent = $input.closest('div'),
					newValue = parseInt($('#interns_limit').val())-1;
					if(newValue <1)
					{
						return  false;
					}
				
				$('#interns_limit').val(newValue);
				$('#total_price').val('$'+newValue*30);
				incrementVar += newValue;
				
			});
	     
			
			
		
	  });
	
	
		
	function new_post()
        {
			 if($('input[name="hidden-skilltags"]').val()=='')
			{
				var skillid = new LiveValidation('skillid',  {onlyOnSubmit: true });
				skillid.add(Validate.Presence,{ failureMessage: 'Required' });	
			}else
			{
				var skillid = new LiveValidation('skillid',  {onlyOnSubmit: true });
				skillid.remove(Validate.Presence,{ failureMessage: 'Required' });	
			}
			
            if(($('#daterange').val() && $('#title').val() && $('#description').val() && $('#industries1').val() && $('#interns_limit').val()) && $('#total_price').val()&& $('input[name="hidden-skilltags"]').val())
            {	
			
				  if($('#payment1').val()==1)
	    			{			   	
							$.each($('form#tab'), function(index) { 
						var sData = $('form#tab').serialize();
						$.ajax({
						type: "POST",
						 beforeSend: function(){$('#loading_img').show();},
						url: web_path+ 'posting/addinternship',
						data: sData,
						success: function(data) {
						/*alert(data);
						return false;*/
					if(data==1)
					{
						
						jAlert('Internship has been Added Successfully !', '');
						$('#daterange').val('') ;
						$('#title').val('');
						$('#description').val('');
						$('#industries1').val('');
						$('#skillid').val('');
						$('input[name="hidden-skilltags"]').val('');
						$('#interns_limit').val(1);
						$('#total_price').val('$'+30);
						$('#loading_img').hide();
						/*$('#msg_success1').show();
						$('#msg_success1').html("Internship has been Added Successfully ");*/
						var countvalue= parseInt($('#add_post_count').val())+parseInt(1);
						$('#count_post').html(countvalue);
						/*setInterval(function(){
					$('#msg_success1').hide();
					},6000);*/
					}
									 }
			 });
    	 });
					}else
					{
						jAlert('Please add credit card for payment information !', '');
						return false;
					}
       		}
		}
	
    </script>
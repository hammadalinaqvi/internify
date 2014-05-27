<?php

class EmployerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
*/
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex()
	{
		$session = Yii::app()->session;
		if(!$session['emp_array']['username'] && !$session['emp_array']['password'])
		{
			$this->redirect(array('posting/index'));
		}
		
		
		
		$this->render('index');
	}
	
	public function actionSaveImage()
	{
		 $session = Yii::app()->session;
		if ((($_FILES["company"]["type"] == "image/gif")
		|| ($_FILES["company"]["type"] == "image/jpeg")
		|| ($_FILES["company"]["type"] == "image/jpg")
		|| ($_FILES["company"]["type"] == "image/png")))
		  {		
		 
				$model = new Employer;
				$uploadedFile = CUploadedFile::getInstanceByName('company');
				$filename = time()."_".rand(100, 99999999)."_".$uploadedFile->getName();
				$target_dir = $_SERVER['DOCUMENT_ROOT']."/sitedata/logo/".$filename;
				$uploadedFile->saveAs($target_dir); 
				
				$objEmp = Employer::model()->findByPk($_POST['emp_id']);
				$objEmp->company_logo = $filename;
				$objEmp->save();
				
			
				$employer_data = $objEmp->get_employer('*','','employer_id = "'.$_POST['emp_id'].'"');
				$objUser = new User;
				$user_data = $objUser->get_user('*','','employer_id = "'.$_POST['emp_id'].'" AND status = "1"'); 
				
				$session['emp_array'] = array_merge($employer_data[0],$user_data[0]);
				
				
				echo 1;
				exit;
				
		  }else{
			 echo 'file is invalid'; 
			 exit;
			 }
		exit;
	}
	
	
	public function actionLogin()
	{
		$session = Yii::app()->session;
		$username = isset($_POST['username'])?$_POST['username']:'';
		$password = isset($_POST['password'])?$_POST['password']:'';
		$remember = isset($_POST['remember-me'])?$_POST['remember-me']:'';
		//$user_role = isset($_POST['remember-me'])?$_POST['remember-me']:'';
	    
		$objEmployer = new Employer;
		$objuser = new User;
		$objStudent = new Student;
		
		$user_data = $objuser->get_user('*','','username = "'.$username.'" AND password = "'.md5($password).'" AND status = "1"'); //,'AND role="employer"'
		
		if(count($user_data) > 0)
		{
			
			if($user_data[0]['role'] == "employer")
			{
				echo 1; // case of authenticated employer
				if($remember==1)
				{
					setcookie("username",$username, time()+3600*24);
					
				}
				$employer_data = $objEmployer->get_employer('*','','employer_id = "'.$user_data[0]['employer_id'].'"');
				$session['emp_array'] = array_merge($employer_data[0],$user_data[0]);
				
			}

			/*if($user_data[0]['role'] == "student")
			{
				echo "student_authenticated"; // case of authenticated student
				if($remember == 1)
				{
					setcookie("username",$username, time()+3600*24);
				}
				
				
				$student_data = $objStudent->get_student('*','','id = "'.$user_data[0]['student_id'].'"');
				//$employer_data = $objEmployer->get_employer('*','','student_id = "'.$user_data[0]['student_id'].'"');
				$session['student_array'] = array_merge($student_data[0],$user_data[0]);
				$_SESSION['student_id'] = $user_data[0]['student_id'];
				//$rows = Yii::app()->db->createCommand("SELECT * FROM student WHERE ")->queryAll();
				//$session['student_array'] = $user_data[0];
			}*/
			
			
		}
		else
		{
			echo 2; // case of not-authenticated
		}
	}
	
	
	public function actionLogout()
	{
		$session = Yii::app()->session;
		unset($session['emp_array']);
		unset($session['student_array']);
		unset($session['linkedin_info']);
		session_destroy();
		$this->redirect('../posting/index');
	}
	
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	
	public function actionCreate()
	{
		$model = new Employer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employer']))
		{
			$model->attributes=$_POST['Employer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->employer_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	public function actionUpdatePassword()
	{
		
		$emp_id=isset($_POST['emp_id'])?$_POST['emp_id']:'';
		$emp_login_id=isset($_POST['emp_login_id'])?$_POST['emp_login_id']:'';
		$old_password=isset($_POST['old_password'])?$_POST['old_password']:'';
		$new_password=isset($_POST['password'])?$_POST['password']:'';
		if($emp_id)
		{
			$employerrmodel = User::model()->findByPk($emp_login_id);	
		}
		
		if(md5($old_password)==$employerrmodel->password)
		{
			$employerrmodel->password=md5($new_password);
			if($employerrmodel->save())
				echo 1;
		}
		else{
		  echo 2;	
		}
		
	}

	
	public function actionUpdateProfile()
	{
		
		$objEmployer =new Employer;
		$objUser = new User;
		
		$emp_id=isset($_POST['emp_id'])?$_POST['emp_id']:'';
		$emp_login_id=isset($_POST['emp_login_id'])?$_POST['emp_login_id']:'';
		$username=isset($_POST['username'])?$_POST['username']:'';
		$firstname=isset($_POST['firstname'])?$_POST['firstname']:'';
		$lastname=isset($_POST['lastname'])?$_POST['lastname']:'';
		$email=isset($_POST['email'])?$_POST['email']:'';
		$address=isset($_POST['address'])?$_POST['address']:'';
		$timezone=isset($_POST['firstname'])?$_POST['timezone']:'';
		
		$username_data= $objUser->get_user('username','','username="'.$email.'"',' AND  employer_id != '.$emp_id.'');
		if(count($username_data) > 0)
		{
			echo 2;
			exit;
		}
		
		$emp_data= $objEmployer->get_employer('email','',' email="'.$email.'"',' AND  employer_id != '.$emp_id.'');
		if(count($emp_data) > 0)
		{
			echo 3;
			exit;
		}
		
	
		if($emp_id)
		{
			$model=$this->loadModel($emp_id);	
			$usermodel = User::model()->findByPk($emp_login_id);	
		}
		
		
		/********find the longitude and latitude**************/
		
		$prepAddr = str_replace(' ','+',$address);
		// TODO: Find and alternate way to get the LAT, LONG so that live request is not sent always.
		$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=true');
		
		$output = json_decode($geocode);
		
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;
			
			
			
		//$model->username=trim(addslashes(strip_tags($username)));
		$model->firstname=trim(addslashes(strip_tags($firstname)));
		$model->lastname=trim(addslashes(strip_tags($lastname)));
		$model->email=trim(addslashes(strip_tags($email)));
		$model->longitude =$longitude;
		$model->latitude =$latitude;
		$model->address=trim(addslashes(strip_tags($address)));
		$model->timezone=trim(addslashes(strip_tags($timezone)));
		
		
		/*********update username in user table **************/
		
		$usermodel->employer_id=trim(addslashes(strip_tags($emp_id)));
		$usermodel->username=trim(addslashes(strip_tags($username)));
		$usermodel->save();
		
		
		
		if($model->save())
		{
			echo 1;
		}else
		{
		   echo 5;	
		}
		
		}
		
	public function actionUpdatePayment()
	{
		$PublishableKey = 'pk_test_guOskqsm83u56mz3eECGpo1i';
		$ApiKey         = 'sk_test_EcKjZUQXE8qEO3Nfgt9NRtUs';
		
		$objEmployer =new Employer;
		
		
		$emp_id=isset($_POST['emp_id'])?$_POST['emp_id']:'';
		$payment_id=isset($_POST['payment_id'])?$_POST['payment_id']:'';
		$fullname=isset($_POST['card_holder_name'])?$_POST['card_holder_name']:'';
		$street = isset($_POST['address_street'])?$_POST['address_street']:'';
		$city = isset($_POST['city'])?$_POST['city']:'';
		$state = isset($_POST['state'])?$_POST['state']:'';
		$zip = isset($_POST['zip'])?$_POST['zip']:'';
		$card_number=isset($_POST['card_number'])?$_POST['card_number']:'';
		$card_expiry=isset($_POST['card_expiry'])?$_POST['card_expiry']:'';
		$card_cvc=isset($_POST['card_ccv'])?$_POST['card_ccv']:'';
		$card_cvc=isset($_POST['card_ccv'])?$_POST['card_ccv']:'';
		$token=isset($_POST['stripeToken1'])?$_POST['stripeToken1']:'';
		$date_expiry = explode('/',$card_expiry);
		
		$objEmployerPayment = new EmployerCreditcard;
		/*$card_data = $objEmployerPayment->get_payment('*','','employer_id= '.$emp_id,' AND card_number = "'.$card_number.'"');
	     
		if(count($card_data) < 1)
		{*/
			try {
					require_once($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/lib/Stripe.php');
					Stripe::setApiKey($ApiKey);
						
						$customer = Stripe_Customer::create(array(
				 		"card" => $token,
				  		"description" => "payinguser@example.com")
						);
					
					
				} 
				
				catch (Stripe_CardError $e) {
					// Card was declined.
					$e_json = $e->getJsonBody();
					$err = $e_json['error'];
					
					$errors['stripe'] = $err['message'];
					print_r($errors['stripe']);
					exit;
				} 		
					
		//} 
		
        /* $payment_data = $objPayment->get_payment('*','','employer_id= '.$emp_id.' AND card_number = "'.$card_number.'"');
		 print_r($payment_data);
		 exit;*/
	   	$objPayment =  EmployerCreditcard::model()->findByPk($payment_id);
	   
	    $objPayment->card_number = $card_number;
		$objPayment->card_holder_name = $fullname;
		$objPayment->token_no=$customer->id;
		$objPayment->card_exp_month = $date_expiry[0];
		$objPayment->card_exp_year = $date_expiry[1];
		$objPayment->card_cvc = $card_cvc;
		$objPayment->address_line1 = $street;
		$objPayment->address_city = $city;
		$objPayment->address_state = $state;
		$objPayment->address_zip = $zip;
		$objPayment->employer_id = $emp_id;
		$objPayment->updated_at = date('Y-m-d h:i:s');
		
		/* if (!$objPayment->validate()) {
				 print_r($objPayment->errors);
				}
				exit;*/
		/*print_r($objPayment->attributes);
		exit;*/
	
		if($objPayment->save())
		{
			echo 1;
		}else
		{
		   echo 5;	
		}
		
		}		


	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	
	public function actionGetCurrentPost()
	{
		$empid=1; // TODO - Why is it hardcoded?
		
		$data['posts']=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.status = 1 ',' AND posting.end_date >='.date('Y-m-d').' AND posting.employer_id='.$empid.' ORDER BY posting.id DESC');
			
		$data['past_results'] = Posting::model()->findAll('status = 2 and employer_id='.$empid.' order by end_date desc  ');
		$this->renderPartial('current_post',array('data'=>$data));
	}  
	 

	public function actionGetTabContent($id,$empid='')
	{
		
		if($id==1) // 1. Current Posts
		{
			
			$data['posts'] = Posting::model()->get_post('posting.*,job_type.id `jobid`,job_type.title `jobname`,employer.company_logo  `image`','join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id','posting.status = 1 ',' AND posting.end_date >="'.date('Y-m-d').'" AND posting.employer_id='.$empid.' ORDER BY posting.id DESC');
			
			$data['past_results'] = Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.company_logo `image`','join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id','posting.employer_id='.$empid.' AND posting.status = 1 AND posting.end_date < "'.date('Y-m-d').'" OR posting.employer_id='.$empid.' AND  posting.status = 2  ORDER BY posting.end_date desc',' ');
			
		/*	echo '<pre>';
			print_r($data);
			exit;*/
			
			$this->renderPartial('current_post',array('data'=>$data));
		}
		if($id==2) // 2. Past Posts
		{
			$data=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.company_logo `image`','join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id','posting.employer_id='.$empid.' AND posting.status = 1 AND posting.end_date < "'.date('Y-m-d').'" OR posting.employer_id='.$empid.' AND  posting.status = 2  ORDER BY posting.end_date desc',' ');
			
			$this->renderPartial('view',array('data'=>$data));			
		}
		if($id == 3) // 3. Settings Tab
		{
			
			
			//$data=Employer::model()->get_employer('*','','employer_id=1',' AND status = 1 ');
			$data['employer']=$this->loadModel($empid);
			$data['emp_login']=User::model()->get_user('*','',' employer_id='.$empid,'AND role="employer"');
			
			$data['card_array']= EmployerCreditcard::model()->get_payment('*','',' employer_id = '.$empid.'');
			
			
			$this->renderPartial('settings',array('emp_data'=>$data,'timezone_data'=>$this->list_timezone(),'state_data'=>$this->list_states()));			
		}
		if($id==4) // 4. Add New Internsip
		{
			
			
			$data['add_posts'] = Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.status = 1 ',' AND posting.end_date >='.date('Y-m-d').' AND posting.employer_id='.$empid.'');
			
			$objPerk = new Perk;
			$data['perk'] = $objPerk->get_perk('*','','1 ORDER BY id');
			//$data=Employer::model()->get_employer('*','','employer_id=1',' AND status = 1 ');
			//$data=$this->loadModel($empid);
			$this->renderPartial('add_post',array('data'=>$data));			
		}
		
		
	} 
	 
	 
	public function list_states()
	{
		$state = array (0 =>"AL",1 =>"AK",2=>"AS",3=>"AZ",4 =>"CA",5 =>"CO",6 =>"CT",7	=>"DE",8 =>"DC",9 =>"FM",10 =>"FL",11 =>"AR",12 =>"GA",13 =>"GU",14 =>"HI",15 =>"ID",16 =>"IL" ,17 =>"IN",18 =>"IA",19=>"KS",20 =>"KY",21 =>"LA",22 =>"ME",23 =>"MH",24	=>"MD",25=>"MA",26=>"MI",27	=>"MN",28=>"MS",29=>"MO",30=>"MT",31=>"NE",32=>"NV",33=>"NH",34=>"NJ",35=>"NM",36=>"NY",37=>"NC",38=>"ND",39=>"MP",40=>"OH",41=>"OK",42=>"OR",43=>"PW",44=>"PA",45=>"PR",46=>"RI",47=>"SC",48=>"SD",49=>"TN",50=>"TX",51=>"UT",52=>"VT",53=>"VI",54=>"VA",55=>"WA",56=>"WV",57=>"WI",58=>"WY");
		
		return $state;
	} 
	
	public	function list_timezone()
	{
		$timezone=array("0"=>array("(GMT -12:00)" , "(GMT -12:00) Eniwetok, Kwajalein"),
			              "1"=>array("(GMT -11:00)","(GMT -11:00) Midway Island, Samoa"),
			              "2"=>array("(GMT -10:00)","(GMT -10:00) Hawaii"),
			              "3"=>array("(GMT -9:00)","(GMT -9:00) Alaska"),
			              "4"=>array("(GMT -8:00)","(GMT -8:00) Pacific Time (US & Canada)"),
			              "5"=>array("(GMT -7:00)","(GMT -7:00) Mountain Time (US & Canada)"),
			              "6"=>array("(GMT -6:00)","(GMT -6:00) Central Time (US & Canada), Mexico City"),
			              "7"=>array("(GMT -5:00)","(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima"),
			              "8"=>array("(GMT -4:00)","(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz"),
			              "9"=>array("(GMT -3:30)","(GMT -3:30) Newfoundland"),
			              "10"=>array("(GMT -3:00)","(GMT -3:00) Brazil, Buenos Aires, Georgetown"),
			              "11"=>array("(GMT -2:00)","(GMT -2:00) Mid-Atlantic"),
			              "12"=>array("(GMT -1:00)","(GMT -1:00 hour) Azores, Cape Verde Islands"),
			              "13"=>array("(GMT 0:00)","(GMT) Western Europe Time, London, Lisbon, Casablanca"),
			              "14"=>array("(GMT +1:00)","(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris"),
			              "15"=>array("(GMT +2:00)","(GMT +2:00) Kaliningrad, South Africa"),
			              "16"=>array("(GMT +3:00)","(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg"),
			              "17"=>array("(GMT +3:30)","(GMT +3:30) Tehran"),
			              "18"=>array("(GMT +4:00)","(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi"),
			              "19"=>array("(GMT +4:30)","(GMT +4:30) Kabul"),
			              "20"=>array("(GMT +5:00)","(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent"),
			              "21"=>array("(GMT +5:30)","(GMT +5:30) Bombay, Calcutta, Madras, New Delhi"),
			              "22"=>array("(GMT +5:45)","(GMT +5:45) Kathmandu"),
			              "23"=>array("(GMT +6:00)","(GMT +6:00) Almaty, Dhaka, Colombo"),
			              "24"=>array("(GMT +7:00)","(GMT +7:00) Bangkok, Hanoi, Jakarta"),
			              "25"=>array("(GMT +8:00)","(GMT +8:00) Beijing, Perth, Singapore, Hong Kong"),
			              "26"=>array("(GMT +9:00)","(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk"),
			              "27"=>array("(GMT +9:30)","(GMT +9:30) Adelaide, Darwin"),
			              "28"=>array("(GMT +10:00)","(GMT +10:00) Eastern Australia, Guam, Vladivostok"),
			              "29"=>array("(GMT +11:00)","(GMT +11:00) Magadan, Solomon Islands, New Caledonia"),
			              "30"=>array("(GMT +12:00)","(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka"));	
						  					  
						  
		return $timezone;
	}
	
	
	public function actionGetPost($id,$emp_id)
    {
	  
	  $data = Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.id ="'.$id.'"',' AND posting.employer_id='.$emp_id.' AND status=1');
	  $data[0]['tab_post']='post_detail';
	  $this->renderPartial('current_post',array('data'=>$data));
		
   }
   

	public function loadModel($id)
	{
		$model = Employer::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

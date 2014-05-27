<?php

class PostingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column1';

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
	 
	public function actionGetIndustry()
	{
		
			
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(404);
			
		$job_data=JobType::model()->get_job('title','','status = 1');
		$typeahead_string='';	
		for($i=0; $i< count($job_data); $i++)
		{
			$formatted_name    =  '"' .$job_data[$i]['title'] . '", ';
			$typeahead_string .= $formatted_name;
		 }
	
		$option_list = "[" . rtrim($typeahead_string, ", ") . "]";
		$data = $option_list;
		echo $data;
		
	} 
	
	public function actionGetSkills()
	{
		
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(404);
			
	$skill_data=Skill::model()->get_skill('id,name','','status = 1 ');
	$typeahead_string='';	
	for($i=0; $i< count($skill_data); $i++)
	{
	 	$formatted_name    =  '"' .$skill_data[$i]['name'] . '",';
  		$typeahead_string .= $formatted_name;
	 }

 	$option_list = "[" . rtrim($typeahead_string, ", ") . "]";
 	$data = $option_list;
	echo $data;
	} 
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

   
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$session = Yii::app()->session;
		$model=new Posting;
		$objEmployer= new Employer;
		
		//print_r($_POST);
		$PublishableKey = 'pk_test_guOskqsm83u56mz3eECGpo1i';
		$ApiKey         = 'sk_test_EcKjZUQXE8qEO3Nfgt9NRtUs';
		//$token='tok_1RgYSWygpzOYKB';
		//print_r($_POST);
		if(isset($_POST))
		{
		  
		/*****employer_information******/  
		$firstname=isset($_POST['first-name'])?$_POST['first-name']:'';
		$lastname=isset($_POST['last-name'])?$_POST['last-name']:'';
		$company=isset($_POST['company_name'])?$_POST['company_name']:'';
		$email=isset($_POST['employer_email'])?$_POST['employer_email']:'';
		$website=isset($_POST['website'])?$_POST['website']:'';
		$no_of_interns=isset($_POST['total_interns'])?$_POST['total_interns']:'';
		$total_price=isset($_POST['intern_price'])?$_POST['intern_price']:'30';
		$token = isset($_POST['stripeToken'])?$_POST['stripeToken']:'';
		$comapany_address=isset($_POST['employer_address'])?$_POST['employer_address']:'';
		$agree=isset($_POST['tos-agreed]'])?$_POST['tos-agreed']:'';
		$password = $this->createPassword();
		
		
		$emp_data= $objEmployer->get_employer('username','','username="'.$email.'"');
		if(count($emp_data) > 0)
		{
			echo 2;
			exit;
		}
		
		$email_data= $objEmployer->get_employer('email','','email="'.$email.'"','');
		if(count($email_data) > 0)
		{
			echo 3;
			exit;
		}
		if(empty($total_price))
		{
			$total_price = 30;
		}
		/*echo $total_price;
		exit;*/
		try {
			
			
			require_once($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/lib/Stripe.php');
			// the amount variable takes value in cents by default.
			
	       	Stripe::setApiKey($ApiKey);
			$charge = Stripe_Charge::create(array(
			  "amount" => $total_price*100,
			  "currency" => "usd",
			  "card" => $token, 
			  "description" => "Charge for test@example.com")
			);
			/*print_r($charge);
			exit;*/
			if ($charge->paid == true) {
					$objEmployer->firstname=trim(addslashes(strip_tags($firstname)));
					$objEmployer->lastname=trim(addslashes(strip_tags($lastname)));
					$objEmployer->username=trim(addslashes(strip_tags($email)));
					$objEmployer->password=trim(addslashes(strip_tags(md5($password))));
					$objEmployer->email=trim(addslashes(strip_tags($email)));
					$objEmployer->address=trim(addslashes(strip_tags(htmlspecialchars($comapany_address))));
					$objEmployer->url=trim(addslashes(strip_tags($website)));
					$objEmployer->company_name=trim(addslashes(strip_tags($company)));
					$objEmployer->status=trim(addslashes(strip_tags(1)));
					$objEmployer->joining_date=trim(addslashes(strip_tags(date('Y-m-d h:i:s'))));
					$objEmployer->token_no=$token;
					$objEmployer->card_holder_name=$charge->card->name;
					$objEmployer->card_type=$charge->card->type;
					$objEmployer->card_exp_month=$charge->card->exp_month;
					$objEmployer->car_exp_year=$charge->card->exp_year;
					$objEmployer->card_fingerprint=$charge->card->fingerprint;
					$objEmployer->country=$charge->card->country;
					$objEmployer->address_line1=$charge->card->address_line1;
					$objEmployer->address_line2=$charge->card->address_line2;
					$objEmployer->address_city=$charge->card->address_city;
					$objEmployer->address_state=$charge->card->address_state;
					$objEmployer->address_zip=$charge->card->address_zip;
					$objEmployer->address_country=$charge->card->address_country;
					$objEmployer->cvc_check=$charge->card->cvc_check;
					$objEmployer->address_line1_check=$charge->card->address_line1_check;
					$objEmployer->address_zip_check=$charge->card->address_zip_check;
					$objEmployer->paid=$charge->paid;
					$objEmployer->currency=$charge->currency;
					/*print_r($objEmployer->attributes);
	 				 exit;*/
	   				/* if (!$objEmployer->validate()) {
				 print_r($objEmployer->errors);
				}
				exit;*/
				
					if($objEmployer->save())
					{
						$employer_id= Yii::app()->db->getLastInsertId();
						
					}else
					{
					  echo 4;
					     
					}	
			
				/******** Post Information***********/  
				$session = Yii::app()->session;
				$objEmployer = new Employer;
				$employer_data=$objEmployer->get_employer('*','','username = "'.$email.'" AND password = "'.md5($password).'"');
				if(count($employer_data) > 0)
				{
					$session['emp_array'] = $employer_data[0];
				}	
				
			  $title=isset($_POST['post_title'])?$_POST['post_title']:'';
			  $date=isset($_POST['post_date'])?$_POST['post_date']:'';
			  $description=isset($_POST['post_description'])?$_POST['post_description']:'';	
			  $job_type=isset($_POST['job_type'])?$_POST['job_type']:'';
			  
			  $skilltags = isset($_POST['hidden-skilltags'])?$_POST['hidden-skilltags']:'';
			  
		  
		
			  $post_date_array=explode('-',$date);	
			  $start_date_format=explode('/',$post_date_array[0]);
			  $start_date=trim($start_date_format[2]).'-'.trim($start_date_format[0]).'-'.trim($start_date_format['1']);
					
			  $end_date_format=explode('/',$post_date_array[1]);
			  $end_date=trim($end_date_format[2]).'-'.trim($end_date_format[0]).'-'.trim($end_date_format['1']);
			
			  $hidden_skilles_array = explode(',',$skilltags);
		  
			  $typeahead_string = '';
			  for($i=0; $i<count($hidden_skilles_array); $i++)
			  {
				  $skill_array=Skill::model()->search_skill($hidden_skilles_array[$i]).',';
				  $typeahead_string .= $skill_array;
			  }
				$skill_list = rtrim($typeahead_string, ", ");
				
				$job_data=JobType::model()->get_job('id','','title ="'.$job_type.'"');
				if(count($job_data) < 1 )
				{
					 $rows = Yii::app()->db->createCommand()->insert('job_type',array(
							'title'=>$job_type,
							'status'=>'1',
						));					
					 $job_title=Yii::app()->db->getLastInsertID();
				}else{
					$job_title=$job_data[0]['id'];
				}
			
				//Yii::app()->user->setFlash('success', " You have Sign up successfully.Please change your Password in settings");
			
				$model->title=trim(addslashes(strip_tags($title)));
				$model->job_type_id=trim(addslashes(strip_tags($job_title)));
				$model->description=trim(addslashes(strip_tags(htmlspecialchars($description))));
				$model->start_date=trim(addslashes(strip_tags($start_date)));
				$model->employer_id=$employer_id;
				$model->end_date=trim(addslashes(strip_tags($end_date)));
				$model->skill_id=trim(addslashes(strip_tags($skill_list)));
				$model->interns_limit=$no_of_interns;
				$model->total_price=$total_price;
				$model->facebook_id='www.facebook.com';
				$model->twitter_id='www.twitter.com';
				$model->linkedin_id='www.linkedin.com';
				$model->status='1';
				$model->created_at=date('Y-m-d h:i:s');
				$model->updated_at='';
	
    			/*  print_r($model->attributes);
	 				 exit;*/
				/* if (!$model->validate()) {
				 print_r($model->errors);
				}*/
				//exit;
			
				
			 	$name='=?UTF-8?B?'.base64_encode($email).'?=';
				$subject='=?UTF-8?B?'.base64_encode('Internify Registration Process').'?=';
				/*$headers="From: {$email} >\r\n".
							"Reply-To: anam.imtiaz@zigron.com\r\n".
							"MIME-Version: 1.0\r\n".
							"Content-type: text/plain; charset=UTF-8";*/
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers  .= "From:  <internify@zigron.com>" . "\r\n";			
				
					 $body = "
						<html>
						<head>
						<title>Internify Registration Process</title>
						</head>
						<body>
						<p style=' font-family: Verdana;font-size: 13px; line-height: 21px;'> <strong> Congratulations!</strong> <br> You been have Registered successfully on Internify. <br /> Kindly login with your following login Details  <br /> <strong>Username :</strong> ".$email." <br> <strong>Password :</strong> ".$password." </p>
						
						</body>
						</html>
						";			
			 			mail($email,$subject,$body,$headers);   
			 
						
		  /* $body=' You have been Registered Successfully. This your following Login details.Kindly Sign in to confirm your account<br /> Username : '.$email.' and password : '.$password.'';*/
			
				
				if($model->save())
				{
					echo 1;
					
					
				}else
				{
					echo 4;
					exit;
				}
		 }			
			
		} catch (Stripe_CardError $e) {
		    // Card was declined.
			$e_json = $e->getJsonBody();
			$err = $e_json['error'];
			
			$errors['stripe'] = $err['message'];
			print_r($errors['stripe']);
			exit;
		} 
		exit;
	
		
		/*print_r($objEmployer->attributes);
	   exit;*/
	   	
		
		
		/*$employer_data = $objEmployer->get_employer('*','','username = "'.$email.'"','');
		$session['emp_array'] = $employer_data[0];*/
				
		/* if (!$objEmployer->validate()) {
		print_r($objEmployer->errors);
		}*/
      
  	  }

	}
	
	
	public function createPassword()
	{
		/*$min=4; 
		$max=15; 
		$pwd=""; 

		for($i=0;$i<rand($min,$max);$i++)
		{
		$num=rand(48,122);
		
		  if(($num > 97 && $num < 122))
		  {
			  $pwd.=chr($num);
		  }
		
		  else if(($num > 65 && $num < 90))
		  {
			  $pwd.=chr($num);
		  }
		
		  else if(($num >48 && $num < 57))
		  {
			  $pwd.=chr($num);
		  }
		
		  else if($num==95)
		  {
			  $pwd.=chr($num);
		  }
		
		  else
		  {
			  $i--;
		  }
		}

		return $pwd;*/
		
		

		$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
		srand((double)microtime()*1000000); 
		$i = 0; 
		$pass = '' ; 

		while ($i <= 7) { 
			$num = rand() % 33; 
			$tmp = substr($chars, $num, 1); 
			$pass = $pass . $tmp; 
			$i++; 
		} 

	    return $pass; 
 }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$div_id,$emp_id)
	{
		/*print_r($_POST);
		exit;*/
		$model=$this->loadModel($id);
		if($model->employer_id==$emp_id)
	  	{
	  	  $post_id = $id;
		  $post_value = isset($_REQUEST['value'])?$_REQUEST['value']:'';
	  
		   /****Post Title******/
		   
		   if($div_id == 'employer_title')
			{
				$emp_data = Posting::model()->get_post('title','',' title="'.$post_value.'"');
				
				if(count($emp_data) > 0)
				{
					echo 'Title Already exists';
					return false;
				}else{
					$model->title=$post_value;
				}
			}
		
		/*****Post Skills******/
		
			if($div_id == 'employer_skills')
			{
				$typeahead_string='';
				for($i=0; $i< count($post_value); $i++)
				{
					
					$skill_id=Skill::model()->search_skill(ltrim($post_value[$i],'<br>')).",";
					
					$typeahead_string .= $skill_id;
				}
					$skill_list = rtrim($typeahead_string, ", ");
					$model->skill_id = trim(addslashes(strip_tags($skill_list)));
			} 
		
		/*****Post Industry******/
		
			 if($div_id == 'employer_industry')
			{
				$job_data= JobType::model()->get_job('id','','title="'.$post_value.'"');
				
				if(count($job_data) > 0 )
				{
					$model->job_type_id=$job_data[0]['id'];
				}else
				{
					
					 $rows = Yii::app()->db->createCommand()->insert('job_type',array(
						'title'=>$post_value,
						'status'=>'1',
					));					
				 	 $job_id=Yii::app()->db->getLastInsertID();
					  $model->job_type_id=$job_id;
					
				}
			} 
			
		
		/*****Post Description******/
		
			if($div_id == 'employer_description')
			{
					
					$model->description = addslashes(htmlspecialchars($post_value));
					
			} 
			if($div_id=='employer_facebook')
			{
				$facebook=explode('.',$post_value);
				if($facebook[1]=='facebook')
				{
					$model->facebook_id = addslashes(htmlspecialchars($post_value));
				}else
				{
					
					echo 'Please enter Facebook url';
					return false;
				}
				
			}
		
			if($div_id == 'employer_twitter')
			{
				$twitter=explode('.',$post_value);
				if($twitter[1]=='twitter')
				{
					
					$model->twitter_id = addslashes(htmlspecialchars($post_value));
				}else
				{
					
					echo 'Please enter Twitter url';
					return false;
				}			
			}
		
			if($div_id == 'employer_linkedin')
			{
				$linkedin=explode('.',$post_value);
				if($linkedin[1]=='linkedin')
				{
				   $model->linkedin_id = addslashes(htmlspecialchars($post_value));
				}else
				{
					echo 'Please enter Linkedin url';
					return false;
				}
				
			} 
		
			
				if($model->save())
					echo 1;
				/*else
				  $errores = $model->getErrors();
				  print_r($errores);*/
				  
	  }      
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$emp_id)
	{
		$model=$this->loadModel($id);
		if($model->employer_id==$emp_id)
		{
		  $model->delete();
		  echo 1;	
		}
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		if(isset($_POST) && $_POST)
		{
			print_r($_POST);
			echo 'hello';
			exit;
		}
		
		$model=new Posting;
		$dataProvider=new CActiveDataProvider('Posting');
		$this->render('index',array(
			'model'=>$model,
		));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Posting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Posting']))
			$model->attributes=$_GET['Posting'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Posting the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Posting::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function search_skill($title)
	{
		 $sql="select id from skill where name='".$title."' and status=1 ";
		 			$rows = Yii::app()->db->createCommand($sql)->queryRow();
					 if(count($rows)>0)
					{
						return $rows['id'];
					}else
					{
			
			
						echo 'hello';
						$sql="Insert into skill set name='".$title."',status=1";
						$connection = Yii::app()-> db;
						$command = $connection ->createCommand($sql);
						$command -> execute();
						echo  $id=Yii::app()->db->lastInsertID;
						
						exit;
					}
		
	}

	/**
	 * Performs the AJAX validation.
	 * @param Posting $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='posting-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

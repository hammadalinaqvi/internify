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
	}*/

	 
	public function actionIndex()
	{
		$model=new Posting;
		$dataProvider=new CActiveDataProvider('Posting');
		
		$objPerk = new Perk;
		$data['perk'] = $objPerk->get_perk('*','','1 ORDER BY id');
		
		$this->render('index',array(
			'data'=>$data,
		));
		
	}
	
	public function actionCheckIndustry()
	{
		/*****Post Industry******/
		 $post_value = isset($_REQUEST['value'])?$_REQUEST['value']:'';
		 
				if(count($post_value) >1)
				{
					echo 1;
					return false;
				}
		 
		
	}
	
	public function actionDuplicatePost($emp_id,$title)
	{
		$PublishableKey = 'pk_test_guOskqsm83u56mz3eECGpo1i';
		$ApiKey         = 'sk_test_EcKjZUQXE8qEO3Nfgt9NRtUs';
		
		
		$employer_id=$emp_id;
		//$employer_id =4 ;
		$objEmployerPayment = new EmployerCreditcard;
		$card_data = $objEmployerPayment->get_payment('*','','employer_id= '.$employer_id,'');
		/*print_r($card_data);
		exit;*/
		
		if($title == 'current')
		{
			$amount = 3000;
		}else if($title == 'past')
		{
			$amount = 2500;
		}
		try {
			
			require_once($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/lib/Stripe.php');
			
			Stripe::setApiKey($ApiKey);
				
				
				$charge = Stripe_Charge::create(array(
				  "amount" => $amount,
				  "currency" => "usd",
				  "customer" => $card_data[0]['token_no'])
				);
			if ($charge->paid == true) {
				
			  $post_id 	   = isset($_POST['postid'])?$_POST['postid']:$_POST['postid'];			   
			  $title 	   = isset($_POST['title_'.$post_id])?$_POST['title_'.$post_id]:$_POST['title'];	
			  $date		   = isset($_POST['daterange'])?$_POST['daterange']:'';
			  $description = isset($_POST['description_'.$post_id])?$_POST['description_'.$post_id]:$_POST['description'];	
			  $job_type    = isset($_POST['industry_'.$post_id][0])?$_POST['industry_'.$post_id][0]:$_POST['industry'];
			  $facebook_id = isset($_POST['facebook_'.$post_id])?$_POST['facebook_'.$post_id]:$_POST['facebook_id'];
			  $twitter_id  = isset($_POST['twitter_'.$post_id])?$_POST['twitter_'.$post_id]:  $_POST['twitter_id'];
			  $linkedin_id = isset($_POST['linkedin_'.$post_id])?$_POST['linkedin_'.$post_id]:$_POST['linkedin_id'];
			  
			  $post_date_array   = explode('-',$date);	
			  $start_date_format = explode('/',$post_date_array[0]);
			  $start_date = trim($start_date_format[2]).'-'.trim($start_date_format[0]).'-'.trim($start_date_format['1']);
					
			  $end_date_format = explode('/',$post_date_array[1]);
			  $end_date = trim($end_date_format[2]).'-'.trim($end_date_format[0]).'-'.trim($end_date_format['1']);
			
			  if(isset($_POST['skills_'.$post_id]))
			  {
				  $skilltags = $_POST['skills_'.$post_id];
			  }else
			  {
			    $skills = $_POST['skills'];
			 	$skilltags = explode(',',$skills);
			 
			
			  }
		  
			  $typeahead_string = '';
			  for($i=0; $i<count($skilltags); $i++)
			  {
				  $skill_array=Skill::model()->search_skill($skilltags[$i]).',';
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
				}
				
				{
					$job_title=$job_data[0]['id'];
				}
				
				$objEmployerPayment = new EmployerCreditcard;
				$card_data = $objEmployerPayment->get_payment('*','','employer_id= '.$emp_id,'');	
				
				$model=new Posting;
				//Yii::app()->user->setFlash('success', " You have Sign up successfully.Please change your Password in settings");
			    
				$model->title = trim(addslashes(strip_tags($title)));
				$model->job_type_id = trim(addslashes(strip_tags($job_title)));
				$model->description = trim(addslashes(strip_tags(htmlspecialchars($description))));
				$model->start_date = trim(addslashes(strip_tags($start_date)));
				$model->employer_id = $emp_id;
				$model->end_date = trim(addslashes(strip_tags($end_date)));
				$model->skill_id = trim(addslashes(strip_tags($skill_list)));
				$model->facebook_id = $facebook_id;
				$model->twitter_id = $twitter_id;
				$model->linkedin_id = $linkedin_id;
				$model->status = '1';
				$model->created_at = date('Y-m-d h:i:s');
				$model->updated_at = '';
				
				
				if($model->save())
				{
					//echo 1;
					$post_id= Yii::app()->db->getLastInsertId();
					 
					$objPayment = new JobPayment;   
					$objPayment->employer_id = $emp_id;
					$objPayment->posting_id = $post_id;  					
					$objPayment->payment_id=$card_data[0]['id'];
					$objPayment->status = 1;
					$objPayment->created_at = date('Y-m-d');
					$objPayment->save();
					echo 1;
					
				}
				
				else
				{
					echo 4;
					exit;
				}
				   
				   
				}
		 
		else
		{
			 echo 5;
			 exit;
		}		
			
		} 
		
		catch (Stripe_CardError $e) {
		    // Card was declined.
			$e_json = $e->getJsonBody();
			$err = $e_json['error'];
			
			$errors['stripe'] = $err['message'];
			print_r($errors['stripe']);
			exit;
		} 
		
		
		
	}

	public function actionAdmin()
	{
		$model = new Posting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Posting']))
			$model->attributes = $_GET['Posting'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionGetIndustry()
	{
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
	
	public function actionChargeCard()
	{
		$PublishableKey = 'pk_test_guOskqsm83u56mz3eECGpo1i';
		$ApiKey         = 'sk_test_EcKjZUQXE8qEO3Nfgt9NRtUs';
		
		
		$employer_id=isset($_POST['emp_id'])?$_POST['emp_id']:'';
		//$employer_id =4 ;
		$objEmployerPayment = new EmployerCreditcard;
		$card_data = $objEmployerPayment->get_payment('*','','employer_id= '.$employer_id,'');
		try {
			
			require_once($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/lib/Stripe.php');
			
			Stripe::setApiKey($ApiKey);
				
				// Charge the Customer instead of the card
				$charge = Stripe_Charge::create(array(
				  "amount" => 3000, # amount in cents, again
				  "currency" => "usd",
				  "customer" => $card_data[0]['token_no'])
				);
			if ($charge->paid == true) {
				echo 1;
				exit;
				}
		 
		else
		{
			 echo 5;
			 exit;
		}		
			
		} 
		
		catch (Stripe_CardError $e) {
		    // Card was declined.
			$e_json = $e->getJsonBody();
			$err = $e_json['error'];
			
			$errors['stripe'] = $err['message'];
			print_r($errors['stripe']);
			exit;
		} 
		
		
	}
	
	public function actionAddInternship($emp_id)
	{
		/*$PublishableKey = 'pk_test_guOskqsm83u56mz3eECGpo1i';
		$ApiKey         = 'sk_test_EcKjZUQXE8qEO3Nfgt9NRtUs';*/
		//$token = 'tok_1RgYSWygpzOYKB';
		
		if(isset($_POST))
		{
			$error = '';
		  if(!isset($_POST['employer_title']) || !isset($_POST['employer_industry']) || !isset($_POST['employer_description']) || !isset($_POST['employer_skills']) || !$_POST['daterange'] )
		  {
			$error =  " &nbsp;&nbsp;All Fields are Required <br>";  
		  }
		  
		  if(isset($_POST['employer_industry']) && count($_POST['employer_industry']) == 2)
		  {
		   	$error  .=  " &nbsp;&nbsp;Enter Only one industry";  
		  }
		  
		   if($error)
		  {
			echo  $error;
			exit;
			
	      }else
		  {
			 
		  
				/******** Post Information***********/  
			
				
			  $title = isset($_POST['employer_title'])?$_POST['employer_title']:'';	
			  $date = isset($_POST['daterange'])?$_POST['daterange']:'';
			  $description = isset($_POST['employer_description'])?$_POST['employer_description']:'';	
			  $job_type = isset($_POST['employer_industry'][0])?$_POST['employer_industry'][0]:'';
			  $skilltags = isset($_POST['employer_skills'])?$_POST['employer_skills']:'';
			  
			  
			  $post_date_array=explode('-',$date);	
			  $start_date_format=explode('/',$post_date_array[0]);
			  $start_date=trim($start_date_format[2]).'-'.trim($start_date_format[0]).'-'.trim($start_date_format['1']);
					
			  $end_date_format=explode('/',$post_date_array[1]);
			  $end_date=trim($end_date_format[2]).'-'.trim($end_date_format[0]).'-'.trim($end_date_format['1']);
			
			 // $hidden_skilles_array = explode(',',$skilltags);
			 
			 /* $perk_string = '';
				
				if(isset($_POST['perk']) && count($_POST['perk'])>0)
				{
					for($i=0; $i< count($_POST['perk']); $i++)
					{  
						$values = $_POST['perk'][$i].',';
						$perk_string .= $values;
					}
					$perk_list = rtrim($perk_string, ", ");
				}*/
				
		  
			  $typeahead_string = '';
			  for($i=0; $i<count($skilltags); $i++)
			  {
				  $skill_array=Skill::model()->search_skill($skilltags[$i]).',';
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
				}
				
				{
					$job_title=$job_data[0]['id'];
				}
				
				$objEmployerPayment = new EmployerCreditcard;
				$card_data = $objEmployerPayment->get_payment('*','','employer_id= '.$emp_id,'');	
				
				$model=new Posting;
				//Yii::app()->user->setFlash('success', " You have Sign up successfully.Please change your Password in settings");
			    
				$model->title = trim(addslashes(strip_tags($title)));
				$model->job_type_id = trim(addslashes(strip_tags($job_title)));
				$model->description = trim(addslashes(strip_tags(htmlspecialchars($description))));
				$model->start_date = trim(addslashes(strip_tags($start_date)));
				$model->employer_id = $emp_id;
				$model->end_date = trim(addslashes(strip_tags($end_date)));
				$model->skill_id = trim(addslashes(strip_tags($skill_list)));
				
				/*if(isset($_POST['perk']) && count($_POST['perk'])>0)
				{
					$model->perk_id=trim(addslashes(strip_tags($perk_list)));
				}
				
				else
				{
					$model->perk_id=0;
				}*/
				
				/*$model->interns_limit = $no_of_interns;
				$model->total_price = $total_price;*/
				$model->facebook_id = 'www.facebook.com';
				$model->twitter_id = 'www.twitter.com';
				$model->linkedin_id = 'www.linkedin.com';
				$model->status = '1';
				$model->created_at = date('Y-m-d h:i:s');
				$model->updated_at = '';
				
				if($model->save())
				{
					//echo 1;
					$post_id= Yii::app()->db->getLastInsertId();
					 
					$objPayment = new JobPayment;   
					$objPayment->employer_id = $emp_id;
					$objPayment->posting_id = $post_id;  					
					$objPayment->payment_id=$card_data[0]['id'];
					$objPayment->status = 1;
					$objPayment->created_at = date('Y-m-d');
					$objPayment->save();
					echo 1;
					
				}
				
				else
				{
					echo 4;
					exit;
				}
		 }
		}
	}
	
	
	public function actionApply($post_id, $employer_id, $student_id)
	{
		//echo $post_id." ".$employer_id." ".$student_id." ".$resume_filename;
		 //echo $_POST['internship_title']; exit; 
		 //print_r($_POST);
		 $error = '';
		 if(isset($_POST['internship_title']) && empty($_POST['internship_title']))
		 {
		   	 $error = '&nbsp;&nbsp;Please add the title<br>';
		 }
		 if(empty($_FILES['student_resume']) )
		 {
			 $error  .= '&nbsp;&nbsp;Please upload resume<br>';
		 }
		/* if( !empty($_FILES['student_resume']) && !$_POST['old_resume'])
		 {
			 $error  .= '&nbsp;&nbsp;Please user only one option for add a resume<br>';
		  }*/
		  
		 if($error)
		 {
			 echo $error;
			 exit;
			 
		 }else{
		$internship_data = Yii::app()->db->createCommand("SELECT * FROM job_applicant WHERE posting_id='".$post_id."' AND employer_id='".$employer_id."' AND student_id='".$student_id."' AND status=1")->queryAll();
		
		if(count($internship_data) > 0)
		{
			echo 0; // failure: Already applied to the internship post
			exit;
			
		}
		else
		{
			
			
			/*if(!$_POST['old_resume'])
			{
			   $filename = $_POST['old_resume'];	
			   
			}else if($_FILES['student_resume'])
			{
			  */
			  
			
			  
			  /*$allowedExts = array("pdf", "doc", "docx"); 
			  $extension = end(explode(".", $_FILES["student_resume"]["name"]));*/
			 
			  /* print_r($_FILES["student_resume"]);
			   exit;*/
				if ((($_FILES["student_resume"]["type"] == "application/msword")
				||($_FILES["student_resume"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
				||($_FILES["student_resume"]["type"] == "application/octet-stream")
				|| ($_FILES["student_resume"]["type"] == "application/pdf")))
				  {					
				  		
				      if($_FILES["student_resume"]["size"] < 80000)
					  {
						  				    
							 $uploadedFile = CUploadedFile::getInstanceByName('student_resume');
							 /*$lastDot = strrpos($uploadedFile->getName(), ".");
						 	 $filename = str_replace(".", "", substr($uploadedFile->getName(), 0, $lastDot)) . substr($uploadedFile->getName(), $lastDot);  exit;*/
							 $filename = time()."_".rand(100, 99999999)."_".$uploadedFile->getName();
							 //$target_dir = $_SERVER['DOCUMENT_ROOT']."/sitedata/resume/".$filename;
							
							 $target_dir = $_SERVER['DOCUMENT_ROOT']."internify_local/sitedata/resume/".$uploadedFile->getName();
							 $uploadedFile->saveAs($target_dir); 
							 $rows = Yii::app()->db->createCommand("INSERT INTO job_applicant SET 
																				posting_id='".$post_id."', 
																				employer_id='".$employer_id."', 
																				student_id='".$student_id."',
																				title='".$_POST['internship_title']."',
																				message='". $_POST['internship_message']."',
																				resume='".$filename."',
																				status=1,
																				created_at='".date("Y-m-d")."',
																				updated_at='".date("Y-m-d")."'")->execute();
							echo 1; // successfull applied
					  }else
					  {
						  echo "File size is too large";
						  exit;  
					  }
					
				  }else{
					echo 2; // not valid extensions and file upload size  
				  }
			//}
			
			
		}
		
	} 
	
}// END - Function ApplyInternship
	
	
	public function actionGetSkills()
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(404);
			
		$skill_data = Skill::model()->get_skill('id,name','','status = 1 ');
		$typeahead_string='';	
		for($i=0; $i< count($skill_data); $i++)
		{
			$formatted_name    =  '"'.trim($skill_data[$i]['name']).'",';
			$typeahead_string .= $formatted_name;
		}
	
		$option_list = "[".rtrim($typeahead_string,",")."]";
		$data = $option_list;
		echo $data;
	} 
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionMap($longitude,$latitude)
	{
		$data['longitude'] = $longitude;
		$data['latitude'] = $latitude;
		$this->renderPartial('load',array('data'=>$data));
	}
	
	public function actionInternship()
	{
		$session = Yii::app()->session;
		/*print_r($session['linkedin_info']);
		exit;*/
/* *********************** PAGE LOADING ON REFINED SEARCHING **********************************/
		
		if( isset( $_POST['search_posted'] ) )
		{
			
			
			//echo "<pre>";  
			if($_POST['daterange'] != "")
			{
				$date_range = explode("-", $_POST['daterange']);
				
				$f_date = explode("/", trim($date_range[0]));
				$t_date = explode("/", trim($date_range[1]));
				
				$from_date = implode("-", array($f_date[2],$f_date[0],$f_date[1] ));
				$to_date = implode("-", array($t_date[2],$t_date[0],$t_date[1] ));
			}
			
			if ($_POST['all_skill_ids'] != "" && $_POST['all_organization_ids'] != "" && $_POST['daterange'] != "" ) 
			{
				/*$all_skills = trim($_POST['all_skill_ids'], ",");
				$all_organizations = trim($_POST['all_organization_ids'], ",");*/
				
				
				$all_skills = explode( ",",$_POST['all_skill_ids']);
				//print_r($all_skills);
				$all_organizations = explode(',',$_POST['all_organization_ids']);
				//print_r($all_organizations);
													
			 $post_data = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.start_date >= "'.$from_date.'" AND posting.end_date <= "'.$to_date.'" ');
													
					//$data['posts'] = array();	
				if(count($post_data) > 0)
				{					
					for($i=0; $i<count($post_data); $i++)
					{
						$skill_array = explode(',',$post_data[$i]['skill_id']);
					
						if(in_array($post_data[$i]['job_type_id'],(array)$all_organizations)==1)
						{
							
								$data['posts'][] = $post_data[$i];
								continue;
						}else{
							
							 $skill_post_array[] = $post_data[$i];	
						}
								
							
					}
					if(isset($skill_post_array))
					{
						for($i=0; $i<count($skill_post_array); $i++)
						{
							$skill_array = explode(',',$skill_post_array[$i]['skill_id']);
							
							for($j=0; $j<count($all_skills); $j++)
							{  
								//echo in_array($all_skills[$j],(array)$skill_array);
								
									if(in_array($all_skills[$j],(array)$skill_array)==1)
									{
										$data['posts'][] = $skill_post_array[$i];
										break;
										
									}
								
							}
						}
					}
				}else
				{
				  $data['posts'] = array();	
				}
				/*echo '<pre>';
				print_r($data['posts']);
				exit;	*/											
			}
			else if ($_POST['all_skill_ids'] != "" && $_POST['all_organization_ids'] == "" && $_POST['daterange'] != "" )  
			{
				$all_skills = explode( ",",$_POST['all_skill_ids']);
				//print_r($all_skills);
			 $post_data = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.start_date >= "'.$from_date.'" AND posting.end_date <= "'.$to_date.'" ');
													
					//$data['posts'] = array();
					/*echo "<pre>";
					print_r($post_data);
					exit;	*/
				if(count($post_data) > 0)
				{					
					for($i=0; $i<count($post_data); $i++)
					{
						$skill_array = explode(',',$post_data[$i]['skill_id']);
					
						for($j=0; $j<count($all_skills); $j++)
						{  
							//echo in_array($all_skills[$j],(array)$skill_array);
							
								if(in_array($all_skills[$j],(array)$skill_array)==1)
								{
									$data['posts'][] = $post_data[$i];
									break;
									
								}else
								{
								  $data['posts'] = array();	
								}
							
						}
					}
				}else
				{
				  $data['posts'] = array();	
				}
				/*echo '<pre>';
				print_r($data['posts']);
				exit;	*/											
			}
			else if ($_POST['all_skill_ids'] == "" && $_POST['all_organization_ids'] != "" && $_POST['daterange'] != "" )
			{
				$all_organizations = explode(',',$_POST['all_organization_ids']);
				//print_r($all_organizations);
													
			 $post_data = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.start_date >= "'.$from_date.'" AND posting.end_date <= "'.$to_date.'" ');
				if(count($post_data) > 0)
				{					
					for($i=0; $i<count($post_data); $i++)
					{
						if(in_array($post_data[$i]['job_type_id'],(array)$all_organizations)==1)
						{
							
								$data['posts'][] = $post_data[$i];
								continue;
						}else{
								$data['posts'] = array();	
						}
								
							
					}
				}else
				{
				  $data['posts'] = array();	
				}
				/*echo '<pre>';
				print_r($data['posts']);
				exit;*/												
			}
			else if ($_POST['all_skill_ids'] != "" && $_POST['all_organization_ids'] != "" && $_POST['daterange'] == "" ) 
			{
				
				/*$all_skills = trim($_POST['all_skill_ids'], ",");*/
				$all_skills = explode( ",",$_POST['all_skill_ids']);
				/*$all_organizations = trim($_POST['all_organization_ids'], ",");*/
				$all_organizations = explode(',',$_POST['all_organization_ids']);
				$post_data = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.end_date >="'.date('Y-m-d').'"');
					//$data['posts'] = array();					
				for($i=0; $i<count($post_data); $i++)
				{
					$skill_array = explode(',',$post_data[$i]['skill_id']);
					
						if(in_array($post_data[$i]['job_type_id'],(array)$all_organizations)==1)
					{
						
							$data['posts'][] = $post_data[$i];
							continue;
					}else{
						
						 $skill_post_array[] = $post_data[$i];	
					}
				}
				
				for($i=0; $i<count($skill_post_array); $i++)
				{
					$skill_array = explode(',',$skill_post_array[$i]['skill_id']);
					
					for($j=0; $j<count($all_skills); $j++)
					{  
					    //echo in_array($all_skills[$j],(array)$skill_array);
						
							if(in_array($all_skills[$j],(array)$skill_array)==1)
							{
								$data['posts'][] = $skill_post_array[$i];
								continue;
								
							}
						
					}
				}
				if(count($data['posts']) < 0 )
				{
				  $data['posts'] = array();	
				}
				/*echo '<pre>';
				print_r($data['posts']);
				exit;	*/								
			}
			else if ($_POST['all_skill_ids'] != "" && $_POST['all_organization_ids'] == "" && $_POST['daterange'] == "") 
			{
				$all_skills = explode( ",",$_POST['all_skill_ids']);
				$post_data = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.end_date >="'.date('Y-m-d').'"');
					//$data['posts'] = array();					
				for($i=0; $i<count($post_data); $i++)
				{
					$skill_array = explode(',',$post_data[$i]['skill_id']);
					
					for($j=0; $j<count($all_skills); $j++)
					{  
					    //echo in_array($all_skills[$j],(array)$skill_array);
						
							if(in_array($all_skills[$j],(array)$skill_array)==1)
							{
								$data['posts'][$i] = $post_data[$i];
								continue;
							}
						
					}
				}
				if(count($data['posts']) < 0 )
				{
				  $data['posts'] = array();	
				}
				//print_r($skill_array);
				/*echo '<pre>';
			   print_r($data['posts']);
			   exit;		*/			
			}
			else if($_POST['all_skill_ids'] == "" && $_POST['all_organization_ids'] != "" && $_POST['daterange'] == "")
			{
				$all_organizations = trim($_POST['all_organization_ids'],',');
				$data['posts'] = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.job_type_id IN ('.$all_organizations.') AND posting.status = 1 ',
													'AND posting.end_date >="'.date('Y-m-d').'"');	
			}
			else
			{
				$data['posts'] = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.end_date >="'.date('Y-m-d').'"');
													
													
			}
			
			//print_r($data['posts']); exit;
			
		} // END IF
		
/* *********************** PAGE LOADING ON REFINED SEARCHING **********************************/
		
		
/* ******
***************** ON NORMAL PAGE LOADING ************************************************/
       	else if( isset($session['linkedin_info']['linkedin_id']) && (isset($session['linkedin_info']['job_type']) && $session['linkedin_info']['job_type'] != '' ) || (isset($session['linkedin_info']['skill']) && $session['linkedin_info']['skill'] != ''))
		{
			/*$data['posts'] = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo','join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ','posting.status = 1 ',' AND posting.end_date >="'.date('Y-m-d').'" AND posting.job_type_id IN ('.$session['linkedin_info']['job_type'].') OR  posting.status =1 AND posting.end_date >="'.date('Y-m-d').'" AND posting.skill_id IN ('.$session['linkedin_info']['skill'].') ');*/
													
			$post_data = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.end_date >="'.date('Y-m-d').'"');
					//$data['posts'] = array();	
					//echo count($post_data);	
					
			if((isset($session['linkedin_info']['job_type']) && $session['linkedin_info']['job_type'] != '' ) &&  (isset($session['linkedin_info']['skill']) && $session['linkedin_info']['skill'] != ''))
			{	
						
						
				for($i=0; $i<count($post_data); $i++)
				{
						
					if($session['linkedin_info']['job_type'] == $post_data[$i]['job_type_id'] )
					{
						
							$data['posts'][] = $post_data[$i];
							continue;
					}else{
						 $skill_post_array[] = $post_data[$i];	
					}
					
						
				}
				$all_skills =  explode(',',$session['linkedin_info']['skill']);
				
				
				for($i=0; $i<count($skill_post_array); $i++)
				{
					$skill_array = explode(',',$skill_post_array[$i]['skill_id']);
					
					for($j=0; $j<count($all_skills); $j++)
					{  
					    //echo in_array($all_skills[$j],(array)$skill_array);
						
							if(in_array($all_skills[$j],(array)$skill_array)==1)
							{
								$data['posts'][] = $skill_post_array[$i];
								continue;
							}
						
					}
				}
				
				if(count($data['posts']) < 0 )
				{
				  $data['posts'] = array();	
				}
				/*echo '<pre>';
				print_r($data['posts']);
				exit;*/
																			
			}else  if((isset($session['linkedin_info']['job_type']) && $session['linkedin_info']['job_type'] != '' ) &&  (isset($session['linkedin_info']['skill']) && $session['linkedin_info']['skill'] == '')  )
			{
			
			
				for($i=0; $i<count($post_data); $i++)
				{
					if($session['linkedin_info']['job_type'] == $post_data[$i]['job_type_id'] )
					{
						
							$data['posts'][] = $post_data[$i];
							continue;
					}
				}
				if(count($data['posts']) < 0 )
				{
				  $data['posts'] = array();	
				}
				
				
				
				
			}else
			{
				$all_skills =  explode(',',$session['linkedin_info']['skill']);
				$data['posts'] = array();
			  
			    for($i=0; $i<count($post_data); $i++)
				{
					$skill_array = explode(',',$post_data[$i]['skill_id']);
					
					for($j=0; $j<count($all_skills); $j++)
					{  
					    //echo in_array($all_skills[$j],(array)$skill_array);
						
							if(in_array($all_skills[$j],(array)$skill_array)==1)
							{
								$data['posts'][] = $post_data[$i];
								continue;
								//print_r($data['posts']);
							}
							
						
					}
				}
				
				if(count($data['posts']) < 0 )
				{
				  $data['posts'] = array();	
				}
				
				/*echo '<pre>';
				print_r($data['posts']);
				exit;	*/	
			}
		}
		else
		{
			$data['posts'] = Posting::model()->get_post(
													'posting.*,job_type.id `jobid`, job_type.title `jobname`,employer.address as company_address, employer.company_logo as logo',
													'join job_type on posting.job_type_id = job_type.id join employer on posting.employer_id = employer.employer_id ',
													'posting.status = 1 ',
													' AND posting.end_date >="'.date('Y-m-d').'"');
		  
		}// END ELSE
		
/* *********************** END - NORMAL PAGE LOADING ************************************************/

	
	
	/* ******** GETTING SKILL IDs AND NAMES *********** */
		
		
		if(count($data['posts']) > 0)
		{	
		   if(isset($_POST['all_skill_ids']))	
			{
		    	$skills_data = $rows = Yii::app()->db->createCommand('SELECT id, name FROM skill WHERE id IN ('.rtrim($_POST['all_skill_ids'],',').') AND status=1')->queryAll();
				
				//SENDING IDs AND NAMES TO PAGE
				foreach($skills_data as $skill_row)
				{
					$data['skill_arrary'][] = array('name' => $skill_row['name'],'id' => $skill_row['id']);	
				}
			}
			else
			{
				$skill_ids_string = "";
				
				//GETTING ALL SKILLS FROM POSTING
				foreach($data['posts'] as $post)
				{
					$skill_ids_string .= $post['skill_id'].",";
				}
				 $skill_ids_string = trim($skill_ids_string, ",");
				
				//GETTING SKILL IDs AND NAMES
				$skills_data = $rows = Yii::app()->db->createCommand('SELECT id, name FROM skill WHERE id IN ('.$skill_ids_string.') AND status=1')->queryAll();
				
				//SENDING IDs AND NAMES TO PAGE
				foreach($skills_data as $skill_row)
				{
					$data['skill_arrary'][] = array('name' => $skill_row['name'],'id' => $skill_row['id']);	
				}
			
			}
			
			/********* GETTING JOB TYPES / ORGANIZATIONS ************/
			if(isset($_POST['all_organization_ids']) && $_POST['all_organization_ids'] )
			{
				$job_types_data = $rows = Yii::app()->db->createCommand('SELECT id, title FROM job_type WHERE id IN ('.rtrim($_POST['all_organization_ids'],',').') AND status = 1')->queryAll();	
				
				foreach($job_types_data as $job_row)
				{
					$data['jobs_array'][] = array('id' => $job_row['id'], 'name' => $job_row['title']);	
				}
			}
			else
			{
			
			
				$job_type_ids_string = "";
				foreach($data['posts'] as $post)
				{
					
					$job_type_ids_string .= $post['job_type_id'].",";
				}
					$job_type_ids_string = trim($job_type_ids_string, ",");
				
				$job_types_data = $rows = Yii::app()->db->createCommand('SELECT id, title FROM job_type WHERE id IN ('.$job_type_ids_string.') AND status = 1')->queryAll();
				
				//SENDING IDs AND NAMES TO PAGE
				foreach($job_types_data as $job_row)
				{
					$data['jobs_array'][] = array('id' => $job_row['id'], 'name' => $job_row['title']);	
				}
			}
			
			
		}
		/* ************************* SETTING SESSION AND LINKED IN INFORMATION AFTER LINKED IN SIGN IN ************************* */	
		if( isset( $_GET['linkedin_id']))
		 {
					$session = Yii::app()->session;
					
					$student_school = isset( $_GET['school'] ) ? $_GET['school'] : NULL;
					$first_name = isset( $_GET['first_name'] ) ? $_GET['first_name'] : NULL;
					$last_name = isset( $_GET['last_name'] ) ? $_GET['last_name'] : NULL;
					$student_name =  $first_name .' '. $last_name;
	
					$objStudent = new Student;
				
					$student_data = $objStudent->get_student('*', '', 'linkedin_id = "'.$_GET['linkedin_id'].'"');
					
					
				
				//echo "Pre Here... <pre>"; print_r($student_data[0]['id']); exit;
				 
					if ( count( $student_data ) == 0 )
					{
						
						
						$rows = Yii::app()->db->createCommand("INSERT INTO student SET 
																linkedin_id='".$_GET['linkedin_id']."', 
																name='".$student_name."', 
																email='".$_GET['email']."',
																university='".$student_school."',
															    join_date='".date('y-m-d h:i:s')."',
																 status=1
																")->execute();
						
						$student_id = Yii::app()->db->lastInsertID;	
						$session['linkedin_info'] = array('id' => $student_id,
												'linkedin_id'=> isset( $_GET['linkedin_id'] ) ? $_GET['linkedin_id'] : NULL,
												'email'=> isset( $_GET['email'] ) ? $_GET['email'] : NULL,
												'name'=> $_GET['first_name'].'&nbsp;'.$_GET['last_name'],
												'first_name'=> isset( $_GET['first_name'] ) ? $_GET['first_name'] : "Your Name",
												'last_name'=> isset( $_GET['last_name'] ) ? $_GET['last_name'] : "Here",
												'picture'=> isset( $_GET['picture'] ) ? $_GET['picture'] : NULL,
												'degree'=> isset( $_GET['degree'] ) ? $_GET['degree'] : NULL,
												'field_of_study'=> isset( $_GET['field_of_study'] ) ? $_GET['field_of_study'] : NULL,
												'school'=> isset( $_GET['school'] ) ? $_GET['school'] : "Institute Here",
												'graduation_date'=> isset( $_GET['graduation_date'] ) ? $_GET['graduation_date'] : "Year Here"
												);
					}
					
					if( count($student_data) > 0)
					{
						$student_id = $student_data[0]['id'];
						$student_array = array(
						'picture'=> isset( $_GET['picture'] ) ? $_GET['picture'] : NULL,
						'field_of_study'=> isset( $_GET['field_of_study'] ) ? $_GET['field_of_study'] : NULL,
						'first_name'=> isset( $_GET['first_name'] ) ? $_GET['first_name'] : "Your Name",
						'last_name'=> isset( $_GET['last_name'] ) ? $_GET['last_name'] : "Here",
						'school'=> isset( $_GET['school'] ) ? $_GET['school'] : "Institute Here",
						'graduation_date'=> isset( $_GET['graduation_date'] ) ? $_GET['graduation_date'] : "Year Here");
						$session['linkedin_info'] = array_merge($student_array,$student_data[0]);
						
					}
					
					
					
					
				}// END IF
		/* ************************* SETTING SESSION AND LINKED IN INFORMATION AFTER LINKED IN SIGN IN ************************* */	

		$this->render('internship',array('data'=>$data));
	
	} // END - FUNCTION actionInternship
	
	
	
	public function  actionSingleInternship()
	{
		$this->render('singleinternship');
	
	} // END - FUNCTION actionInternship
	
	
	public function actionLinkedin()
	{
		$this->renderPartial('_linkedin');
	}

	public function actionStudentprofile()
	{
		
		$skill_tags = strip_tags(isset( $_POST['hidden-student_skill_tags']) ? $_POST['hidden-student_skill_tags'] : '');
		$student_address = strip_tags(isset( $_POST['student_address']) ? $_POST['student_address'] : '');
		$student_linkedin_id = isset( $_POST['student_linkedin_id']) ? $_POST['student_linkedin_id'] : '';
		$student_industry = isset( $_POST['student_industry']) ? $_POST['student_industry'] : '';
		$skill_tags_array = explode(',', $skill_tags);
		
		
		
		
		$typeahead_string = '';
	
		foreach($skill_tags_array as $skill)
		{	
			$skill_array = Skill::model()->search_skill($skill).',';
			$typeahead_string .= $skill_array;
		}
	
		$skill_list = rtrim($typeahead_string, ", ");
		
		/*print_r($skill_list);
		exit;*/
		
		/*$rows = Yii::app()->db->createCommand()->insert('student',array(
							'address'=>$student_address,
							'skill'=>$skill_list,
						));*/		
		 if($student_industry)
		 {
			 $job_data = JobType::model()->get_job('id','','title ="'.mysql_real_escape_string($student_industry).'"');
						if(count($job_data) < 1 )
						{
							 $rows = Yii::app()->db->createCommand()->insert('job_type',array(
									'title'=>$student_industry,
									'status'=>'1',
								));					
							 $job_title=Yii::app()->db->getLastInsertID();
						}
						
						else {
							$job_title = $job_data[0]['id'];
						}
		 }else{
			  $job_title = '';
			 }
		 
		 
		$rows = Yii::app()->db->createCommand("UPDATE student SET address='".$student_address."' , skill='".$skill_list."', job_type='".$job_title."' WHERE linkedin_id = '".$student_linkedin_id."'" )->execute();
		$session = Yii::app()->session;
		$objStudent = new Student;
		$student_data = $objStudent->get_student('*','','linkedin_id = "'.$student_linkedin_id.'"');
		$session['linkedin_info'] = $student_data[0];
	
		echo 1;
		//print_r($skill_list); exit;
	}

	
	public function actionCreate()
	{
		
		
		$session = Yii::app()->session;
		$model   = new Posting;
		$objEmployer = new Employer;
		$objuser = new User;
		$objPayment = new JobPayment;
		$objEmployerPayment = new EmployerCreditcard;
		
		
		$PublishableKey = 'pk_test_guOskqsm83u56mz3eECGpo1i';
		$ApiKey         = 'sk_test_EcKjZUQXE8qEO3Nfgt9NRtUs';

		
		if(isset($_POST))
		{
			/*
			print_r($_POST);
			exit;*/
		 
		/*****Employer_information******/  
		
			$firstname = mysql_real_escape_string(isset($_POST['first-name'])?$_POST['first-name']:'');
			$lastname = mysql_real_escape_string(isset($_POST['last-name'])?$_POST['last-name']:'');
			$company = mysql_real_escape_string(isset($_POST['company_name'])?$_POST['company_name']:'');
			$email = mysql_real_escape_string(isset($_POST['employer_email'])?$_POST['employer_email']:'');
			$website = mysql_real_escape_string(isset($_POST['website'])?$_POST['website']:'');
			$no_of_interns = mysql_real_escape_string(isset($_POST['total_interns'])?$_POST['total_interns']:'');
			$total_price = mysql_real_escape_string(isset($_POST['intern_price'])?$_POST['intern_price']:'30');
			$token = mysql_real_escape_string(isset($_POST['stripeToken'])?$_POST['stripeToken']:'');
			$comapany_address = mysql_real_escape_string(isset($_POST['employer_address'])?$_POST['employer_address']:'');
			$agree = isset($_POST['tos-agreed'])?$_POST['tos-agreed']:'';
			$company_starting = isset($_POST['company_starting_date'])?$_POST['company_starting_date']:'';
			$card_number = isset($_POST['card_number'])?$_POST['card_number']:'';
			$card_cvc = isset($_POST['card_cvc'])?$_POST['card_cvc']:'';
			
			$company_date_format=explode('-',$company_starting);	
			$company_date=trim($company_date_format[2]).'-'.trim($company_date_format[1]).'-'.trim($company_date_format['0']);
			$password = $this->createPassword();
			
			
			$user_data= $objuser->get_user('username','','username="'.$email.'" AND status=1 AND role="employer"','');
			if(count($user_data) > 0)
			{
				echo 2;
				exit;
			}
			$email_data= $objEmployer->get_employer('email','','email="'.$email.'" AND status=1','');
			if(count($email_data) > 0)
			{
				echo 3;
				exit;
			}
			if(empty($total_price))
			{
				$total_price = 30;
			}
		
		try {
			
			require_once($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/lib/Stripe.php');
			// the amount variable takes value in cents by default.
			
	       	Stripe::setApiKey($ApiKey);
			/*$charge = Stripe_Charge::create(array(
			  "amount" => $total_price*100,
			  "currency" => "usd",
			  "card" => $token, 
			  "description" => "Charge for test@example.com")
			);*/
			
				$customer = Stripe_Customer::create(array(
				  "card" => $token,
				  "description" => "payinguser@example.com")
				);
				
				// Charge the Customer instead of the card
				$charge = Stripe_Charge::create(array(
				  "amount" => $total_price*100, # amount in cents, again
				  "currency" => "usd",
				  "customer" => $customer->id)
				);
			/*echo $customer->id;
			print_r($charge);
			exit;*/
			
			if ($charge->paid == true) {
				
					/********find the longitude and latitude**************/
		
					$prepAddr = str_replace(' ','+',$comapany_address);
					// TODO: Find and alternate way to get the LAT, LONG so that live request is not sent always.
					$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=true');
					
					$output = json_decode($geocode);
					
					$latitude = $output->results[0]->geometry->location->lat;
					$longitude = $output->results[0]->geometry->location->lng;
				
					$objEmployer->firstname=trim(addslashes(strip_tags($firstname)));
					$objEmployer->lastname=trim(addslashes(strip_tags($lastname)));
					$objEmployer->email=trim(addslashes(strip_tags($email)));
					$objEmployer->address=trim(addslashes(strip_tags(htmlspecialchars($comapany_address))));
					$objEmployer->longitude =$longitude;
					$objEmployer->latitude =$latitude;
					$objEmployer->url=trim(addslashes(strip_tags($website)));
					$objEmployer->company_name=trim(addslashes(strip_tags($company)));
					$objEmployer->status=trim(addslashes(strip_tags(1)));
					$objEmployer->joining_date=trim(addslashes(strip_tags(date('Y-m-d h:i:s'))));
					$objEmployer->company_starting_date=trim(addslashes(strip_tags($company_date)));
					$objEmployer->timezone=trim(addslashes(strip_tags('-4')));
					
					/*print_r($objEmployer->attributes); exit;*/
	 				
				
					if($objEmployer->save())
					{
						$employer_id= Yii::app()->db->getLastInsertId();
					}
					
					else
					{
					  echo 4;
					  exit;  
					}	
					
				/******** Login  Information***********/
				  
				$objuser->username = trim(addslashes(strip_tags($email)));
				$objuser->password = trim(addslashes(strip_tags(md5($password))));
				$objuser->employer_id = $employer_id;
				$objuser->role = 'employer';
				$objuser->status = '1';
				$objuser->created_at = date('Y-m-d h:i:s'); 
				$objuser->save();
				
				
				/******** Perk Information***********/
				//print_r($_POST['perk']);
				
				$perk_string = '';
				
				if(isset($_POST['perk']) && count($_POST['perk'])>0)
				{
					for($i=0; $i< count($_POST['perk']); $i++)
					{  
						$values = $_POST['perk'][$i].',';
						$perk_string .= $values;
				  }
					$perk_list = rtrim($perk_string, ", ");
					
				}
				
				/******** Post Information***********/  
				$employer_data = $objEmployer->get_employer('*','','employer_id = "'.$employer_id.'"');
				$user_data = $objuser->get_user('*','','username = "'.$email.'" AND password = "'.md5($password).'"','AND role="employer"');
				
				if(count($employer_data) > 0)
				{
					$session['emp_array'] = array_merge($employer_data[0],$user_data[0]);
				}	
				
				
				 $title = isset($_POST['post_title'])?$_POST['post_title']:'';
				 $date = isset($_POST['post_date'])?$_POST['post_date']:'';
				 $description = isset($_POST['post_description'])?$_POST['post_description']:'';	
				 $job_type = mysql_real_escape_string(isset($_POST['job_type'])?$_POST['job_type']:'');
				 $skilltags = mysql_real_escape_string(isset($_POST['hidden-skilltags'])?$_POST['hidden-skilltags']:'');
			  
				  $post_date_array=explode('-',$date);	
				  $start_date_format=explode('/',$post_date_array[0]);
				  $start_date=trim($start_date_format[2]).'-'.trim($start_date_format[0]).'-'.trim($start_date_format['1']);
					
				  $end_date_format=explode('/',$post_date_array[1]);
				  $end_date=trim($end_date_format[2]).'-'.trim($end_date_format[0]).'-'.trim($end_date_format['1']);
				
				  $hidden_skilles_array = explode(',',$skilltags);
		  
				  $typeahead_string = '';
				  for($i=0; $i<count($hidden_skilles_array); $i++)
				  {
					  $skill_array = Skill::model()->search_skill($hidden_skilles_array[$i]).',';
					  $typeahead_string .= $skill_array;
				  }
					$skill_list = rtrim($typeahead_string, ", ");
					
					$job_data = JobType::model()->get_job('id','','title ="'.$job_type.'"');
					if(count($job_data) < 1 )
					{
						 $rows = Yii::app()->db->createCommand()->insert('job_type',array(
								'title'=>$job_type,
								'status'=>'1',
							));					
						 $job_title=Yii::app()->db->getLastInsertID();
					}
					
					else {
						$job_title = $job_data[0]['id'];
					}
					
					$model->title = trim(addslashes(strip_tags($title)));
					$model->job_type_id = trim(addslashes(strip_tags($job_title)));
					$model->description = trim(addslashes(strip_tags(htmlspecialchars($description))));
					$model->start_date = trim(addslashes(strip_tags($start_date)));
					$model->employer_id = $employer_id;
					$model->end_date = trim(addslashes(strip_tags($end_date)));
					$model->skill_id = trim(addslashes(strip_tags($skill_list)));
					
					if(isset($_POST['perk']) && count($_POST['perk'])>0)
					{
						$model->perk_id = trim(addslashes(strip_tags($perk_list)));
					}
					else
					{
						$model->perk_id = 0;
					}
					
					$model->interns_limit = $no_of_interns;
					$model->total_price = $total_price;
					$model->facebook_id = 'http://www.facebook.com';
					$model->twitter_id = 'http://www.twitter.com';
					$model->linkedin_id = 'http://www.linkedin.com';
					$model->status = '1';
					$model->created_at = date('Y-m-d h:i:s');
					$model->updated_at = '';
					
			
				if($model->save())
				{
				   	$post_id= Yii::app()->db->getLastInsertId();
                   
					/******** Payment  Information***********/
				   
					$objEmployerPayment->employer_id = $employer_id;
					$objEmployerPayment->token_no=$customer->id;
					$objEmployerPayment->card_holder_name=$charge->card->name;
					$objEmployerPayment->card_number = $card_number;
					$objEmployerPayment->card_cvc = $card_cvc;
					$objEmployerPayment->card_type=$charge->card->type;
					$objEmployerPayment->card_exp_month=$charge->card->exp_month;
					$objEmployerPayment->card_exp_year=$charge->card->exp_year;
					$objEmployerPayment->card_fingerprint=$charge->card->fingerprint;
					$objEmployerPayment->country=$charge->card->country;
					$objEmployerPayment->address_line1=$charge->card->address_line1;
					
					
					$objEmployerPayment->address_city=$charge->card->address_city;
					$objEmployerPayment->address_state=$charge->card->address_state;
					$objEmployerPayment->address_zip=$charge->card->address_zip;
					$objEmployerPayment->currency=$charge->currency;
					$objEmployerPayment->status = 1;
					$objEmployerPayment->created_at = date('Y-m-d h:i:s');
					$objEmployerPayment->save();
					
					$payment_id =  Yii::app()->db->getLastInsertId();
					$objPayment->employer_id = $employer_id;
					$objPayment->payment_id = $payment_id;
					$objPayment->posting_id = $post_id;
					$objPayment->status = 1; 
					$objPayment->created_at = date('Y-m-d h:i:s');
					$objPayment->save();
					
				$name='=?UTF-8?B?'.base64_encode($email).'?=';
				$subject='=?UTF-8?B?'.base64_encode('Internify Registration Process').'?=';
				
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
					
					/* if (!$objPayment->validate()) {
				 print_r($objPayment->errors);
				}*/
					 
					if($objPayment->save())
					{
						echo 1;
						exit;
					}
					else
					{
					  echo 4;
					  exit;	
					}
					
					
				}
				else
				{
					echo 4;
					exit;
				}
		  }			
			
		}
		
		catch (Stripe_CardError $e) {
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
	   	
  	  }

	} // END - FUNCTION
	
	
	public function createPassword()
	{
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
				/*$emp_data = Posting::model()->get_post('title','',' title="'.$post_value.'"');
				
				if(count($emp_data) > 0)
				{
					echo 'Title Already exists';
					return false;
				}else{*/
					$model->title=$post_value;
				//}
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
				if(count($post_value) >1)
				{
					echo 'Please enter one industry ';
					return false;
				}else
				{
					
					$job_data= JobType::model()->get_job('id','','title="'.$post_value[0].'"');
				
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
			} 
			
		
		/*****Post Description******/
		
			if($div_id == 'employer_description')
			{
					
					$model->description = addslashes(htmlspecialchars($post_value));
					
			} 
			if($div_id=='employer_facebook')
			{
				/*$facebook=explode('.',$post_value);
				if($facebook[1]=='facebook')
				{*/
					$model->facebook_id = addslashes(htmlspecialchars($post_value));
				/*}else
				{
					
					echo 'Please enter Facebook url';
					return false;
				}*/
				
			}
		
			if($div_id == 'employer_twitter')
			{
				/*$twitter=explode('.',$post_value);
				if($twitter[1]=='twitter')
				{*/
					
					$model->twitter_id = addslashes(htmlspecialchars($post_value));
				/*}else
				{
					
					echo 'Please enter Twitter url';
					return false;
				}	*/		
			}
		
			if($div_id == 'employer_linkedin')
			{
				/*$linkedin=explode('.',$post_value);
				if($linkedin[1]=='linkedin')
				{*/
				   $model->linkedin_id = addslashes(htmlspecialchars($post_value));
				/*}else
				{
					echo 'Please enter Linkedin url';
					return false;
				}*/
				
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
	public function actionArchive($id,$emp_id)
	{
		$model = $this->loadModel($id);
		if($model->employer_id==$emp_id)
		{
		     $model->status = 2;
			 $model->save();
		 	 echo 1;	
		}
		
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
		$sql = "Select id From skill Where name='".$title."' and status=1";
		$rows = Yii::app()->db->createCommand($sql)->queryRow();
		
		if(count($rows)>0)
		{
			return $rows['id'];
		}
		
		else
		{
			echo 'hello';
			$sql = "Insert Into skill SET name='".$title."',status=1";
			$connection = Yii::app()-> db;
			$command = $connection ->createCommand($sql);
			$command -> execute();
			echo $id=Yii::app()->db->lastInsertID;
			
			exit;
		}
	}
	
	public function actionInterninfo()
	{
		$session = Yii::app()->session;

		$session['student_position'] = $_POST['position'];
		
		
		if ( isset($_POST['position']) ) {  $session['student_position'] =  $_POST['position']; }
		if ( isset($_POST['univesity']) ) { $session['student_univesity'] =  $_POST['univesity'];}
		if ( isset($_POST['indsutry']) ) { $session['student_indsutry'] =  $_POST['indsutry'];} 
		
		exit;
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

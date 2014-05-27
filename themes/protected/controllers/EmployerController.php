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
		$model=new Employer;

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

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	
	public function actionUpdatePassword()
	{
		$emp_id=isset($_POST['emp_id'])?$_POST['emp_id']:'';
		$old_password=isset($_POST['old_password'])?$_POST['old_password']:'';
		$new_password=isset($_POST['password'])?$_POST['password']:'';
		if($emp_id)
		{
			$model=$this->loadModel($emp_id);	
		}
		
		if(md5($old_password)==$model->password)
		{
			$model->password=md5($new_password);
			if($model->save())
				echo 1;
		}
		else{
		  echo 2;	
		}
		
		}
	
	
	
	public function actionUpdateProfile()
	{
		
		$objEmployer =new Employer;
		
		$emp_id=isset($_POST['emp_id'])?$_POST['emp_id']:'';
		$username=isset($_POST['username'])?$_POST['username']:'';
		$firstname=isset($_POST['firstname'])?$_POST['firstname']:'';
		$lastname=isset($_POST['lastname'])?$_POST['lastname']:'';
		$email=isset($_POST['email'])?$_POST['email']:'';
		$address=isset($_POST['address'])?$_POST['address']:'';
		$timezone=isset($_POST['firstname'])?$_POST['timezone']:'';
		
		$username_data= $objEmployer->get_employer('username','',' username="'.$username.'"',' AND  employer_id != '.$emp_id.'');
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
		}
		
		
		
		$model->username=trim(addslashes(strip_tags($username)));
		$model->firstname=trim(addslashes(strip_tags($firstname)));
		$model->lastname=trim(addslashes(strip_tags($lastname)));
		$model->email=trim(addslashes(strip_tags($email)));
		$model->address=trim(addslashes(strip_tags($address)));
		$model->timezone=trim(addslashes(strip_tags($timezone)));
		
		
		
		if($model->save())
		{
			echo 1;
		}
		
		}	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionGetTabContent($id,$empid='')
	{
		
		if($id==1)
		{
			
			$data=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.status = 1 ',' AND posting.end_date >='.date('Y-m-d').' AND posting.employer_id='.$empid.'');
			
			
			/*$past_data=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.employer_id='.$empid.' AND posting.status = 2 order by posting.end_date desc',' ');
			
			$data['past_count']=count($past_data);
			echo '<pre>';
			print_r($data);
			exit;*/
			
			$this->renderPartial('current_post',array('data'=>$data));
		}
		if($id==2)
		{
			
			/*$data=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.employer_id='.$empid.' AND  posting.end_date <'.date('Y-m-d').'',' ');*/
			/*$data=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.employer_id='.$empid.' AND posting.end_date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND posting.end_date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY',' ');*/
			
			$data=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.employer_id='.$empid.' AND posting.status = 2 order by posting.end_date desc',' ');
			$this->renderPartial('view',array('data'=>$data));			
		}
		if($id==3)
		{
			//$data=Employer::model()->get_employer('*','','employer_id=1',' AND status = 1 ');
			$data=$this->loadModel($empid);
			$this->renderPartial('settings',array('emp_data'=>$data,'timezone_data'=>$this->list_timezone()));			
		}
		
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
	  
	  $data=Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.id ="'.$id.'"',' AND posting.employer_id='.$emp_id.'');
	  $data[0]['tab_post']='post_detail';
	  $this->renderPartial('current_post',array('data'=>$data));
		
   }
	public function actionIndex()
	{
		$session = Yii::app()->session;
		if(!$session['emp_array']['username'] && !$session['emp_array']['password'])
		{
			$this->redirect(array('posting/index'));
		}
		
		$this->render('index');
	}
	
	public function actionLogin()
	{
		
		$session = Yii::app()->session;
		$username=isset($_POST['username'])?$_POST['username']:'';
		$password=isset($_POST['password'])?$_POST['password']:'';
		$remember=isset($_POST['remember-me'])?$_POST['remember-me']:'';
	    
		$objEmployer = new Employer;
		$employer_data=$objEmployer->get_employer('*','','username = "'.$username.'" AND password = "'.md5($password).'"');
		if(count($employer_data) > 0)
		{
			echo 1;
			if($remember==1)
			{
				setcookie("username",$username, time()+3600*24);
				
			}
			$session['emp_array'] = $employer_data[0];
		}
		else
		{
			echo 2;
		}
	}
	
	public function actionLogout()
	{
		$session = Yii::app()->session;
		unset($session['emp_array']);
		$this->redirect('../posting/index');
	}

	public function loadModel($id)
	{
		$model=Employer::model()->findByPk($id);
		if($model===null)
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

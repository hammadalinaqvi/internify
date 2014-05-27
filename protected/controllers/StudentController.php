<?php

class StudentController extends Controller
{
	/* var string the default layout for the views. Defaults to '//layouts/column2', meaning using two-column layout. See 'protected/views/layouts/column2.php' */
	//public $layout='//layouts/column2';

	/** @return array action filters */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}*/


	/* Specifies the access control rules. This method is used by the 'accessControl' filter. @return array access control rules*/
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

	
	public function actionIndex()
	{
		
		$session = Yii::app()->session;
		if(!$session['linkedin_info'])
		{
			$this->redirect(array('posting/index'));
		}
		
		$this->render('index');
		
		/*$dataProvider = new CActiveDataProvider('Student');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}
	
	public function actionInternship()
	{
		$this->render('internship');
	}
	
	public function actionSettings()
	{
		//$dataProvider=new CActiveDataProvider('Student');
		$this->render('settings');
	}
	
	public function actionUpdateProfile()
	{
		
		$objStudent = new Student;
		$objUser = new User;
		
		$student_id = isset($_POST['student_id'])?$_POST['student_id']:'';
		$user_id = isset($_POST['user_id'])?$_POST['user_id']:'';
		$user_name = isset($_POST['user_name'])?$_POST['user_name']:'';
		$name = isset($_POST['name'])?$_POST['name']:'';
		$email = isset($_POST['email'])?$_POST['email']:'';
		$university = isset($_POST['university'])?$_POST['university']:'';
		
		//print_r($_POST); exit; 
		$username_data = $objUser->get_user('username','','username="'.$user_name.'"',' AND  student_id != '.$student_id.'');
		//print_r($user_data); exit;
		if(count($username_data) > 0)
		{
			echo 2;
			exit;
		}
		
		$student_email_data = $objStudent->get_student('email','',' email="'.$email.'"',' AND  id != '.$student_id.'');
		if(count($student_email_data) > 0)
		{
			echo 3;
			exit;
		}
		
		if($student_id)
		{
			$user_model = User::model()->findByPk($user_id);	
			//$user_model->student_id = trim(addslashes(strip_tags($student_id)));
			$user_model->username = trim(addslashes(strip_tags($user_name)));
			$user_model->save();
		
			$student_model = Student::model()->findByPk($student_id);	
			$student_model->name = trim(addslashes(strip_tags($name)));
			$student_model->email = trim(addslashes(strip_tags($email)));
			$student_model->university = trim(addslashes(strip_tags($university)));
			
			if($student_model->save())
			{
				echo 1;
			}
		}
	}	
	
	public function actionGetTabContent($id,$empid='')
	{
		if($id==1) // 1. Current Posts
		{
			
			$session = Yii::app()->session;
			
			$internship_data = Yii::app()->db->createCommand("SELECT posting_id FROM job_applicant WHERE student_id='".$session['linkedin_info']['id']."' AND status=1 ORDER BY posting_id")->queryAll();
			
			
			
			$post_ids = array();
			foreach($internship_data as $key => $data)
			{
				$post_ids[$key] = $data['posting_id'];
			}
			
			$post_id = implode(",", $post_ids);
		
			
			if ($post_id != "")
			{
				$data['posts'] = Posting::model()->get_post(
														'posting.*,job_type.id `jobid`, job_type.title `jobname`',
														'join job_type on posting.job_type_id = job_type.id', 
														'posting.id IN ('.$post_id.')',
														' AND posting.status = 1 AND posting.end_date >= "'.date('Y-m-d').'"');
														
				$data['past_posts'] = Posting::model()->get_post(
														'posting.*,job_type.id `jobid`, job_type.title `jobname`',
														'join job_type on posting.job_type_id = job_type.id',
														'posting.id IN ('.$post_id.')',
														' AND posting.end_date < "'.date('Y-m-d').'"');												
			}
			
			else
			{
				$data['posts'] = NULL;	
			}

			//$data['past_results'] = Posting::model()->findAll('status = 2 order by end_date desc  ');
			
			$this->renderPartial('current_post',array('data'=>$data));
		}
		
		if($id==2) // 2. Active Posts
		{
			$this->renderPartial('active_post');			
		}
		
		if($id==3) // 3. Past Posts
		{
			$session = Yii::app()->session;
			
			$internship_data = Yii::app()->db->createCommand("SELECT posting_id FROM job_applicant WHERE student_id='".$session['linkedin_info']['id']."' AND status=1 ORDER BY posting_id")->queryAll();
			
			$post_ids = array();
			foreach($internship_data as $key => $data)
			{
				$post_ids[$key] = $data['posting_id'];
			}
			
			$post_id = implode(",", $post_ids);
			
			if ($post_id != "")
			{
				/*$data['posts'] = Posting::model()->get_post(
														'posting.*,job_type.id `jobid`, job_type.title `jobname`',
														'join job_type on posting.job_type_id = job_type.id',
														'posting.id IN ('.$post_id.')',
														' AND posting.status = 2 ');*/
			$data['posts'] = Posting::model()->get_post(
														'posting.*,job_type.id `jobid`, job_type.title `jobname`',
														'join job_type on posting.job_type_id = job_type.id',
														'posting.id IN ('.$post_id.')',
														' AND posting.end_date < "'.date('Y-m-d').'"');											
														
														 //AND posting.end_date >='.date('Y-m-d')
			}
			
			else
			{
				$data['posts'] = NULL;	
			}
			
			$this->renderPartial('past_post', array('data'=>$data));			
		}
		
		
		/*if($id==2) // 2. Past Posts
		{
			$data = Posting::model()->get_post('posting.*,job_type.id `jobid`, job_type.title `jobname`','join job_type on posting.job_type_id = job_type.id','posting.employer_id='.$empid.' AND posting.status = 2 order by posting.end_date desc',' ');
			$this->renderPartial('view',array('data'=>$data));			
		}*/
		
		if($id == 4) // 3. Settings Tab
		{
			
			$data['student'] = Student::model()->get_student('*','','id='.$empid.'',' AND  status = 1 ');
			//$data['student'] = $this->loadModel($empid);
			//$data['user_login'] = User::model()->get_user('*','',' student_id='.$empid,'AND role="student"');
			/*print_r($data['student']);
			exit;*/
			
			$this->renderPartial('settings',array('student_data'=>$data));			
		}
		
	} 
	
	public function actionUpdatePassword()
	{
		
		$student_id = isset($_POST['student_id'])?$_POST['student_id']:'';
		$user_id = isset($_POST['user_id'])?$_POST['user_id']:'';
		
		$old_password = isset($_POST['old_password'])?$_POST['old_password']:'';
		$new_password = isset($_POST['new_password'])?$_POST['new_password']:'';
		
		if($student_id)
		{
			$user_model = User::model()->findByPk($user_id);	
		}
		
		if(md5($old_password)==$user_model->password)
		{
			$user_model->password=md5($new_password);
			if($user_model->save())
				echo 1;
		}
		
		else
		{
		  echo 2;	
		}
		
	}
	
	
	public function loadModel($id)
	{
		$model=Student::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Student the loaded model
	 * @throws CHttpException
	 */
	 
	 /* Displays a particular model.@param integer $id the ID of the model to be displayed */
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
		$model=new Student;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
	 * Performs the AJAX validation.
	 * @param Student $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

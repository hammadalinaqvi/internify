<?php

class ContactController extends Controller
{
	
	public function actionIndex()
	{
		
		$model = new Contact;
		
		if(isset($_POST['submit']))
		{
		   //echo ' hello';
		   $first_name = $_POST['f_name'];
		   $last_name = $_POST['l_name'];
		   $email = $_POST['email'];
		   $subject = $_POST['subject'];
		   $message = $_POST['message'];
		   
		   	$to      = 'sshani21@gmail.com';
						
			$headers = 'From: '.$email.'' . "\r\n" .
								'X-Mailer: PHP/' . phpversion()."\r\n" . "MIME-Version: 1.0" . "\n"."Content-type: text/html; charset=iso-8859-1";			
						
			
				$mail =		mail($to, $subject, $message, $headers);
				   if($mail){
					   
					   $model->first_name = $first_name;
					   $model->last_name = $last_name;
					   $model->email = $email;
					   $model->subject = $subject;
					   $model->message = $message;
					   $model->created_at = date('Y-m-d H:i:s');
					   
					   $model->save();
					   Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
						//$this->redirect(array('posting/index'));
						$this->refresh();
					   }
		   //exit;
		}
		
		
				$this->render('index');
	}


}

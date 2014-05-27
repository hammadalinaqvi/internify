<?php

class StudentController extends Controller
{
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionInternship()
	{
		$this->render('internship');
	}
	
}
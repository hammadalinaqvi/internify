<?php

class JobTypeController extends Controller
{
	public $typeahead_string;
	
	public function actionGetJob()
	{/*
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(404);*/
			
		$rows = Yii::app()->db->createCommand()
		->select('id,title')
		->from('job_type')
		->where('status=1')
		->queryAll();
		
		$typeahead_string='';
		for($i=0; $i< count($rows); $i++)
		{
			//$job[$rows[$i]['id']]=$rows[$i]['title'];
			$job= $rows[$i]['id'].":'".$rows[$i]['title']."',";
			$typeahead_string .= $job;
		}
		//$skill_list_name = "{".rtrim($typeahead_string, ", ")."}"; 
		$skill_list_name = rtrim($typeahead_string, ", ");   
	   print_r($skill_list_name);
	  //echo json_encode($job);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
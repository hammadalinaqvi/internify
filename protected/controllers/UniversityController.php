<?php

class UniversityController extends Controller
{
	public function actionGetUniversity()
	{
		
		$university_data=University::model()->get_university('college','','1 Order By college ASC');
		$typeahead_string='';	
		for($i=0; $i< count($university_data); $i++)
		{
			$formatted_name    =  '"' .$university_data[$i]['college'] . '", ';
			$typeahead_string .= $formatted_name;
		 }
	
		$option_list = "[" . rtrim($typeahead_string, ", ") . "]";
		$data = $option_list;
		echo $data;
		//$this->render('getUniversity');
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
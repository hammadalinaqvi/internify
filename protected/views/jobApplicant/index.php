<?php
/* @var $this JobApplicantController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Job Applicants',
);

$this->menu=array(
	array('label'=>'Create JobApplicant', 'url'=>array('create')),
	array('label'=>'Manage JobApplicant', 'url'=>array('admin')),
);
?>

<h1>Job Applicants</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

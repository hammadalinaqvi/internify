<?php
/* @var $this JobApplicantController */
/* @var $model JobApplicant */

$this->breadcrumbs=array(
	'Job Applicants'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JobApplicant', 'url'=>array('index')),
	array('label'=>'Manage JobApplicant', 'url'=>array('admin')),
);
?>

<h1>Create JobApplicant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this JobApplicantController */
/* @var $model JobApplicant */

$this->breadcrumbs=array(
	'Job Applicants'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JobApplicant', 'url'=>array('index')),
	array('label'=>'Create JobApplicant', 'url'=>array('create')),
	array('label'=>'View JobApplicant', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JobApplicant', 'url'=>array('admin')),
);
?>

<h1>Update JobApplicant <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
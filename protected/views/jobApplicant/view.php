<?php
/* @var $this JobApplicantController */
/* @var $model JobApplicant */

$this->breadcrumbs=array(
	'Job Applicants'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JobApplicant', 'url'=>array('index')),
	array('label'=>'Create JobApplicant', 'url'=>array('create')),
	array('label'=>'Update JobApplicant', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JobApplicant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JobApplicant', 'url'=>array('admin')),
);
?>

<h1>View JobApplicant #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'posting_id',
		'employer_id',
		'student_id',
		'status',
		'created_at',
		'updated_at',
	),
)); ?>

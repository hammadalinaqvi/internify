<?php
/* @var $this PostingController */
/* @var $model Posting */

$this->breadcrumbs=array(
	'Postings'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Posting', 'url'=>array('index')),
	array('label'=>'Create Posting', 'url'=>array('create')),
	array('label'=>'Update Posting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Posting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Posting', 'url'=>array('admin')),
);
?>

<h1>View Posting #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'job_type_id',
		'employer_id',
		'title',
		'description',
		'skill_id',
		'start_date',
		'end_date',
		'facebook_id',
		'twitter_id',
		'linkedin_id',
		'status',
		'created_at',
		'updated_at',
	),
)); ?>

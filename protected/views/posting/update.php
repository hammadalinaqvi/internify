<?php
/* @var $this PostingController */
/* @var $model Posting */

$this->breadcrumbs=array(
	'User'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Posting', 'url'=>array('index')),
	array('label'=>'Create Posting', 'url'=>array('create')),
	array('label'=>'View Posting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Posting', 'url'=>array('admin')),
);
?>

<h1>Update Posting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
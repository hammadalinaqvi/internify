<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
*/?>

<h1>Update <?php echo ucwords($model->fname).'&nbsp;'.ucwords($model->lname); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
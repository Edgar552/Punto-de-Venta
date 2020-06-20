<?php
/* @var $this ProdTallaController */
/* @var $model ProdTalla */

$this->breadcrumbs=array(
	'Prod Tallas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProdTalla', 'url'=>array('index')),
	array('label'=>'Manage ProdTalla', 'url'=>array('admin')),
);
?>

<h1>Create ProdTalla</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
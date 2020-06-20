<?php
/* @var $this ProdMarcasController */
/* @var $model ProdMarcas */

$this->breadcrumbs=array(
	'Prod Marcases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProdMarcas', 'url'=>array('index')),
	array('label'=>'Manage ProdMarcas', 'url'=>array('admin')),
);
?>

<h1>Create ProdMarcas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
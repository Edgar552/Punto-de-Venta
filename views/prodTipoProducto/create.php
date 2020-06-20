<?php
/* @var $this ProdTipoProductoController */
/* @var $model ProdTipoProducto */

$this->breadcrumbs=array(
	'Prod Tipo Productos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProdTipoProducto', 'url'=>array('index')),
	array('label'=>'Manage ProdTipoProducto', 'url'=>array('admin')),
);
?>

<h1>Create ProdTipoProducto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
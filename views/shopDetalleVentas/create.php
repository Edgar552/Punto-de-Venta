<?php
/* @var $this ShopDetalleVentasController */
/* @var $model ShopDetalleVentas */

$this->breadcrumbs=array(
	'Shop Detalle Ventases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ShopDetalleVentas', 'url'=>array('index')),
	array('label'=>'Manage ShopDetalleVentas', 'url'=>array('admin')),
);
?>

<h1>Create ShopDetalleVentas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this ShopVentasController */
/* @var $model ShopVentas */

$this->breadcrumbs=array(
	'Ventas'=>array(''),
	'Nueva Venta',
);

$this->menu=array(
	//array('label'=>'List ShopVentas', 'url'=>array('index')),
	array('label'=>'Administrar Ventas', 'url'=>array('admin')),
);
?>
<h1>Actualizar Ticket</h1>

<?php $this->renderPartial('_form', array('model'=>$model,
										 'model_detalle_ventas'=>$model_detalle_ventas)); ?>
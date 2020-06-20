<?php
/* @var $this ShopVentasController */
/* @var $model ShopVentas */

$this->breadcrumbs=array(
	'Shop Ventases'=>array('index'),
	$model->id_shop_ventas,
);

$this->menu=array(
	array('label'=>'List ShopVentas', 'url'=>array('index')),
	array('label'=>'Create ShopVentas', 'url'=>array('create')),
	array('label'=>'Update ShopVentas', 'url'=>array('update', 'id'=>$model->id_shop_ventas)),
	array('label'=>'Delete ShopVentas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_shop_ventas),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShopVentas', 'url'=>array('admin')),
);
?>

<h1>View ShopVentas #<?php echo $model->id_shop_ventas; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_shop_ventas',
		'numero_ticket',
		'fecha_venta',
		'hora_venta',
		'venta_total',
		'nombre_vendedor',
	),
)); ?>

<?php
/* @var $this ShopDetalleVentasController */
/* @var $model ShopDetalleVentas */

$this->breadcrumbs=array(
	'Shop Detalle Ventases'=>array('index'),
	$model->id_detalle_venta,
);

$this->menu=array(
	array('label'=>'List ShopDetalleVentas', 'url'=>array('index')),
	array('label'=>'Create ShopDetalleVentas', 'url'=>array('create')),
	array('label'=>'Update ShopDetalleVentas', 'url'=>array('update', 'id'=>$model->id_detalle_venta)),
	array('label'=>'Delete ShopDetalleVentas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_detalle_venta),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShopDetalleVentas', 'url'=>array('admin')),
);
?>

<h1>View ShopDetalleVentas #<?php echo $model->id_detalle_venta; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_detalle_venta',
		'codigo_barras',
		'id_tipo_producto',
		'id_marca',
		'id_talla',
		'precio_producto',
		'numero_ticket',
	),
)); ?>

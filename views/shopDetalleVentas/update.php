<?php
/* @var $this ShopDetalleVentasController */
/* @var $model ShopDetalleVentas */

$this->breadcrumbs=array(
	'Shop Detalle Ventases'=>array('index'),
	$model->id_detalle_venta=>array('view','id'=>$model->id_detalle_venta),
	'Update',
);

$this->menu=array(
	array('label'=>'List ShopDetalleVentas', 'url'=>array('index')),
	array('label'=>'Create ShopDetalleVentas', 'url'=>array('create')),
	array('label'=>'View ShopDetalleVentas', 'url'=>array('view', 'id'=>$model->id_detalle_venta)),
	array('label'=>'Manage ShopDetalleVentas', 'url'=>array('admin')),
);
?>

<h1>Update ShopDetalleVentas <?php echo $model->id_detalle_venta; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
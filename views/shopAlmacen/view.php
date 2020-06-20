<?php
/* @var $this ShopAlmacenController */
/* @var $model ShopAlmacen */

$this->breadcrumbs=array(
	'Shop Almacens'=>array('index'),
	$model->id_almacen,
);

$this->menu=array(
	array('label'=>'List ShopAlmacen', 'url'=>array('index')),
	array('label'=>'Create ShopAlmacen', 'url'=>array('create')),
	array('label'=>'Update ShopAlmacen', 'url'=>array('update', 'id'=>$model->id_almacen)),
	array('label'=>'Delete ShopAlmacen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_almacen),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShopAlmacen', 'url'=>array('admin')),
);
?>

<h1>View ShopAlmacen #<?php echo $model->id_almacen; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_almacen',
		'codigo_barras',
		'id_tipo_producto',
		'id_marca',
		'id_talla',
		'precio_producto',
		'fecha_alta',
	),
)); ?>

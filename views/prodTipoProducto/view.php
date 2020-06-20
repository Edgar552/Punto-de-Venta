<?php
/* @var $this ProdTipoProductoController */
/* @var $model ProdTipoProducto */

$this->breadcrumbs=array(
	'Prod Tipo Productos'=>array('index'),
	$model->id_tipo_producto,
);

$this->menu=array(
	array('label'=>'List ProdTipoProducto', 'url'=>array('index')),
	array('label'=>'Create ProdTipoProducto', 'url'=>array('create')),
	array('label'=>'Update ProdTipoProducto', 'url'=>array('update', 'id'=>$model->id_tipo_producto)),
	array('label'=>'Delete ProdTipoProducto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tipo_producto),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProdTipoProducto', 'url'=>array('admin')),
);
?>

<h1>View ProdTipoProducto #<?php echo $model->id_tipo_producto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tipo_producto',
		'tipo_producto',
	),
)); ?>

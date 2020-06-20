<?php
/* @var $this ProdTipoProductoController */
/* @var $model ProdTipoProducto */

$this->breadcrumbs=array(
	'Prod Tipo Productos'=>array('index'),
	$model->id_tipo_producto=>array('view','id'=>$model->id_tipo_producto),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProdTipoProducto', 'url'=>array('index')),
	array('label'=>'Create ProdTipoProducto', 'url'=>array('create')),
	array('label'=>'View ProdTipoProducto', 'url'=>array('view', 'id'=>$model->id_tipo_producto)),
	array('label'=>'Manage ProdTipoProducto', 'url'=>array('admin')),
);
?>

<h1>Update ProdTipoProducto <?php echo $model->id_tipo_producto; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
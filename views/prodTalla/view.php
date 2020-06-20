<?php
/* @var $this ProdTallaController */
/* @var $model ProdTalla */

$this->breadcrumbs=array(
	'Prod Tallas'=>array('index'),
	$model->id_tipo_talla,
);

$this->menu=array(
	array('label'=>'List ProdTalla', 'url'=>array('index')),
	array('label'=>'Create ProdTalla', 'url'=>array('create')),
	array('label'=>'Update ProdTalla', 'url'=>array('update', 'id'=>$model->id_tipo_talla)),
	array('label'=>'Delete ProdTalla', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tipo_talla),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProdTalla', 'url'=>array('admin')),
);
?>

<h1>View ProdTalla #<?php echo $model->id_tipo_talla; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tipo_talla',
		'tipo_talla',
	),
)); ?>

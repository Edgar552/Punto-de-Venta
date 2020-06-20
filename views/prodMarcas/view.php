<?php
/* @var $this ProdMarcasController */
/* @var $model ProdMarcas */

$this->breadcrumbs=array(
	'Prod Marcases'=>array('index'),
	$model->id_marca,
);

$this->menu=array(
	array('label'=>'List ProdMarcas', 'url'=>array('index')),
	array('label'=>'Create ProdMarcas', 'url'=>array('create')),
	array('label'=>'Update ProdMarcas', 'url'=>array('update', 'id'=>$model->id_marca)),
	array('label'=>'Delete ProdMarcas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_marca),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProdMarcas', 'url'=>array('admin')),
);
?>

<h1>View ProdMarcas #<?php echo $model->id_marca; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_marca',
		'tipo_marca',
		'id_tipo_producto',
	),
)); ?>

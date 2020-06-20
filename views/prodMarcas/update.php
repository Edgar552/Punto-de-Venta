<?php
/* @var $this ProdMarcasController */
/* @var $model ProdMarcas */

$this->breadcrumbs=array(
	'Prod Marcases'=>array('index'),
	$model->id_marca=>array('view','id'=>$model->id_marca),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProdMarcas', 'url'=>array('index')),
	array('label'=>'Create ProdMarcas', 'url'=>array('create')),
	array('label'=>'View ProdMarcas', 'url'=>array('view', 'id'=>$model->id_marca)),
	array('label'=>'Manage ProdMarcas', 'url'=>array('admin')),
);
?>

<h1>Update ProdMarcas <?php echo $model->id_marca; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this ProdTallaController */
/* @var $model ProdTalla */

$this->breadcrumbs=array(
	'Prod Tallas'=>array('index'),
	$model->id_tipo_talla=>array('view','id'=>$model->id_tipo_talla),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProdTalla', 'url'=>array('index')),
	array('label'=>'Create ProdTalla', 'url'=>array('create')),
	array('label'=>'View ProdTalla', 'url'=>array('view', 'id'=>$model->id_tipo_talla)),
	array('label'=>'Manage ProdTalla', 'url'=>array('admin')),
);
?>

<h1>Update ProdTalla <?php echo $model->id_tipo_talla; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
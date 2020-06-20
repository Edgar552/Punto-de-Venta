<?php
/* @var $this ShopAlmacenController */
/* @var $model ShopAlmacen */

$this->breadcrumbs=array(
	'Inventario'=>array(''),
	'Nuevo Item',
);

$this->menu=array(
	//array('label'=>'Listado de Invenario', 'url'=>array('index')),
	array('label'=>'Administrar Inventario', 'url'=>array('admin')),
);
?>

<h1>Cargar a Inventario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<?php if(Yii::app()->user->hasFlash('error')):?>    
  <div class="alert alert-danger">
    <strong>Error!</strong> El código de barras ingresado ya existe.
  </div>
<?php endif; ?>
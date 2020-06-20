<?php
/* @var $this ShopAlmacenController */
/* @var $model ShopAlmacen */

$this->breadcrumbs=array(
	'Inventario'=>array(''),
	'Administrar',
);

$this->menu=array(
	//array('label'=>'link(target, link)stado de Invenario', 'url'=>array('index')),
	array('label'=>'Cargar Nuevo Item', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#shop-almacen-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrador del Inventario</h1>

<p>
En la presente tabla se visualiza el contenido de cada pieza en almacen.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shop-almacen-grid',
	'itemsCssClass'=>"table table-hover table-bordered",
	'pager'=>array("htmlOptions"=>array("class"=>"pagination")), //despues de 10 elementos pagina
	'emptyText'=>'No existen resultados de esta búsqueda', //cuando no existe algun registro muestra ese mensaje
	'summaryText'=>'{start}-{end} de {count} Items',// muestra el numero que ti
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_almacen',

		array(
			'name' =>'codigo_barras',
			'header'=>'Código de Barras' ),

		array(
			'name' =>'id_tipo_producto',
			'header'=>'Producto',
			'value'=>'shopAlmacen::getNameProducto($data->id_tipo_producto)'),

		array(
			'name' =>'id_marca',
			'header'=>'Marca',
			'value'=>'shopAlmacen::getNameMarca($data->id_marca)'),

		array(
			'name' =>'id_talla',
			'header'=>'Talla',
			'value'=>'shopAlmacen::getNameTalla($data->id_talla)'),

		array(
			'name' =>'precio_producto',
			'header'=>'Precio Unitario' ),

		array(
			'name' =>'status_item',
			'header'=>'Status' ),
		/*
		'fecha_alta',
		*/
		array(
			'class'=>'CButtonColumn',
			'header'=>'Acciones',
			'template'=>'{update}{delete}', //modifica mi tema y solo recibe las acciones que le indico
			'deleteConfirmation'=>('¿Desea borrar el ítem?'),
			'buttons'=>array(
					'update'=>array('rel'=>'tooltip',
					'options'=>array(
					'data-toggle'=>'tooltip',
					'title'=>Yii::t('app','Actualizar')
									),
				'label'=>'<i class="fa fa-refresh fa-2x"></i>',
				'imageUrl'=>false,
				'updateButtonUrl'=>'Yii::app()->controller->createUrl("update")',
							),


					'delete'=>array('rel'=>'tooltip',
					'options'=>array(
					'data-toggle'=>'tooltip',
					'title'=>Yii::t('app','Borrar')
									),
				'label'=>'<i class="fa fa-times fa-2x"></i>',
				'imageUrl'=>false,
				'updateButtonUrl'=>'Yii::app()->controller->createUrl("delete")',
							),	
				),
			),
	),
)); ?>

<?php if(Yii::app()->user->hasFlash('success')):?>    
  <div class="alert alert-success">
    <strong>Éxito!</strong> El producto se ha Almacenado correctamente.
  </div>
<?php endif; ?>


<?php if(Yii::app()->user->hasFlash('updatesuccess')):?>    
  <div class="alert alert-success">
    <strong>Éxito!</strong> El producto se ha Actualizado correctamente.
  </div>
<?php endif; ?>

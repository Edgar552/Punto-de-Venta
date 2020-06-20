<script>
	function checkSubmit() 
	{
    	document.getElementById("btsubmit").value = "Enviando datos...";
    	document.getElementById("btsubmit").disabled = true;
    	return true;
	}
</script>


<div class="form" onsubmit="return checkSubmit();">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-almacen-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los Campos con <span class="required">*</span> son obligatorios.</p>


	<div class="row">
		<label>Tipo de Producto*</label>
		<?php echo $form->dropDownList($model,'id_tipo_producto',shopAlmacen::getListProductos(),
		array(
		'style'=>'width::20%',
		'prompt'=>'Seleccione un producto',
		'ajax' => array(
        'type' => 'POST',
        //ENVIA POR POST EL "ID" DE NUESTRO ESTADO PARA PODER RECIBIRLO EN EL CONTROLADOR
        'url' => CController::createUrl('ShopAlmacen/SelectMarca'),
        //RECIBE EL METODO "selectMunicipio" PARA OBTENER EL "id" DE NUESTRA MARCA--->VAMOS AL CONTROLADOR
		'update' => '#'.CHtml::activeId($model,'id_marca'),
                               
            		),
	     ));?>
		<?php echo $form->error($model,'id_tipo_producto'); ?>
	</div>

	<div class="row">
		<label>Marca del Producto *</label>
		<?php echo $form->dropDownList($model,'id_marca',shopAlmacen::getListMarcas(),
		array('prompt'=>'Seleccione una marca'));?>
		<?php echo $form->error($model,'id_marca'); ?>

	</div>

	<div class="row">
		<label>Talla del Producto*</label>
		<?php echo $form->dropDownList($model,'id_talla',shopAlmacen::getListTallas(),
		array('prompt'=>'Seleccione una talla'));?>
		<?php echo $form->error($model,'id_talla'); ?>
	</div>

	<div class="row">
		<label>Precio del Producto*</label>
		<?php echo $form->textField($model,'precio_producto',array('size'=>45,'maxlength'=>45,'placeholder'=>'$')); ?>
		<?php echo $form->error($model,'precio_producto'); ?>
	</div>

	<div class="row">
		<label>Fecha de Alta</label>
		<?php $this->widget("zii.widgets.jui.CJuiDatePicker",array(
		"attribute"=>"fecha_alta",
		"model"=>$model,
		"language"=>"es",
		"options"=>array(
			'autoSize'=>'true',
		  	'changeMonth' => 'true', 
		    'changeYear' => 'true', 
 			'dateFormat' => 'yy-mm-dd',
			'yearRange'=>'2019:2025',
			'defaultDate'=>$model->fecha_alta,
			),
 			'htmlOptions'=>array('readonly' => true,'style'=>'cursor:pointer','placeholder'=>'Seleccione Fecha')
 			));?>
		<?php echo $form->error($model,'fecha_alta'); ?>
	</div>

	<div class="row">
		<label>Código de Barras </label>
		<?php echo $form->textField($model,'codigo_barras',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'codigo_barras'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Añadir' : 'Actualizar',array('id'=>'btsubmit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
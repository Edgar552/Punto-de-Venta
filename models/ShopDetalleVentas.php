<?php

/**
 * This is the model class for table "shop_detalle_ventas".
 *
 * The followings are the available columns in table 'shop_detalle_ventas':
 * @property integer $id_detalle_venta
 * @property string $codigo_barras
 * @property integer $id_tipo_producto
 * @property integer $id_marca
 * @property integer $id_talla
 * @property double $precio_producto
 * @property string $numero_ticket
 */
class ShopDetalleVentas extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_detalle_ventas';
	}

	public static function listarVentas($id)
	{
			$sql="
				SELECT 
				    sdv.numero_ticket, tp.tipo_producto, pm.tipo_marca,pt.tipo_talla, sdv.precio_final  ,sdv.id_detalle_venta
				FROM
				    shop_detalle_ventas sdv
				        INNER JOIN
				    prod_tipo_producto tp ON sdv.id_tipo_producto = tp.id_tipo_producto
				    	INNER JOIN
				    prod_marcas pm ON sdv.id_marca=pm.id_marca
				    	INNER JOIN
				    prod_talla pt ON sdv.id_talla=pt.id_tipo_talla

				WHERE
				    sdv.numero_ticket=".$id;	
		    $sql1="
		    	SELECT 
		    	    COUNT(*)
		    	FROM
		    	    shop_detalle_ventas sdv
		    	       
		    	WHERE
		    	    numero_ticket=".$id;

			$count=Yii::app()->db->createCommand($sql1)->queryScalar();

			 return new CSqlDataProvider($sql,
					array(
						'totalItemCount'=>$count,
						'sort'=>array(
						       'attributes'=>array(
						            'id_detalle_venta', 'numero_ticket', 'tipo_producto','tipo_marca','tipo_talla','precio_final',
						       ),
						   ),
						'keyField'=>'id_detalle_venta',
						'pagination'=>array('pageSize'=>10,)
					)
		   );
	}


	public static function GetCredito($IdDetalleProducto)
	{

		$ObtenerTicket="
			SELECT numero_ticket
			
			FROM
			    shop_detalle_ventas
			WHERE
			    id_detalle_venta ='$IdDetalleProducto'";

		$resultTicket=Yii::app()->db->createCommand($ObtenerTicket)->queryScalar(); //EJECUTA LA CONSULTA Y OBTIENE EL NUMERO DE TICKET CON BASE AL ID DEL ELEMENTO SELECCIONADO EN LA TABLA DEL FORM
	
		$ObtenerCantidad="
			SELECT precio_final
			
			FROM
			    shop_detalle_ventas
			WHERE
			    id_detalle_venta ='$IdDetalleProducto'";

		$resultCantidad=Yii::app()->db->createCommand($ObtenerCantidad)->queryScalar();// OBTIENE EL PRECIO DEL PRODUCTO QUE SE ELIMINÓ PARA DESPUES COMPARARLO CON EL CREDITO EXISTENTE Y DEFINIR UN CREDITO FINAL

		$CreditoExistente="
			SELECT credito_disponible
			
			FROM
			    shop_ventas
			WHERE
			    numero_ticket ='$resultTicket'";

		$resultCreditoExistente=Yii::app()->db->createCommand($CreditoExistente)->queryScalar();

		$ResultFinalCredito=$resultCantidad+$resultCreditoExistente;

		$sqlInsert="UPDATE shop_ventas 
					SET credito_disponible=$ResultFinalCredito 
					WHERE numero_ticket=$resultTicket";
		
		$ResultInsert=Yii::app()->db->createCommand($sqlInsert)->query();

	    return $ResultFinalCredito;

	}



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_barras, id_tipo_producto, id_marca, id_talla, precio_producto, numero_ticket, descuento_aplicado, precio_final', 'required'),
			array('id_tipo_producto, id_marca, id_talla', 'numerical', 'integerOnly'=>true),
			array('precio_producto', 'numerical'),
			array('codigo_barras', 'length', 'max'=>45),
			array('numero_ticket', 'length', 'max'=>65),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_detalle_venta, codigo_barras, id_tipo_producto, id_marca, id_talla, precio_producto, numero_ticket', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_detalle_venta' => 'Id Detalle Venta',
			'codigo_barras' => 'Codigo Barras',
			'id_tipo_producto' => 'Id Tipo Producto',
			'id_marca' => 'Id Marca',
			'id_talla' => 'Id Talla',
			'precio_producto' => 'Precio Producto',
			'numero_ticket' => 'Numero Ticket',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_detalle_venta',$this->id_detalle_venta);
		$criteria->compare('codigo_barras',$this->codigo_barras,true);
		$criteria->compare('id_tipo_producto',$this->id_tipo_producto);
		$criteria->compare('id_marca',$this->id_marca);
		$criteria->compare('id_talla',$this->id_talla);
		$criteria->compare('precio_producto',$this->precio_producto);
		$criteria->compare('numero_ticket',$this->numero_ticket,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShopDetalleVentas the static model class
	 */

}

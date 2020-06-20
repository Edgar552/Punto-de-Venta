<?php

/**
 * This is the model class for table "shop_ventas".
 *
 * The followings are the available columns in table 'shop_ventas':
 * @property integer $id_shop_ventas
 * @property string $numero_ticket
 * @property string $fecha_venta
 * @property string $hora_venta
 * @property double $venta_total
 * @property string $nombre_vendedor
 */
class ShopVentas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_ventas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero_ticket, venta_total', 'required'),
			array('venta_total, credito_disponible', 'numerical'),
			array('numero_ticket', 'length', 'max'=>65),
			array('nombre_vendedor', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_shop_ventas, numero_ticket, fecha_venta, hora_venta, venta_total, nombre_vendedor', 'safe', 'on'=>'search'),
		);
	}




//   FUNCIONES GET PARA CONTROLADOR Y AÑADIR A DETALLE EN VENTA

	public static function GetCodigoBarras($CodigoBarras) //RECIBE EL CONTENIDO DEL CONTROLADOR Y LO MANIPULA EN UNA CONSULTA SQL
	{

		$sqlBarras="
			SELECT 
			    codigo_barras
			FROM
			    shop_almacen 
			WHERE
			    codigo_barras ='$CodigoBarras'";
		$GetBarras=ShopAlmacen::model()->findBySql($sqlBarras);  //ALMACENA EL RESULTADO DE LA CONSULTA Y COMPARA
		return $GetBarras['codigo_barras']; // DENTRO DE CORCHETES ES EL VALOR ALMACENADO ES DECIR, EL DE LA CONSULTA
		//LO REGRESA AL CONTROLADOR
	}

//   FUNCIONES GET PARA CONTROLADOR Y AÑADIR A DETALLE EN VENTA

	public static function GetProductoID($CodigoBarras) //RECIBE EL CONTENIDO DEL CONTROLADOR Y LO MANIPULA EN UNA CONSULTA SQL
	{
		$sqlProducto="
			SELECT 
			    id_tipo_producto
			FROM
			    shop_almacen 
			WHERE
			    codigo_barras ='$CodigoBarras'";
		$GetProductoID=ShopAlmacen::model()->findBySql($sqlProducto);  //ALMACENA EL RESULTADO DE LA CONSULTA Y COMPARA
		return $GetProductoID['id_tipo_producto']; // DENTRO DE CORCHETES ES EL VALOR ALMACENADO ES DECIR, EL DE LA CONSULTA
		//LO REGRESA AL CONTROLADOR
	}

	public static function GetMarcaID($CodigoBarras) //RECIBE EL CONTENIDO DEL CONTROLADOR Y LO MANIPULA EN UNA CONSULTA SQL
	{
		$sqlMarca="
			SELECT 
			    id_marca
			FROM
			    shop_almacen 
			WHERE
			    codigo_barras ='$CodigoBarras'";
		$GetMarcaID=ShopAlmacen::model()->findBySql($sqlMarca);  //ALMACENA EL RESULTADO DE LA CONSULTA Y COMPARA
		return $GetMarcaID['id_marca']; // DENTRO DE CORCHETES ES EL VALOR ALMACENADO ES DECIR, EL DE LA CONSULTA
		//LO REGRESA AL CONTROLADOR
	}

	public static function GetTallaID($CodigoBarras) //RECIBE EL CONTENIDO DEL CONTROLADOR Y LO MANIPULA EN UNA CONSULTA SQL
	{
		$sqlMarca="
			SELECT 
			    id_talla
			FROM
			    shop_almacen 
			WHERE
			    codigo_barras ='$CodigoBarras'";
		$GetTallaID=ShopAlmacen::model()->findBySql($sqlMarca);  //ALMACENA EL RESULTADO DE LA CONSULTA Y COMPARA
		return $GetTallaID['id_talla']; // DENTRO DE CORCHETES ES EL VALOR ALMACENADO ES DECIR, EL DE LA CONSULTA
		//LO REGRESA AL CONTROLADOR
	}

	public static function GetPrecio($CodigoBarras) //RECIBE EL CONTENIDO DEL CONTROLADOR Y LO MANIPULA EN UNA CONSULTA SQL
	{
		$sqlPrecio="
			SELECT 
			    precio_producto
			FROM
			    shop_almacen 
			WHERE
			    codigo_barras ='$CodigoBarras'";
		$GetPrecio=ShopAlmacen::model()->findBySql($sqlPrecio);  //ALMACENA EL RESULTADO DE LA CONSULTA Y COMPARA
		return $GetPrecio['precio_producto']; // DENTRO DE CORCHETES ES EL VALOR ALMACENADO ES DECIR, EL DE LA CONSULTA
		//LO REGRESA AL CONTROLADOR
	}

	public static function GetNameProducto($id_producto)
	{
		$sql="
			SELECT 
			    tipo_producto
			FROM
			    prod_tipo_producto
			WHERE
			    id_tipo_producto ='$id_producto'";
		$producto=ProdTipoProducto::model()->findBySql($sql);
		return $producto['tipo_producto'];

	}


	public static function GetNameMarca($id_marca)
	{
		$sql="
			SELECT 
			    tipo_marca
			FROM
			    prod_marcas
			WHERE
			    id_marca ='$id_marca'";
		$marca=ProdMarcas::model()->findBySql($sql);
		return $marca['tipo_marca'];

	}


	public static function GetNameTalla($id_talla)
	{
		$sql="
			SELECT 
			    tipo_talla
			FROM
			    prod_talla
			WHERE
			    id_tipo_talla ='$id_talla'";
		$talla=ProdTalla::model()->findBySql($sql);
		return $talla['tipo_talla'];

	}

	public static function GetSumaDetalle($NumTicket)
	{
		$sql="
			SELECT SUM(precio_final)
			
			FROM
			    shop_detalle_ventas
			WHERE
			    numero_ticket ='$NumTicket'";

		$result=Yii::app()->db->createCommand($sql)->queryScalar();


		$sqlInsert="UPDATE shop_ventas 
					SET venta_total=$result 
					WHERE numero_ticket=$NumTicket";
		
		$ResultInsert=Yii::app()->db->createCommand($sqlInsert)->query();




	    return $result;

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
			'id_shop_ventas' => 'Id Shop Ventas',
			'numero_ticket' => 'Numero Ticket',
			'fecha_venta' => 'Fecha Venta',
			'hora_venta' => 'Hora Venta',
			'venta_total' => 'Venta Total',
			'nombre_vendedor' => 'Nombre Vendedor',
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

		$criteria->compare('id_shop_ventas',$this->id_shop_ventas);
		$criteria->compare('numero_ticket',$this->numero_ticket,true);
		$criteria->compare('fecha_venta',$this->fecha_venta,true);
		$criteria->compare('hora_venta',$this->hora_venta,true);
		$criteria->compare('venta_total',$this->venta_total);
		$criteria->compare('nombre_vendedor',$this->nombre_vendedor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShopVentas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

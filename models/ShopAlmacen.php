<?php

/**
 * This is the model class for table "shop_almacen".
 *
 * The followings are the available columns in table 'shop_almacen':
 * @property integer $id_almacen
 * @property string $codigo_barras
 * @property integer $id_tipo_producto
 * @property integer $id_marca
 * @property integer $id_talla
 * @property string $precio_producto
 * @property string $fecha_alta
 */
class ShopAlmacen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_almacen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_barras, id_tipo_producto, id_marca, id_talla, precio_producto', 'required'),
			array('id_tipo_producto, id_marca, id_talla', 'numerical', 'integerOnly'=>true),
			array('codigo_barras, precio_producto, fecha_alta', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_almacen, codigo_barras, id_tipo_producto, id_marca, id_talla, precio_producto, fecha_alta', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		'idTipoProducto' => array(self::BELONGS_TO, 'ProdTipoProducto', 'id_tipo_producto'),
		'idMarca' => array(self::BELONGS_TO, 'ProdMarcas', 'id_marca'),
		'idTalla'=> array(self::BELONGS_TO,'ProdTalla','id_talla'),


		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_almacen' => 'ID Almacen',
			'codigo_barras' => 'Código de Barras',
			'id_tipo_producto' => 'Tipo de Producto',
			'id_marca' => 'Marca',
			'id_talla' => 'Talla',
			'precio_producto' => 'Precio del Producto',
			'fecha_alta' => 'Fecha Alta',
		);
	}

		public static function getListProductos()
	{//regresa la lista de productos por su contenido
		return CHtml::listData(ProdTipoProducto::model()->findAll(),'id_tipo_producto',
			'tipo_producto');
	}	

	public static function getNameProducto($id_tipo_producto)
	{
		$producto=ProdTipoProducto::model()->find('id_tipo_producto='.$id_tipo_producto);
		return $producto['tipo_producto'];	
	}

		public static function getListMarcas()
	{//regresa la lista de productos por su contenido
		return CHtml::listData(ProdMarcas::model()->findAll(),'id_marca',
			'tipo_marca');
	}

	public static function getNameMarca($id_marca)
	{
		$marca=ProdMarcas::model()->find('id_marca='.$id_marca);
		return $marca['tipo_marca'];
	}	

		public static function getListTallas()
	{//regresa la lista de productos por su contenido
		return CHtml::listData(ProdTalla::model()->findAll(),'id_tipo_talla',
			'tipo_talla');
	}


	public static function getNameTalla($id_talla)
	{
		$talla=ProdTalla::model()->find('id_tipo_talla='.$id_talla);
		return $talla['tipo_talla'];
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

		$criteria->compare('id_almacen',$this->id_almacen);
		$criteria->compare('codigo_barras',$this->codigo_barras,true);

		$criteria->with = array('idTipoProducto','idMarca','idTalla');

		$criteria->compare('(idTipoProducto.tipo_producto)',(string)$this->id_tipo_producto,true);
		$criteria->compare('(idMarca.tipo_marca)',(string)$this->id_marca,true);
		$criteria->compare('(idTalla.tipo_talla)',(string)$this->id_talla,true);

		$criteria->compare('precio_producto',$this->precio_producto,true);
		$criteria->compare('fecha_alta',$this->fecha_alta,true);

		$criteria->order = 'id_almacen DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
			'pageSize'=>50,
			), 
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShopAlmacen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



}

<?php

/**
 * This is the model class for table "universities".
 *
 * The followings are the available columns in table 'universities':
 * @property string $college
 * @property string $state
 * @property string $link
 */
class University extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return University the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'universities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('college, state, link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('college, state, link', 'safe', 'on'=>'search'),
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
			'college' => 'College',
			'state' => 'State',
			'link' => 'Link',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('college',$this->college,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function get_university($params='',$join='',$where_clause, $cond='')
	{
		$sql="SELECT ".$params." FROM  universities ".$join." where ".$where_clause." ".$cond;
		//echo $sql; exit;
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		//echo "<pre>"; print_r($rows); exit;
		return $rows;
		
	}
}
<?php

/**
 * This is the model class for table "skill".
 *
 * The followings are the available columns in table 'skill':
 * @property integer $id
 * @property string $name
 * @property string $proficiency
 * @property integer $status
 */
class Skill extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Skill the static model class
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
		return 'skill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, proficiency, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, proficiency', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, proficiency, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'proficiency' => 'Proficiency',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('proficiency',$this->proficiency,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function get_skill($params='',$join='',$where_clause='', $cond='')
	{
		$sql="Select ".$params." from skill ".$join." where ".$where_clause."  ".$cond;
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		return $rows;
		
	}
	
	public function search_skill($title)
	{
		$sql_row="SELECT id FROM skill WHERE name='".mysql_real_escape_string($title)."' AND status=1 ";
		$numrows = Yii::app()->db->createCommand($sql_row)->queryRow();
		 
		$count = Skill::model()->count("name=:name", array("name" => $title));
		if($count >0)
		{
			return $numrows['id'];
		}
		
		else
		{
			 $rows = Yii::app()->db->createCommand()->insert('skill',array(
						'name'=>$title,
						'status'=>'1',
					));					
			$id = Yii::app()->db->getLastInsertID();
			return $id;
		}
		
	} // END FUNCTION  

} // END CLASS
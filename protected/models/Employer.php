<?php

/**
 * This is the model class for table "employer".
 *
 * The followings are the available columns in table 'employer':
 * @property integer $employer_id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $address
 * @property string $company_name
 * @property string $company_starting_date
 * @property string $timezone
 * @property string $joining_date
 * @property integer $status
 */
class Employer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employer the static model class
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
		return 'employer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname,  email, address, company_name,  joining_date', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname,email, company_name, timezone', 'length', 'max'=>300),
			array('address', 'length', 'max'=>3000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employer_id, firstname, lastname, username, password, email, address, company_name, company_starting_date, timezone, joining_date, status', 'safe', 'on'=>'search'),
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
			'employer_id' => 'Employer',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'url'=>'URL',
			'address' => 'Address',
			'company_name' => 'Company Name',
			'company_starting_date' => 'Company Starting Date',
			'timezone' => 'Timezone',
			'joining_date' => 'Joining Date',
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

		$criteria->compare('employer_id',$this->employer_id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_starting_date',$this->company_starting_date,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('joining_date',$this->joining_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function get_employer($params='',$join='',$where_clause, $cond='')
	{
		
		$sql="Select ".$params." from employer ".$join." where ".$where_clause." ".$cond;
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
	
		return $rows;
		
	}
}
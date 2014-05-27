<?php

/**
 * This is the model class for table "employer_creditcard".
 *
 * The followings are the available columns in table 'employer_creditcard':
 * @property integer $id
 * @property integer $employer_id
 * @property string $card_type
 * @property string $card_number
 * @property string $card_holder_name
 * @property integer $card_exp_month
 * @property string $card_exp_year
 * @property string $card_fingerprint
 * @property integer $card_cvc
 * @property string $token_no
 * @property string $country
 * @property string $address_line1
 * @property string $address_line2
 * @property string $address_city
 * @property string $address_state
 * @property string $address_zip
 * @property string $address_country
 * @property string $currency
 * @property integer $status
 * @property string $created_at
 */
class EmployerCreditcard extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmployerCreditcard the static model class
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
		return 'employer_creditcard';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/*public function rules()
	{
	
		return array(
			array('employer_id, card_type, card_number, card_holder_name, card_exp_month, card_exp_year, card_fingerprint, card_cvc, token_no, country, address_line1, address_line2, address_city, address_state, address_zip, address_country, currency, status, created_at', 'required'),
			array('employer_id, card_exp_month, card_cvc, status', 'numerical', 'integerOnly'=>true),
			array('card_type, card_number, address_state, address_country', 'length', 'max'=>50),
			array('card_holder_name, card_fingerprint, token_no, country, address_line1, address_line2', 'length', 'max'=>300),
			array('card_exp_year', 'length', 'max'=>4),
			array('address_city', 'length', 'max'=>100),
			array('address_zip, currency', 'length', 'max'=>20),
		
			array('id, employer_id, card_type, card_number, card_holder_name, card_exp_month, card_exp_year, card_fingerprint, card_cvc, token_no, country, address_line1, address_line2, address_city, address_state, address_zip, address_country, currency, status, created_at', 'safe', 'on'=>'search'),
		);
	}*/

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
			'employer_id' => 'Employer',
			'card_type' => 'Card Type',
			'card_number' => 'Card Number',
			'card_holder_name' => 'Card Holder Name',
			'card_exp_month' => 'Card Exp Month',
			'card_exp_year' => 'Card Exp Year',
			'card_fingerprint' => 'Card Fingerprint',
			'card_cvc' => 'Card Cvc',
			'token_no' => 'Token No',
			'country' => 'Country',
			'address_line1' => 'Address Line1',
			'address_city' => 'Address City',
			'address_state' => 'Address State',
			'address_zip' => 'Address Zip',
			'currency' => 'Currency',
			'status' => 'Status',
			'created_at' => 'Created At',
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
		$criteria->compare('employer_id',$this->employer_id);
		$criteria->compare('card_type',$this->card_type,true);
		$criteria->compare('card_number',$this->card_number,true);
		$criteria->compare('card_holder_name',$this->card_holder_name,true);
		$criteria->compare('card_exp_month',$this->card_exp_month);
		$criteria->compare('card_exp_year',$this->card_exp_year,true);
		$criteria->compare('card_fingerprint',$this->card_fingerprint,true);
		$criteria->compare('card_cvc',$this->card_cvc);
		$criteria->compare('token_no',$this->token_no,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('address_line1',$this->address_line1,true);
		$criteria->compare('address_line2',$this->address_line2,true);
		$criteria->compare('address_city',$this->address_city,true);
		$criteria->compare('address_state',$this->address_state,true);
		$criteria->compare('address_zip',$this->address_zip,true);
		$criteria->compare('address_country',$this->address_country,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function get_payment($params='',$join='',$where_clause, $cond='')
	{
		
		$sql="Select ".$params." from employer_creditcard ".$join." where ".$where_clause." ".$cond;
		//echo $sql;exit;
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
	
		return $rows;
		
	}
}
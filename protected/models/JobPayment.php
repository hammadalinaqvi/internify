<?php

/**
 * This is the model class for table "job_payment".
 *
 * The followings are the available columns in table 'job_payment':
 * @property integer $id
 * @property integer $employer_id
 * @property integer $payment_id
 * @property integer $posting_id
 * @property integer $status
 * @property string $created_at
 */
class JobPayment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JobPayment the static model class
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
		return 'job_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/*public function rules()
	{
		
		return array(
			array('employer_id, payment_id, posting_id, status, created_at', 'required'),
			array('employer_id, payment_id, posting_id, status', 'numerical', 'integerOnly'=>true),
		
			array('id, employer_id, payment_id, posting_id, status, created_at', 'safe', 'on'=>'search'),
		);
	}
*/
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
			'payment_id' => 'Payment',
			'posting_id' => 'Posting',
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
		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('posting_id',$this->posting_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
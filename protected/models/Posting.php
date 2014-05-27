<?php

/**
 * This is the model class for table "posting".
 *
 * The followings are the available columns in table 'posting':
 * @property integer $id
 * @property integer $job_type_id
 * @property integer $employer_id
 * @property string $title
 * @property string $description
 * @property string $skill_id
 * @property string $start_date
 * @property string $end_date
 * @property string $facebook_id
 * @property string $twitter_id
 * @property string $linkedin_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Posting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posting the static model class
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
		return 'posting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_type_id, employer_id, title, description, skill_id, start_date, end_date, facebook_id, twitter_id, linkedin_id, status', 'required'),
			array('job_type_id, employer_id, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('description', 'length', 'max'=>10000),
			array('skill_id, facebook_id, twitter_id, linkedin_id', 'length', 'max'=>3000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_type_id, employer_id, title, description, skill_id, start_date, end_date, facebook_id, twitter_id, linkedin_id, status, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		 'jobtype' => array(self::BELONGS_TO,'JobType','job_type_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_type_id' => 'Job Type',
			'employer_id' => 'Employer',
			'title' => 'Title',
			'description' => 'Description',
			'skill_id' => 'Skill',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'facebook_id' => 'Facebook',
			'interns_limit'=>"Intern Limit",
			'total_price'=>'TotalPrice',
			'twitter_id' => 'Twitter',
			'linkedin_id' => 'Linkedin',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('job_type_id',$this->job_type_id);
		$criteria->compare('employer_id',$this->employer_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('skill_id',$this->skill_id,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('twitter_id',$this->twitter_id,true);
		$criteria->compare('linkedin_id',$this->linkedin_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function get_post($params='',$join='',$where_clause, $cond='')
	{
		$sql="SELECT ".$params." FROM posting ".$join." where ".$where_clause." ".$cond;
		//echo $sql; exit;
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		//echo "<pre>"; print_r($rows); exit;
		return $rows;
		
	}
}
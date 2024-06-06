<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\base\Model;
class Jobs extends ActiveRecord
{
    public $verifyCode;
    const SCENARIO_EDIT = 'edit';
    const SCENARIO_DEFAULT = 'default'; 
    public static function tableName()
    {
        return 'jobs';
    }

    public function rules()
    {
        return [
            [['name', 'applied_position', 'email','gender','phone_number','coverLetter','address','cc_name','skill','cc_notice_period','cc_total_exp','cc_ctc','total_exp'], 'required'],
            [['email'], 'email'],
            [['phone_number'], 'match', 'pattern' => '/^\d{10,10}$/'],
            [['cc_notice_period','cc_total_exp','cc_ctc','total_exp'], 'match', 'pattern' => '/^\d+$/'],
            [['coverLetter'], 'string'],
            [['uploadResume'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpg'],
            [['profile_img'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            [['created_at', 'updated_at'], 'safe'],
            ['verifyCode', 'captcha'],
            
        ];
    }
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name','verifyCode', 'applied_position', 'email','gender','phone_number','profile_img','coverLetter','address','cc_name','skill','cc_notice_period','cc_total_exp','cc_ctc','total_exp','uploadResume'], 
            self::SCENARIO_EDIT => ['name','verifyCode','applied_position', 'email','gender','phone_number','coverLetter','address','cc_name','skill','cc_notice_period','cc_total_exp','cc_ctc','total_exp'] 
        ];
    }

    public function attributeLabels()
    {
        return [
           
            'name' => 'Name',
            'applied_position' => 'Applied Position',
            'email' => 'Email',
            'phoneNumber' => 'Phone Number',
            'gender' => 'Gender',
            'uploadResume' => 'Upload Resume',
            'coverLetter' => 'Cover Letter',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verifyCode' => 'Verify Code',
            'cc_name' => 'Company Name',
            'cc_ctc' => 'Current CTC(PA IN INR)',
            'cc_notice_period' => 'Notice Period(Month)',
            'cc_total_exp' => 'Total Years In Current Company',
            'skill' => 'Skill',
            'total_exp' => 'Total Experience (years)',
            'profile_img' => 'Profile Image'

        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $applicationName
 * @property string $description
 * @property integer $sms
 * @property string $sms_key
 * @property string $sms_pass
 * @property integer $gcm
 * @property string $gcm_api_key
 * @property string $gcm_sender
 * @property string $emailAdmin
 * @property string $emailSupport
 * @property string $emailOrder
 * @property string $sendgridUsername
 * @property string $sendgridPassword
 * @property string $whatsappNumber
 * @property string $whatsappPassword
 * @property string $whatsappSend
 * @property string $facebook
 * @property string $instagram
 * @property string $google
 * @property string $twitter
 * @property string $approval
 * @property integer $userCreate
 * @property integer $userUpdate
 * @property string $updateDate
 * @property string $createDate
 */
class Setting extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['sms', 'gcm', 'userCreate', 'userUpdate'], 'integer'],
            [['updateDate', 'createDate'], 'safe'],
            //[['approval'], 'number'],
            [['applicationName', 'sms_key', 'sms_pass', 'gcm_api_key', 'gcm_sender', 'emailAdmin', 'emailSupport', 'emailOrder', 'sendgridUsername', 'sendgridPassword', 'whatsappNumber', 'whatsappPassword', 'whatsappSend', 'facebook', 'instagram', 'google', 'twitter'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'applicationName' => 'Application Name',
            'description' => 'Description',
            'sms' => 'Sms',
            'sms_key' => 'Sms Key',
            'sms_pass' => 'Sms Pass',
            'gcm' => 'Gcm',
            'gcm_api_key' => 'Gcm Api Key',
            'gcm_sender' => 'Gcm Sender',
            'emailAdmin' => 'Email Admin',
            'emailSupport' => 'Email Support',
            'emailOrder' => 'Email Order',
            'sendgridUsername' => 'Sendgrid Username',
            'sendgridPassword' => 'Sendgrid Password',
            'whatsappNumber' => 'Whatsapp Number',
            'whatsappPassword' => 'Whatsapp Password',
            'whatsappSend' => 'Whatsapp Send',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'google' => 'Google',
            'twitter' => 'Twitter',
            'userCreate' => 'User Create',
            'userUpdate' => 'User Update',
            'updateDate' => 'Update Date',
            'createDate' => 'Create Date',
        ];
    }

}

<?php

namespace app\models;

use Yii;
use app\models\User;
use kartik\helpers\Enum;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $title
 * @property string $message
 * @property string $url
 * @property string $params
 * @property integer $userUpdate
 * @property integer $userCreate
 * @property string $updateDate
 * @property string $createDate
 */
class Notification extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'params'], 'string'],
            [['userUpdate', 'userCreate'], 'integer'],
            [['updateDate', 'createDate'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'message' => 'Message',
            'url' => 'Url',
            'params' => 'Params',
            'userUpdate' => 'User Update',
            'userCreate' => 'User Create',
            'updateDate' => 'Update Date',
            'createDate' => 'Create Date',
        ];
    }

    public static function count()
    {
        return static::find()->count();
    }

    public static function notification()
    {
        //  $models = static::find()->orderBy('id desc')->all();
        $query = static::find();
        $query->orderBy('id desc');
        $query->limit(7);
        $models = $query->all();


        $return = '';
        $return .='<li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">' . self::count() . '</span>
                            </a>';
        $return .= '<ul class="dropdown-menu">
                                <li class="header">You have ' . self::count() . ' notifications</li>
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                    <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">';
        if ($models)
            foreach ($models as $model) {
                $return .='<li><a href="#"><i class="ion ion-ios7-people info"></i>' . $model->message . ' <small style="color:green">' . $model->timeago . '</small></a></li>';
            }
        $return .='</ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 156.862745098039px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>';
        $return .=' </ul></li>';

        return $return;
    }

    public function getTimeago()
    {
        if ($this->createDate)
            return Enum::timeElapsed($this->createDate);
    }

}

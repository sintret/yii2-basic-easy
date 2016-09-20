<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_dynagrid".
 *
 * @property string $id
 * @property string $filter_id
 * @property string $sort_id
 * @property string $data
 */
class TblDynagrid extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_dynagrid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'data'], 'required'],
            [['data'], 'string'],
            [['id', 'filter_id', 'sort_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filter_id' => 'Filter ID',
            'sort_id' => 'Sort ID',
            'data' => 'Data',
        ];
    }

    public static function pageMe($table = NULL)
    {

        $page = 0;
        $userId = Yii::$app->user->id;

        if ($table) {
            $id = $table . $userId . '_' . $userId;
        }

        $model = static::find()->where(['id' => $id])->one();
        if ($model->id) {
            $data = $model->data;
            $encode = json_decode($data, true);
            $page = $encode['page'];
        }

        return $page;
    }

    /*
     * This example function using to standarization grid for each users
     */

    public static function buildGrid($userId)
    {

        $affix = $userId . '_' . $userId;

        //$return['Kabupaten' . $affix] = '{"page":"100","theme":"panel-default","keys":["e04112b1","7a87b836","78f67f03","7b6b4a62"],"filter":"","sort":""}';
        //$return['Kecamatan' . $affix] = '{"page":"100","theme":"panel-default","keys":["5c18e243","e04112b1","7a87b836","78f67f03","7b6b4a62"],"filter":"","sort":""}';    
        //$return['Category' . $affix] = '{"page":"100","theme":"panel-default","keys":["e04112b1","7a87b836","78f67f03","7b6b4a62"],"filter":"","sort":""}';
        $return['Desa' . $affix] = '{"page":"100","theme":"panel-default","keys":["51d4c9e2","8a6dce69","e04112b1","4e2a8076","7a87b836","7b6b4a62"],"filter":"","sort":""}';
   
        return $return;
    }

    public static function buildMe($userId)
    {
        $array = self::buildGrid($userId);

        foreach ($array as $k => $v) {
            
            
            $model = static::find()->where(['id' => $k])->one();
            if ($model->id) {
                $model->data = $v;
                $model->save();
            } else {
                $model = new TblDynagrid();
                $model->id = $k;
                $model->data = $v;
                $model->save();
            }
        }
    }

    public static function builds()
    {
        $users = User::find()->all();
        if ($users)
            foreach ($users as $user) {
                self::buildMe($user->id);
            }
    }

}

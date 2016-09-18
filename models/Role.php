<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $name
 * @property string $params
 *
 * @property Access[] $accesses
 */
class Role extends \yii\db\ActiveRecord {

    const ROLE_ADMIN = 1;
    const ROLE_WORK_REQUEST = 2;
    const ROLE_WORK_ORDER = 3;
    const ROLE_SUPERVISOR = 4;

    public $role_name;
    public static $methods = ['create', 'update', 'index', 'view', 'parsing-log', 'excel', 'parsing', 'sample', 'delete', 'delete-all'];

    public static function controllers()
    {

        $array = [];
        $not = ['tbl_dynagrid', 'tbl_dynagrid_dtl', 'chat', 'access', 'migration', 'todolist'];


        $tableNames = Yii::$app->getDb()->getSchema()->tableNames;

        foreach ($tableNames as $table) {

            if (!in_array($table, $not)) {

                $table = str_replace("_", "-", $table);

                $array[] = $table;
            }
        }

        return $array;
    }

    public static function accessFilter()
    {
        $return = [];
        foreach (self::controllers() as $v) {
            $return[$v] = self::$methods;
        }

        //custom filter using join array here...

        return $return;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['params'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'params' => 'Params',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses()
    {
        return $this->hasMany(Access::className(), ['roleId' => 'id']);
    }

    public static function dropdown()
    {
        $models = static::find()->all();
        foreach ($models as $model) {
            $dropdown[$model->id] = $model->name;
        }
        return $dropdown;
    }

}

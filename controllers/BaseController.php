<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as WebController;
use yii\helpers\Url;

/**
 * Controller base on all access for dynamic controllers
 */
class BaseController extends WebController {

    public $user;

    public function init() {
        parent::init();
    }

    public function beforeAction($action) {
        $method = $action->id;
        $controller = strtolower(Yii::$app->controller->id);

        if (Yii::$app->user->id) {
            if ($this->accessMenu($controller, $method)) {
                return true;
            } else {
                $this->redirect(Url::to(['site/403']));
                return false;
                exit(0);
            }
        } else {
            $this->redirect(Url::to(['site/login']));
        }

        parent::beforeAction($action);
    }

    public function accessMenu($controller, $method) {

        if (Yii::$app->user->id) {
            if (Yii::$app->user->id == -1)
                return true;
            else
                return self::checkAccess($controller, $method, Yii::$app->user->identity->roleId);
        } else
            return false;
    }

    public static function getParams($roleId) {
        $model = \app\models\Role::find()->where(['id' => $roleId])->one();
        $params = empty($model->params) ? NULL : \yii\helpers\Json::decode($model->params);

        return $params;
    }

    public static function checkAccess($controller, $method, $roleId, $json = null) {

        if (empty($json)) {
            $params = self::getParams($roleId);
        } else {
            $params = $json;
        }


        $controller = strtolower(trim($controller));
        $method = strtolower(trim($method));
        $array = [];

        if ($params)
            foreach ($params as $k => $v) {
                $key = strtolower($k);

                foreach ($v as $j => $n) {
                    $je = strtolower($j);
                    $array[$key][$je] = $n;
                }
            }
        return isset($array[$controller][$method]);
    }

    public static function accessTo($controller, $method) {
        return self::checkAccess($controller, $method, Yii::$app->user->identity->role);
    }

    public static function checkManyAccess($array, $roleId, $json = null) {
        $return = 0;
        if ($array)
            foreach ($array as $v) {
                $explode = explode(".", $v);
                if (self::checkAccess($explode[0], $explode[1], $roleId, $json)) {
                    $return += 1;
                }
            }

        return $return;
    }

    public static function fieldsArray() {
        $fields = \app\models\Role::accessFilter();

        $return = [];
        foreach ($fields as $keys => $values) {
            foreach ($values as $k => $v) {
                $return[] = strtolower($keys) . '.' . $v;
            }
        }

        return $return;
    }

    public function accessUser($name) {
        if (Yii::$app->user->id) {
            $role = \yii\helpers\Json::decode(Yii::$app->user->identity->roles->params);
        } else
            return false;
    }

}

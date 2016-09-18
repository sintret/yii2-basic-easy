<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/*
 * Not pointing to access, you can modify this class
 */

class AjaxController extends Controller {

    public $enableCsrfValidation = false;

    /*
     * this method generates sample of excel file
     */

    public function actionSample($sessionName = NULL)
    {
        if (Yii::$app->user->id) {

            /*
             *  you can modify excel template
             */
            $template = Yii::getAlias("@webroot/xls_sample/new.xlsx");

            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load(Yii::getAlias($template));
            $excelChar = \sintret\diesel\components\Util::excelChar();
            $logName = Yii::$app->session->get($sessionName);

            Yii::$app->session->set($sessionName, NULL);
            if ($logName) {
                $string = file_get_contents($logName);
                $json = json_decode($string, true);

                return $this->render('sample', ['json' => $json, 'excelChar' => $excelChar, 'logName' => $logName, 'objPHPExcel' => $objPHPExcel]);
            }
        }
    }

}

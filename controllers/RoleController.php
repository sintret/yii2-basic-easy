<?php

namespace app\controllers;

use Yii;
use app\models\Role;
use app\models\RoleSearch;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use sintret\gii\models\LogUpload;
use sintret\gii\components\Util;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends \sintret\diesel\controllers\Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $methods = Role::$methods;
        $fields = Role::accessFilter();
        $controllers = Role::controllers();

        $roleId = isset($_GET['roleId']) == null ? 1 : $_GET['roleId'];
        $model = $this->findModel($roleId);
        $model->role_name = $roleId;

        $sql = '';

        //echo '<pre>';print_r($_POST['Roles']); exit(0);
        if ($model->load(Yii::$app->request->post())) {
            \app\models\Access::deleteAll('roleId = :roleId', [':roleId' => $roleId]);
            foreach ($_POST['Roles'] as $keys => $values) {
                foreach ($values as $k => $v) {
                    //if($v=='on')
                    $sql .= ' INSERT INTO access (roleId,controller,method) values ("' . $roleId . '","' . $keys . '","' . $k . '"); ';
                }
            }

            if ($sql) {
                Yii::$app->db->createCommand($sql)->execute();
                Yii::$app->session->setFlash('success', 'Successfully, Update access role!');
            }
        }

        return $this->render('index', [
                    'model' => $model,
                    'methods' => $methods,
                    'fields' => $fields,
                    'controllers' => $controllers,
                    'roleId' => $roleId
        ]);
    }

    /**
     * Displays a single Role model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Well done! successfully to save data!  ');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Well done! successfully to update data!  ');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Well done! successfully to deleted data!  ');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php
namespace backend\controllers;


use yii\web\Controller;
use backend\models\Proyectos;

/**
 * Site controller
 */
class ProyectosController extends Controller
{

    public function actionIndex()
    {
        $model = new Proyectos();
        $models = $model->findAll(['Activo' => 1]);
        \Yii::$app->response->format = "json";
        return $models;
    }

    public function actionCreate($nombre)
    {
        $model = new Proyectos();
        $model->Activo = 1;
        $model->NombreProyecto = $nombre;
        $model->save();
        \Yii::$app->response->format = "json";
        return $model;
    }

    public function actionUpdate($id, $activo)
    {
        $model = Proyectos::findOne($id);
        if($model !== null){
            $model->Activo = $activo;
            $model->save();
            \Yii::$app->response->format = "json";
            return $model ;
        }
    }

    public function actionDelete($id)
    {
        $model = Proyectos::findOne($id);
        if($model !== null){
            $model->delete();
            \Yii::$app->response->format = "json";
            return $model ;
        }
    }
}

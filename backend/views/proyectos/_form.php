<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyectos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreProyecto')->textInput(['maxlength' => true]) ?>

    <?php
    if (!$model->isNewRecord) {
        echo $form->field($model, 'Activo')->checkbox();

        Modal::begin([
            'header' => '<h4>Actividades</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
        ?>

        <h2>Actividades</h2>
        <?=
        \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getActividades(),
                'pagination' => false
                    ]),
            'columns' => [
                'NombreActividad',
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'controller' => 'actividades',
                    'header' => Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;Nueva', ['actividades/create-con-proyecto', 'idProyecto' => $model->idProyecto]),
                    //Html::button('Nueva actividad', ['value' => Url::to(['actividades/create-con-proyecto', 'idProyecto' => $model->idProyecto]), 'class' => 'btn btn-primary', 'id' => 'modalActividad']),
                    'template' => '{update_con_proyecto}{delete}',
                    'buttons' => [
                        'update_con_proyecto' => function ($url, $model) {
                            return Html::a('<span class="glyphicon  glyphicon-pencil"></span>', $url);
                        }
                    ],
                    'urlCreator' => function($action, $model, $key, $index){
                        if($action === 'update_con_proyecto'){
                            $url = Url::to(['actividades/update-con-proyecto', 'id' => $model->idActividad]);
                            return $url;
                        }else if($action == "delete"){
                            $url = Url::to(['actividades/delete-con-proyecto', 'id' => $model->idActividad]);
                            return $url;
                        }
                    }
                ]
            ]
        ]);
                ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

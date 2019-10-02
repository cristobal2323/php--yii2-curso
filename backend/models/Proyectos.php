<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Proyectos".
 *
 * @property int $idProyecto
 * @property string $NombreProyecto
 * @property int $Activo
 *
 * @property Actividades[] $actividades
 * @property Bitacoratiempos[] $bitacoratiempos
 */
class Proyectos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Proyectos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Activo'], 'integer'],
            [['NombreProyecto'], 'string', 'max' => 200],
            [['NombreProyecto'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProyecto' => Yii::t('app', 'Id Proyecto'),
            'NombreProyecto' => Yii::t('app', 'Nombre Proyecto'),
            'Activo' => Yii::t('app', 'Activo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividades()
    {
        return $this->hasMany(Actividades::className(), ['idProyecto' => 'idProyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoratiempos()
    {
        return $this->hasMany(Bitacoratiempos::className(), ['idProyecto' => 'idProyecto']);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        if($insert)
            $this->Activo = 1;
        return true;
    }
}

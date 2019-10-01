<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Proyectos extends ActiveRecord{

    public static function tableName()
    {
        return '{{proyectos}}';
    }
    
}
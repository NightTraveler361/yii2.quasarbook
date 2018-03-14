<?php

namespace app\models;

use Yii;

class Authors extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'authors';
    }
    
}
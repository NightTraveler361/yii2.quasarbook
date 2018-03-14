<?php

namespace app\models;

use Yii;

class Posts extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }
    
}
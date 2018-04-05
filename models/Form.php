<?php

namespace app\models;

use yii\base\Model;

class Form extends Model
{
    public $work;

    public function rules()
    {
        return [
            [['work'], 'required']
        ];
    }
}
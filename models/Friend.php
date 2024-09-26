<?php

namespace app\Models;

use yii\db\ActiveRecord;

class Friend extends ActiveRecord{


    public function rules(){

        return [
            [["user_id","number","name"],"required"]
        ];
    }
    
    public static function tableName(){
        return "friends";
    }

    public function getUser(){
        return $this->hasOne(User::class,["id"=>'user_id']);
    }

}
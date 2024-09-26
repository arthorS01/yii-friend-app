<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\Models\Friend;


    $friend = new Friend;

    $form = ActiveForm::begin([
        "action"=>"/friend/add",
        "method"=>"POST"
    ]);


    echo $form->field($friend,"name")->textInput();

    echo $form->field($friend,"number")->textInput();

    echo HTML::hiddenInput("user_id",$user_id);

    echo HTML::submitButton();

    ActiveForm::end();

?>
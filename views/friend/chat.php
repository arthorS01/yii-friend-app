<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\Models\User;

?>
<div class="container"> 

<a href=<?="/friend/add?uid=".$user_id?>><button>Add friend</button></a>
<ul>
    <?php foreach($list as $friend):?>

        <li class="friend-row">
            <span><?=$friend->name?></span>
            <br>
            <small><?=$friend->number?></small>
            <span class="tools">

            <?php  $form = ActiveForm::begin([
                "action"=>"/friend/delete",
                "method"=>"POST",
                "class"=>"form-btn"
            ]);

            echo HTML::hiddenInput("name",$friend->name);
            echo HTML::hiddenInput("number",$friend->number);
            echo HTML::hiddenInput("user_id",$user_id);

            echo HTML::submitButton("delete");
            ActiveForm::end();
            ?>
        

            <?php  $form = ActiveForm::begin([
                "action"=>"/friend/call",
                "method"=>"POST",
                "class"=>"form-btn"
            ]);

            echo HTML::hiddenInput("name",$friend->name);

            echo HTML::submitButton("call");
            ActiveForm::end();
            ?>
            </span>
        </li>

    <?php endforeach; ?>

    </ul>
</div>
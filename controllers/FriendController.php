<?php

namespace app\controllers;

use app\Models\{LoginForm,Friend,User};

use Yii;

class FriendController extends \yii\web\controller{

    public function actionIndex(){

        $model = new LoginForm;
        
        return $this->render("login",["model"=>$model]);
    }

    public function actionTest(){
            
        $friend = Friend::findOne(['id' => 3]);

        // if ($friend === null) {
        //     echo "Record not found!";
        // } else {
        //     echo "Record found!";
        //     echo $friend->getAttribute("id");  
        // } 

        return $this->render("/site/index",["friend"=>$friend]);

    }

    public function actionChat($user_id){

        $user = User::FindOne($user_id);
        
        $friendsList = $user->friends;

        return $this->render("/friend/chat",["list"=>$friendsList,"user_id"=>$user_id]);
        // echo "got here";
    }

    
    public function actionAuth(){

       $data = \yii::$app->request->post();
       
       $model = new LoginForm;
        $model->username = $data["LoginForm"]["username"];
        $model->password = $data["LoginForm"]["password"];

        $user = $model->login();

        var_dump($user);
        
        if($user === false){
            return $this->redirect(["friend/index","error"=>"true"]);
        }

        return $this->redirect(["friend/chat"]);
    }


    public function actionDelete(){

        if(Yii::$app->request->getMethod()=="POST"){
            
            $data = Yii::$app->request->post();

            $friend = Friend::FindOne(["user_id"=>$data["user_id"], "name"=>$data["name"], "number"=>$data["number"]]);

            $friend->delete();

            return $this->redirect("/friend/chat?user_id=".$data["user_id"]);
    }

}
        

    public function actionAdd($uid=null){

        if(Yii::$app->request->getMethod() == "POST"){
           
            $data = Yii::$app->request->post();
            
          
            $friend = new Friend;
            $friend->user_id = $data["user_id"];;
            $friend->number = $data["Friend"]["number"];
            $friend->name  = $data["Friend"]["name"];
            

            $friend->save();

            return $this->redirect("/friend/chat?user_id=".$friend->user_id);


        }else{
            
        }
        return $this->render("/friend/add",["user_id"=>$uid]);

    }

    public function actionCall(){

     
        if(Yii::$app->request->post()){

       
            $name = yii::$app->request->post()["name"];
            // $friend_id = yii::$app->request->post()["friend_id"];


        return $this->render("/friend/call",[
            "name"=>$name
        ]);
    }

}

}
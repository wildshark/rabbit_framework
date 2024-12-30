<?php
$sub = explode("-",$_REQUEST['submit']);
$act = $sub[0];
$req = $sub[1];
$url = [];
$token = BNK;

switch($act){

    case"user":
        if($req === "login"){           
            $rp = $sbn->SusuModule("login",$_POST);
            if($rp == false){
                $url['page'] = "login";
            }else{    
                setcookie("_user",$_POST['username']);
                setcookie("uid",$rp['uid']);
                $url['main'] = "dashboard";
                $url['token']=$rp['bid'];
            }
        }elseif($req ==="registration"){
            $user = $_POST['username'];
            $pwd = $_POST['password'];
            $post = $qry->registration($user,$pwd);
        }elseif($req ==="reset"){
            $email = $_POST['email'];
            $post = $qry->registration($email);
        }   
    break;

}

header("location: ?".http_build_query($url));
?>
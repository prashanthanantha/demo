<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/cryptojs-aes.php';
require 'common_file/inout_function.php';

$app->any('/login-form', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    } else {
        $args['first_name'] =  'login';
    }
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    /*echo "<pre>"; print_r($nav_result); exit;*/
    $args['nav_result'] = $nav_result;

    $sub_ct_result = getCurls('users/getSubCategoris');
    //echo "<pre>"; print_r($sub_ct_result); exit;
    $args['sub_ct_result'] = $sub_ct_result;

    //For nav banners
    $banner_result = getCurls('users/getBanners');
    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 4);
    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;

    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    // get url
    $url1 = $request->getUri()->gethost();

    $url2 = $request->getUri()->getBasePath();

    $url3 = $request->getUri()->getpath();

    $args['url']=$url1.$url2.'/'.$url3;
    // get sliders
    if($args['first_name'] ==  'login'){
       $args['page'] = 'login_form';
    }else{
        header('Location: http://localhost/manast_curl_changes');
        die();
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);

});

$app->any('/login', function ($request, $response, $args){
    if (isset($_POST) && count($_POST) > 0) {
        /*echo "<pre>"; print_r($_POST); exit;*/
       $login_email = $_POST["email"];
       $login_password = $_POST["password"];
        if(!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $login_email)){
            $args['error'] = "email address error"; 
            $result = json_encode($args);
            echo $result; exit;

      }

      if(!preg_match('/^[ A-Za-z0-9_@.#&+-]{6,}$/', $login_password)){

            $args['error'] = "please enter valid password"; 

            $result = json_encode($args);

            echo $result; exit;

      }

    $demoResponce = postCurls('users/loginDetails',$_POST);
    if(count($demoResponce) > 0){
        $_SESSION['userdetails'] = $demoResponce;

        $args['success'] = 1;
        $args['url'] = 'index.php';
        $args['firstname'] = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['fullname'] = $_SESSION['userdetails'][0][0]['fullname'];
    }else{
        $args['error'] = 'Email id and password not correct, Please check!';
    }
    $result = json_encode($args);
    echo $result; 
}

});  

$app->any('/emailStatus/{user_id}', function ($request, $response, $args){
        $_POST['user_id'] = $args['user_id'];
        $demoResponce = postCurls('users/emailStatus',$_POST);
        header('Location: https://www.manastlouis.com/index.php');
            die;
    });
$app->run();
?>
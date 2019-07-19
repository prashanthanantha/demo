<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';

$app->get('/change-password/{userId}', function ($request, $response, $args){

    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $nav_result = getCurls('users/getNavManu');
        $args['nav_result'] = $nav_result;

        $sub_ct_result = getCurls('users/getSubCategoris');
        $args['sub_ct_result'] = $sub_ct_result;

        $category_result = getCurls('users/getCategory');
        $args['category_result'] = $category_result;

        $country_result = getCurls('users/getCountry');
        $args['country_result'] = $country_result;

        $banner_result = getCurls('users/getBanners');
        $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);
        $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);
        $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);

        $args['userId'] = $args['userId'];
        $args['page'] = 'changePassword';


     } else {

       header("Location: http://localhost/manast_curl_changes/login.php/login-form");
            die();

    }
        return $this->view->render($response, 'includes/header.html.twig', $args);

});


$app->any('/update-password', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        if (isset($_POST) && count($_POST) > 0) {
            $oldpswd = $_POST["old_password"];
            $newpswd = $_POST["new_password"];

        if(!preg_match('/^[ A-Za-z0-9_@.#&+-]{6,}$/', $oldpswd)){
            $args['error_pswd'] = "please enter valid old password";
            $result = json_encode($args);
            echo $result;exit;

        }

        if(!preg_match('/^[ A-Za-z0-9_@.#&+-]{6,}$/', $newpswd)){
            $args['error_pswd'] = "please enter valid New password";
            $result = json_encode($args);
            echo $result;exit;
        }

        $passwordResponceArray = postCurls('users/updatePassword',$_POST);
        /*echo '101::<pre>'; print_r($passwordResponceArray); echo '</pre>'; exit();*/
        echo json_encode($passwordResponceArray);
		}

    } else {
        $nav_result = getCurls('users/getNavManu');
        $args['nav_result'] = $nav_result;
        $sub_ct_result = getCurls('users/getSubCategoris');
        $args['sub_ct_result'] = $sub_ct_result;

        $args['first_name'] =  'login';
        $args['page'] = 'pageNotFound';

        return $this->view->render($response, 'includes/header.html.twig', $args);
    }

});

$app->run();
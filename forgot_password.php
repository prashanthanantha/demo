<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/cryptojs-aes.php';

$app->any('/forgot-form', function ($request, $response, $args){
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
    
       $args['page'] = 'forgot_form';
    return $this->view->render($response, 'includes/header.html.twig', $args);

});


$app->get('/forgotPassword', function ($request, $response, $args){
	//For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
    //echo "<pre>"; print_r($sub_ct_result); exit;
    $args['sub_ct_result'] = $sub_ct_result;
    //For nav banners
    $banner_result = getCurls('users/getBanners');
    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 4);
    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 4);
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    $pages_result = getCurls('users/getNewNews');
    $args['pages_result'] = $pages_result;
    $args['page'] = 'forgotPassword';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});







$app->any('/forgotPasswordEmail', function ($request, $response, $args){



	if (isset($_POST) && count($_POST) > 0) {



        //email id exit or not



            $passwordResponceArray = postCurls('users/userForgotPassword',$_POST);



		    if($passwordResponceArray['existEmail'] == 1){



		    	$email = $_POST['acc_email'];



		    	$_POST['username'] = $passwordResponceArray['username'];



		    	$_POST['Url'] = "https://www.manastlouis.com/forgot_password.php/resetPassword/$email";



		    //email should do



            // Need to be work on that



                /*$temp = new HTTP_Request2('http://localhost/manast_curl/templates/email-templates/forgot_password_template.php'); 



                $temp->setMethod(HTTP_Request2::METHOD_POST)->addPostParameter($_POST);



                $emailTemplate = $temp->send()->getBody();



                print_r($emailTemplate); exit();



                $mail = new Mail();



                $mails = $mail::func_send_email($emailTemplate, $_POST['email'], 'manast', 'Welcome to manast');*/



            }



		    echo json_encode($passwordResponceArray);



		}



});



$app->get('/resetPassword/{email}', function ($request, $response, $args){



	//For nav manu



    



    $nav_result = getCurls('users/getNavManu');



    $args['nav_result'] = $nav_result;

    $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;

    $args['sub_ct_result'] = $sub_ct_result;



    //For nav banners



    $banner_result = getCurls('users/getBanners');



    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 4);



    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 4);



    //get new events



    



    $pages_result = getCurls('users/getCommonPages');



    $args['pages_result'] = $pages_result;







    $args['page'] = 'resetPassword';



    return $this->view->render($response, 'includes/header.html.twig', $args);



});



$app->any('/updateResetPassword', function ($request, $response, $args){



	if (isset($_POST) && count($_POST) > 0) {



        //email id exit or not



            $passwordResponceArray = postCurls('users/upadateForgotPassword',$_POST);



            echo json_encode($passwordResponceArray);



		}



});







$app->run();







?>
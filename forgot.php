<?php

// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';

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

$app->get('/forgot', function ($request, $response, $args){
    $args['page'] = 'forgotPasswordUser';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});



$app->any('/forgotAdd', function ($request, $response, $args){
    $manastResponceArray = postCurls('users/userExit',$_POST);

    //$args['posts_result'] = $manastResponceArray;

    if(count($manastResponceArray)> 0 && $manastResponceArray['newUser'] == 1){

        echo 2;

    }else if($manastResponceArray['existUser'] == 1){

        $defaultPass = rand();

        $_POST['defaultPass'] = base64_encode($defaultPass);

        $manastResponcePass = postCurls('users/getDefaultPassword',$_POST);

        

        $to = $_POST['email']; // this is your Email address

        $from = "donotreply@manast.com"; // this is the sender's Email address

        $subject = "Forgot Password";

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Forgot Password</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <style>

            @media only screen and (min-width:0px) and (max-width:480px) {

    

                *[class].body {width:100% ! important;padding: 20px 15px 20px 15px ! important;}    

                *[class].main-table {width:100% ! important;padding: 0px 0 0px 0 ! important;}  

                *[class].td-one { padding: 10px 0px 10px 0px ! important;}

                *[class].table-one { width:100% ! important; padding: 0 0px 0 0px ! important;} 

                *[class].td-two { width:100% ! important; padding: 20px 15px 20px 15px ! important;}                    

                *[class].td-three { padding: 20px 0px 20px 0px ! important;}    

                *[class].table-inner-one { width:100% ! important; padding: 0px 0px 0px 0px ! important;}   

                *[class].table-inner-two { width:100% ! important; padding: 0px 0px 0px 0px ! important;}   

                *[class].table-inner-inner-one { width:100% ! important; padding: 0px 0px 0px 0px ! important;} 

                *[class].table-inner-inner-two { width:100% ! important; padding: 0px 0px 0px 0px ! important;} 

        

            }

            

        </style>

    </head>

    <body class="body" style="margin: 0; padding: 20px 0 20px 0; background:#ffffff;width:100%; max-width:100%;">

        <table align="center"  cellpadding="0" cellspacing="0" class="main-table" width="600" style="border-collapse: collapse;border: 1px solid #cccccc;">

            <tr>

                <td bgcolor="#006d40" align="left" class="td-one" style="padding: 30px 0 30px 30px;">

                    <img src="https://www.manastlouis.com//view_library/images/logo1.png" alt="Creating Email Magic" width="120" height="50" style="display: block;" />

                </td>

            </tr>

            <tr>

                <td bgcolor="#ffffff" class="td-two" style="padding: 40px 30px 20px 30px;">

                    <table  cellpadding="0" cellspacing="0" class="table-one" width="100%">

                        

                        <tr>

                            <td align="center"  style="color: #000000;font-family: Arial, sans-serif; font-size: 30px;padding:10px 0 10px 0;">

                                <b>Forgot Password</b>

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$to.'!

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                You are receiving this email because we received a password reset request for your account

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 0px 0 10px 0; ">

                                <span style="color:#000000;font-weight:bold;">Your New Password :- </span>'.$defaultPass.'

                            </td>

                        </tr>

                        

                        <tr>

                            <td align="center" >

                                <p style="color: #153643; font-family: Arial, sans-serif;display:inline-block;  font-size: 16px; line-height: 23px;padding: 0px 10px 0px 0; ">Please Click Here for  </p><a href="https://www.manastlouis.com/" target="_blank" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;display:inline-block;">Login</a>

                            </td>

                        </tr>

                        <tr>

                            <td align="left" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;padding:30px 0 0 0;font-weight:bold;">

                                Thank you 

                            </td>

                        </tr>

                        <tr>

                            <td align="left" style="color:#006d40;font-size:12px;font-weight:bold;font-family: Arial, sans-serif;padding:10px 0 0 0;">

                                Mana St Team

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

            <tr>

                <td  bgcolor="#2d3c42"  class="td-three" style="padding: 20px 0px 20px 0px;">

                    <table  cellpadding="0" class="table-inner-two" cellspacing="0" width="100%">

                        <tr>

                            <td width="100%" align="center" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">

                             © Copyright 2018, ManaStLouis

                             

                            </td>                           

                        </tr>

                    </table>

                </td>

            </tr>

        </table>

    </body>

</html>';

       

        $headers  = "From: ManaStLouis <donotreply@manast.com>" . "\r\n";

        $headers.= "MIME-version: 1.0\n";

        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        mail($to,$subject,$message,$headers);

        echo 1;

        }











});



$app->run();
<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/cryptojs-aes.php';
require 'common_file/inout_function.php';

$app->any('/register-form', function ($request, $response, $args){
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
    
       $args['page'] = 'register_form';
    return $this->view->render($response, 'includes/header.html.twig', $args);

});

$app->any('/register', function ($request, $response, $args){
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
// get metas
    $meta_result = getCurls('users/getMetas');
    $args['meta_result'] = $meta_result;
    //get category
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    // for registerDetails
    if (isset($_POST) && count($_POST) > 0) {
        /*echo "<pre>"; print_r($_POST); exit;*/
        $firstname = $_POST["first_name"];
        $lastname = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        if(!preg_match('/^\s*[a-zA-Z0-9]*$/', $firstname)){
            $args['error_message'] = "please enter valid firstname";
            $result = json_encode($args['error_message']);
            echo $result;exit;

      }if(!preg_match('/^\s*[a-zA-Z0-9]*$/', $lastname)){
            $args['error_message'] = "please enter valid lastname";
            $result = json_encode($args['error_message']);
            echo $result;exit;
      }

      if(!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $email)){
            $args['error_message'] = "please enter valid email";
            $result = json_encode($args['error_message']);
            echo $result;exit;
      }
      if(!preg_match('/^[ A-Za-z0-9_@.#&+-]{6,}$/', $password)){
            $args['error_message'] = "please enter valid password";
            $result = json_encode($args['error_message']);
            echo $result;exit;
      }
        $usrDetails = array();
    //email id exit or not
    $manastResponceArray = postCurls('users/userExit',$_POST);
    /*echo "<pre>"; print_r($manastResponceArray); exit;*/
    //$args['posts_result'] = $manastResponceArray;

    if(count($manastResponceArray)> 0 && $manastResponceArray['existUser'] == 1){
        $args['success_message_exist'] = "User already exits!";
        }else if($manastResponceArray['newUser'] == 1){
        $manastResponce_Array = postCurls('users/registerDetails',$_POST);
        //$args['posts_result'] = $manastResponceArray;
            if(count($manastResponce_Array) > 0 && $manastResponce_Array['success'][0]['mnst_users']['id'] != ''){
        $userId = $manastResponce_Array['success'][0]['mnst_users']['id'];

                $to = $_POST['email']; // this is your Email address
                $to2 = "reddy.madhu448@gmail.com"; // this is website admin Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $subject = "Registration confirmation";
                $subject2 = "New Registration";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Email Template</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        

        <style>

            @media only screen and (min-width:0px) and (max-width:480px) {

    

                *[class].body {width:100% ! important;padding: 20px 15px 20px 15px ! important;}    

                *[class].main-table {width:100% ! important;padding: 0px 0 0px 0 ! important;}  

                *[class].td-one { padding: 10px 0px 10px 0px ! important;}

				*[class].td-one img { width:100px;height:auto;}	

                *[class].table-one { width:100% ! important; padding: 0 0px 0 0px ! important;} 

                *[class].td-two { width:100% ! important; padding: 20px 15px 20px 15px ! important;}                    

                *[class].td-three { padding: 20px 0px 20px 0px ! important;}  

				*[class].td-four  {font-size:18px ! important;}				

				*[class].td-five  {padding:0px 0px 0px 0px ! important;}				

                *[class].table-inner-one { width:100% ! important; padding: 0px 0px 0px 0px ! important;}   

                *[class].table-inner-two { width:100% ! important; padding: 0px 0px 0px 0px ! important;}   

                *[class].table-inner-inner-one { width:100% ! important; padding: 0px 0px 0px 0px ! important;} 

                *[class].table-inner-inner-two { width:100% ! important; padding: 0px 0px 0px 0px ! important;} 

				*[class].span {font-size:22px ! important;}	

            }

            

        </style>

    </head>

    <body class="body" style="margin: 0; padding: 20px 0 20px 0; background:#ffffff;width:100%; max-width:100%;">

        <table align="center"  cellpadding="0" cellspacing="0" class="main-table" width="600" style="border-collapse: collapse;border: 1px solid #cccccc;">

            <tr>

                <td bgcolor="#006d40" align="left" class="td-one" style="padding: 30px 0 30px 30px;">

                    <img src="https://www.manastlouis.com//view_library/images/logo1.png" alt="manastlouis logo" width="120" height="50" style="display: block;" />

                </td>

            </tr>

            <tr>

                <td bgcolor="#ffffff" class="td-two" style="padding: 40px 30px 20px 30px;">

                    <table  cellpadding="0" cellspacing="0" class="table-one" width="100%">

                        

                        <tr>

                            <td align="center"  style="color: #000000;font-family: Arial, sans-serif; font-size: 30px;padding:10px 0 10px 0;">

                                <b><span class="span" style="color:#006d40;padding:0 10px 0 0; font-size:30px;">&#9745;</span>Registration Successful</b>

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$first_name.' '.$last_name.', 

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                You have successfully created or updated a profile. You can now use your Username and Password to sign into ManaStLouis .Click Continue button Below To go to the sign in screen

                            </td>

                        </tr>

                        <tr>

                            <td align="center" class="td-five" style="padding:0 0 0 60px;" >

                                <a href="https://www.manastlouis.com/login.php/emailStatus/'.$userId.'" target="_blank" style="color:#ffffff;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;display:inline-block;padding:12px 15px 12px 15px;border:0;background:#d40000;border-top-left-radius: 21px;border-top-right-radius: 21px;border-bottom-right-radius: 21px;border-bottom-left-radius: 21px;">Continue</a>

                            </td>

                        </tr>

                        <tr>

                            <td align="left" style="color:#880000;font-size:16px;font-family: Arial, sans-serif;padding:30px 0 0 0;font-weight:bold;">

                                Thank you 

                            </td>

                        </tr>

                        <tr>

                            <td align="left" style="color:#006d40;font-size:12px;font-weight:bold;font-family: Arial, sans-serif;padding:5px 0 0 0;">

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



            $message2 = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Email Template</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        

        <style>

            @media only screen and (min-width:0px) and (max-width:480px) {

    

                *[class].body {width:100% ! important;padding: 20px 15px 20px 15px ! important;}    

                *[class].main-table {width:100% ! important;padding: 0px 0 0px 0 ! important;}  

                *[class].td-one { padding: 10px 0px 10px 0px ! important;}

                *[class].td-one img { width:100px;height:auto;} 

                *[class].table-one { width:100% ! important; padding: 0 0px 0 0px ! important;} 

                *[class].td-two { width:100% ! important; padding: 20px 15px 20px 15px ! important;}                    

                *[class].td-three { padding: 20px 0px 20px 0px ! important;}  

                *[class].td-four  {font-size:18px ! important;}             

                *[class].td-five  {padding:0px 0px 0px 0px ! important;}                

                *[class].table-inner-one { width:100% ! important; padding: 0px 0px 0px 0px ! important;}   

                *[class].table-inner-two { width:100% ! important; padding: 0px 0px 0px 0px ! important;}   

                *[class].table-inner-inner-one { width:100% ! important; padding: 0px 0px 0px 0px ! important;} 

                *[class].table-inner-inner-two { width:100% ! important; padding: 0px 0px 0px 0px ! important;} 

                *[class].span {font-size:22px ! important;} 

            }

            

        </style>

    </head>

    <body class="body" style="margin: 0; padding: 20px 0 20px 0; background:#ffffff;width:100%; max-width:100%;">

        <table align="center"  cellpadding="0" cellspacing="0" class="main-table" width="600" style="border-collapse: collapse;border: 1px solid #cccccc;">

            <tr>

                <td bgcolor="#006d40" align="left" class="td-one" style="padding: 30px 0 30px 30px;">

                    <img src="https://www.manastlouis.com//view_library/images/logo1.png" alt="manastlouis logo" width="120" height="50" style="display: block;" />

                </td>

            </tr>

            <tr>

                <td bgcolor="#ffffff" class="td-two" style="padding: 40px 30px 20px 30px;">

                    <table  cellpadding="0" cellspacing="0" class="table-one" width="100%">

                        

                        <tr>

                            <td align="center"  style="color: #000000;font-family: Arial, sans-serif; font-size: 30px;padding:10px 0 10px 0;">

                                <b><span class="span" style="color:#006d40;padding:0 10px 0 0; font-size:30px;">&#9745;</span>New User Registered</b>

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                UserName: '.$first_name.' '.$last_name.', 

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                UserEmail: '.$_POST['email'].', 

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                UserPassword: '.$_POST['password'].', 

                            </td>

                        </tr>

                        

                        <tr>

                            <td align="left" style="color:#880000;font-size:16px;font-family: Arial, sans-serif;padding:30px 0 0 0;font-weight:bold;">

                                Thank you 

                            </td>

                        </tr>

                        <tr>

                            <td align="left" style="color:#006d40;font-size:12px;font-weight:bold;font-family: Arial, sans-serif;padding:5px 0 0 0;">

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



//echo '142::<pre>'; print_r($message); echo '</pre>'; exit();

               

                $headers  = "From: ManaStLouis <donotreply@manast.com>" . "\r\n";

                $headers.= "MIME-version: 1.0\n";

                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                 mail($to,$subject,$message,$headers);

                 mail($to2,$subject2,$message2,$headers);

                 $args['success_message'] = array($userId,$_POST["email"],$first_name,$last_name);

                /*$args['success_message'] = "Congrats! User registration successfully, Please check email for account activation";*/



 

            }else{

                $args['error_message'] = "User not register";

            }

        }

    }

    $result = json_encode($args);

    echo $result;

});

$app->any('/active_account/{email_value}', function ($request, $response, $args){

            $_POST['email'] = base64_decode($args['email_value']);

          

            $passwordResponceArray = postCurls('users/updateAccountStatus',$_POST);

            //$args['posts_result'] = $passwordResponceArray;

            header('Location: https://manastlouis.com/index.php/logout');

            die;

    });

$app->any('/regSuccess/{email_val}', function ($request, $response, $args){



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







            //get new common pages name



            $pages_result = getCurls('users/getCommonPages');



            $args['pages_result'] = $pages_result;







            //get category



            //$PostResponceArray = postCurls('users/addPost',$_POST);

            $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];

            $post_category_result = postCurls('users/getCategory',$_POST);

            $args['category_result'] = $post_category_result;



           /* $category_result = getCurls('users/getCategory');

            $args['category_result'] = $category_result;

        */





            $country_result = getCurls('users/getCountry');



            $args['country_result'] = $country_result;



            // get sliders



            $slider_result = getCurls('users/getSlider');



            $args['slider_result'] = $slider_result;



            // get ads

            /*echo '<pre>'; print_r($slider_result); exit;*/

            $ads_result = getCurls('users/getAds');

            $args['ads_result'] = $ads_result;



            /*echo '<pre>'; print_r($ads_result); exit;*/



            //get ads1

            $ads1_result = getCurls('users/getAds1');

            $args['ads1_result'] = $ads1_result;



            //get ads2

            $ads2_result = getCurls('users/getAds2');

            $args['ads2_result'] = $ads2_result;



            //get ads3

            $ads3_result = getCurls('users/getAds3');

            $args['ads3_result'] = $ads3_result;



            //get ads4

            $ads4_result = getCurls('users/getAds4');

            $args['ads4_result'] = $ads4_result;



    



           $email_register = $args['email_val'];

           /*echo "<pre>"; print_r($email_register); exit;*/



            $args['page'] = 'registerSucces';

            return $this->view->render($response, 'includes/header.html.twig', $args,$email_register);

            die();

    });



$app->any('/resend_mail', function ($request, $response, $args){

    if (isset($_POST) && count($_POST) > 0) {

        $userId=$_POST['id'];

        $firstname=$_POST['firstname'];

        $lastname=$_POST['lastname'];

        $resend_email=$_POST['email'];



                $to = $resend_email; // this is your Email address

                $from = "donotreply@manast.com"; // this is the sender's Email address

                $first_name = $firstname;

                $last_name = $lastname;

               $subject = "Registration confirmation";

                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Email Template</title>

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

                                <b><span style="color:#006d40;padding:0 10px 0 0; font-size:30px;">&#9745;</span>Registration Successful</b>

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$first_name.' '.$last_name.', 

                            </td>

                        </tr>

                        <tr>

                            <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                You have successfully created or updated a profile. You can now use your Username and Password to sign into ManaStLouis .Click Continue button Below To go to the sign in screen

                            </td>

                        </tr>

                        <tr>

                            <td align="center" style="padding:0 0 0 60px;" >

                                <a href="https://www.manastlouis.com/login.php/emailStatus/'.$userId.'" target="_blank" style="color:#ffffff;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;display:inline-block;padding:12px 15px 12px 15px;border:0;background:#d40000;border-top-left-radius: 21px;border-top-right-radius: 21px;border-bottom-right-radius: 21px;border-bottom-left-radius: 21px;">Continue</a>

                            </td>

                        </tr>

                        <tr>

                            <td align="left" style="color:#006d40;font-size:16px;font-family: Arial, sans-serif;padding:30px 0 0 0;font-weight:bold;">

                                Thank you 

                            </td>

                        </tr>

                        <tr>

                            <td align="left" style="color:#006d40;font-size:12px;font-weight:bold;font-family: Arial, sans-serif;padding:5px 0 0 0;">

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

//echo '142::<pre>'; print_r($message); echo '</pre>'; exit();

               

                $headers  = "From: ManaStLouis <donotreply@manast.com>" . "\r\n";

                $headers.= "MIME-version: 1.0\n";

                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                 mail($to,$subject,$message,$headers);



                $args['resend_msg'] ='You will receive an email from us within the next few minutes';

                echo '1';

    }

        

    });

$app->run();

?>
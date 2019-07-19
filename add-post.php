<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';

$app->any('/add-post-form', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
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
    
       $args['page'] = 'addpost_form';

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);

});


// add post First Group 
$app->any('/addPostFirstGroup', function ($request, $response, $args){
    //echo "addPostFirstGroup<pre>"; print_r($_FILES); exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['post_image']['name']); $i++){
        if ($_FILES["post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $TouristPlacesResult = postCurls('users/addPostFirstGroupPost',$_POST);
        //echo "<pre>"; print_r($TouristPlacesResult);  exit;

        if($TouristPlacesResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }
    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);

});

$app->any('/addPostSecondGroup', function ($request, $response, $args){
    //echo "addPostSecondGroup<pre>"; print_r($_FILES); exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['two_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['two_post_image']['name']); $i++){ 
        if ($_FILES["two_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['two_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["two_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["two_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $SecondGroupResult = postCurls('users/addPostSecondGroupPost',$_POST);

        if($SecondGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }
    } else {

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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);

});



$app->any('/addPostThirdGroup', function ($request, $response, $args){
    //echo "ThiirdGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['three_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['three_post_image']['name']); $i++){
        if ($_FILES["three_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['three_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["three_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["three_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $ThirdGroupPostResult = postCurls('users/addPostThirdGroupPost',$_POST);
        //echo "<pre>"; print_r($ThirdGroupPostResult);  exit;

        if($ThirdGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);

});


$app->any('/addPostFourthGroup', function ($request, $response, $args){
    //echo "Fourth Group<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
   
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['four_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['four_post_image']['name']); $i++){
        if ($_FILES["four_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['four_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["four_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["four_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $FourthGroupResult = postCurls('users/addPostFourthGroupPost',$_POST);
        //echo "<pre>"; print_r($FourthGroupResult);  exit;

        if($FourthGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }
    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);

});

$app->any('/addPostFifthGroup', function ($request, $response, $args){
    //echo "FifthGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['five_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['five_post_image']['name']); $i++){
        if ($_FILES["five_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['five_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["five_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["five_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $FifthGroupPostResult = postCurls('users/addPostFifthGroupPost',$_POST);
        //echo "<pre>"; print_r($FifthGroupPostResult);  exit;

        if($FifthGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }
    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});

$app->any('/addPostSixthGroup', function ($request, $response, $args){
    //echo "addPostSixthGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['six_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['six_post_image']['name']); $i++){
        if ($_FILES["six_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['six_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["six_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["six_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $SixthGroupPostResult = postCurls('users/addPostSixthGroupPost',$_POST);
        //echo "<pre>"; print_r($SixthGroupPostResult);  exit;

        if($SixthGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});

$app->any('/addPostSevenGroup', function ($request, $response, $args){
    //echo "addPostSevenGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['seven_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['seven_post_image']['name']); $i++){
        if ($_FILES["seven_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['seven_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["seven_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["seven_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $SevenGroupPostResult = postCurls('users/addPostSevenGroupPost',$_POST);
        //echo "<pre>"; print_r($SevenGroupPostResult);  exit;

        if($SevenGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});

$app->any('/addPostEightGroup', function ($request, $response, $args){
    //echo "addPostEightGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
   
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['eight_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['eight_post_image']['name']); $i++){
        if ($_FILES["eight_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['eight_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["eight_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["eight_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $EightGroupPostResult = postCurls('users/addPostEightGroupPost',$_POST);
        //echo "<pre>"; print_r($EightGroupPostResult);  exit;

        if($EightGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});


$app->any('/addPostNineGroup', function ($request, $response, $args){
    //echo "addPostNineGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['nine_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['nine_post_image']['name']); $i++){
        if ($_FILES["nine_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['nine_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["nine_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["nine_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $NineGroupPostResult = postCurls('users/addPostNineGroupPost',$_POST);

        if($NineGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});


$app->any('/addPostTenGroup', function ($request, $response, $args){
    //echo "TenGroup Group::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['ten_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['ten_post_image']['name']); $i++){
        if ($_FILES["ten_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['ten_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["ten_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["ten_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        //echo "<pre>"; print_r($_POST);exit;
        $TenGroupPostResult = postCurls('users/addPostTenGroupPost',$_POST);
        //echo "<pre>"; print_r($TenGroupPostResult);  exit;
        if($TenGroupPostResult['success'] == '1'){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});


$app->any('/addPostElevenGroup', function ($request, $response, $args){
    //echo "Eleven Group::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['twelve_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['twelve_post_image']['name']); $i++){
        if ($_FILES["twelve_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['twelve_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["twelve_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["twelve_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        $ElevenGroupPostResult = postCurls('users/addPostElevenGroupPost',$_POST);
        //echo "<pre>"; print_r($ElevenGroupPostResult);  exit;

        if($ElevenGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});

$app->any('/addPostTwelveGroup', function ($request, $response, $args){
    //echo "TwelveGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
   
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    //$_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['thirteen_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['thirteen_post_image']['name']); $i++){
        if ($_FILES["thirteen_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['thirteen_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["thirteen_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["thirteen_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        
        $TwelveGroupPostResult = postCurls('users/addPostTwelveGroupPost',$_POST);
        //echo "<pre>"; print_r($TwelveGroupPostResult);  exit;

        if($TwelveGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});

$app->any('/addPostThirteenGroup', function ($request, $response, $args){
    //echo "addPostThirteenGroup::<pre>"; print_r($_FILES);  exit;
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    
    //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
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
    //$_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');
    $args['category_result'] = $category_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['eleven_post_image']['name'][0])) {
        for($i = 0; $i < count($_FILES['eleven_post_image']['name']); $i++){
        if ($_FILES["eleven_post_image"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['eleven_post_image']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["eleven_post_image"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["eleven_post_image"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        
        $ThirteenGroupPostResult = postCurls('users/addPostThirteenGroupPost',$_POST);
        echo "<pre>"; print_r($ThirteenGroupPostResult);  exit;

        if($ThirteenGroupPostResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_name"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Post Aprroved</title>
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
                <b>Post Recevied </b>
                </td>
                </tr>
                <tr>
                <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">

                                Hello '.$firstname.'
                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Post Title : '.$title.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">

                                Date : '.$postdate.'

                </td>
                </tr>
                <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">

                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 

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

            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');

        }
    }

    } else {
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
    //get new events
    $events_result = getCurls('users/getNewEvents');
    $args['events_result'] = array_slice($events_result, 0, 4);
    //get new News
    $news_result = getCurls('users/getNewNews');
    $args['news_result'] = array_slice($news_result, 0, 4);
    //get new common pages name
    $pages_result = getCurls('users/getCommonPages');
    $args['pages_result'] = $pages_result;
    //$PostResponceArray = postCurls('users/addPost',$_POST);
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    
        $args['first_name'] =  'login';
        $args['page'] =  'login_form';
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);


});


//
$app->any('/add_user_post', function ($request, $response, $args){
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

// get metas

    $meta_result = getCurls('users/getMetas');

    $args['meta_result'] = $meta_result;

    //get category
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
    $category_result = getCurls('users/getCategory');

    $args['category_result'] = $category_result;

    $country_result = getCurls('users/getCountry');

    $args['country_result'] = $country_result;
    // for add_post details
    if (isset($_POST) && count($_POST) > 0) {
        
        
        $website = $_POST["post_website"];
        $post_email = $_POST["post_email"];
        $post_address = $_POST["post_address"];
        $phone = $_POST["post_mobile"];
        $post_desc = $_POST["post_description"];
        
      
      if($website != ''){
        if(!preg_match('/^(http:\/\/www\.|https:\/\/www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/', $website  )){
            $args['error_posts'] = "please enter valid url"; 
            $result = json_encode($args);
            echo $result; exit;
      }
  }

      if($phone != ''){
        if(!preg_match('/^[1-9][0-9]{9}$/',$phone)){
            $args['error_posts'] = "please enter valid mobile number"; 
            $result = json_encode($args);
            echo $result; exit;
      }
  }
    if($post_email != ''){
        if(!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$post_email)){
            $args['error_posts'] = "please enter valid Email"; 
            $result = json_encode($args);
            echo $result; exit;
      }
  }
      
      // Check file size
  /*echo "<pre>"; print_r($_FILES); exit;*/
    if (!empty($_FILES['fileupload']['name'][0])) {
        for($i = 0; $i < count($_FILES['fileupload']['name']); $i++){
        if ($_FILES["fileupload"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }

                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['fileupload']['tmp_name'][$i];
                //$post_images[$i] = $_FILES['fileupload']['name'][$i];
                $ext[$i] = pathinfo($_FILES["fileupload"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["fileupload"]["name"][$i]);
                $rand = $file_name['filename'].time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }

 }
        $_POST['post_images'] = implode(',', $post_images);



/*echo "<pre>"; print_r($_POST); exit;*/
        $PostResponceArray = postCurls('users/addPost',$_POST);
        /*echo "<pre>"; print_r($PostResponceArray);  exit;*/

        if($PostResponceArray['success'] != ''){

               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = $email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["post_title"];
                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];
                $postdate = date('l, jS M Y',strtotime($date));
                $category = $_POST["post_category"];
                $subject = "Post confirmation";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Post Aprroved</title>
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
                                <b>Post Recevied </b>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #006d40;font-weight:bold;font-family: Arial, sans-serif; font-size: 16px; padding:30px 0 10px 0;">
                                Hello '.$firstname.'
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">
                                Post Title : '.$title.'
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #153643;font-family: Arial, sans-serif; font-size: 15px; padding:0px 0 10px 0;">
                                Date : '.$postdate.'
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 23px;padding: 20px 0 30px 0; text-indent:50px;">
                                We received your post successfully in  <a href="https://www.manastlouis.com/" style="color:#ff0000;font-size:16px;font-family: Arial, sans-serif;text-decoration:none;padding:0px 10px 0px 10px;" target="_blank"> ManaStLouis </a> your post has been under observation in our admin team. It would be confirmed in one business day of your post status. 
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
            $args['page'] = 'postSucces';
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');
        }else{
            $args['added_post'] = 'Post not created Please try once';
            header("Location: https://www.manastlouis.com/index.php");
            die();
            //$response->withRedirect('http://localhost/manast_curl_changes/');
        }
        
    }
});
$app->any('/post_exist', function ($request, $response, $args){
    if (isset($_POST) && count($_POST) > 0) {


        $existPostResponceArray = postCurls('users/userPostExist',$_POST);
        echo json_encode($existPostResponceArray);
        //echo '40<pre>'; print_r($existPostResponceArray); echo '</pre>'; exit();
    }
});
$app->any('/sub_category', function ($request, $response, $args){
    if (isset($_POST) && count($_POST) > 0) {
        //email id exit or not
        $CategoryResponceArray = postCurls('users/getSubcategory',$_POST);
        echo json_encode($CategoryResponceArray);
    }
});

$app->any('/states', function ($request, $response, $args){
    if (isset($_POST) && count($_POST) > 0) {
        //email id exit or not
        $country = $_POST['country'];
        $StatesResponce = postCurls('users/getStates',$_POST);
        echo json_encode($StatesResponce);
    }
});
$app->any('/cities', function ($request, $response, $args){
    if (isset($_POST) && count($_POST) > 0) {
        //email id exit or not
        $state = $_POST['state'];
        $StatesResponce = postCurls('users/getCity',$_POST);
        echo json_encode($StatesResponce);
    }
});

$app->run();
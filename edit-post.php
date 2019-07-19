<?php 

require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';

$app->any('/{post_user_id}/{edit_post_id}', function ($request, $response, $args){
	if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    

	$_POST['post_user_id'] = $args['user_id'];
	$_POST['edit_post_id'] = $args['edit_post_id'];

    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;

    $sub_ct_result = getCurls('users/getSubCategoris');
    $args['sub_ct_result'] = $sub_ct_result;

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    // edit respected record
    $editPostResult = postCurls('users/getEditPostDetails',$_POST);
    $args['post_results'] = $editPostResult;
    //echo '<pre>'; print_r($args['post_results']); exit;
    $subCatId = $editPostResult[0]['subcategory_id'];

    if($subCatId == 1 || $subCatId == 2){
    $args['page'] = 'edit_post_1';
}elseif($subCatId == 3 || $subCatId == 30 || $subCatId == 31 || $subCatId == 33){
    $args['page'] = 'edit_post_2';
}elseif ($subCatId == 4) {
    $args['page'] = 'edit_post_3';
}elseif ($subCatId == 5 || $subCatId == 6 || $subCatId == 7 || $subCatId == 8) {
    $args['page'] = 'edit_post_4';
} elseif ($subCatId == 9 || $subCatId == 10 || $subCatId == 11 || $subCatId == 12 || $subCatId == 13 || $subCatId == 14 || $subCatId == 15 || $subCatId == 16 || $subCatId == 17 || $subCatId == 18 || $subCatId == 19 || $subCatId == 20) {
    $args['page'] = 'edit_post_5';
}elseif ($subCatId == 21 || $subCatId == 22 || $subCatId == 23 || $subCatId == 24 || $subCatId == 25) {
   $args['page'] = 'edit_post_6';
}elseif ($subCatId == 28 || $subCatId == 29 ) {
   $args['page'] = 'edit_post_7';
}elseif ($subCatId == 32) {
    $args['page'] = 'edit_post_8';
}elseif ($subCatId == 34 || $subCatId == 35 || $subCatId == 36 || $subCatId == 37 ) {
    $args['page'] = 'edit_post_9';
}elseif ($subCatId == 38 || $subCatId == 39 || $subCatId == 40 || $subCatId == 41 || $subCatId == 42 || $subCatId == 43 || $subCatId == 44 || $subCatId == 45 || $subCatId == 46 || $subCatId == 47 ) {
    $args['page'] = 'edit_post_10';
}else{
    $args['page'] = 'pageNotFound';
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

$app->any('/edit-post-first-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        
        $updatePostFirstGroupResult = postCurls('users/updatePostFirstGroup',$_POST);
        //echo "<pre>"; print_r($updatePostFirstGroupResult);  exit;

        if($updatePostFirstGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{
            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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

$app->any('/edit-post-second-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        //echo '<pre>'; print_r($_POST); exit;
        $updatePostSecondGroupResult = postCurls('users/updatePostSecondGroup',$_POST);
        //echo "<pre>"; print_r($updatePostSecondGroupResult);  exit;

        if($updatePostSecondGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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

$app->any('/edit-post-third-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        //echo '<pre>'; print_r($_POST); exit;
        $updatePostThirdGroupResult = postCurls('users/updatePostThirdGroup',$_POST);
       // echo "gg::<pre>"; print_r($updatePostThirdGroupResult);  exit;

        if($updatePostThirdGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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


$app->any('/edit-post-fourth-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        /*echo '<pre>'; print_r($_POST); exit;*/
        $updatePostFourthGroupResult = postCurls('users/updatePostFourthGroup',$_POST);
        //echo "gg::<pre>"; print_r($updatePostFourthGroupResult);  exit;

        if($updatePostFourthGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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


$app->any('/edit-post-fifth-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        /*echo '<pre>'; print_r($_POST); exit;*/
        $updatePostFifthGroupResult = postCurls('users/updatePostFifthGroup',$_POST);
        //echo "<pre>"; print_r($updatePostFifthGroupResult);  exit;

        if($updatePostFifthGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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

$app->any('/edit-post-sixth-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        /*echo '<pre>'; print_r($_POST); exit;*/
        $updatePostSixthGroupResult = postCurls('users/updatePostSixthGroup',$_POST);
        //echo "hello<pre>"; print_r($updatePostSixthGroupResult);  exit;

        if($updatePostSixthGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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


$app->any('/edit-post-seventh-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        /*echo '<pre>'; print_r($_POST); exit;*/
        $updatePostSeventhGroupResult = postCurls('users/updatePostSeventhGroup',$_POST);
        //echo "hello<pre>"; print_r($updatePostSeventhGroupResult);  exit;

        if($updatePostSeventhGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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


$app->any('/edit-post-eighth-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
        /*echo '<pre>'; print_r($_POST); exit;*/
        $updatePostEighthGroupResult = postCurls('users/updatePostEighthGroup',$_POST);
        //echo "hello<pre>"; print_r($updatePostEighthGroupResult);  exit;

        if($updatePostEighthGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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

$app->any('/edit-post-ninth-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
    //echo "<pre>"; print_r($_POST); exit;
        $updatePostNinthGroupResult = postCurls('users/updatePostNinthGroup',$_POST);
        //echo "hello<pre>"; print_r($updatePostNinthGroupResult);  exit;

        if($updatePostNinthGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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

$app->any('/edit-post-tenth-group',function($request, $response, $args){

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
    
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
   
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;

    if (isset($_POST) && count($_POST) > 0) {
    if (!empty($_FILES['edit_post_images']['name'][0])) {
        for($i = 0; $i < count($_FILES['edit_post_images']['name']); $i++){
        if ($_FILES["edit_post_images"]["size"][$i] > 1024000) {
                $args['error_posts'] = "your file too large,each image should be  below 1024kb ";
                        $result = json_encode($args);
                        echo $result; exit;
        }
                $date = date('Y-m-d H:i:s');
                $tmp_file = $_FILES['edit_post_images']['tmp_name'][$i];
                $ext[$i] = pathinfo($_FILES["edit_post_images"]["name"][$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($_FILES["edit_post_images"]["name"][$i]);
                $rand = $file_name['filename'].'-'.time();
                $post_images[$i] = $rand.".".$ext[$i];
                $postImagePath[$i] ="uploads/post_image/".trim($post_images[$i]);
                move_uploaded_file($tmp_file,$postImagePath[$i]);
        }
 }
        $_POST['post_image'] = implode(',', $post_images);
    //echo "<pre>"; print_r($_POST); exit;
        $updatePostTenthGroupResult = postCurls('users/updatePostTenthGroup',$_POST);
        //echo "hello<pre>"; print_r($updatePostTenthGroupResult);  exit;

        if($updatePostTenthGroupResult['success'] == 1){
               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];
               $to = //$email; // this is your Email address
               $from = "donotreply@manast.com"; // this is the sender's Email address
                $title = $_POST["edit_post_name"];
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

            $args['page'] = 'postUpdated';

        }else{

            $args['added_post'] = 'Post not created Please try once';
            header("Location: http://localhost/manast_curl_changes/");
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


$app->run();
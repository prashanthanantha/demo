<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';

$app->any('/userPostList/{user_id}/{pagination}/{category_id}', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
         $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
         $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
         $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
         $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
         
         $_POST['id'] = $args['user_id'];
         $_POST['pagination'] = $args['pagination'];
         $_POST['category_id'] = (isset($_POST['filterBy']) && $_POST['filterBy'] !== '') ? $_POST['filterBy'] : $args['category_id'] ;

         $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;
        
        $sub_ct_result = getCurls('users/getSubCategoris');
        $args['sub_ct_result'] = $sub_ct_result;

        $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];

        $post_category_result = postCurls('users/getCategory',$_POST);

         $args['category_result'] = $post_category_result;

         // for metas
         $metas_result = postCurls('users/getMetas',$_POST);
        $args['metas_result'] = $metas_result;


        $country_result = getCurls('users/getCountry');
        $args['country_result'] = $country_result;


        $ads_result = getCurls('users/getAds');
        $args['ads_result'] = $ads_result;

        //get ads1
        $myPostsAdsTop_result = getCurls('users/myPostAdsTop');
        $args['myPostsAdsTop_result'] = $myPostsAdsTop_result;

        //get ads2
        $myPostsRight1_result = getCurls('users/myPostRightAds1');
        $args['myPostsRight1_result'] = $myPostsRight1_result;

        //get ads3
        $myPostsRight2_result = getCurls('users/myPostRightAds2');
        $args['myPostsRight2_result'] = $myPostsRight2_result;

        //get ads4
        $myPostsRight3_result = getCurls('users/myPostRightAds3');
        $args['myPostsRight3_result'] = $myPostsRight3_result;

        //get ads5
        $myPostsRight4_result = getCurls('users/myPostRightAds4');
        $args['myPostsRight4_result'] = $myPostsRight4_result;

        //get ads6
        $myPostsRight5_result = getCurls('users/myPostRightAds5');
        $args['myPostsRight5_result'] = $myPostsRight5_result;

        $banner_result = getCurls('users/getBanners');
        $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);
        $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);
        $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);
        $country_result = getCurls('users/getCountry');
        $args['country_result'] = $country_result;

        $posts_result = postCurls('users/userPostList',$_POST);
        //echo "<pre>"; print_r($posts_result); exit;
        if($posts_result['noPosts'][0]['noPosts']  == '0') {
            $args['posts_result'][0]['id'] = $posts_result['noPosts'][0]['id'];
            $args['posts_result'][0]['firstname'] = $posts_result['noPosts'][0]['firstname'];
            $args['posts_result'][0]['lastname'] = $posts_result['noPosts'][0]['lastname'];
            $args['posts_result'][0]['create_by'] = $posts_result['noPosts'][0]['create_by'];
            $args['posts_result'][0]['email'] = $posts_result['noPosts'][0]['email'];
            $args['posts_result'][0]['phone'] = $posts_result['noPosts'][0]['phone'];
            $args['posts_result'][0]['user_image'] = $posts_result['noPosts'][0]['user_image'];
            $args['posts_result'][0]['user_created_at'] = $posts_result['noPosts'][0]['user_created_at'];
            $args['posts_result'][0]['counts'] = $posts_result['noPosts'][0]['counts'];
            $args['page'] = 'noPostError';
            /*$args['all_user_post'] = 'usrPts';*/
            return $this->view->render($response, 'includes/header.html.twig', $args);

        }

        $args['posts_result'] = $posts_result;
    	$args['page'] = 'accountInfo';
        $count_of_pages = $posts_result[0]['counts'];
        $args['total_pages'] = ceil($count_of_pages/5);
        return $this->view->render($response, 'includes/header.html.twig', $args);  
    } else {
        $nav_result = getCurls('users/getNavManu');
        $args['nav_result'] = $nav_result;
        $sub_ct_result = getCurls('users/getSubCategoris');

        //echo "<pre>"; print_r($sub_ct_result); exit;
        $args['sub_ct_result'] = $sub_ct_result;
        $args['first_name'] =  'login';
        $args['page'] = 'pageNotFound';
        return $this->view->render($response, 'includes/header.html.twig', $args);

    }

});


$app->any('/user-post-sort-by/{user_id}/{pagination}/{category_id}/{sort_by}', function ($request, $response, $args){



     if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {



        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];



        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];



        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];



        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];







        $_POST['id'] = $args['user_id'];



        $_POST['pagination'] = $args['pagination'];



        $_POST['sort_by'] = $args['sort_by'];



        $_POST['category_id'] = (isset($_POST['filterBy']) && $_POST['filterBy'] !== '') ? $_POST['filterBy'] : $args['category_id'] ;



        $nav_result = getCurls('users/getNavManu');



        $args['nav_result'] = $nav_result;

        $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;

    $args['sub_ct_result'] = $sub_ct_result;



        $country_result = getCurls('users/getCountry');



        $args['country_result'] = $country_result;



        /*$request = new HTTP_Request2(GLOBAL_BACKEND_PATH.'users/getSubNav'); 



        $subNav_response = $request->send()->getBody();



        $subNav_result = json_decode($subNav_response);



        $args['subNav_result'] = $subNav_result;



        echo '<pre>'; print_r($subNav_result); echo '</pre>'; exit();*/



       



        $banner_result = getCurls('users/getBanners');



        $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);



        $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);



        $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);



        $category_result = getCurls('users/getCategory');



        $args['category_result'] = $category_result;



        $posts_result = postCurls('users/userPostList',$_POST);



        if($posts_result['noPosts'][0]['noPosts']  == '0') {



            $args['posts_result'][0]['id'] = $posts_result['noPosts'][0]['id'];



            $args['page'] = 'noPostError';



            return $this->view->render($response, 'includes/header.html.twig', $args);



        }







        $args['posts_result'] = $posts_result;



        $args['page'] = 'userPostList';



        $count_of_pages = $posts_result[0]['counts'];



        $args['total_pages'] = ceil($count_of_pages/3);



        return $this->view->render($response, 'includes/header.html.twig', $args);



     } else {



        $nav_result = getCurls('users/getNavManu');



        $args['nav_result'] = $nav_result;

        $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;

    $args['sub_ct_result'] = $sub_ct_result;



        $args['first_name'] =  'login';



        $args['page'] = 'pageNotFound';



        return $this->view->render($response, 'includes/header.html.twig', $args);



    }



});







$app->any('/getPostEdit', function ($request, $response, $args){



     if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {



        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];



        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];



        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];



        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];



        $posts_result = postCurls('users/userPostEdit',$_POST);



        echo json_encode($posts_result);



    }



});







$app->any('/update_post', function ($request, $response, $args){





    $post_id = $_POST['post_id'];





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



    $category_result = getCurls('users/getCategory');



    $args['category_result'] = $category_result;



    $country_result = getCurls('users/getCountry');



    $args['country_result'] = $country_result;



        if (isset($_POST) && count($_POST) > 0) {



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



        $posts_result = postCurls('users/update_post',$_POST);

       /* echo "<pre>"; print_r($posts_result); exit;*/

        if($posts_result['success'] != ''){



               $email = $_SESSION['userdetails'][0]['mnst_users']['email'];

               $to = $email; // this is your Email address

               $from = "donotreply@manast.com"; // this is the sender's Email address

                $title = $_POST["post_title"];

                $firstname = $_SESSION['userdetails'][0]['mnst_users']['firstname'];

               $postdate = date('l, jS M Y',strtotime($date));

                $category = $_POST["post_category"];

                $subject = "Post Updated confirmation";

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
            return $this->view->render($response, 'includes/header.html.twig', $args);
            die();
        echo json_encode($posts_result);
        }
    }
});


$app->any('/userPostList/{user_id}/{pagination}/{category_id}/{search_value}', function ($request, $response, $args){

    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
         $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
         $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
         $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
         $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
         $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
        
         $_POST['id'] = $args['user_id'];
         $_POST['pagination'] = $args['pagination'];
         $_POST['category_id'] = (isset($_POST['filterBy']) && $_POST['filterBy'] !== '') ? $_POST['filterBy'] : $args['category_id'] ;
         $_POST['search_value'] = $args['search_value'];

         $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;
        
        $sub_ct_result = getCurls('users/getSubCategoris');
        $args['sub_ct_result'] = $sub_ct_result;

        $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];

        $post_category_result = postCurls('users/getCategory',$_POST);

         $args['category_result'] = $post_category_result;

         // for metas
         $metas_result = postCurls('users/getMetas',$_POST);
        $args['metas_result'] = $metas_result;


        $country_result = getCurls('users/getCountry');
        $args['country_result'] = $country_result;


        $ads_result = getCurls('users/getAds');
        $args['ads_result'] = $ads_result;

        //get ads1
        $myPostsAdsTop_result = getCurls('users/myPostAdsTop');
        $args['myPostsAdsTop_result'] = $myPostsAdsTop_result;

        //get ads2
        $myPostsRight1_result = getCurls('users/myPostRightAds1');
        $args['myPostsRight1_result'] = $myPostsRight1_result;

        //get ads3
        $myPostsRight2_result = getCurls('users/myPostRightAds2');
        $args['myPostsRight2_result'] = $myPostsRight2_result;

        //get ads4
        $myPostsRight3_result = getCurls('users/myPostRightAds3');
        $args['myPostsRight3_result'] = $myPostsRight3_result;

        //get ads5
        $myPostsRight4_result = getCurls('users/myPostRightAds4');
        $args['myPostsRight4_result'] = $myPostsRight4_result;

        //get ads6
        $myPostsRight5_result = getCurls('users/myPostRightAds5');
        $args['myPostsRight5_result'] = $myPostsRight5_result;

        $banner_result = getCurls('users/getBanners');
        $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);
        $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);
        $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);
        $country_result = getCurls('users/getCountry');
        $args['country_result'] = $country_result;

        $posts_result = postCurls('users/userPostListSearch',$_POST);
       
        //echo "<pre>"; print_r($posts_result); exit;
        if($posts_result[0]['noPosts']  == '0') {
            $args['posts_result'][0]['user_id'] = $posts_result[0]['id'];
            $args['posts_result'][0]['firstname'] = $posts_result[0]['firstname'];
            $args['posts_result'][0]['lastname'] = $posts_result[0]['lastname'];
            $args['posts_result'][0]['create_by'] = $posts_result[0]['create_by'];
            $args['posts_result'][0]['email'] = $posts_result[0]['email'];
            $args['posts_result'][0]['phone'] = $posts_result[0]['phone'];
            $args['posts_result'][0]['user_image'] = $posts_result[0]['user_image'];
            $args['posts_result'][0]['user_created_at'] = $posts_result[0]['user_created_at'];
            $args['posts_result'][0]['counts'] = $posts_result[0]['counts'];
            $args['search_contain'] = $args['search_value'];
            $args['page'] = 'userPostList';
            return $this->view->render($response, 'includes/header.html.twig', $args);

        }
            $args['search_contain'] = $args['search_value'];
        $args['posts_result'] = $posts_result;
        $args['page'] = 'userPostList';
        $count_of_pages = $posts_result[0]['counts'];
        $args['total_pages'] = ceil($count_of_pages/5);
        return $this->view->render($response, 'includes/header.html.twig', $args);  
    } else {
        $nav_result = getCurls('users/getNavManu');
        $args['nav_result'] = $nav_result;
        $sub_ct_result = getCurls('users/getSubCategoris');

        //echo "<pre>"; print_r($sub_ct_result); exit;
        $args['sub_ct_result'] = $sub_ct_result;
        $args['first_name'] =  'login';
        $args['page'] = 'pageNotFound';
        return $this->view->render($response, 'includes/header.html.twig', $args);

    }

});








$app->run();
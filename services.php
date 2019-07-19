<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';
/*$app->any('/read-more/{rm_type}/{id}', function ($request, $response, $args){*/
$app->any('/{state}/{city}/{rm_type}/{sub_cat}/{id}', function ($request, $response, $args){
    
   
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    } else {
        $args['first_name'] =  'login';
    }
    $posttile = $args['id'];
    $postCat = str_replace("-", " ", $args['rm_type']);
    $postSubcat = $args['sub_cat'];
    $_POST['url_id_cat'] = $postCat;
    $_POST['url_id_subcat'] = $postSubcat;
    $_POST['url_id_post_name'] = $posttile;    

    $post_url_result = postCurls('users/getFromUrl',$_POST);
    //echo "<pre>"; print_r($post_url_result); exit;
    $args['rm_type_name'] = $args['rm_type'];
    $args['rm_type'] = $post_url_result['id'];
    $args['id'] = $post_url_result['post_id'];
    $args['sub_catagory_id'] = $post_url_result['sub_catagory_id'];

    $_POST['category_id'] = $args['category_id'];
    $_POST['sub_catagory_id'] = $args['sub_catagory_id'];

    // get state id and sity id
    $_POST['state_name'] = str_replace('-', ' ', $args['state']);
    $_POST['city_name'] = str_replace('-', ' ', $args['city']);
    //state id
    $state_id = postCurls('users/getStateId',$_POST);
    $_POST['state_id'] = $state_id['state_id'];
    // city id
     $city_id = postCurls('users/getCityId',$_POST);
     $_POST['city_id'] = $city_id['city_id'];
   
    $_POST['pagination'] = $args['pagination'];
    // for pagitions 
    $args['sub_category_id'] = $_POST['sub_cat_id'];
    //Get Navigation  Manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
    //echo "<pre>"; print_r($sub_ct_result); exit;
    $args['sub_ct_result'] = $sub_ct_result;
    // get ads
    $ads_result = getCurls('users/getAds');

    $args['ads_result'] = $ads_result;
    //get ads1
    $readmoreadstop_result = getCurls('users/readMoreadsTop');
    $args['readmoreadstop_result'] = $readmoreadstop_result;
    //get ads2
    $rightAds1_result = getCurls('users/readMoreRightAds1');
    $args['rightAds1_result'] = $rightAds1_result;
    //get ads3
    $rightAds2_result = getCurls('users/readMoreRightAds2');
    $args['rightAds2_result'] = $rightAds2_result;
    //get ads4
    $rightAds3_result = getCurls('users/readMoreRightAds3');
    $args['rightAds3_result'] = $rightAds3_result;
    //get ads4
    $rightAds4_result = getCurls('users/readMoreRightAds4');
    $args['rightAds4_result'] = $rightAds4_result;
    //get ads5
    $rightAds5_result = getCurls('users/readMoreRightAds5');
    $args['rightAds5_result'] = $rightAds5_result;
    // post category
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
        $post_category_result = postCurls('users/getCategory',$_POST);
         $args['category_result'] = $post_category_result;
    
    //Get Country 
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    //read more functionality for filter
    $_POST['id'] = $args['id'];
    $_POST['rm_type'] = $args['rm_type'];
    // get similar posts
    $similar_posts = postCurls('users/getSimilarPosts', $_POST);
    $args['similar_posts'] = $similar_posts;
    $posts_result = postCurls('users/getReadMorePostDetails',$_POST); 
//echo '<pre>'; print_r($posts_result); echo '</pre>'; exit();
    // sub cat id for readmore page
    $subCatId = $posts_result[0]['mnst_new_event']['sub_catagory_id'];
    //echo '<pre>'; print_r($posts_result); echo '</pre>'; exit();
    if($posts_result['noPosts'][0] == '0') {
        $args['page'] = 'noPostError';
        return $this->view->render($response, 'includes/header.html.twig', $args);
    }
    $url1 = $request->getUri()->gethost();
    $url2 = $request->getUri()->getBasePath();
    $url3 = $request->getUri()->getpath();

    $args['posts_result'] = $posts_result;
    $args['similar_posts'] = $similar_posts;
    $args['metas_result'] = $posts_result;
    $args['url']=$url1.$url2.'/'.$url3;

if($subCatId == 1 || $subCatId == 2){
    $args['page'] = 'rear_more_1';
}elseif($subCatId == 3 || $subCatId == 30 || $subCatId == 31 || $subCatId == 33){
    $args['page'] = 'rear_more_2';
}elseif ($subCatId == 4) {
    $args['page'] = 'rear_more_3';
}elseif ($subCatId == 5 || $subCatId == 6 || $subCatId == 7 || $subCatId == 8) {
    $args['page'] = 'rear_more_4';
} elseif ($subCatId == 9 || $subCatId == 10 || $subCatId == 11 || $subCatId == 12 || $subCatId == 13 || $subCatId == 14 || $subCatId == 15 || $subCatId == 16 || $subCatId == 17 || $subCatId == 18 || $subCatId == 19 || $subCatId == 20) {
    $args['page'] = 'rear_more_5';
}elseif ($subCatId == 21 || $subCatId == 22 || $subCatId == 23 || $subCatId == 24 || $subCatId == 25) {
   $args['page'] = 'rear_more_6';
}elseif ($subCatId == 28 || $subCatId == 29 ) {
   $args['page'] = 'rear_more_7';
}elseif ($subCatId == 32) {
    $args['page'] = 'rear_more_8';
}elseif ($subCatId == 34 || $subCatId == 35 || $subCatId == 36 || $subCatId == 37 ) {
    $args['page'] = 'rear_more_9';
}elseif ($subCatId == 38 || $subCatId == 39 || $subCatId == 40 || $subCatId == 41 || $subCatId == 42 || $subCatId == 43 || $subCatId == 44 || $subCatId == 45 || $subCatId == 46 || $subCatId == 47 ) {
    $args['page'] = 'rear_more_10';
}else{
    $args['page'] = 'rear_more';
}

    //echo '<pre>'; print_r($args); echo '</pre>'; exit();

    return $this->view->render($response, 'includes/header.html.twig', $args);

});


$app->any('/{rm_type}/{sub_cat}/{id}/{pagination}', function ($request, $response, $args){

    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    } else {
        $args['first_name'] =  'login';
    }

    $_POST['category_id'] = $args['category_id'];
    $_POST['sub_cat_id'] = (isset($_POST['filterBy']) && $_POST['filterBy'] !== '') ? $_POST['filterBy'] : $args['sub_cat_id'] ;
    $_POST['pagination'] = $args['pagination'];
    // for pagitions 
    $args['sub_category_id'] = $_POST['sub_cat_id'];
    //Get Navigation  Manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');
    //echo "<pre>"; print_r($sub_ct_result); exit;
    $args['sub_ct_result'] = $sub_ct_result;
    // get ads
    $ads_result = getCurls('users/getAds');
    $args['ads_result'] = $ads_result;
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
    // post category
    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
        $post_category_result = postCurls('users/getCategory',$_POST);
         $args['category_result'] = $post_category_result;
    
    //Get Banners 
    $banner_result = getCurls('users/getBanners');
    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);
    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);
    $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);
    //Get Country 
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
    //read more functionality for filter
    $_POST['id'] = $args['id'];
    $_POST['rm_type'] = $args['rm_type'];
    $_POST['pagination'] = $args['pagination'];

    $posts_result = postCurls('users/getReadMorePostDetailsPagination',$_POST);
    //echo '<pre>'; print_r($posts_result); echo '</pre>'; exit();

    if($posts_result['noPosts'][0] == '0') {

        $args['page'] = 'noPostError';

        return $this->view->render($response, 'includes/header.html.twig', $args);

    }

    $url1 = $request->getUri()->gethost();

    $url2 = $request->getUri()->getBasePath();

    $url3 = $request->getUri()->getpath();



    $args['posts_result'] = $posts_result;

    $args['metas_result'] = $posts_result;

    $args['url']=$url1.$url2.'/'.$url3;

    $args['page'] = 'rear_more';


    //echo '<pre>'; print_r($args); echo '</pre>'; exit();

    return $this->view->render($response, 'includes/header.html.twig', $args);

});


$app->any('/update-post-status', function ($request, $response, $args){

    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $_POST['user_id'] = $args['user_id'];

        $post_status_responce = postCurls('users/updatePostStatus',$_POST);

        echo $post_status_responce['update']; exit;

    } else {
        $args['first_name'] =  'login';
    }



});



$app->run();



?>
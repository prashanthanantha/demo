<?php 
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';
$app->any('/', function ($request, $response, $args){    
    //phpinfo(); exit;
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
    $args['nav_result'] = $nav_result;
   $sub_ct_result = getCurls('users/getSubCategoris');
    //echo "<pre>"; print_r($sub_ct_result); exit;
    $args['sub_ct_result'] = $sub_ct_result;
    
    $post_category_wise = getCurls('users/getPostCategoryWise');
    $args['post_category_wise'] = $post_category_wise;
    //echo "<pre>"; print_r($args['post_category_wise']); exit;
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
    //get all cities
    $city_result = getCurls('users/getAllCities');
    $args['city_result'] = $city_result;
    // get sliders
    $slider_result = getCurls('users/getSlider');
    $args['slider_result'] = $slider_result;
    
    $args['page'] = 'home';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});
$app->any('/{state}/{city}', function ($request, $response, $args){    
    //phpinfo(); exit;
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
    $args['nav_result'] = $nav_result;
   $sub_ct_result = getCurls('users/getSubCategoris');
    $args['sub_ct_result'] = $sub_ct_result;
    //get state id and city id
    $_POST['state_name'] = str_replace('-', ' ', $args['state']);
    $_POST['city_name'] = str_replace('-', ' ', $args['city']);
    $state_id = postCurls('users/getStateId',$_POST);
    $_POST['state_id'] = $state_id['state_id'];

     $city_id = postCurls('users/getCityId',$_POST);

     $_POST['city_id'] = $city_id['city_id'];

    //get new News
    $news_result = postCurls('users/getNewNews',$_POST);
    //echo "<pre>"; print_r($news_result); exit;
    if($news_result['noNews'] === 0){
      //For nav manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
   $sub_ct_result = getCurls('users/getSubCategoris');
    $args['sub_ct_result'] = $sub_ct_result;
        $args['page'] =  'pageNotFound';
         return $this->view->render($response, 'includes/header.html.twig', $args); exit;
    }
    $_SESSION["city"] = $_POST['city_name'];
    $_SESSION["state"] = $_POST['state_name'];
    $args['news_result'] = array_slice($news_result, 0, 4);
    $post_category_wise = postCurls('users/getPostCategoryWise',$_POST);
    $args['post_category_wise'] = $post_category_wise;
    //echo "<pre>"; print_r($args['post_category_wise']); exit;
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
    $topads_result = getCurls('users/homePageTopAd');
    //echo '<pre>'; print_r($ads1_result); exit;
    $args['topads_result'] = $topads_result;
    //get ads2
    $rightsid1_result = getCurls('users/homeRighSidetAd1');
    //echo "<pre>"; print_r($rightsid1_result); exit;
    $args['rightsid1_result'] = $rightsid1_result;
    //get ads3
    $rightsid2_result = getCurls('users/homeRighSidetAd2');
    $args['rightsid2_result'] = $rightsid2_result;
    //get ads4
    $rightsid3_result = getCurls('users/homeRighSidetAd3');
    $args['rightsid3_result'] = $rightsid3_result;
   //get ads5
    $rightsid4_result = getCurls('users/homeRighSidetAd4');
    $args['rightsid4_result'] = $rightsid4_result;
  //get ads6
    $rightsid5_result = getCurls('users/homeRighSidetAd5');
    $args['rightsid5_result'] = $rightsid5_result;

    $args['path'] = $request->getUri()->getpath();
    
    $args['page'] = 'index';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});
$app->any('/disclaimer', function ($request, $response, $args){
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
    
       $args['page'] = 'disclaimer';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});
$app->any('/about-us', function ($request, $response, $args){
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
    
       $args['page'] = 'aboutus';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});
$app->any('/contact-us', function ($request, $response, $args){
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
    
       $args['page'] = 'contactus';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});
$app->any('/logout', function($request, $response, $args){
    session_unset();
    session_destroy();
    return $response->withRedirect(GLOBAL_HOME);
});
$app->run();

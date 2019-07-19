<?php
// error_reporting(E_ALL);
// error_reporting(1);
require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';
$app->any('/search_result/{search_val}/{pagination}', function ($request, $response, $args){

    	$_POST['srch_term'] = $args['search_val'];
        if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
            $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
            $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
            $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
            $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
            $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
        } else {
            $args['first_name'] =  'login';
        }

	    $nav_result = getCurls('users/getNavManu');
    	$args['nav_result'] = $nav_result;
        $sub_ct_result = getCurls('users/getSubCategoris');
        $args['sub_ct_result'] = $sub_ct_result;

	    $banner_result = getCurls('users/getBanners');
	    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 4);
	    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 4);
            // post category
	    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];
        $post_category_result = postCurls('users/getCategory',$_POST);
         $args['category_result'] = $post_category_result;

	    $country_result = getCurls('users/getCountry');
	    $args['country_result'] = $country_result;
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

	    $posts_category_result = postCurls('users/getPostCategoryForFilter',$_POST);
   		$args['posts_category_result'] = $posts_category_result;
	    $country_result = getCurls('users/getPostBySubCategory');

        if (isset($_POST) && count($_POST) > 0) {
        $_POST['pagination'] = $args['pagination'];
        $searchResponceArray = postCurls('users/searchDetails',$_POST);
   		    $args['posts_result'] = $searchResponceArray;
	        $args['search_contain'] = $_POST['srch_term'];
   		 }

    if($searchResponceArray[0]['post_name'] != ''){
    	$count_of_pages = $searchResponceArray[0]['counts'];
    	$args['total_pages'] = ceil($count_of_pages/15);
        $args['page'] = 'search';

    } else {
    	$args['search_contain'] = $_POST['srch_term'];
        $args['total_pages'] = 0;
        $args['page'] = 'search'; 
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);

});

$app->run();

?>
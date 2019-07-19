<?php
// error_reporting(E_ALL);
// error_reporting(1);

require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';

$app->any('/{state}/{city}/{category_id}/{sub_cat_id}/{pagination}', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    } else {
        $args['first_name'] =  'login';
    }

    $post_category = str_replace("-", " ", $args['category_id']);
    $post_subcategory = $args['sub_cat_id'];
    $_POST['url_id_cat'] = $post_category;
    $_POST['url_id_subcat'] = $post_subcategory;   


    $post_url_result = postCurls('users/get_Cat_Subcat_FromUrl',$_POST);

    $args['category_id'] = $post_url_result['category_id'];
    $args['sub_cat_id'] = $post_url_result['sub_cat_id'];


    $_POST['category_id'] = $args['category_id'];
    $_POST['postUserId'] = $args['postUserId'];

    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];

    // get state and city ids
    //get state id and city id
    $_POST['state_name'] = str_replace('-', ' ', $args['state']);
    $_POST['city_name'] = str_replace('-', ' ', $args['city']);
    $state_id = postCurls('users/getStateId',$_POST);
    $_POST['state_id'] = $state_id['state_id'];

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
   
    //Get Country 
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
     // get ads
    $ads_result_top = postCurls('users/topAds',$_POST);
    $args['top_ads'] = $ads_result_top; 
    $ads_result1 = postCurls('users/rightsideAdone',$_POST);
    $args['right_ad1'] = $ads_result1;
    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);
    $args['right_ad2'] = $ads_result2;
    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);
    $args['right_ad3'] = $ads_result3;
    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);
    $args['right_ad4'] = $ads_result4;

    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);
    $args['right_ad5'] = $ads_result5;
    //Post Category for filter
    $posts_category_result = postCurls('users/getPostCategoryForFilter',$_POST);
    $args['posts_category_result'] = $posts_category_result;
    //Post category 
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
    //get category

    /*$category_result = getCurls('users/getCategory');

    $args['category_result'] = $category_result;*/

    /*echo "96:<pre>"; print_r($_POST); exit;*/

    $metas_result = postCurls('users/getMetas',$_POST);

    $args['metas_result'] = $metas_result;



    $posts_result = postCurls('users/getPostBySubCategory',$_POST);
    echo '<pre>'; print_r($posts_result); exit;

    /*foreach ($posts_result as $keyp => $valuepost) {
        $posts_result[$keyp]['for_url'] = $posts_result[$keyp]['post_name'];
    }*/


    if($posts_result['noPosts'][0]['noPosts'] == '0') {

        $args['posts_result'][0]['subcategory_name'] = $posts_result['noPosts'][0]['subcategory_name'];

        $args['posts_result'][0]['category_name'] = $posts_result['noPosts'][0]['category_name'];

        $args['page'] = 'noPostFound';

        return $this->view->render($response, 'includes/header.html.twig', $args);

    }


    $count_of_pages = $posts_result[0]['counts'];



    $args['total_pages'] = ceil($count_of_pages/5);



 //  get ads

     // get ads

    $ads_result_top = postCurls('users/topAds',$_POST);

    $args['top_ads'] = $ads_result_top; 



    $ads_result1 = postCurls('users/rightsideAdone',$_POST);

    $args['right_ad1'] = $ads_result1;



    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);

    $args['right_ad2'] = $ads_result2;



    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);

    $args['right_ad3'] = $ads_result3;



    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);

    $args['right_ad4'] = $ads_result4;



    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);

    $args['right_ad5'] = $ads_result5;



    $args['posts_result'] = $posts_result;



	$args['page'] = 'commonPost';



    return $this->view->render($response, 'includes/header.html.twig', $args);



});







$app->any('/post-sort-by/{category_id}/{sub_cat_id}/{pagination}/{sort_by}', function ($request, $response, $args){


	



    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {



        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];



        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];



        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];



        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];



        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];



    } else {



        $args['first_name'] =  'login';



    }


//echo "<pre>"; print_r($args); exit;




    $_POST['category_id'] = $args['category_id'];

    $_POST['sort_by'] = $args['sort_by'];
    //This is for onload and filter by variable assigned;
    $_POST['sub_cat_id'] = (isset($_POST['filterBy']) && $_POST['filterBy'] !== '') ? $_POST['filterBy'] : $args['sub_cat_id'] ;



    $_POST['pagination'] = $args['pagination'];



    // for pagitions 



    $args['sub_category_id'] = $_POST['sub_cat_id'];



    



    $nav_result = getCurls('users/getNavManu');



    $args['nav_result'] = $nav_result;


    $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;

    $args['sub_ct_result'] = $sub_ct_result;



    //  get ads

     // get ads

    $ads_result_top = postCurls('users/topAds',$_POST);

    $args['top_ads'] = $ads_result_top; 



    $ads_result1 = postCurls('users/rightsideAdone',$_POST);

    $args['right_ad1'] = $ads_result1;



    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);

    $args['right_ad2'] = $ads_result2;



    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);

    $args['right_ad3'] = $ads_result3;



    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);

    $args['right_ad4'] = $ads_result4;



    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);

    $args['right_ad5'] = $ads_result5;



    $banner_result = getCurls('users/getBanners');



    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);



    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);



    $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);



    $country_result = getCurls('users/getCountry');



    $args['country_result'] = $country_result;



    $posts_category_result = postCurls('users/getPostCategoryForFilter',$_POST);



    $args['posts_category_result'] = $posts_category_result;



    $posts_result = postCurls('users/getPostBySubCategory',$_POST);






    if($posts_result['noPosts'][0]['noPosts'] == '0') {

        $args['posts_result'][0]['category_name'] = $posts_result['noPosts'][0]['category_name'];

        $args['posts_result'][0]['subcategory_name'] = $posts_result['noPosts'][0]['subcategory_name'];



        $args['page'] = 'noPostError';



        return $this->view->render($response, 'includes/header.html.twig', $args);



    }



    $count_of_pages = $posts_result[0]['counts'];



    $args['total_pages'] = ceil($count_of_pages/5);



    $args['sort_by_pagination'] = 'sort_pag';



    $args['posts_result'] = $posts_result;





    $args['page'] = 'commonPost';



    return $this->view->render($response, 'includes/header.html.twig', $args);



});







$app->get('/getPostDescription/{postId}', function ($request, $response, $args){


//echo "hello2"; exit;


    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {



        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];



        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];



        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];



        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];



        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];



    } else {



        $args['first_name'] =  'login';



    }



    $_POST['id'] = $args['postId'];



   



    $nav_result = getCurls('users/getNavManu');



    $args['nav_result'] = $nav_result;


    $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;

    $args['sub_ct_result'] = $sub_ct_result;





    //  get ads

     // get ads

    $ads_result_top = postCurls('users/topAds',$_POST);

    $args['top_ads'] = $ads_result_top; 



    $ads_result1 = postCurls('users/rightsideAdone',$_POST);

    $args['right_ad1'] = $ads_result1;



    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);

    $args['right_ad2'] = $ads_result2;



    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);

    $args['right_ad3'] = $ads_result3;



    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);

    $args['right_ad4'] = $ads_result4;



    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);

    $args['right_ad5'] = $ads_result5;



   



    $banner_result = getCurls('users/getBanners');



    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);



    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);



    $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);



    



    $country_result = getCurls('users/getCountry');



    $args['country_result'] = $country_result;



   



    $posts_result = postCurls('users/getPostsDescription',$_POST);



    



    $args['posts_result'] = $posts_result;



    $args['page'] = 'postDescription';



    return $this->view->render($response, 'includes/header.html.twig', $args);



});  







$app->any('/getPostsByCategory/{category_id}/{pagination}', function ($request, $response, $args){


    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {



        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];



        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];



        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];



        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];



        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];



    } else {



        $args['first_name'] =  'login';



    }

//echo "<pre>"; print_r($args); exit;
    //$_POST['category_id'] = $args['category_id'];



    $_POST['category_id'] = (isset($_POST['filterBy']) && $_POST['filterBy'] !== '') ? $_POST['filterBy'] : $args['category_id'] ;



    $_POST['pagination'] = $args['pagination'];



    $nav_result = getCurls('users/getNavManu');



    $args['nav_result'] = $nav_result;


    $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;

    $args['sub_ct_result'] = $sub_ct_result;



    //  get ads

     // get ads

    $ads_result_top = postCurls('users/topAds',$_POST);

    $args['top_ads'] = $ads_result_top; 



    $ads_result1 = postCurls('users/rightsideAdone',$_POST);

    $args['right_ad1'] = $ads_result1;



    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);

    $args['right_ad2'] = $ads_result2;



    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);

    $args['right_ad3'] = $ads_result3;



    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);

    $args['right_ad4'] = $ads_result4;



    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);

    $args['right_ad5'] = $ads_result5;



    $banner_result = getCurls('users/getBanners');



    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);



    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);



    $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);



    $country_result = getCurls('users/getCountry');



    $args['country_result'] = $country_result;



    $posts_category_result = postCurls('users/getPostCategoryForFilter',$_POST);



    $args['posts_category_result'] = $posts_category_result;



    $posts_result = postCurls('users/getPostsByCategory',$_POST);




    $args['posts_result'] = $posts_result;



    if($posts_result['noPosts'][0]['noPosts']  == '0') {



        $args['posts_result'][0]['category_name'] = $posts_result['noPosts'][0]['category_name'];



        $args['page'] = 'noPostError';



        return $this->view->render($response, 'includes/header.html.twig', $args);



    }



    $count_of_pages = $posts_result[0]['counts'];



    $args['total_pages'] = ceil($count_of_pages/5);



    $args['sort_by'] = 'desc';



    $args['page'] = 'categoryPost';



    return $this->view->render($response, 'includes/header.html.twig', $args);



});



$app->any('/getPostsByCategorySortBy/{category_id}/{pagination}/{sort_by}', function ($request, $response, $args){

//echo "<pre>"; print_r($args); exit;


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



    $_POST['pagination'] = $args['pagination'];



    $_POST['sort_by'] = $args['sort_by'];



    $nav_result = getCurls('users/getNavManu');



    $args['nav_result'] = $nav_result;


    $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;

    $args['sub_ct_result'] = $sub_ct_result;





     // get ads

    $ads_result_top = postCurls('users/topAds',$_POST);

    $args['top_ads'] = $ads_result_top; 



    $ads_result1 = postCurls('users/rightsideAdone',$_POST);

    $args['right_ad1'] = $ads_result1;



    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);

    $args['right_ad2'] = $ads_result2;



    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);

    $args['right_ad3'] = $ads_result3;



    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);

    $args['right_ad4'] = $ads_result4;



    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);

    $args['right_ad5'] = $ads_result5;



    $banner_result = getCurls('users/getBanners');



    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);



    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);



    $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);



    $country_result = getCurls('users/getCountry');



    $args['country_result'] = $country_result;



    $posts_category_result = postCurls('users/getPostCategoryForFilter',$_POST);



    $args['posts_category_result'] = $posts_category_result;



    $posts_result = postCurls('users/getPostsByCategory',$_POST);



    $args['posts_result'] = $posts_result;




    if($posts_result['noPosts'][0]['noPosts']  == '0') {



        $args['posts_result'][0]['category_name'] = $posts_result['noPosts'][0]['category_name'];



        $args['page'] = 'noPostError';



        return $this->view->render($response, 'includes/header.html.twig', $args);



    }



    $count_of_pages = $posts_result[0]['counts'];



    $args['total_pages'] = ceil($count_of_pages/5);







    $args['page'] = 'categoryPost';



    return $this->view->render($response, 'includes/header.html.twig', $args);



});



$app->any('/posts/{category_id}/{sub_cat_id}/{pagination}/{event}', function ($request, $response, $args){

//echo "hello 5"; exit;

    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {



        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];

        /*echo "<pre>"; print_r($args['user_id']); exit;*/



        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];



        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];



        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];



        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];



    } else {



        $args['first_name'] =  'login';



    }

//echo '<pre>'; print_r('hello-5'); exit;

    $_POST['category_id'] = $args['category_id'];

    $_POST['admin_user_id'] = $_SESSION['userdetails'][0]['mnst_users']['id'];



    //This is for onload and filter by variable assigned;



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



    //Get Banners 



    $banner_result = getCurls('users/getBanners');



    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);



    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);



    $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);



    //Get Country 



    $country_result = getCurls('users/getCountry');



    $args['country_result'] = $country_result;



        //  get ads

     // get ads

    $ads_result_top = postCurls('users/topAds',$_POST);

    $args['top_ads'] = $ads_result_top; 



    $ads_result1 = postCurls('users/rightsideAdone',$_POST);

    $args['right_ad1'] = $ads_result1;



    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);

    $args['right_ad2'] = $ads_result2;



    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);

    $args['right_ad3'] = $ads_result3;



    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);

    $args['right_ad4'] = $ads_result4;



    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);

    $args['right_ad5'] = $ads_result5;



    //Post Category for filter



    $posts_category_result = postCurls('users/getPostCategoryForFilter',$_POST);

    $args['posts_category_result'] = $posts_category_result;


    //Post category 

    $post_category_result = postCurls('users/getCategory',$_POST);

    $args['category_result'] = $post_category_result;

    

    //get category

    /*$category_result = getCurls('users/getCategory');

    $args['category_result'] = $category_result;*/

    /*echo "96:<pre>"; print_r($_POST); exit;*/

    $metas_result = postCurls('users/getMetas',$_POST);

    $args['metas_result'] = $metas_result;



    $posts_result = postCurls('users/getPostBylatestEvents',$_POST);




    if($posts_result['noPosts'][0]['noPosts'] == '0') {



        $args['posts_result'][0]['subcategory_name'] = $posts_result['noPosts'][0]['subcategory_name'];



        $args['posts_result'][0]['category_name'] = $posts_result['noPosts'][0]['category_name'];



        $args['page'] = 'noPostError';









        return $this->view->render($response, 'includes/header.html.twig', $args);



    }



    $args['sort_by'] = 'desc';



    $count_of_pages = $posts_result[0]['counts'];



    $args['total_pages'] = ceil($count_of_pages/5);



 //  get ads

     // get ads

    $ads_result_top = postCurls('users/topAds',$_POST);

    $args['top_ads'] = $ads_result_top; 



    $ads_result1 = postCurls('users/rightsideAdone',$_POST);

    $args['right_ad1'] = $ads_result1;



    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);

    $args['right_ad2'] = $ads_result2;



    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);

    $args['right_ad3'] = $ads_result3;



    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);

    $args['right_ad4'] = $ads_result4;



    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);

    $args['right_ad5'] = $ads_result5;



    $args['posts_result'] = $posts_result;



    $args['page'] = 'commonPost';



    return $this->view->render($response, 'includes/header.html.twig', $args);



});

$app->any('/user/all-posts/{username}/{pagination}', function ($request, $response, $args){

    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {

        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        /*echo "<pre>"; print_r($args['user_id']); exit;*/

        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

    } else {

        $args['first_name'] =  'login';
    }

    $_POST['username'] = str_replace('-', ' ', $args['username']);
    $_POST['pagination'] = $args['pagination'];


    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;
    $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;
    $args['sub_ct_result'] = $sub_ct_result;

   //Get Banners 
    $banner_result = getCurls('users/getBanners');
    $metas_result = postCurls('users/getMetas',$_POST);
    $args['metas_result'] = $metas_result;


    // get User all posts 
    $user_all_posts = postCurls('users/getUserAllPosts',$_POST);


    $args['user_all_posts'] = $user_all_posts;


    if($user_all_posts['noPosts'][0]['noPosts']  == '0') {


        $args['user_all_posts'][0]['username'] = $user_all_posts['noPosts'][0]['username'];


        $args['page'] = 'noPostError';



        return $this->view->render($response, 'includes/header.html.twig', $args);



    }



    $count_of_pages = $user_all_posts[0]['mnst_user_posts']['counts'];


    $args['total_pages'] = ceil($count_of_pages/5);
    

    $args['page'] = 'userAllPosts';


    return $this->view->render($response, 'includes/header.html.twig', $args);

});

$app->any('/{category_id}/{sub_cat_id}/{search_term}/{pagination}', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
    } else {
        $args['first_name'] =  'login';
    }

    $post_category = str_replace("-", " ", $args['category_id']);
    $post_subcategory = $args['sub_cat_id'];
    $_POST['search_contain'] = $args['search_term'];
    $_POST['url_id_cat'] = $post_category;
    $_POST['url_id_subcat'] = $post_subcategory;   

    $post_url_result = postCurls('users/get_Cat_Subcat_FromUrl',$_POST);

    $args['category_id'] = $post_url_result['category_id'];
    $args['sub_cat_id'] = $post_url_result['sub_cat_id'];

    $_POST['category_id'] = $args['category_id'];
    $_POST['sub_category_id'] = $args['sub_cat_id'];
    
    $_POST['pagination'] = $args['pagination'];

    //Get Navigation  Manu
    $nav_result = getCurls('users/getNavManu');
    $args['nav_result'] = $nav_result;

    $sub_ct_result = getCurls('users/getSubCategoris');

    //echo "<pre>"; print_r($sub_ct_result); exit;
    $args['sub_ct_result'] = $sub_ct_result;
    //Get Banners 
    $banner_result = getCurls('users/getBanners');
    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);
    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);
    $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);
    //Get Country 
    $country_result = getCurls('users/getCountry');
    $args['country_result'] = $country_result;
     // get ads
    $ads_result_top = postCurls('users/topAds',$_POST);
    $args['top_ads'] = $ads_result_top; 
    $ads_result1 = postCurls('users/rightsideAdone',$_POST);
    $args['right_ad1'] = $ads_result1;
    $ads_result2 = postCurls('users/rightsideAdtwo',$_POST);
    $args['right_ad2'] = $ads_result2;
    $ads_result3 = postCurls('users/rightsideAdthree',$_POST);
    $args['right_ad3'] = $ads_result3;
    $ads_result4 = postCurls('users/rightsideAdfour',$_POST);
    $args['right_ad4'] = $ads_result4;

    $ads_result5 = postCurls('users/rightsideAdfive',$_POST);
    $args['right_ad5'] = $ads_result5;
    //Post Category for filter
    //$posts_category_result = postCurls('users/getPostCategoryForFilter',$_POST);
   // $args['posts_category_result'] = $posts_category_result;
    //Post category 
    $post_category_result = postCurls('users/getCategory',$_POST);
    $args['category_result'] = $post_category_result;
    //get category

    /*$category_result = getCurls('users/getCategory');

    $args['category_result'] = $category_result;*/

    /*echo "96:<pre>"; print_r($_POST); exit;*/

    $metas_result = postCurls('users/getMetas',$_POST);

    $args['metas_result'] = $metas_result;



    $posts_result = postCurls('users/getPostBySubCategorySearch',$_POST);
    //echo '<pre>'; print_r($posts_result); exit;

    /*foreach ($posts_result as $keyp => $valuepost) {
        $posts_result[$keyp]['for_url'] = $posts_result[$keyp]['post_name'];
    }*/

    if($posts_result['noPosts'][0]['noPosts'] == '0') {
        $args['posts_result'][0]['subcategory_name'] = $posts_result['noPosts'][0]['subcategory_name'];
        $args['posts_result'][0]['category_name'] = $posts_result['noPosts'][0]['category_name'];
        $args['search_contain'] = $posts_result['noPosts'][0]['search_contain'];
        $args['total_pages'] = 0;
        $args['page'] = 'commonPost';
        return $this->view->render($response, 'includes/header.html.twig', $args);
    }
    //$args['sort_by'] = 'desc';
    $count_of_pages = $posts_result[0]['counts'];
    $args['total_pages'] = ceil($count_of_pages/5);

    $args['search_contain'] = $posts_result[0]['search_contain'];
    $args['posts_result'] = $posts_result;
    $args['page'] = 'commonPost';
    return $this->view->render($response, 'includes/header.html.twig', $args);
});


$app->any('/user/all-posts/{user_name}/{search_value}/{pagination}', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
            $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
            $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
            $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
            $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
            $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];
        } else {
            $args['first_name'] =  'login';
        }
        $_POST['user_name'] = str_replace('-', ' ', $args['user_name']);
        $_POST['search_value'] = $args['search_value'];
        $_POST['pagination'] = $args['pagination'];
        $nav_result = getCurls('users/getNavManu');
        $args['nav_result'] = $nav_result;
        $sub_ct_result = getCurls('users/getSubCategoris');
        $args['sub_ct_result'] = $sub_ct_result;
    //echo "<pre>"; print_r($sub_ct_result); exit;
        $banner_result = getCurls('users/getBanners');
        $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 4);
        $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 4);

         if (isset($_POST) && count($_POST) > 0) {
        $searchResponceArray = postCurls('users/searchUserPosts',$_POST);
       //echo '<pre>'; print_r($searchResponceArray); echo '</pre>'; exit();
            $args['user_all_posts'] = $searchResponceArray;
            $args['search_contain'] = $_POST['search_value'];
         }
    if($searchResponceArray[0]['mnst_user_posts']['counts'] != 0){
        $count_of_pages = $searchResponceArray[0]['mnst_user_posts']['counts'];
        $args['total_pages'] = ceil($count_of_pages/5);
        $args['page'] = 'userAllPosts';
    } else {
        $args['user_all_posts'][0]['mnst_user_posts']['user_id'] = $searchResponceArray[0]['usr']['id'];
        $args['user_all_posts'][0]['mnst_user_posts']['firstname'] = $searchResponceArray[0]['usr']['firstname'];
        $args['user_all_posts'][0]['mnst_user_posts']['lastname'] = $searchResponceArray[0]['usr']['lastname'];
        $args['user_all_posts'][0]['mnst_user_posts']['create_by'] = $searchResponceArray[0]['usr']['username'];
        $args['user_all_posts'][0]['mnst_user_posts']['user_email'] = $searchResponceArray[0]['usr']['email'];
        $args['user_all_posts'][0]['mnst_user_posts']['user_phone'] = $searchResponceArray[0]['usr']['phone'];
        $args['user_all_posts'][0]['mnst_user_posts']['user_image'] = $searchResponceArray[0]['usr']['user_image'];
        $args['user_all_posts'][0]['mnst_user_posts']['created_at'] = date('d M Y',strtotime($searchResponceArray[0]['usr']['created_at']));
        $args['user_all_posts'][0]['mnst_user_posts']['counts'] = $searchResponceArray[0][0]['counts'];
        $args['total_pages'] = 0;
        //echo "<pre>"; print_r($args['user_all_posts']); exit;
        $args['search_contain'] = $_POST['search_value'];
        $args['page'] = 'userAllPosts'; 
    }
    return $this->view->render($response, 'includes/header.html.twig', $args);
    });

$app->run();




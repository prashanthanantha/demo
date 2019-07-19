<?php
// error_reporting(E_ALL);
// error_reporting(1);

require 'default_config/index.php';
require 'common_file/mail.php';
require 'common_file/inout_function.php';

$app->any('/my-account', function ($request, $response, $args){

    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $_POST['id'] = $args['user_id'];

        $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;

         $banner_result = getCurls('users/getBanners');
         $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);
         $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);
         $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);

         $country_result = getCurls('users/getCountry');
         $args['country_result'] = $country_result;

         $user_response = postCurls('users/accountInfo',$_POST);
         $args['user_details_result'] = $user_response;
         //echo '<pre>'; print_r($args['user_details_result']); exit;
         // for My Posts
         $user_posts = postCurls('users/myPosts',$_POST);
         $args['user_posts'] = $user_posts;

         $count_of_pages = $user_posts[0]['counts'];
        $args['total_pages'] = ceil($count_of_pages/5);

        // for pending Posts
        $user_pending_posts = postCurls('users/pendingPosts',$_POST);
         $args['user_pending_posts'] = $user_pending_posts;

         $count_of_pending_posts = $user_pending_posts[0]['counts'];
        $args['total_pending_posts'] = ceil($count_of_pending_posts/5);

        // for dis-approoval posts
        $user_disapproval_posts = postCurls('users/disapprovalPosts',$_POST);
         $args['user_disapproval_posts'] = $user_disapproval_posts;


         $count_of_disapproval_posts = $user_disapproval_posts[0]['counts'];
        $args['total_disapproval_posts'] = ceil($count_of_disapproval_posts/5);
         //echo '<pre>'; print_r($args['total_dipapproval_posts']); exit;

         $args['page'] = 'accountInfo';

}else{
        $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;
         
        $args['first_name'] = 'login';
        $args['page']='login_form';
}
return $this->view->render($response, 'includes/header.html.twig', $args);

});

$app->any('/my-account/pagination',function($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $_POST['id'] = $args['user_id'];
        $user_posts = postCurls('users/myPostsPagination',$_POST);

    echo json_encode($user_posts); exit;
    }else{
        $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;
         
        $args['first_name'] = 'login';
        $args['page']='login_form';
        return $this->view->render($response, 'includes/header.html.twig', $args);
}

});

$app->any('/my-account/pending-posts/pagination',function($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $_POST['id'] = $args['user_id'];
        $pending_posts = postCurls('users/pendingPostsPagination',$_POST);
        
    echo json_encode($pending_posts); exit;
    }else{
    $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;
         
        $args['first_name'] = 'login';
        $args['page']='login_form';
        return $this->view->render($response, 'includes/header.html.twig', $args);
}

});

$app->any('/my-account/disaproval-posts/pagination',function($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $_POST['id'] = $args['user_id'];
        $disaproval_posts = postCurls('users/disaprovalPostsPagination',$_POST);
        
    echo json_encode($disaproval_posts); exit;
    }else{
    $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;
         
        $args['first_name'] = 'login';
        $args['page']='login_form';
        return $this->view->render($response, 'includes/header.html.twig', $args);
}

});


$app->get('/accountInfo/{userId}/{value}', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $_POST['id'] = $args['userId'];

        $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;

         $banner_result = getCurls('users/getBanners');
         $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 5);
         $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 5);
         $args['banner_result']['center'] = array_slice($banner_result['top_center'], 0, 2);

         $country_result = getCurls('users/getCountry');
         $args['country_result'] = $country_result;

         $user_response = postCurls('users/accountInfo',$_POST);
         $args['user_details_result'] = $user_response;

         if($args['value'] == 'edit'){
            $args['user_id'] = $args['userId'];
            $args['page'] = 'accountEdit';
        }else{
            $args['page'] = 'accountInfo';
        }
        return $this->view->render($response, 'includes/header.html.twig', $args);
    } else {
        $nav_result = getCurls('users/getNavManu');
        $args['nav_result'] = $nav_result;

        $sub_ct_result = getCurls('users/getSubCategoris');
        $args['sub_ct_result'] = $sub_ct_result;

        $args['first_name'] =  'login';
        $args['page'] = 'pageNotFound';

        return $this->view->render($response, 'includes/header.html.twig', $args);
    }

});

$app->post('/update-profile', function ($request, $response, $args){
    
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

        $firstname = $_POST["firstName"];
        $lastname = $_POST["lastName"];
        $uphone = $_POST['mobile'];

        if(!preg_match('/^\s*[a-zA-Z0-9]*$/', $firstname)){
            $args['error_message'] = "please enter valid firstname";
            $result = json_encode($args['error_message']);
            echo $result;exit;
        }

          if(!preg_match('/^\s*[a-zA-Z0-9]*$/', $lastname)){
            $args['error_message'] = "please enter valid lastname";
            $result = json_encode($args['error_message']);
            echo $result;exit;
        }

          if(!preg_match('/^((\d{3})-(\d{3})-(\d{4}))?$/', $mobile)){
            $args['error_message'] = "please enter valid Phoe number";
            $result = json_encode($args);
            echo $result;exit;
        }

        
        $user_response = postCurls('users/updateAccountInfo',$_POST);
        if($user_response['updatePost'] == 1){
            echo 1;
        }else{
            echo 0;
        }
        }else{
            header("Location: http://localhost/manast_curl_changes/login.php/login-form");
            die();
        }


});

$app->any('/my-posts/search', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

    
        $myPosts = postCurls('users/myPostsSearch',$_POST);

    echo json_encode($myPosts); exit;
    }else{
        $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;
         
        $args['first_name'] = 'login';
        $args['page']='login_form';
        return $this->view->render($response, 'includes/header.html.twig', $args);
}

});


$app->any('/pending-posts/search', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

    
        $pendingPosts = postCurls('users/pendingPostsSearch',$_POST);

    echo json_encode($pendingPosts); exit;
    }else{
        $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;
         
        $args['first_name'] = 'login';
        $args['page']='login_form';
        return $this->view->render($response, 'includes/header.html.twig', $args);
}

});

$app->any('/disaproval-posts/search', function ($request, $response, $args){
    if(isset($_SESSION['userdetails'][0]['mnst_users']['firstname']) && $_SESSION['userdetails'][0]['mnst_users']['firstname'] !== '') {
        $args['user_id'] =  $_SESSION['userdetails'][0]['mnst_users']['id'];
        $args['first_name'] =  $_SESSION['userdetails'][0]['mnst_users']['firstname'];
        $args['email'] =  $_SESSION['userdetails'][0]['mnst_users']['email'];
        $args['user_image'] =  $_SESSION['userdetails'][0]['mnst_users']['user_image'];
        $args['fullname'] =  $_SESSION['userdetails'][0][0]['fullname'];

    
        $disaprovalPosts = postCurls('users/disaprovalPostsSearch',$_POST);

    echo json_encode($disaprovalPosts); exit;
    }else{
        $nav_result = getCurls('users/getNavManu');
         $args['nav_result'] = $nav_result;

         $sub_ct_result = getCurls('users/getSubCategoris');
         $args['sub_ct_result'] = $sub_ct_result;
         
        $args['first_name'] = 'login';
        $args['page']='login_form';
        return $this->view->render($response, 'includes/header.html.twig', $args);
}

});





$app->run();
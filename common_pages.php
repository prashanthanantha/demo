<?php

// error_reporting(E_ALL);

// error_reporting(1);

require 'default_config/index.php';

require 'common_file/mail.php';

require 'common_file/cryptojs-aes.php';



$app->get('/commonPages/{pagename}', function ($request, $response, $args){



	//For nav manu

    $nav_result = getCurls('users/getNavManu');

    $args['nav_result'] = $nav_result;

    //For nav banners

    $banner_result = getCurls('users/getBanners');

    $args['banner_result']['right'] = array_slice($banner_result['right'], 0, 4);

    $args['banner_result']['left'] = array_slice($banner_result['left'], 0, 4);

    //get new events

    $events_result = getCurls('users/getNewEvents');

    $args['events_result'] = array_slice($events_result, 0, 4);

    // get ads
    /*echo '<pre>'; print_r($slider_result); exit;*/
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

    //get new News

    $news_result = getCurls('users/getNewNews');

    $args['news_result'] = array_slice($news_result, 0, 4);



    if($args['pagename'] == 'about_us'){

        $args['page'] = 'about_us';

    } else if($args['pagename'] == 'terms_and_conditions'){

        $args['page'] = 'terms_and_conditions';

    } else if($args['pagename'] == 'vision'){

        $args['page'] = 'vision';

    } else if($args['pagename'] == 'mission'){

        $args['page'] = 'mission';

    } else if($args['pagename'] == 'contact_us'){

        $args['page'] = 'contact_us';

    } else {

       $args['page'] = 'pageNotFound'; 

    }

    return $this->view->render($response, 'includes/header.html.twig', $args);

});



$app->run();



?>
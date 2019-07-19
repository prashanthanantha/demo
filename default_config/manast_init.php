<?php

    $root_dir = 'http://localhost/manast_curl_changes/';
        define("GLOBAL_DIR_PATH", '/');
        define("GLOBAL_HOME", 'http://localhost/manast_curl_changes/');
        define("GLOBAL_IP_PATH", "");
        define("GLOBAL_BACKEND_PATH", 'http://localhost/manast_curl_changes/apiservices/');
   
	$container['flash'] = function ($container) use ($app) {
    	return new \Slim\Flash\Messages();
	};

	$app->add(function ($request, $response, $next) {
	    $this->view->offsetSet('flash', $this->flash);
	    return $next($request, $response);
	});
	// Register Twig View helper
	$container['view'] = function ($container) use ($root_dir) {

	$view = new \Slim\Views\Twig('templates', [
	'cache' => false,
	'debug' => true
	]);
		
	$view->addExtension(new \Slim\Views\TwigExtension(
		$container['router'],
		$container['request']->getUri()
	));

    function print_me($string){
		echo "<pre>";print_r($string); echo "</pre>"; exit();
	}
	
	function dump_me($string){
		echo "<pre>";var_dump($string); echo "</pre>"; exit();
	}
        
    $server_params = $container->get('request')->getServerParams();
    // below statements will be used for debugging in the templates 
	$view->getEnvironment()->addFilter('print_r', new Twig_Filter_Function('print_me'));
	$view->getEnvironment()->addFilter('var_dump', new Twig_Filter_Function('dump_me'));

    $view->getEnvironment()->addGlobal('GLOBAL_DIR_PATH', 'http://localhost/manast_curl_changes/');
    $view->getEnvironment()->addGlobal('GLOBAL_IP_PATH', '');
	$view->getEnvironment()->addGlobal('GLOBAL_BACKEND_PATH', 'http://localhost/manast_curl_changes/apiservices/');
    $view->getEnvironment()->addGlobal('CURRENT_PATH', $container->get('request')->getUri()->getbasePath());
    $view->getEnvironment()->addGlobal('CURRENT_PATH_PARAMS', $server_params['REQUEST_URI']);

    
    
	return $view;
	};

	


	

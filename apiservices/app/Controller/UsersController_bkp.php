<?php

App::uses('AppController', 'Controller');

/**

 * Users Controller

 *

 * @property User $User

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class UsersController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session');



/**

 * index method

 *

 * @return void

 */

	public function index() {

		$this->User->recursive = 0;

		$this->set('users', $this->Paginator->paginate());

	}



/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function view($id = null) {

		if (!$this->User->exists($id)) {

			throw new NotFoundException(__('Invalid user'));

		}

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));

		$this->set('user', $this->User->find('first', $options));

	}



/**

 * add method

 *

 * @return void

 */

	public function add() {

		if ($this->request->is('post')) {

			$this->User->create();

			if ($this->User->save($this->request->data)) {

				$this->Session->setFlash(__('The user has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));

			}

		}

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function edit($id = null) {

		if (!$this->User->exists($id)) {

			throw new NotFoundException(__('Invalid user'));

		}

		if ($this->request->is(array('post', 'put'))) {

			if ($this->User->save($this->request->data)) {

				$this->Session->setFlash(__('The user has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));

			$this->request->data = $this->User->find('first', $options);

		}

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->User->id = $id;

		if (!$this->User->exists()) {

			throw new NotFoundException(__('Invalid user'));

		}

		$this->request->allowMethod('post', 'delete');

		if ($this->User->delete()) {

			$this->Session->setFlash(__('The user has been deleted.'));

		} else {

			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}



/**

 * admin_index method

 *

 * @return void

 */

	public function admin_index() {

		$this->User->recursive = 0;

		$this->set('users', $this->Paginator->paginate());

	}



/**

 * admin_view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_view($id = null) {

		if (!$this->User->exists($id)) {

			throw new NotFoundException(__('Invalid user'));

		}

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));

		$this->set('user', $this->User->find('first', $options));

	}



/**

 * admin_add method

 *

 * @return void

 */

	public function admin_add() {

		if ($this->request->is('post')) {

			$this->User->create();

			if ($this->User->save($this->request->data)) {

				$this->Session->setFlash(__('The user has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));

			}

		}

	}



/**

 * admin_edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_edit($id = null) {

		if (!$this->User->exists($id)) {

			throw new NotFoundException(__('Invalid user'));

		}

		if ($this->request->is(array('post', 'put'))) {

			if ($this->User->save($this->request->data)) {

				$this->Session->setFlash(__('The user has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));

			$this->request->data = $this->User->find('first', $options);

		}

	}



/**

 * admin_delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_delete($id = null) {

		$this->User->id = $id;

		if (!$this->User->exists()) {

			throw new NotFoundException(__('Invalid user'));

		}

		$this->request->allowMethod('post', 'delete');

		if ($this->User->delete()) {

			$this->Session->setFlash(__('The user has been deleted.'));

		} else {

			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}



	

	public function loginDetails(){

		self::noView();

		header("Content-Type:application/json");

		$data_post = json_decode(file_get_contents('php://input'), true);
		$this->request->data = $data_post;
		$email = $this->request->data['email'];

		$password = base64_encode($this->request->data['password']);

		$loginDetail = $this->User->query("SELECT CONCAT(firstname,' ',lastname) AS fullname,id,firstname,email FROM mnst_users where email = '$email'and password = '$password'");

		$final_json = json_encode($loginDetail);

		return $final_json;

		

	}



	public function registerDetails(){

		self::noView();

		header("Content-Type:application/json");

		echo json_encode($this->request->data); exit;



		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$userDetail = $this->request->data;

		$email = $userDetail['email'];

		$first_name = $userDetail['first_name'];

		$last_name = $userDetail['last_name'];

		$password =  base64_encode($userDetail['password']);

		$phone = $userDetail['phone'];

		$user_status = 0;

		return "INSERT INTO mnst_users(`firstname`,`lastname`,`email`,`password`,`phone`,`user_status`) VALUES ('$first_name','$last_name','$email','$password','$phone','$user_status')"; exit;

		$userDetailQuery = $this->User->query("INSERT INTO mnst_users(`firstname`,`lastname`,`email`,`password`,`phone`,`user_status`) VALUES ('$first_name','$last_name','$email','$password','$phone','$user_status')");

		$result_array = array('success' => 1);

		$final_json = json_encode($result_array);

		return $final_json;

		

	}



	public function userExit(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$email = $this->request->data['email'];

		$loginDetail = $this->User->query("SELECT id,email FROM mnst_users where email = '$email'");

		if(count($loginDetail) > 0 && $loginDetail[0]['mnst_users']['email'] != ''){

			$loginDetail = array('existUser' => 1);

			$final_json = json_encode($loginDetail);

		}else{

			$loginDetail = array('newUser' => 1);

			$final_json = json_encode($loginDetail);

		}

		

		return $final_json;

		

	}



	public function getNavManu(){

		self::noView();

		$navDetail = $this->User->query("SELECT id,category_name,category_status FROM mnst_category WHERE category_status = 1");

		if(count($navDetail) > 0 && $navDetail[0]['mnst_category']['category_name'] != ''){

			$final_json = json_encode($navDetail);

		}else{

			$navDetail = array('noManues' => 0);

			$final_json = json_encode($navDetail);

		}

		return $final_json;

	}



	public function getBanners(){

		self::noView();

		$bannerDetail = $this->User->query("SELECT id,banner_name,banner_images,banner_url,banner_possion FROM mnst_advertising_banners");



		if(count($bannerDetail) > 0 && $bannerDetail[0]['mnst_advertising_banners']['banner_name'] != ''){

			$banner_final_array = array();

			$i = 0;

			foreach ($bannerDetail as $banerVal) {

				if($banerVal['mnst_advertising_banners']['banner_possion'] == 'right'){

					$banner_final_array['right'][$i]['id'] =$banerVal['mnst_advertising_banners']['id'];

					$banner_final_array['right'][$i]['banner_name'] =$banerVal['mnst_advertising_banners']['banner_name'];

					$banner_final_array['right'][$i]['banner_images'] =$banerVal['mnst_advertising_banners']['banner_images'];

					$banner_final_array['right'][$i]['banner_url'] =$banerVal['mnst_advertising_banners']['banner_url'];

					$banner_final_array['right'][$i]['banner_possion'] =$banerVal['mnst_advertising_banners']['banner_possion'];

					

				} else if($banerVal['mnst_advertising_banners']['banner_possion'] == 'left'){

					

					$banner_final_array['left'][$i]['id'] =$banerVal['mnst_advertising_banners']['id'];

					$banner_final_array['left'][$i]['banner_name'] =$banerVal['mnst_advertising_banners']['banner_name'];

					$banner_final_array['left'][$i]['banner_images'] =$banerVal['mnst_advertising_banners']['banner_images'];

					$banner_final_array['left'][$i]['banner_url'] =$banerVal['mnst_advertising_banners']['banner_url'];

					$banner_final_array['left'][$i]['banner_possion'] =$banerVal['mnst_advertising_banners']['banner_possion'];

					

				} else if($banerVal['mnst_advertising_banners']['banner_possion'] == 'top_center'){

					

					$banner_final_array['top_center'][$i]['id'] =$banerVal['mnst_advertising_banners']['id'];

					$banner_final_array['top_center'][$i]['banner_name'] =$banerVal['mnst_advertising_banners']['banner_name'];

					$banner_final_array['top_center'][$i]['banner_images'] =$banerVal['mnst_advertising_banners']['banner_images'];

					$banner_final_array['top_center'][$i]['banner_url'] =$banerVal['mnst_advertising_banners']['banner_url'];

					$banner_final_array['top_center'][$i]['banner_possion'] =$banerVal['mnst_advertising_banners']['banner_possion'];

					

				}

				$i++;

			}

			$final_json = json_encode($banner_final_array);

		}else{

			$bannerDetail = array('noManues' => 0);

			$final_json = json_encode($bannerDetail);

		}

		return $final_json;

	}

	public function getNewEvents(){

		self::noView();

		$eventsDetail = $this->User->query("SELECT id,event_name,event_city,event_description,event_address,event_date,event_status FROM mnst_new_event");

		if(count($eventsDetail) > 0 && $eventsDetail[0]['mnst_new_event']['event_name'] != ''){

			$final_json = json_encode($eventsDetail);

		}else{

			$eventsDetail = array('noEvents' => 0);

			$final_json = json_encode($eventsDetail);

		}

		return $final_json;

	}

	public function getNewNews(){

		self::noView();

		$newsDetail = $this->User->query("SELECT id,city_news,city,news_description,news_date,news_status FROM mnst_city_news");

		if(count($newsDetail) > 0 && $newsDetail[0]['mnst_city_news']['city_news'] != ''){

			$final_json = json_encode($newsDetail);

		}else{

			$newsDetail = array('noNews' => 0);

			$final_json = json_encode($newsDetail);

		}

		return $final_json;

	}

	public function getCommonPages(){

		self::noView();

		$pagesDetail = $this->User->query("SELECT id,common_about,common_faq,common_vision,common_mission,common_terms_conditions,common_contacts FROM mnst_common_pages");

		if(count($pagesDetail) > 0 && $pagesDetail[0]['mnst_common_pages']['common_about'] != ''){

			$final_json = json_encode($pagesDetail);

		}else{

			$pagesDetail = array('noPages' => 0);

			$final_json = json_encode($pagesDetail);

		}

		return $final_json;

	}



	public function getCategory(){

		self::noView();

		$categoryDetail = $this->User->query("SELECT id,category_name,category_status FROM mnst_category WHERE category_status = 1");

		if(count($categoryDetail) > 0 && $categoryDetail[0]['mnst_category']['category_name'] != ''){

			$final_json = json_encode($categoryDetail);

		}else{

			$categoryDetail = array('noCategory' => 0);

			$final_json = json_encode($categoryDetail);

		}

		return $final_json;

	}



	public function getSubcategory(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$category_id = $this->request->data['category'];

		$subCategoryDetail = $this->User->query("SELECT id,subcategory_name FROM mnst_subcategory WHERE category_id = $category_id AND subcategory_status = 1");

		if(count($subCategoryDetail) > 0 && $subCategoryDetail[0]['mnst_subcategory']['subcategory_name'] != ''){

			$final_json = json_encode($subCategoryDetail);

		}else{

			$subCategoryDetail = array('noSubCategory' => 0);

			$final_json = json_encode($subCategoryDetail);

		}

		return $final_json;

	}

	public function getSubNav(){

		self::noView();

		/*$addPostDetail = array('noStates' => $subNavDetail);

		$final_json = json_encode($addPostDetail);

		return $final_json;*/

		$subNavDetail = $this->User->query("SELECT ct.id, ct.category_name, sbc.id, sbc.subcategory_name FROM mnst_category AS ct INNER JOIN mnst_subcategory AS sbc ON ct.id = sbc.category_id");

		$i = 0;

		$final_subnav_array = array();

		foreach ($subNavDetail as $subNav) {

			$final_subnav_array[$subNav['ct']['category_name']][$i] = $subNav['sbc']['subcategory_name']; 

			$i++;

		}

		$addPostDetail = array('noStates' => $final_subnav_array);

		$final_json = json_encode($addPostDetail);

		return $final_json;

		if(count($final_subnav_array) > 0 && $final_subnav_array['St Louis']['0']!= ''){

			$final_json = json_encode($final_subnav_array);

		}else{

			$final_subnav_array = array('noSubCategory' => 0);

			$final_json = json_encode($final_subnav_array);

		}

		return $final_json;

	}



	public function getCountry(){

		self::noView();

		$subCountryDetail = $this->User->query("SELECT id,country_name FROM mnst_country WHERE country_status = 1");

		if(count($subCountryDetail) > 0 && $subCountryDetail[0]['mnst_country']['country_name'] != ''){

			$final_json = json_encode($subCountryDetail);

		}else{

			$subCountryDetail = array('noCountry' => 0);

			$final_json = json_encode($subCountryDetail);

		}

		return $final_json;

	}



	public function getStates(){

		self::noView();



		$country_id = $this->request->data['country'];

		$getStatesDetail = $this->User->query("SELECT id,states_name FROM mnst_states WHERE country_id = $country_id AND states_status = 1");

		if(count($getStatesDetail) > 0 && $getStatesDetail[0]['mnst_states']['states_name'] != ''){

			$final_json = json_encode($getStatesDetail);

		}else{

			$getStatesDetail = array('noStates' => $country_id);

			$final_json = json_encode($getStatesDetail);

		}

		return $final_json;

	}



	public function getAllStates(){

		self::noView();

		$getStatesDetail = $this->User->query("SELECT id,states_name FROM mnst_states");

		if(count($getStatesDetail) > 0 && $getStatesDetail[0]['mnst_states']['states_name'] != ''){

			$final_json = json_encode($getStatesDetail);

		}else{

			$getStatesDetail = array('noStates' => 0);

			$final_json = json_encode($getStatesDetail);

		}

		return $final_json;

	}



	public function addPost(){

		self::noView();

		/*$addPostDetail = array('noStates' => $_POST);

		$final_json = json_encode($addPostDetail);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$addPost = $this->request->data;

		$user_id = $addPost['user_id'];

		$post_name = $addPost['post_title'];

		$post_url = $addPost['post_website'];

		$post_image = $addPost['post_images'];

		$category_id = $addPost['post_category'];

		$sub_category_id = $addPost['post-subcategory'];

		$country_id = $addPost['post_country'];

		$state_id = $addPost['post_state'];

		$address = $addPost['post_address'];

		$mobile = $addPost['post_mobile'];

		$description = $addPost['post_description'];

		$created_at = date('Y-m-d H:i:s');



		$addPostDetail = $this->User->query("INSERT INTO mnst_user_posts(`create_by`,`post_name`,`post_image`,`post_url`,`catagory_id`,`sub_catagory_id`, `country_id`,`state_id`,`address`,`mobile_num`,`description`,`created_at`) VALUES ('$user_id', '$post_name','$post_image','$post_url','$category_id','$sub_category_id','$country_id','$state_id','$address','$mobile','$description','$created_at')");

			$addPostDetail = array('success' => "1");

			$final_json = json_encode($addPostDetail);

		

		return $final_json;

	}

	public function getPosts(){

		self::noView();

		/*$getPostsDetails = array('noPosts' => 0);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$post_var = $this->request->data;



		$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by ORDER BY upst.id DESC");

		$finalArray = array();

		$i = 0;

		foreach ($getPostsDetails as $getValue) {



			$finalArray[$i]['id'] = $getValue['upst']['id'];

			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];

			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);

			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];

			$finalArray[$i]['description'] = substr($getValue['upst']['description'], 0, 150);

			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));

			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];



			$i++;

		}

		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){

			$final_json = json_encode($finalArray);

		}else{

			$finalArray = array('noPosts' => 0);

			$final_json = json_encode($finalArray);

		}

		return $final_json;

	}



	public function userPostEdit(){

		self::noView();

		/*$getPostsDetails = array('noPosts' => 0);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$post_id = $this->request->data['post_id'];



		$getPostsDetails = $this->User->query("SELECT upst.id, upst.post_name, upst.post_image, upst.description, upst.address , upst.created_at, upst.post_url, ct.category_name, ct.id, sbct.subcategory_name, sbct.id, cn.country_name, cn.id, st.states_name, st.id FROM mnst_user_posts AS upst INNER JOIN mnst_category AS ct ON ct.id = upst.catagory_id INNER JOIN mnst_subcategory AS sbct ON sbct.id = upst.sub_catagory_id INNER JOIN mnst_country AS cn ON cn.id = upst.country_id INNER JOIN mnst_states AS st ON st.id = upst.state_id WHERE upst.id = $post_id");



		$finalArray = array();

		$i = 0;

		foreach ($getPostsDetails as $getValue) {



			$finalArray[$i]['id'] = $getValue['upst']['id'];

			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];

			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);

			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];

			$finalArray[$i]['description'] = $getValue['upst']['description'];

			$finalArray[$i]['address'] = $getValue['upst']['address'];

			$finalArray[$i]['category_name'] = $getValue['ct']['category_name'];

			$finalArray[$i]['category_id'] = $getValue['ct']['id'];

			$finalArray[$i]['subcategory_name'] = $getValue['sbct']['subcategory_name'];

			$finalArray[$i]['subcategory_id'] = $getValue['sbct']['id'];

			$finalArray[$i]['country_name'] = $getValue['cn']['country_name'];

			$finalArray[$i]['country_id'] = $getValue['cn']['id'];

			$finalArray[$i]['states_name'] = $getValue['st']['states_name'];

			$finalArray[$i]['states_id'] = $getValue['st']['id'];



			$i++;

		}

		

		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){

			$final_json = json_encode($finalArray);

		}else{

			$finalArray = array('noPosts' => 0);

			$final_json = json_encode($finalArray);

		}

		return $final_json;

	}

	public function update_post(){

		self::noView();

		/*$addPostDetail = array('noStates' => 0);

		$final_json = json_encode($addPostDetail);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$addPost = $this->request->data;

		$user_id = $addPost['user_id'];

		$post_name = $addPost['post_title'];

		$post_url = $addPost['post_website'];

		$post_image = $addPost['post_images'];

		$category_id = $addPost['post_category'];

		$sub_category_id = $addPost['post-subcategory'];

		$country_id = $addPost['post_country'];

		$state_id = $addPost['post_state'];

		$address = $addPost['post_address'];

		$mobile = $addPost['post_mobile'];

		$description = str_replace("'", ' ', $addPost['post_description']);

		$update_at = date('Y-m-d H:i:s');

		

		$addPostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_image` = '$post_image', `post_url` = '$post_url', `catagory_id` = '$category_id', `sub_catagory_id` = '$sub_category_id', `country_id` = '$country_id', `state_id` = '$state_id', `address` = '$address', `mobile_num` = '$mobile', `description` = '$description',  `updated_at` = '$update_at' WHERE id=$user_id");

			$addPostDetail = array('success' => "1");

			$final_json = json_encode($addPostDetail);

		

		return $final_json;

	}



	public function getPostsByCategory(){

			self::noView();

			/*$getPostsDetails = array('noPosts' => 0);

			$final_json = json_encode($getPostsDetails);

			return $final_json;*/

			header("Content-Type:application/json");

			$this->request->data = json_decode(file_get_contents('php://input'), true);

			$post_category = $this->request->data;

			if(isset($post_category['sort_by']) && $post_category['sort_by'] !== '') {

			 	$sort_by =  $post_category['sort_by'];

			 } else  {

			 	$sort_by = "DESC";

			 };

			$category_id = $post_category['category_id'];

			$page_no = (isset($post_category['pagination']) && $post_category['pagination'] > 1) ? ($post_category['pagination']-1) : "0";

			$from_limit = $page_no * 3;

			$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE catagory_id = $category_id ) as counts, (SELECT category_name FROM mnst_category WHERE id = $category_id) as category_name, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.catagory_id = $category_id ORDER BY upst.id $sort_by LIMIT $from_limit,3");



			$finalArray = array();

			$i = 0;



			foreach ($getPostsDetails as $getValue) {



				$finalArray[$i]['id'] = $getValue['upst']['id'];

				$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];	

				$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);

				$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];

				$finalArray[$i]['description'] = substr($getValue['upst']['description'], 0, 150);

				$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));

				$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];

				$finalArray[$i]['category_name'] = $getValue[0]['category_name'];

				$finalArray[$i]['counts'] = $getValue[0]['counts'];

				$i++;

			}



			if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){

				$final_json = json_encode($finalArray);

			}else{

				$getPostsDetails = $this->User->query("SELECT category_name FROM mnst_category WHERE id = $category_id");

				$finalArray[0]['category_name'] = $getPostsDetails[0]['mnst_category']['category_name'];

				$finalArray[0]['noPosts'] = '0';

				$finalArray = array('noPosts' => $finalArray);

				$final_json = json_encode($finalArray);

			}

			return $final_json;

		}

	public function getPostBySubCategory(){

		self::noView();

		/*$getPostsDetails = array('noPosts' => $sub_category);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$post_cat_subcat = $this->request->data;

		if(isset($post_cat_subcat['sort_by']) && $post_cat_subcat['sort_by'] !== '') {

		 	$sort_by =  $post_cat_subcat['sort_by'];

		 } else  {

		 	$sort_by = "DESC";

		 };

		$page_no = (isset($post_cat_subcat['pagination']) && $post_cat_subcat['pagination'] > 1) ? ($post_cat_subcat['pagination']-1) : "0";

		$from_limit = $page_no * 3;

		$category_id = $post_cat_subcat['category_id'];

		$sub_cat_id = $post_cat_subcat['sub_cat_id'];

		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE catagory_id = $category_id AND sub_catagory_id = $sub_cat_id) AS counts, (SELECT category_name FROM mnst_category WHERE id = $category_id) AS category_name,(SELECT subcategory_name FROM mnst_subcategory WHERE id = $sub_cat_id) AS subcategory_name, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.catagory_id = $category_id AND upst.sub_catagory_id = $sub_cat_id ORDER BY upst.id $sort_by LIMIT $from_limit,3");

		

		$finalArray = array();

		$i = 0;

		foreach ($getPostsDetails as $getValue) {



			$finalArray[$i]['id'] = $getValue['upst']['id'];

			$finalArray[$i]['subcategory_name'] = $getValue['upst']['subcategory_name'];

			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];

			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);

			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];

			$finalArray[$i]['description'] = substr($getValue['upst']['description'], 0, 150);

			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));

			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];

			$finalArray[$i]['subcategory_name'] = $getValue[0]['subcategory_name'];

			$finalArray[$i]['category_name'] = $getValue[0]['category_name'];

			$finalArray[$i]['counts'] = $getValue[0]['counts'];



			$i++;

		}



		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){

			$final_json = json_encode($finalArray);

		}else{

			$getPostsCategoryDetails = $this->User->query("SELECT category_name FROM mnst_category WHERE id = $category_id");



			$finalArray[0]['category_name'] = $getPostsCategoryDetails[0]['mnst_category']['category_name'];



			$getPostsSubcategoryDetails = $this->User->query("SELECT subcategory_name FROM mnst_subcategory WHERE id = $sub_cat_id");

			$finalArray[0]['subcategory_name'] = $getPostsSubcategoryDetails[0]['mnst_subcategory']['subcategory_name'];



			$finalArray[0]['noPosts'] = '0';

			

			$finalArray = array('noPosts' => $finalArray);

			$final_json = json_encode($finalArray);

		}

		return $final_json;

	}



	public function getPostsDescription(){

		self::noView();

		/*$getPostsDetails = array('noPosts' => 0);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$post_id = $this->request->data['id'];



		$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by, upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, cn.country_name, st.states_name, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by INNER JOIN mnst_country AS cn ON cn.id = upst.country_id INNER JOIN mnst_states AS st ON st.id = upst.state_id WHERE upst.id = $post_id");

		$finalArray = array();

		$i = 0;

		foreach ($getPostsDetails as $getValue) {



			$finalArray[$i]['id'] = $getValue['upst']['id'];

			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];

			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);

			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];

			$finalArray[$i]['description'] = substr($getValue['upst']['description'], 0, 150);

			$finalArray[$i]['country_name'] = $getValue['cn']['country_name'];

			$finalArray[$i]['states_name'] = $getValue['st']['states_name'];

			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));

			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];



			$i++;

		}

		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){

			$final_json = json_encode($finalArray);

		}else{

			$finalArray = array('noPosts' => 0);

			$final_json = json_encode($finalArray);

		}

		return $final_json;

	}



	public function accountInfo(){

		self::noView();

		/*$getPostsDetails = array('noPosts' => 0);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$user_id = $this->request->data['id'];

		$getUserDetails = $this->User->query("SELECT usr.id, usr.firstname, usr.lastname, usr.email, usr.username, usr.phone, usr.created_at, cn.id, cn.country_name, st.id, st.states_name, usr.city_id, usr.user_image, usr.gender, usr.address, usr.date_of_birth, usr.user_message, usr.user_status FROM mnst_users AS usr LEFT JOIN mnst_country AS cn ON usr.country_id = cn.id LEFT JOIN mnst_states AS st ON usr.state_id = st.id WHERE usr.id = $user_id");

		

		if(count($getUserDetails) > 0 && $getUserDetails[0]['usr']['firstname'] != ''){

			$final_json = json_encode($getUserDetails);

		}else{

			$getUserDetails = array('noPosts' => 0);

			$final_json = json_encode($getUserDetails);

		}

		return $final_json;

	}



	public function userPostList(){

		self::noView();

		/*$getPostsDetails = array('noPosts' => $this->request->data);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$post_user_id = $this->request->data;

		$user_id = $post_user_id['id'];

		$post_category = $post_user_id['category_id'];

		if($post_category == 'allPosts'){

			$post_cat_condition = " ";

			$category_name_condition = " ";

			$post_count_user = "(SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id) as counts";

		}else{

			$category_name_condition = "(SELECT category_name FROM mnst_category WHERE id = $post_category) AS category_name,";

			$post_cat_condition = " AND upst.catagory_id = $post_category"; 

			$post_count_user = "(SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND catagory_id = $post_category) as counts";

		}

		if(isset($post_user_id['sort_by']) && $post_user_id['sort_by'] !== '') {

		 	$sort_by =  $post_user_id['sort_by'];

		 } else  {

		 	$sort_by = "DESC";

		 };

		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";

		$from_limit = $page_no * 3;

		

		$getPostsDetails = $this->User->query("SELECT $post_count_user, $category_name_condition CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE usr.id = $user_id $post_cat_condition ORDER BY upst.id $sort_by LIMIT $from_limit,3");

		

		$finalArray = array();

		$i = 0;

		foreach ($getPostsDetails as $getValue) {



			$finalArray[$i]['id'] = $getValue['upst']['id'];

			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];

			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);

			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];

			$finalArray[$i]['description'] = substr($getValue['upst']['description'], 0, 150);

			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));

			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];

			$finalArray[$i]['counts'] = $getValue[0]['counts'];

			$finalArray[$i]['category_name'] = $getValue[0]['category_name'];



			$i++;

		}



		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){



			$final_json = json_encode($finalArray);

		}else{

			$getPostsDetails = $this->User->query("SELECT id FROM mnst_user_posts WHERE create_by = $user_id");

			$finalArray[0]['id'] = $getPostsDetails[0]['mnst_user_posts']['id'];

			$getPostsCategoryDetails = $this->User->query("SELECT category_name FROM mnst_category WHERE id = $post_category");

				$finalArray[0]['category_name'] = $getPostsCategoryDetails[0]['mnst_category']['category_name'];

			$finalArray[0]['noPosts'] = '0';

			$finalArray = array('noPosts' => $finalArray);

			$final_json = json_encode($finalArray);

		}

		return $final_json;

	}

	public function updateAccountInfo(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$addUser = $this->request->data;

		$user_id = $addUser['user_id'];

		$firstname = $addUser['firstname'];

		$lastname = $addUser['lastname'];

		$username = $addUser['username'];

		$user_image = $addUser['user_image'];

		//$email = $addUser['email'];

		$country = $addUser['country'];

		$state = $addUser['state'];

		$city = $addUser['city'];

		$address = $addUser['address'];

		$gender = $addUser['gender'];

		$mobile = $addUser['mobile'];

		$date_of_birth = $addUser['date_of_birth'];

		$description = $addUser['description'];

		$updated_at = date('Y-m-d H:i:s');



		$addPostDetail = $this->User->query("UPDATE mnst_users SET `firstname` = '$firstname', `lastname` = '$lastname', `username` = '$username', `phone` = '$mobile', `username` = '$username',  `country_id` = '$country', `state_id` = '$state', `city_id` = '$city', `user_image` = '$user_image', `address` ='$address', `gender` = '$gender' , `date_of_birth` = '$date_of_birth', `user_message` = '$description', `updated_at` = '$updated_at' WHERE id = '$user_id'");

			$addPostDetail = array('success' => "1");

			$final_json = json_encode($addPostDetail);

		

		return $final_json;

	}



	public function getPostCategoryForFilter(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$post_category = $this->request->data['category_id'];

		/*$getPostsDetails = array('noPosts' => $post_category);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		$subCategoryDetail = $this->User->query("SELECT id,category_id,subcategory_name,subcategory_status FROM mnst_subcategory WHERE category_id = $post_category AND subcategory_status = 1");

		if(count($subCategoryDetail) > 0 && $subCategoryDetail[0]['mnst_subcategory']['subcategory_name'] != ''){

			$final_json = json_encode($subCategoryDetail);

		}else{

			$categoryDetail = array('noCategory' => 0);

			$final_json = json_encode($categoryDetail);

		}

		return $final_json;

	}

	public function userPostExist(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$post_exist = $this->request->data;



		$post_name = $post_exist['post_name'];

		if($post_name != ''){

		$existPostsDetail = $this->User->query("SELECT count(id) as postCnt FROM mnst_user_posts WHERE post_name = '$post_name'");

			if($existPostsDetail[0][0]['postCnt'] > 0 ){

				$existPostsDetail = array('existUser' => 1);

				$final_json = json_encode($existPostsDetail);

			}else{

				$existPostsDetail = array('existUser' => 0);

				$final_json = json_encode($existPostsDetail);

			}

		} 

		return $final_json;

		

	}

	public function updatePassword(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$change_pswd = $this->request->data;

		$user_id =  $change_pswd['change_pswd_user_id'];

		$old_password =  base64_encode($change_pswd['old_password']);

		$new_password =  base64_encode($change_pswd['new_password']);

		if($old_password != ''){

		$existPasswordDetail = $this->User->query("SELECT count(id) as usrCnt FROM mnst_users WHERE password = '$old_password'");

			if($existPasswordDetail[0][0]['usrCnt'] > 0 ){

				$existPasswordDetail = $this->User->query("UPDATE mnst_users SET `password` = '$new_password' WHERE id = $user_id");

				$existPasswordDetail = array('existPassword' => 1);

				$final_json = json_encode($existPasswordDetail);

			}else{

				$existPasswordDetail = array('existPassword' => 0);

				$final_json = json_encode($existPasswordDetail);

			}

		} else {

				$existPasswordDetail = array('existUser' => 0);

				$final_json = json_encode($existPasswordDetail);

			}

		return $final_json;

		

	}

	public function userForgotPassword(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$email = $this->request->data['acc_email'];



		$loginDetail = $this->User->query("SELECT id,CONCAT(firstname,' ',lastname) AS creted_by, email FROM mnst_users where email = '$email'");

		

		if(count($loginDetail) > 0 && $loginDetail[0]['mnst_users']['email'] != ''){

			$loginDetail = array('existEmail' => 1,'username' => $loginDetail[0][0]['creted_by']);

			$final_json = json_encode($loginDetail);

		}else{

			$loginDetail = array('existEmail' => 0);

			$final_json = json_encode($loginDetail);

		}

		

		return $final_json;

		

	}



	public function upadateForgotPassword(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$change_pswd = $this->request->data;



		$email =  $change_pswd['change_pswd_user_email'];

		$new_password =  base64_encode($change_pswd['new_password']);

		if($new_password != ''){

		$existEmailDetail = $this->User->query("SELECT count(id) as usrCnt FROM mnst_users WHERE email = '$email'");



			if($existEmailDetail[0][0]['usrCnt'] > 0 ){

				$existEmailDetail = $this->User->query("UPDATE mnst_users SET `password` = '$new_password' WHERE email = '$email'");

				$existEmailDetail = array('updatePassword' => 1);

				$final_json = json_encode($existEmailDetail);

			}else{

				$existEmailDetail = array('updatePassword' => 0);

				$final_json = json_encode($existEmailDetail);

			}

		} else {

				$existEmailDetail = array('updatePassword' => 0);

				$final_json = json_encode($existEmailDetail);

			}

		return $final_json;

		

	}

	public function updateAccountStatus(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$change_pswd = $this->request->data;



		$email =  $change_pswd['email'];

		if($email != ''){

		$existEmailDetail = $this->User->query("SELECT count(id) as usrCnt FROM mnst_users WHERE email = '$email'");



			if($existEmailDetail[0][0]['usrCnt'] > 0 ){

				$existEmailDetail = $this->User->query("UPDATE mnst_users SET `user_status` = 1 WHERE email = '$email'");

				$existEmailDetail = array('updateStatus' => 1);

				$final_json = json_encode($existEmailDetail);

			}

		return $final_json;

		}

		

	}

	public function searchDetails(){

		self::noView();

		/*$getPostsDetails = array('noPosts' => 0);

		$final_json = json_encode($getPostsDetails);

		return $final_json;*/

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$search_val = $this->request->data;

		$post_search = $search_val['srch_term'];

		$page_no = (isset($search_val['pagination']) && $search_val['pagination'] > 1) ? ($search_val['pagination']-1) : "0";

		$from_limit = $page_no * 3;

		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE post_name LIKE '%$post_search%' ) AS counts, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.post_name LIKE '%$post_search%' ORDER BY upst.id DESC LIMIT $from_limit,3");



		$finalArray = array();

		$i = 0;

		foreach ($getPostsDetails as $getValue) {



			$finalArray[$i]['id'] = $getValue['upst']['id'];

			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];

			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);

			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];

			$finalArray[$i]['description'] = substr($getValue['upst']['description'], 0, 150);

			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));

			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];

			$finalArray[$i]['counts'] = $getValue[0]['counts'];



			$i++;

		}

		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){

			$final_json = json_encode($finalArray);

		}else{

			$finalArray[0]['noPosts'] = '0';

			$finalArray = array('noPosts' => $finalArray);

			$final_json = json_encode($finalArray);

		}

		return $final_json;

	}

	public function addreg(){

		self::noView();

		header("Content-Type:application/json");

		$this->request->data = json_decode(file_get_contents('php://input'), true);

		$test_val = $this->request->data;

		$firstname = $test_val['first_name'];

		$lastname = $test_val['last_name'];

		$getPostsDetails = $this->User->query("INSERT INTO test_table(`firstname`,`lastname`) VALUES('$firstname','$lastname')");

		$getDetails = $this->User->query("SELECT * FROM test_table ORDER BY id DESC LIMIT 1");

		$getDataDetails = array('data' => $getDetails);

		$final_json = json_encode($getDataDetails);

		return $final_json;



	} 

	public function getreg(){

		self::noView();

		$getDetails = $this->User->query("SELECT * FROM test_table");

		$getDataDetails = array('data' => $getDetails);

		$final_json = json_encode($getDataDetails);

		return $final_json;



	} 

	//curl example for DST

	public function testcurls(){

		self::noView();

		header("Content-Type:application/json");

		$data = json_decode(file_get_contents('php://input'), true);

		return $data;

		$insertcurlvalue = $this->User->query("INSERT INTO test_curls(`usename`,`email`) VALUES ()");



		$getDetails = $this->User->query("SELECT * FROM test_curls");

		$getDataDetails = array('data' => $getDetails);

		$final_json = json_encode($getDataDetails);

		return $final_json;



	} 

	public function noView(){

		$this->autoRender = false;

		Configure::write('debug',0);

		$this->layout = null;

	}

}


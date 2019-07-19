<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $Use
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
		$loginDetail = $this->User->query("SELECT CONCAT(firstname,' ',lastname) AS fullname, id, firstname, lastname, email, user_image FROM mnst_users WHERE email = '$email' AND password = '$password' AND email_status = 1 AND user_status = 1");
		$final_json = json_encode($loginDetail);
		return $final_json;
		
	}
	public function registerDetails(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$userDetail = $this->request->data;
		$email = $userDetail['email'];
		$first_name = $userDetail['first_name'];
		$last_name = $userDetail['last_name'];
		$user_name = $first_name.' '.$last_name;
		$password =  base64_encode($userDetail['password']);
		/*$phone = $userDetail['phone'];*/
		$user_status = 1;
		$userDetailQuery = $this->User->query("INSERT INTO mnst_users(`firstname`,`lastname`,`username`,`email`,`password`,`user_status`) VALUES ('$first_name','$last_name','$user_name','$email','$password','$user_status')");
		$getDetails = $this->User->query("SELECT id FROM mnst_users ORDER BY id DESC LIMIT 1");
		$result_array = array('success' => $getDetails);
		$final_json = json_encode($result_array);
		echo $final_json; exit;
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
	public function contactUs(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$contactDetail = $this->request->data;
		$username = $contactDetail['username'];
		$email = $contactDetail['email'];
		$description = $contactDetail['description'];
		$created_at = date('Y-m-d H:i:s');
 if($username !='' && $email !=''){
	$contactDetailQuery = $this->User->query("INSERT INTO mnst_contact_us(`username`,`email`,`description`,`created_at`) VALUES ('$username','$email','$description','$created_at')");
	$getDetails = $this->User->query("SELECT id FROM mnst_contact_us WHERE email = '$email' ORDER BY id DESC LIMIT 1");
 }
		$result_array = array('success' => $getDetails);
		$final_json = json_encode($result_array);
		echo $final_json; exit;
			
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
public function getSubCategoris(){
		self::noView();
		$subCatDetail = $this->User->query("SELECT sc.id as scid,sc.subcategory_name,sc.category_id,sc.subcategory_status,ct.id as cid,ct.category_name FROM mnst_subcategory AS sc INNER JOIN mnst_category AS ct ON sc.category_id = ct.id WHERE sc.subcategory_status = 1");
		$final_subcat_array = array();
		$i = 0;
		foreach ($subCatDetail as $getValue) {
			$finalArray[$i]['id'] = $getValue['sc']['scid'];
			$finalArray[$i]['subcategory_name'] = $getValue['sc']['subcategory_name'];
			$finalArray[$i]['category_id'] =  $getValue['sc']['category_id'];
			$finalArray[$i]['category_name'] =  $getValue['ct']['category_name'];
			$i++;
		}
		if(count($finalArray) > 0 && $finalArray[0]['subcategory_name'] != ''){
			$final_json = json_encode($finalArray);
		}else{
			$finalArray = array('noPosts' => 0);
			$final_json = json_encode($finalArray);
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
		$eventsDetail = $this->User->query("SELECT id,event_name,url_name,event_city,event_description,event_address,event_date,event_status FROM mnst_new_event ORDER BY id DESC");
		$i = 0;
		foreach ($eventsDetail as $value) {
			$eventsDetail[$i]['mnst_new_event']['type'] = 'st-louis-news';
			$i++;
		}
		if(count($eventsDetail) > 0 && $eventsDetail[0]['mnst_new_event']['event_name'] != ''){
			$final_json = json_encode($eventsDetail);
		}else{
			$eventsDetail = array('noEvents' => 0);
			$final_json = json_encode($eventsDetail);
		}
		return $final_json;
	}
public function getFlashnews(){
		self::noView();
		$post_cat_subcat = $this->request->data;
		$page_no = (isset($post_cat_subcat['pagination']) && $post_cat_subcat['pagination'] > 1) ? ($post_cat_subcat['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$eventsDetail = $this->User->query("SELECT (SELECT count(id) FROM mnst_new_event) AS counts,mnst.id,mnst.event_name,mnst.event_city,mnst.event_description,mnst.event_address,mnst.event_date,mnst.event_status FROM mnst_new_event AS mnst ORDER BY mnst.id LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($eventsDetail as $value) {
			$eventsDetail[$i]['mnst']['type'] ='st-louis-news';
			$finalArray[$i]['id'] = $value['mnst']['id'];
			$finalArray[$i]['event_name'] = $value['mnst']['event_name'];
			$finalArray[$i]['counts'] = $value[0]['counts'];
		/*$final_json = json_encode($finalArray[$i]['counts']);
		echo $final_json; exit;*/
			$i++;
		}
		if(count($finalArray) > 0 && $finalArray[0]['event_name'] != ''){
			$final_json = json_encode($eventsDetail);
		}else{
			$eventsDetail = array('noEvents' => 0);
			$final_json = json_encode($eventsDetail);
		}
		return $final_json;
	}

	public function getStateId(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$location_data = $this->request->data;
		$state_name = $location_data['state_name'];      
		$finalArray = array();
		$getStateId = $this->User->query("SELECT id,states_name FROM mnst_states WHERE states_name = '$state_name'");
		
		$finalArray['state_id'] = $getStateId[0]['mnst_states']['id'];
		$final_json = json_encode($finalArray);
		return $final_json;
	} 

	public function getCityId(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$location_data = $this->request->data;
		$state_id = $location_data['state_id'];
		$city_name = $location_data['city_name'];

		$finalArray = array();
		$getCityId = $this->User->query("SELECT id,city_name FROM mnst_city WHERE states_id = $state_id AND city_name = '$city_name'");
		
		$finalArray['city_id'] = $getCityId[0]['mnst_city']['id'];
		$final_json = json_encode($finalArray);
		return $final_json;
	}
	
	public function getNewNews(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$location = $this->request->data;
		$city_id = $location['city_id'];
		
		$newsDetail = $this->User->query("SELECT musrp.id, musrp.post_name, musrp.url_name, musrp.catagory_id, musrp.post_image, mcat.category_name, musrp.sub_catagory_id, msbct.subcategory_name,musrp.description,musrp.address,musrp.street,musrp.city_id,musrp.state_id,mncn.country_name, mnst.states_name, mnct.city_name,musrp.city,musrp.country, musrp.created_at, usr.firstname,usr.lastname,usr.username,usr.user_image, musrpd.price  FROM mnst_user_posts AS musrp INNER JOIN mnst_category AS mcat ON mcat.id = musrp.catagory_id INNER JOIN mnst_subcategory AS msbct ON msbct.id = musrp.sub_catagory_id INNER JOIN mnst_country AS mncn ON mncn.id = musrp.country_id INNER JOIN mnst_states AS mnst ON mnst.id = musrp.state_id INNER JOIN mnst_city AS mnct ON mnct.id = musrp.city_id LEFT JOIN mnst_users as usr ON usr.id = musrp.create_by LEFT JOIN mnst_user_post_details as musrpd ON musrpd.post_id = musrp.id WHERE musrp.city_id = $city_id AND musrp.status = 1 ORDER BY musrp.created_at DESC LIMIT 12");

		$final_array = array();
		if(count($newsDetail) > 0 && $newsDetail[0]['musrp']['post_name'] != ''){
			
			foreach ($newsDetail as $key => $value) {
				$final_array['mnst_just_new'][$key]['id']  = $value['musrp']['id'];
				$final_array['mnst_just_new'][$key]['post_name']  = $value['musrp']['post_name'];
				$final_array['mnst_just_new'][$key]['url_name']  = $value['musrp']['url_name'];
				$final_array['mnst_just_new'][$key]['catagory_id']  = $value['musrp']['catagory_id'];
				$final_array['mnst_just_new'][$key]['sub_catagory_id']  = $value['musrp']['sub_catagory_id'];
				$final_array['mnst_just_new'][$key]['address']  = $value['musrp']['address'];
				$final_array['mnst_just_new'][$key]['street']  = $value['musrp']['street'];
				$final_array['mnst_just_new'][$key]['city_id']  = $value['musrp']['city_id'];
				$final_array['mnst_just_new'][$key]['city_name']  = $value['mnct']['city_name'];
				$final_array['mnst_just_new'][$key]['states_name']  = $value['mnst']['states_name'];
				$final_array['mnst_just_new'][$key]['country_id']  = $value['mncn']['country_id'];
				$final_array['mnst_just_new'][$key]['city']  = $value['musrp']['city'];
				$final_array['mnst_just_new'][$key]['country']  = $value['musrp']['country'];
				$final_array['mnst_just_new'][$key]['post_image'] = explode(",", $value['musrp']['post_image']);
				$final_array['mnst_just_new'][$key]['description']  = $value['musrp']['description'];
				$final_array['mnst_just_new'][$key]['user_firstname']  = $value['usr']['firstname'];
				$final_array['mnst_just_new'][$key]['user_lastname']  = $value['usr']['lastname'];
				$final_array['mnst_just_new'][$key]['user_username']  = $value['usr']['username'];
				$final_array['mnst_just_new'][$key]['user_image']  = $value['usr']['user_image'];
				$final_array['mnst_just_new'][$key]['price']  = $value['musrpd']['price'];
				$final_array['mnst_just_new'][$key]['created_at']  = date('d M Y',strtotime($value['musrp']['created_at']));
				$final_array['mnst_just_new'][$key]['category_name']  = $value['mcat']['category_name'];
				$final_array['mnst_just_new'][$key]['subcategory_name']  = $value['msbct']['subcategory_name']; 
			}
			$final_json = json_encode($final_array);
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
	public function getSlider(){
		self::noView();
		$sliderDetails = $this->User->query("SELECT slider_image,slider_title FROM mnst_slider ORDER BY id DESC LIMIT 3");
		if(count($sliderDetails) > 0 && $sliderDetails[0]['mnst_slider']['slider_image'] != ''){
			$final_json = json_encode($sliderDetails);
		}else{
			$sliderDetails = array('noCategory' => 0);
			$final_json = json_encode($sliderDetails);
		}
		return $final_json;
	}
	public function homePageTopAd(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_home_ads WHERE ad_place = 1 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_home_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function homeRighSidetAd1(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_home_ads WHERE ad_place = 2 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_home_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function homeRighSidetAd2(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_home_ads WHERE ad_place = 3 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_home_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function homeRighSidetAd3(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_home_ads WHERE ad_place = 4 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_home_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function homeRighSidetAd4(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_home_ads WHERE ad_place = 5 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_home_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function homeRighSidetAd5(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_home_ads WHERE ad_place = 6 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_home_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function readMoreadsTop(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_readmore_ads WHERE ad_place = 1 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_readmore_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function readMoreRightAds1(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_readmore_ads WHERE ad_place = 2 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_readmore_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function readMoreRightAds2(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_readmore_ads WHERE ad_place = 3 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_readmore_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function readMoreRightAds3(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_readmore_ads WHERE ad_place = 4 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_readmore_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function readMoreRightAds4(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_readmore_ads WHERE ad_place = 5 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_readmore_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function readMoreRightAds5(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_readmore_ads WHERE ad_place = 6 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_readmore_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function myPostAdsTop(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_myposts_ads WHERE ad_place = 1 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_myposts_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function myPostRightAds1(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_myposts_ads WHERE ad_place = 2 AND status = 1 ORDER BY id DESC LIMIT 1 ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_myposts_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function myPostRightAds2(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_myposts_ads WHERE ad_place = 3 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_myposts_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function myPostRightAds3(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_myposts_ads WHERE ad_place = 4 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_myposts_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function myPostRightAds4(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_myposts_ads WHERE ad_place = 5 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_myposts_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function myPostRightAds5(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_place FROM mnst_myposts_ads WHERE ad_place = 6 AND status = 1 ORDER BY id DESC ");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_myposts_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function topAds(){
		self::noView();
		
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$sc_id = $adsData['sub_cat_id'];
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_page,ad_place FROM mnst_ads WHERE ad_page = $sc_id AND ad_place = 1 ORDER BY id DESC LIMIT 1");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function rightsideAdone(){
		self::noView();
		
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$sc_id = $adsData['sub_cat_id'];
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_page,ad_place FROM mnst_ads WHERE ad_page = $sc_id AND ad_place = 2 ORDER BY id DESC LIMIT 1");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function rightsideAdtwo(){
		self::noView();
		
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$sc_id = $adsData['sub_cat_id'];
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_page,ad_place FROM mnst_ads WHERE ad_page = $sc_id AND ad_place = 3 ORDER BY id DESC LIMIT 1");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function rightsideAdthree(){
		self::noView();
		
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$sc_id = $adsData['sub_cat_id'];
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_page,ad_place FROM mnst_ads WHERE ad_page = $sc_id AND ad_place = 4 ORDER BY id DESC LIMIT 1");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function rightsideAdfour(){
		self::noView();
		
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$sc_id = $adsData['sub_cat_id'];
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_page,ad_place FROM mnst_ads WHERE ad_page = $sc_id AND ad_place = 5 ORDER BY id DESC LIMIT 1");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function rightsideAdfive(){
		self::noView();
		
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$adsData = $this->request->data;
		$adsDetail = array('noAds' => $addPost);
		$final_json = json_encode($adsDetail);
		$sc_id = $adsData['sub_cat_id'];
		$adsDetails = $this->User->query("SELECT id,ad_image,ad_title,ad_page,ad_place FROM mnst_ads WHERE ad_page = $sc_id AND ad_place = 6 ORDER BY id DESC LIMIT 1");
		if(count($adsDetails) > 0 && $adsDetails[0]['mnst_ads']['ad_image'] != ''){
			$final_json = json_encode($adsDetails);
		}else{
			$adsDetails = array('noCategory' => 0);
			$final_json = json_encode($adsDetails);
		}
		return $final_json;
	}
	public function getCategory(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$addPost = $this->request->data;
		$adminDetail = array('noCategory' => $addPost);
		$final_json = json_encode($adminDetail);
		$admin_user_id = $addPost['admin_user_id'];
		if($admin_user_id == 121 || $admin_user_id == 122){
			
			$categoryDetail = $this->User->query("SELECT id,category_name,category_status FROM mnst_category WHERE category_status = 1");
		}else{
			
			$categoryDetail = $this->User->query("SELECT id,category_name,category_status FROM mnst_category WHERE category_status = 1 ");		
		}
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
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$country_id = $this->request->data['country'];
		$getStatesDetail = $this->User->query("SELECT id,states_name FROM mnst_states WHERE country_id = $country_id AND states_status = 1 AND id = 26");
		if(count($getStatesDetail) > 0 && $getStatesDetail[0]['mnst_states']['states_name'] != ''){
			$final_json = json_encode($getStatesDetail);
		}else{
			$getStatesDetail = array('noStates' => $country_id);
			$final_json = json_encode($getStatesDetail);
		}
		return $final_json;
	}
	public function getCity(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$state_id = $this->request->data['state'];
		$getCityDetail = $this->User->query("SELECT id,city_name FROM mnst_city WHERE states_id = $state_id AND city_status = 1");
		if(count($getCityDetail) > 0 && $getCityDetail[0]['mnst_city']['city_name'] != ''){
			$final_json = json_encode($getCityDetail);
		}else{
			$getCityDetail = array('noCity' => $country_id);
			$final_json = json_encode($getCityDetail);
		}
		return $final_json;
	}
	public function getAllStates(){
		self::noView();
		$getStatesDetail = $this->User->query("SELECT id,states_name FROM mnst_states WHERE id = 5");
		if(count($getStatesDetail) > 0 && $getStatesDetail[0]['mnst_states']['states_name'] != ''){
			$final_json = json_encode($getStatesDetail);
		}else{
			$getStatesDetail = array('noStates' => 0);
			$final_json = json_encode($getStatesDetail);
		}
		return $final_json;
	}
	public function getAllCities(){
		self::noView();
		$getCityDetail = $this->User->query("SELECT id,city_name FROM mnst_city WHERE states_id = 5 LIMIT 15");
		if(count($getCityDetail) > 0 && $getCityDetail[0]['mnst_city']['city_name'] != ''){
			$final_json = json_encode($getCityDetail);
		}else{
			$getCityDetail = array('noCity' => 0);
			$final_json = json_encode($getCityDetail);
		}
		return $final_json;
	}
	public function getMetas(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$metaPost = $this->request->data;
		$metasDetail = array('noMetas' => $addPost);
		$final_json = json_encode($metasDetail);
		$meta_id = $metaPost['sub_cat_id'];
		$metaDetails = $this->User->query("SELECT id,page_name,title,description,keywords FROM mnst_metas WHERE id = $meta_id");
		if(count($metaDetails) > 0 && $metaDetails[0]['mnst_metas']['page_name'] != ''){
			$final_json = json_encode($metaDetails);
		}else{
			$metaDetails = array('noCategory' => 0);
			$final_json = json_encode($metaDetails);
		}
		return $final_json;
	}
	public function addPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$addPost = $this->request->data;
		$addPostDetail = array('noStates' => $addPost);
		$final_json = json_encode($addPostDetail);
		$user_id = $addPost['user_id'];
		$post_name = str_replace("'", "",$addPost['post_title']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($post_name, 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$post_url = $addPost['post_website'];
		$post_image = $addPost['post_images'];
		$category_id = $addPost['post_category'];
		$sub_category_id = $addPost['post-subcategory'];
		$email = $addPost['post_email'];
		$address = str_replace("'", "",$addPost['post_address']);
		$mobile = $addPost['post_mobile'];
		$phone_national_code = $addPost['phone_national_code'];
		$description = str_replace("'", "",$addPost['post_description']);
		$created_at = date('Y-m-d H:i:s');
		$addPostDetail = $this->User->query("INSERT INTO mnst_user_posts(`create_by`,`post_name`,`url_name`,`post_image`,`post_url`,`catagory_id`,`sub_catagory_id`,`post_email`,`address`,`mobile_num`,`phone_national_code`,`description`,`created_at`) VALUES ('$user_id', '$post_name','$url_name','$post_image','$post_url','$category_id','$sub_category_id','$email','$address','$mobile','$phone_national_code' ,'$description','$created_at')");
		$addPostDetail = array('success' => "1");
		$final_json = json_encode($addPostDetail);
		return $final_json;
	}
	public function deletePost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$deletePost = $this->request->data;
		$deletePostDetail = array('noStates' => $deletePost);
		$final_json = json_encode($deletePostDetail);
		$post_id = $deletePost['post_id'];
		$deletePostDetail = $this->User->query("DELETE FROM mnst_user_posts WHERE id = $post_id");
			$deletePostDetail = array('success' => "1");
			$final_json = json_encode($deletePostDetail);
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
		$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.status = 1 ORDER BY upst.id DESC");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
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
		$getPostsDetails = $this->User->query("SELECT upst.id, upst.post_name, upst.post_image, upst.description,upst.post_email, upst.address, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, ct.category_name, ct.id ,sbct.subcategory_name, sbct.id  FROM mnst_user_posts AS upst LEFT JOIN mnst_category AS ct ON ct.id = upst.catagory_id INNER JOIN mnst_subcategory AS sbct ON sbct.id = upst.sub_catagory_id WHERE upst.status = 1 AND upst.id = $post_id");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['post_email'] = $getValue['upst']['post_email'];
			$finalArray[$i]['address'] = $getValue['upst']['address'];
			$finalArray[$i]['category_name'] = $getValue['ct']['category_name'];
			$finalArray[$i]['category_id'] = $getValue['ct']['id'];
			$finalArray[$i]['subcategory_name'] = $getValue['sbct']['subcategory_name'];
			$finalArray[$i]['subcategory_id'] = $getValue['sbct']['id'];
			$finalArray[$i]['phone_national_code'] = $getValue['upst']['phone_national_code'];
			$finalArray[$i]['mobile_num'] = $getValue['upst']['mobile_num']; 
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
		/*header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$addPostDetail = array('noStates' => $this->request->data);
		$final_json = json_encode($addPostDetail);
		return $final_json; exit;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$addPost = $this->request->data;
		$user_id = $addPost['user_id'];
		$post_id = $addPost['post_id'];
		$post_name = str_replace("'", ' ', $addPost['post_title']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($post_name, 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$post_url = $addPost['post_website'];
		$post_image = $addPost['post_images'];
		/*$category_id = $addPost['post_category'];*/
		/*$sub_category_id = $addPost['post-subcategory'];*/
		$phone_national_code = $addPost['phone_national_code'];
		$email = $addPost['post_email'];
		$address = str_replace("'", '', $addPost['post_address']);
		$mobile = $addPost['post_mobile'];
		$description = str_replace("'", ' ', $addPost['post_description']);
		$update_at = date('Y-m-d H:i:s');
		$status = 2;
		$info = pathinfo($post_image);
 
		if(isset( $addPost['post_images']) &&  $addPost['post_images'] != '' && $info["extension"] != ""){
		$addPostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$post_name',`url_name` = '$url_name',`post_image` = '$post_image', `post_url` = '$post_url', `phone_national_code` = '$phone_national_code',`post_email` = '$email', `address` = '$address', `mobile_num` = '$mobile', `description` = '$description',`status` = '$status',`created_at` = '$update_at',`updated_at` = '$update_at' WHERE id = '$post_id' AND create_by = '$user_id'");
		} else {
			$addPostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$post_name',`url_name` = '$url_name',`post_url` = '$post_url', `phone_national_code` = '$phone_national_code',`post_email` = '$email', `address` = '$address', `mobile_num` = '$mobile', `description` = '$description',`status` = '$status',`created_at` = '$update_at',`updated_at` = '$update_at' WHERE id = '$post_id' AND create_by = '$user_id'");
		}
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
			$from_limit = $page_no * 5;
			$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE catagory_id = $category_id AND status = 1 ) as counts, (SELECT category_name FROM mnst_category WHERE id = $category_id) as category_name, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.catagory_id = $category_id AND upst.status = 1 ORDER BY upst.id $sort_by LIMIT $from_limit,5");
			$finalArray = array();
			$i = 0;
			foreach ($getPostsDetails as $getValue) {
				$finalArray[$i]['id'] = $getValue['upst']['id'];
				$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];	
				$finalArray[$i]['for_url'] = $getValue['upst']['post_name'];
				$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
				$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
				$finalArray[$i]['description'] = $getValue['upst']['description'];
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
		$from_limit = $page_no * 5;
		$category_id = $post_cat_subcat['category_id'];
		$sub_cat_id = $post_cat_subcat['sub_cat_id'];
		$postUserId = $post_cat_subcat['postUserId'];
		$state_id = $post_cat_subcat['state_id'];
		$city_id = $post_cat_subcat['city_id'];
if($category_id == 'all posts'){
	$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $postUserId AND status = 1) AS counts,  CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = $postUserId LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.status = 1 ORDER BY upst.id $sort_by LIMIT $from_limit,5");
}else{
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE catagory_id = $category_id AND sub_catagory_id = $sub_cat_id AND status = 1) AS counts, (SELECT category_name FROM mnst_category WHERE id = $category_id AND category_status = 1) AS category_name,(SELECT subcategory_name FROM mnst_subcategory WHERE id = $sub_cat_id AND subcategory_status = 1) AS subcategory_name, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num ,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.catagory_id = $category_id AND upst.sub_catagory_id = $sub_cat_id AND upst.states_id = $state_id AND upst.city_id = $city_id AND upst.status = 1 ORDER BY upst.id $sort_by LIMIT $from_limit,5");
}
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['subcategory_name'] = $getValue['upst']['subcategory_name'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['price'] = $getValue['upst']['price'];
			$finalArray[$i]['created_at'] = date("d-M-Y", strtotime($getValue['upst']['created_at']));
			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];
			$finalArray[$i]['subcategory_name'] = $getValue[0]['subcategory_name'];
			$finalArray[$i]['category_name'] = $getValue[0]['category_name'];
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			if(isset($getValue['upst']['post_url'])){ 
				$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			} else { 
				$finalArray[$i]['post_url'] =  'N/A'; 
			};
			if(isset($getValue['upst']['phone_national_code']) && isset($getValue['upst']['mobile_num'])){ 
				$finalArray[$i]['phone_national_code'] = $getValue['upst']['phone_national_code'].''.$getValue['upst']['mobile_num']; 
			} else { 
				$finalArray[$i]['phone_national_code'] =  'N/A'; 
			};
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
// this is done by prashanth
public function getPostBylatestEvents(){
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
		$from_limit = $page_no * 5;
		$category_id = $post_cat_subcat['category_id'];
		$sub_cat_id = $post_cat_subcat['sub_cat_id'];
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE catagory_id = $category_id AND sub_catagory_id = $sub_cat_id AND status = 1) AS counts, (SELECT category_name FROM mnst_category WHERE id = $category_id AND status = 1) AS category_name,(SELECT subcategory_name FROM mnst_subcategory WHERE id = $sub_cat_id AND status = 1) AS subcategory_name, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.catagory_id = $category_id AND upst.sub_catagory_id = $sub_cat_id AND upst.status = 1 AND upst.created_at <= DATE(NOW()) - INTERVAL 7 DAY ORDER BY upst.id $sort_by LIMIT $from_limit,5");
		
         
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['subcategory_name'] = $getValue['upst']['subcategory_name'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));
			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];
			$finalArray[$i]['subcategory_name'] = $getValue[0]['subcategory_name'];
			$finalArray[$i]['category_name'] = $getValue[0]['category_name'];
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			if(isset($getValue['upst']['post_url'])){ 
				$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			} else { 
				$finalArray[$i]['post_url'] =  'N/A'; 
			};
			if(isset($getValue['upst']['phone_national_code']) && isset($getValue['upst']['mobile_num'])){ 
				$finalArray[$i]['phone_national_code'] = $getValue['upst']['phone_national_code'].''.$getValue['upst']['mobile_num']; 
			} else { 
				$finalArray[$i]['phone_national_code'] =  'N/A'; 
			};
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
		$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by, upst.id, upst.post_name, upst.post_image,upst.post_email, upst.description, upst.created_at,upst.post_url FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.status = 1 AND upst.id = $post_id");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['post_email'] = $getValue['upst']['post_email'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
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
		$getUserDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 1) as my_posts, (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 2) as pending_posts, (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 0) as disaprooval_posts,  usr.id, usr.firstname, usr.lastname, usr.email, usr.username, usr.phone,usr.gender, usr.created_at, cn.id, cn.country_name, st.id, st.states_name, usr.city_id, ct.id,ct.city_name, usr.user_image, usr.gender, usr.address, usr.date_of_birth, usr.user_message,usr.zip, usr.user_status FROM mnst_users AS usr LEFT JOIN mnst_country AS cn ON usr.country_id = cn.id LEFT JOIN mnst_states AS st ON usr.state_id = st.id LEFT JOIN mnst_city AS ct ON ct.id = usr.city_id WHERE usr.id = $user_id");
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
			$post_count_user = "(SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 1) as counts";
		}else{
			$category_name_condition = "(SELECT category_name FROM mnst_category WHERE id = $post_category) AS category_name,";
			$post_cat_condition = " AND upst.catagory_id = $post_category"; 
			$post_count_user = "(SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND catagory_id = $post_category AND status = 1) as counts";
		}
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT $post_count_user, $category_name_condition usr.id,usr.firstname,usr.lastname, CONCAT(usr.firstname,' ',usr.lastname) create_by, usr.email,usr.phone,usr.user_image,usr.created_at, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE usr.id = $user_id $post_cat_condition AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));
			$finalArray[$i]['create_by'] = $getValue[0]['create_by'];
			$finalArray[$i]['user_id'] = $getValue['usr']['id'];
			$finalArray[$i]['firstname'] = $getValue['usr']['firstname'];
			$finalArray[$i]['lastname'] = $getValue['usr']['lastname'];
			$finalArray[$i]['email'] = $getValue['usr']['email'];
			$finalArray[$i]['phone'] = $getValue['usr']['phone'];
			$finalArray[$i]['user_image'] = $getValue['usr']['user_image'];
			$finalArray[$i]['user_created_at'] = date('M d, Y',strtotime($getValue['usr']['created_at']));
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			$finalArray[$i]['category_name'] = $getValue['mct']['category_name'];
			$finalArray[$i]['subcategory_name'] = $getValue['msct']['subcategory_name'];
			if(isset($getValue['upst']['post_url'])){ 
				$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			} else { 
				$finalArray[$i]['post_url'] =  'N/A'; 
			};
			if(isset($getValue['upst']['phone_national_code']) && isset($getValue['upst']['mobile_num'])){ 
				$finalArray[$i]['phone_national_code'] = $getValue['upst']['phone_national_code'].''.$getValue['upst']['mobile_num']; 
			} else { 
				$finalArray[$i]['phone_national_code'] =  'N/A'; 
			};
			$i++;
		}
		
		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){
			$final_json = json_encode($finalArray);
		}else{
			$getPostsDetails = $this->User->query("SELECT usr.firstname,usr.lastname,usr.username,usr.email,usr.user_image,usr.phone,usr.created_at,count(upst.id) as counts FROM mnst_users as usr LEFT JOIN mnst_user_posts as upst ON upst.create_by = usr.id WHERE usr.id = $user_id AND upst.status = 1");
			$finalArray[0]['firstname'] = $getPostsDetails[0]['usr']['firstname'];
			$finalArray[0]['lastname'] = $getPostsDetails[0]['usr']['lastname'];
			$finalArray[0]['create_by'] = $getPostsDetails[0]['usr']['username'];
			$finalArray[0]['email'] = $getPostsDetails[0]['usr']['email'];
			$finalArray[0]['phone'] = $getPostsDetails[0]['usr']['phone'];
			$finalArray[0]['user_image'] = $getPostsDetails[0]['usr']['user_image'];
			$finalArray[0]['user_created_at'] = date('M d, Y',strtotime($getPostsDetails[0]['usr']['created_at']));
			$finalArray[0]['counts'] = $getPostsDetails[0][0]['counts'];
			/*$getPostsCategoryDetails = $this->User->query("SELECT category_name FROM mnst_category WHERE id = $post_category");
				$finalArray[0]['category_name'] = $getPostsCategoryDetails[0]['mnst_category']['category_name'];*/
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
		$updateUser = $this->request->data;
		$user_id = $updateUser['user_id'];
		$firstname = $updateUser['firstName'];
		$lastname = $updateUser['lastName'];
		$username = $updateUser['firstName'].' '.$updateUser['lastName'];
		$country = $updateUser['country'];
		$state ='MO';
		$city = 'St Louis';
		
		$gender = $updateUser['gender'];
		$mobile = $updateUser['mobile'];
		$date_of_birth = $updateUser['dob'];
		$zip = $updateUser['zip'];
		$user_image = $updateUser['image'];
		
		$updated_at = date('Y-m-d H:i:s');
		if($user_id !=''){
		$addPostDetail = $this->User->query("UPDATE mnst_users SET `firstname` = '$firstname', `lastname` = '$lastname', `username` = '$username', `phone` = '$mobile',  `country` = '$country', `state` = '$state', `city` = '$city', `user_image` = '$user_image', `gender` = '$gender' , `date_of_birth` = '$date_of_birth',`zip` = '$zip', `updated_at` = '$updated_at' WHERE id = '$user_id'");
		$addPostDetail = array('updatePost' => 1);
		$final_json = json_encode($addPostDetail);
	}else{
		$addPostDetail = array('updatePost' => 0);
		$final_json = json_encode($addPostDetail);
	}
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
		$post_name = str_replace("'", "",$post_exist['post_name']);
		$sub_category_id = $post_exist['sub_catagory_id'];
		if($post_name != '' && $sub_category_id != ''){
		$existPostsDetail = $this->User->query("SELECT count(id) as postCnt FROM mnst_user_posts WHERE post_name = '$post_name' AND sub_catagory_id= $sub_category_id ");
	
			if($existPostsDetail[0][0]['postCnt'] > 0 ){
				$existPostsDetail = array('existPost' => 1);
			}else{
				$existPostsDetail = array('existPost' => 0);
			}
				$final_json = json_encode($existPostsDetail);
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
		$existPasswordDetail = $this->User->query("SELECT count(id) as usrCnt FROM mnst_users WHERE password = '$old_password' AND id ='$user_id'");
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
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE post_name LIKE '%$post_search%' AND status = 1) AS counts, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.url_name, upst.post_image, upst.catagory_id,upst.sub_catagory_id, upst.description, upst.created_at, upst.post_url,mcat.id,mcat.category_name,msbct.id,msbct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by INNER JOIN mnst_category AS mcat ON mcat.id = upst.catagory_id INNER JOIN mnst_subcategory AS msbct ON msbct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.post_name LIKE '%$post_search%' AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['category_id'] = $getValue['upst']['catagory_id'];
			$finalArray[$i]['category_name'] = $getValue['mcat']['category_name'];
			$finalArray[$i]['subcategory_name'] = $getValue['msbct']['subcategory_name'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['price'] = $getValue['upstd']['price'];
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
	//Read more API functionality here
	public function getReadMorePostDetails(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $sub_category);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_cat_subcat = $this->request->data;
		if($post_cat_subcat['rm_type'] == 'st-louis-news'){
			$id = $post_cat_subcat['id'];
			$eventsDetail = $this->User->query("SELECT id,event_name,event_city,event_images,event_description,event_address,event_date,DATE_FORMAT(created_date,'%d-%m-%Y (%h:%i  %p)') AS created_date,event_status FROM mnst_new_event WHERE id = $id");
			$imagefinal = array();
			$event_images = explode(",", $eventsDetail[0]['mnst_new_event']['event_images']);
					foreach ($event_images as $key => $imgValue) {
						$imagefinal[$key] = "../../view_library/images/".$imgValue;
					}
			$eventPrev = $this->User->query("SELECT  id as prvid,url_name FROM mnst_new_event WHERE id < $id AND event_status=1 order by id desc");
				$eventNext = $this->User->query("SELECT  id as nxtid,url_name FROM mnst_new_event WHERE id > $id AND event_status=1");
				if(count($eventPrev[0]['mnst_new_event']['prvid']) <= 0 && count($eventNext[0]['mnst_new_event']['nxtid']) >= 0) {
					$eventsDetail[0]['mnst_new_event']['record'] = 'nnn'; 
					$eventsDetail[0]['mnst_new_event']['nxtid'] = $eventNext[0]['mnst_new_event']['nxtid'];
					$eventsDetail[0]['mnst_new_event']['nxt_event_name'] = $eventNext[0]['mnst_new_event']['url_name'];
				} else if(count($eventNext[0]['mnst_new_event']['nxtid']) <= 0 && count($eventPrev[0]['mnst_new_event']['prvid']) >= 0) {
					$eventsDetail[0]['mnst_new_event']['record'] = 'ppp'; 
					$eventsDetail[0]['mnst_new_event']['prvid'] = $eventPrev[0]['mnst_new_event']['prvid'];
					$eventsDetail[0]['mnst_new_event']['prv_event_name'] = $eventPrev[0]['mnst_new_event']['url_name'];
				} else if(count($eventNext[0]['mnst_new_event']['nxtid']) > 0 && count($eventPrev[0]['mnst_new_event']['prvid']) > 0){
					$eventsDetail[0]['mnst_new_event']['record'] = 'eee';
					$eventsDetail[0]['mnst_new_event']['nxtid'] = $eventNext[0]['mnst_new_event']['nxtid'];
					$eventsDetail[0]['mnst_new_event']['nxt_event_name'] = $eventNext[0]['mnst_new_event']['url_name'];
					$eventsDetail[0]['mnst_new_event']['prvid'] = $eventPrev[0]['mnst_new_event']['prvid'];
					$eventsDetail[0]['mnst_new_event']['prv_event_name'] = $eventPrev[0]['mnst_new_event']['url_name'];
				}
		
			$eventsDetail[0]['mnst_new_event']['event_images'] = $imagefinal;
			$eventsDetail[0]['mnst_new_event']['event_date'] = date("l, jS M Y", strtotime($eventsDetail[0]['mnst_new_event']['created_date']));
			$final_json = json_encode($eventsDetail);
			return $final_json; exit;
		} else 	if($post_cat_subcat['rm_type'] == 'allPosts'){
				$post_id = $post_cat_subcat['id'];
			$cat_type = $post_cat_subcat['rm_type'];
			$user_id = $post_cat_subcat['admin_user_id'];
			/*$final_json = json_encode($user_id);
				return $final_json;*/
			$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by,usr.firstname,usr.lastname,usr.created_at as register_date,usr.phone as user_phone,usr.email as user_email,usr.user_image, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_email,upst.address,upst.street,upst.city,upst.country,upst.zip, upst.mobile_num , upst.post_url, upst.phone_national_code , upst.catagory_id,upst.sub_catagory_id , mcat.category_name,msbct.subcategory_name, mupd.open_close_monday,mupd.open_close_tuesday,mupd.open_close_wednesday,mupd.open_close_thursday,mupd.open_close_friday,mupd.open_close_saturday,mupd.open_close_sunday,mupd.monday_usr_time_from,mupd.monday_usr_time_to,mupd.tuesday_usr_time_from,mupd.tuesday_usr_time_to,mupd.wednesday_usr_time_from,mupd.wednesday_usr_time_to,mupd.thursday_usr_time_from,mupd.thursday_usr_time_to,mupd.friday_usr_time_from,mupd.friday_usr_time_to,mupd.saturday_usr_time_from,mupd.saturday_usr_time_to,mupd.sunday_usr_time_from,mupd.sunday_usr_time_to,mupd.price,mupd.owner_name,mupd.intakes,mupd.pooja_monday_usr_time_from,mupd.pooja_monday_usr_time_to,mupd.pooja_tuesday_usr_time_from,mupd.pooja_tuesday_usr_time_to,mupd.pooja_wednesday_usr_time_from,mupd.pooja_wednesday_usr_time_to,mupd.pooja_thursday_usr_time_from,mupd.pooja_thursday_usr_time_to,mupd.pooja_friday_usr_time_from,mupd.pooja_friday_usr_time_to,mupd.pooja_saturday_usr_time_from,mupd.pooja_saturday_usr_time_to,mupd.pooja_sunday_usr_time_from,mupd.pooja_sunday_usr_time_to,mupd.director,mupd.producer,mupd.music,mupd.theaters,mupd.cast_crew,mupd.release_date,mupd.event_start_date,mupd.event_end_date,mupd.event_start_time,mupd.event_end_time,mupd.post_status FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by LEFT JOIN mnst_user_post_details AS mupd ON upst.id = mupd.post_id INNER JOIN mnst_category AS mcat ON mcat.id = upst.catagory_id INNER JOIN mnst_subcategory AS msbct ON msbct.id = upst.sub_catagory_id WHERE upst.id = $post_id AND  upst.create_by = $user_id AND upst.status = 1");
			/*$final_json = json_encode($getPostsDetails);
				return $final_json; exit;*/
			
				$finalArray = array();
				$i = 0;
				foreach ($getPostsDetails as $key => $getValue) {
					$finalArray[$i]['mnst_new_event']['id'] = $getValue['upst']['id'];
					$finalArray[$i]['mnst_new_event']['event_name'] = $getValue['upst']['post_name'];
					$finalArray[$i]['mnst_new_event']['url_name'] = $getValue['upst']['url_name'];
					$event_images = explode(",", $getValue['upst']['post_image']);
					foreach ($event_images as $key => $imgValue) {
						$finalArray[$i]['mnst_new_event']['event_images'][$key] = "../../uploads/post_image/".$imgValue;
					}
					$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url'];
					$finalArray[$i]['mnst_new_event']['event_description'] = $getValue['upst']['description'];
					$finalArray[$i]['mnst_new_event']['post_email'] = $getValue['upst']['post_email'];
					$finalArray[$i]['mnst_new_event']['address'] = str_replace(",", ",<br>", $getValue['upst']['address']);
					$finalArray[$i]['mnst_new_event']['street'] =  $getValue['upst']['street'];
					$finalArray[$i]['mnst_new_event']['city'] =  $getValue['upst']['city'];
					$finalArray[$i]['mnst_new_event']['country'] =  $getValue['upst']['country'];
					$finalArray[$i]['mnst_new_event']['zip'] =  $getValue['upst']['zip'];
					$finalArray[$i]['mnst_new_event']['category_name'] = $getValue['mcat']['category_name'];
					$finalArray[$i]['mnst_new_event']['sub_catagory_id'] = $getValue['upst']['sub_catagory_id'];
					$finalArray[$i]['mnst_new_event']['subcategory_name'] = $getValue['msbct']['subcategory_name'];
					$finalArray[$i]['mnst_new_event']['mobile_num'] = $getValue['upst']['mobile_num'];
					$finalArray[$i]['mnst_new_event']['created_date'] = date("l, jS M Y", strtotime($getValue['upst']['created_at']));
					$finalArray[$i]['mnst_new_event']['firstname'] = $getValue['usr']['firstname'];
					$finalArray[$i]['mnst_new_event']['lastname'] = $getValue['usr']['lastname'];
					$finalArray[$i]['mnst_new_event']['creted_by'] = $getValue[0]['creted_by'];
					$finalArray[$i]['mnst_new_event']['register_date'] = $getValue[0]['register_date'];
					$finalArray[$i]['mnst_new_event']['user_phone'] = $getValue[0]['user_phone'];
					$finalArray[$i]['mnst_new_event']['user_email'] = $getValue[0]['user_email'];
					$finalArray[$i]['mnst_new_event']['user_image'] = $getValue[0]['user_image'];
					if(isset($getValue['upst']['post_url'])){ 
						$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url']; 
					} else { 
						$finalArray[$i]['mnst_new_event']['post_url'] =  'N/A'; 
					};
					$finalArray[$i]['mnst_new_event']['open_close_monday'] = $getValue['mupd']['open_close_monday'];
					$finalArray[$i]['mnst_new_event']['open_close_tuesday'] = $getValue['mupd']['open_close_tuesday'];
					$finalArray[$i]['mnst_new_event']['open_close_wednesday'] = $getValue['mupd']['open_close_wednesday'];
					$finalArray[$i]['mnst_new_event']['open_close_thursday'] = $getValue['mupd']['open_close_thursday'];
					$finalArray[$i]['mnst_new_event']['open_close_friday'] = $getValue['mupd']['open_close_friday'];
					$finalArray[$i]['mnst_new_event']['open_close_saturday'] = $getValue['mupd']['open_close_saturday'];
					$finalArray[$i]['mnst_new_event']['open_close_sunday'] = $getValue['mupd']['open_close_sunday'];
					$finalArray[$i]['mnst_new_event']['monday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['monday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['monday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['monday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['tuesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['tuesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['tuesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['tuesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['wednesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['wednesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['wednesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['wednesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['thursday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['thursday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['thursday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['thursday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['friday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['friday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['friday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['friday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['saturday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['saturday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['saturday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['saturday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['sunday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['sunday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['sunday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['sunday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['price'] = $getValue['mupd']['price'];
					$finalArray[$i]['mnst_new_event']['owner_name'] = $getValue['mupd']['owner_name'];
					$finalArray[$i]['mnst_new_event']['intakes'] = $getValue['mupd']['intakes'];
					$finalArray[$i]['mnst_new_event']['post_status'] = $getValue['mupd']['post_status'];
					$finalArray[$i]['mnst_new_event']['pooja_monday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_monday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_monday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_monday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_tuesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_tuesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_tuesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_tuesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_wednesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_wednesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_wednesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_wednesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_thursday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_thursday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_thursday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_thursday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_friday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_friday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_friday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_friday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_saturday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_saturday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_saturday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_saturday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_sunday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_sunday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_sunday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_sunday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['director'] = $getValue['mupd']['director'];
					$finalArray[$i]['mnst_new_event']['producer'] = $getValue['mupd']['producer'];
					$finalArray[$i]['mnst_new_event']['music'] = $getValue['mupd']['music'];
					$finalArray[$i]['mnst_new_event']['theaters'] = $getValue['mupd']['theaters'];
					$finalArray[$i]['mnst_new_event']['cast_crew'] = $getValue['mupd']['cast_crew'];
					$finalArray[$i]['mnst_new_event']['release_date'] = $getValue['mupd']['release_date'];
					if($getValue['mupd']['event_start_date'] == ''){
					$finalArray[$i]['mnst_new_event']['event_start_date'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_start_date'] = date('d M Y',strtotime($getValue['mupd']['event_start_date']));
					}
					if($getValue['mupd']['event_end_date'] == ''){
					$finalArray[$i]['mnst_new_event']['event_end_date'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_end_date'] = date('d M Y',strtotime($getValue['mupd']['event_end_date']));
					}
					if($getValue['mupd']['event_start_time'] == ''){
					$finalArray[$i]['mnst_new_event']['event_start_time'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_start_time'] = date('h:i A',strtotime($getValue['mupd']['event_start_time']));
					}
					if($getValue['mupd']['event_end_time'] == ''){
					$finalArray[$i]['mnst_new_event']['event_end_time'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_end_time'] = date('h:i A',strtotime($getValue['mupd']['event_end_time']));
					}
					$i++;
				}
			$finalArray[0][0]['created_date'] = $finalArray[0]['mnst_new_event']['created_date'];
			$eventPrev = $this->User->query("SELECT  id as prvid, url_name FROM mnst_user_posts WHERE id < $post_id AND create_by = $user_id AND status=1 order by id desc");
				$eventNext = $this->User->query("SELECT  id as nxtid , url_name FROM mnst_user_posts WHERE id > $post_id AND create_by = $user_id AND status=1");
				if(count($eventPrev[0]['mnst_user_posts']['prvid']) <= 0 && count($eventNext[0]['mnst_user_posts']['nxtid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'nnn'; 
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventNext[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) <= 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'ppp'; 
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) > 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) > 0){
					$finalArray[0]['mnst_user_posts']['record'] = 'eee';
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventNext[0]['mnst_user_posts']['url_name'];
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				}
				
			
			$finalArray[$i][0]['mnst_user_posts']['event_images'] = $imagefinal;
			$finalArray[$i][0]['mnst_user_posts']['event_date'] = date("l, jS M Y", strtotime($finalArray[$i][0]['mnst_user_posts']['event_date']));
			$final_json = json_encode($finalArray);
			return $final_json;exit;
			}else{
			$post_id = $post_cat_subcat['id'];
			$cat_type = $post_cat_subcat['rm_type'];
			$sub_cat_id = $post_cat_subcat['sub_catagory_id'];
			$state_id = $post_cat_subcat['state_id'];
			$city_id = $post_cat_subcat['city_id'];
			$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by,usr.firstname,usr.lastname,usr.created_at as register_date,usr.phone as user_phone,usr.email as user_email,usr.user_image, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_email,upst.address,upst.street,upst.city,upst.country,upst.zip, upst.mobile_num , upst.post_url, upst.phone_national_code , upst.catagory_id,upst.sub_catagory_id , mcat.category_name,msbct.subcategory_name, mupd.open_close_monday,mupd.open_close_tuesday,mupd.open_close_wednesday,mupd.open_close_thursday,mupd.open_close_friday,mupd.open_close_saturday,mupd.open_close_sunday,mupd.monday_usr_time_from,mupd.monday_usr_time_to,mupd.tuesday_usr_time_from,mupd.tuesday_usr_time_to,mupd.wednesday_usr_time_from,mupd.wednesday_usr_time_to,mupd.thursday_usr_time_from,mupd.thursday_usr_time_to,mupd.friday_usr_time_from,mupd.friday_usr_time_to,mupd.saturday_usr_time_from,mupd.saturday_usr_time_to,mupd.sunday_usr_time_from,mupd.sunday_usr_time_to,mupd.price,mupd.owner_name,mupd.intakes,mupd.pooja_monday_usr_time_from,mupd.pooja_monday_usr_time_to,mupd.pooja_tuesday_usr_time_from,mupd.pooja_tuesday_usr_time_to,mupd.pooja_wednesday_usr_time_from,mupd.pooja_wednesday_usr_time_to,mupd.pooja_thursday_usr_time_from,mupd.pooja_thursday_usr_time_to,mupd.pooja_friday_usr_time_from,mupd.pooja_friday_usr_time_to,mupd.pooja_saturday_usr_time_from,mupd.pooja_saturday_usr_time_to,mupd.pooja_sunday_usr_time_from,mupd.pooja_sunday_usr_time_to,mupd.director,mupd.producer,mupd.music,mupd.theaters,mupd.cast_crew,mupd.release_date,mupd.event_start_date,mupd.event_end_date,mupd.event_start_time,mupd.event_end_time,mupd.post_status FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by LEFT JOIN mnst_user_post_details AS mupd ON upst.id = mupd.post_id INNER JOIN mnst_category AS mcat ON mcat.id = upst.catagory_id INNER JOIN mnst_subcategory AS msbct ON msbct.id = upst.sub_catagory_id WHERE upst.id = $post_id AND upst.state_id = $state_id AND upst.city_id = $city_id AND upst.catagory_id = $cat_type AND upst.sub_catagory_id = $sub_cat_id AND upst.status = 1");
				$finalArray = array();
				$i = 0;
				foreach ($getPostsDetails as $key => $getValue) {
					$finalArray[$i]['mnst_new_event']['id'] = $getValue['upst']['id'];
					$finalArray[$i]['mnst_new_event']['event_name'] = $getValue['upst']['post_name'];
					$finalArray[$i]['mnst_new_event']['url_name'] = $getValue['upst']['url_name'];
					$event_images = explode(",", $getValue['upst']['post_image']);
					foreach ($event_images as $key => $imgValue) {
						$finalArray[$i]['mnst_new_event']['event_images'][$key] = "../../uploads/post_image/".$imgValue;
					}
					$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url'];
					$finalArray[$i]['mnst_new_event']['event_description'] = $getValue['upst']['description'];
					$finalArray[$i]['mnst_new_event']['post_email'] = $getValue['upst']['post_email'];
					$finalArray[$i]['mnst_new_event']['category_name'] = $getValue['mcat']['category_name'];
					$finalArray[$i]['mnst_new_event']['sub_catagory_id'] = $getValue['upst']['sub_catagory_id'];
					$finalArray[$i]['mnst_new_event']['subcategory_name'] = $getValue['msbct']['subcategory_name'];
					
					$finalArray[$i]['mnst_new_event']['address'] = str_replace(",", ",<br>", $getValue['upst']['address']);
					$finalArray[$i]['mnst_new_event']['street'] =  $getValue['upst']['street'];
					$finalArray[$i]['mnst_new_event']['city'] =  $getValue['upst']['city'];
					$finalArray[$i]['mnst_new_event']['country'] =  $getValue['upst']['country'];
					$finalArray[$i]['mnst_new_event']['zip'] =  $getValue['upst']['zip'];
					$finalArray[$i]['mnst_new_event']['mobile_num'] = $getValue['upst']['mobile_num'];
					$finalArray[$i]['mnst_new_event']['created_date'] = date("l, jS M Y", strtotime($getValue['upst']['created_at']));
					$finalArray[$i]['mnst_new_event']['firstname'] = $getValue['usr']['firstname'];
					$finalArray[$i]['mnst_new_event']['lastname'] = $getValue['usr']['lastname'];
					$finalArray[$i]['mnst_new_event']['creted_by'] = $getValue[0]['creted_by'];
					$finalArray[$i]['mnst_new_event']['register_date'] = date('d M Y',strtotime($getValue['usr']['register_date']));
					$finalArray[$i]['mnst_new_event']['user_phone'] = $getValue['usr']['user_phone'];
					$finalArray[$i]['mnst_new_event']['user_email'] = $getValue['usr']['user_email'];
					$finalArray[$i]['mnst_new_event']['user_image'] = $getValue['usr']['user_image'];
					if(isset($getValue['upst']['post_url'])){ 
						$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url']; 
					} else { 
						$finalArray[$i]['mnst_new_event']['post_url'] =  'N/A'; 
					};
					$finalArray[$i]['mnst_new_event']['open_close_monday'] = $getValue['mupd']['open_close_monday'];
					$finalArray[$i]['mnst_new_event']['open_close_tuesday'] = $getValue['mupd']['open_close_tuesday'];
					$finalArray[$i]['mnst_new_event']['open_close_wednesday'] = $getValue['mupd']['open_close_wednesday'];
					$finalArray[$i]['mnst_new_event']['open_close_thursday'] = $getValue['mupd']['open_close_thursday'];
					$finalArray[$i]['mnst_new_event']['open_close_friday'] = $getValue['mupd']['open_close_friday'];
					$finalArray[$i]['mnst_new_event']['open_close_saturday'] = $getValue['mupd']['open_close_saturday'];
					$finalArray[$i]['mnst_new_event']['open_close_sunday'] = $getValue['mupd']['open_close_sunday'];
					$finalArray[$i]['mnst_new_event']['monday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['monday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['monday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['monday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['tuesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['tuesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['tuesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['tuesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['wednesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['wednesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['wednesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['wednesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['thursday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['thursday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['thursday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['thursday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['friday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['friday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['friday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['friday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['saturday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['saturday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['saturday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['saturday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['sunday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['sunday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['sunday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['sunday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['price'] = $getValue['mupd']['price'];
					$finalArray[$i]['mnst_new_event']['owner_name'] = $getValue['mupd']['owner_name'];
					$finalArray[$i]['mnst_new_event']['intakes'] = $getValue['mupd']['intakes'];
					$finalArray[$i]['mnst_new_event']['post_status'] = $getValue['mupd']['post_status'];
					$finalArray[$i]['mnst_new_event']['pooja_monday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_monday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_monday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_monday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_tuesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_tuesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_tuesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_tuesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_wednesday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_wednesday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_wednesday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_wednesday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_thursday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_thursday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_thursday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_thursday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_friday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_friday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_friday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_friday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_saturday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_saturday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_saturday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_saturday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['pooja_sunday_usr_time_from'] = date('h:i A',strtotime($getValue['mupd']['pooja_sunday_usr_time_from']));
					$finalArray[$i]['mnst_new_event']['pooja_sunday_usr_time_to'] = date('h:i A',strtotime($getValue['mupd']['pooja_sunday_usr_time_to']));
					$finalArray[$i]['mnst_new_event']['director'] = $getValue['mupd']['director'];
					$finalArray[$i]['mnst_new_event']['producer'] = $getValue['mupd']['producer'];
					$finalArray[$i]['mnst_new_event']['music'] = $getValue['mupd']['music'];
					$finalArray[$i]['mnst_new_event']['theaters'] = $getValue['mupd']['theaters'];
					$finalArray[$i]['mnst_new_event']['cast_crew'] = $getValue['mupd']['cast_crew'];
					$finalArray[$i]['mnst_new_event']['release_date'] = $getValue['mupd']['release_date'];
					if($getValue['mupd']['event_start_date'] == ''){
					$finalArray[$i]['mnst_new_event']['event_start_date'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_start_date'] = date('d M Y',strtotime($getValue['mupd']['event_start_date']));
					}
					if($getValue['mupd']['event_end_date'] == ''){
					$finalArray[$i]['mnst_new_event']['event_end_date'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_end_date'] = date('d M Y',strtotime($getValue['mupd']['event_end_date']));
					}
					if($getValue['mupd']['event_start_time'] == ''){
					$finalArray[$i]['mnst_new_event']['event_start_time'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_start_time'] = date('h:i A',strtotime($getValue['mupd']['event_start_time']));
					}
					if($getValue['mupd']['event_end_time'] == ''){
					$finalArray[$i]['mnst_new_event']['event_end_time'] = '';
					}else{
					$finalArray[$i]['mnst_new_event']['event_end_time'] = date('h:i A',strtotime($getValue['mupd']['event_end_time']));
					}
					$i++;
				}
			$finalArray[0][0]['created_date'] = $finalArray[0]['mnst_new_event']['created_date'];
			$eventPrev = $this->User->query("SELECT  id as prvid, url_name FROM mnst_user_posts WHERE id < $post_id AND catagory_id = $cat_type AND sub_catagory_id = $sub_cat_id AND status=1 order by id desc");
				$eventNext = $this->User->query("SELECT  id as nxtid, url_name FROM mnst_user_posts WHERE id > $post_id AND catagory_id = $cat_type AND sub_catagory_id = $sub_cat_id AND status=1");
				if(count($eventPrev[0]['mnst_user_posts']['prvid']) <= 0 && count($eventNext[0]['mnst_user_posts']['nxtid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'nnn'; 
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventNext[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) <= 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'ppp'; 
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) > 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) > 0){
					$finalArray[0]['mnst_user_posts']['record'] = 'eee';
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventNext[0]['mnst_user_posts']['url_name'];
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				}
			$final_json = json_encode($finalArray);
			return $final_json;exit;
			}
			
		
		if(count($eventsDetail) > 0 && $eventsDetail[0]['mnst_new_event']['event_name'] != ''){
			foreach ($eventsDetail as $key=>$value) {
				$event_images = explode(',', $value['mnst_new_event']['event_images']);
				$eventsDetail[$key]['mnst_new_event']['event_images'] = $event_images;
			}
		}else{
			$eventsDetail = array('noEvents' => 0);
			$final_json = json_encode($eventsDetail);
		}
				$final_json = json_encode($eventsDetail);
				return $final_json;
	}
		public function getReadMorePostDetailsPagination(){
			self::noView();
			/*$getPostsDetails = array('noPosts' => $sub_category);
			$final_json = json_encode($getPostsDetails);
			return $final_json;*/
			header("Content-Type:application/json");
			$this->request->data = json_decode(file_get_contents('php://input'), true);
			$post_cat_subcat = $this->request->data;
			if($post_cat_subcat['pagination'] == 'prev'){
					$oper = '<';
			} else if($post_cat_subcat['pagination'] == 'next'){
					$oper = '>';
			}
			
			if($post_cat_subcat['rm_type'] == 'st-louis-news'){
				$id = $post_cat_subcat['id'];
				$eventsDetail = $this->User->query("SELECT id,event_name,event_city,event_images,event_description,event_address,event_date,DATE_FORMAT(created_date,'%d-%m-%Y (%h:%i  %p)') AS created_date,event_status FROM mnst_new_event WHERE id = $id LIMIT 1");
				$imagefinal = array();
				$event_images = explode(",", $eventsDetail[0]['mnst_new_event']['event_images']);
						foreach ($event_images as $key => $imgValue) {
							$imagefinal[$key] = "../../view_library/images/".$imgValue;
						}
				$eventPrev = $this->User->query("SELECT  id as prvid, url_name FROM mnst_new_event WHERE id < $id AND event_status=1 order by id desc");
				$eventNext = $this->User->query("SELECT  id as nxtid , url_name FROM mnst_new_event WHERE id > $id AND event_status=1");
				if(count($eventPrev[0]['mnst_new_event']['prvid']) <= 0 && count($eventNext[0]['mnst_new_event']['nxtid']) >= 0) {
					$eventsDetail[0]['mnst_new_event']['record'] = 'nnn'; 
					$eventsDetail[0]['mnst_new_event']['nxtid'] = $eventNext[0]['mnst_new_event']['nxtid'];
					$eventsDetail[0]['mnst_new_event']['nxt_event_name'] = $eventNext[0]['mnst_new_event']['url_name'];
				} else if(count($eventNext[0]['mnst_new_event']['nxtid']) <= 0 && count($eventPrev[0]['mnst_new_event']['prvid']) >= 0) {
					$eventsDetail[0]['mnst_new_event']['record'] = 'ppp'; 
					$eventsDetail[0]['mnst_new_event']['prvid'] = $eventPrev[0]['mnst_new_event']['prvid'];
					$eventsDetail[0]['mnst_new_event']['prv_event_name'] = $eventPrev[0]['mnst_new_event']['url_name'];
				} else if(count($eventNext[0]['mnst_new_event']['nxtid']) > 0 && count($eventPrev[0]['mnst_new_event']['prvid']) > 0){
					$eventsDetail[0]['mnst_new_event']['record'] = 'eee';
					$eventsDetail[0]['mnst_new_event']['nxtid'] = $eventNext[0]['mnst_new_event']['nxtid'];
					$eventsDetail[0]['mnst_new_event']['nxt_event_name'] = $eventPrev[0]['mnst_new_event']['url_name'];
					$eventsDetail[0]['mnst_new_event']['prvid'] = $eventPrev[0]['mnst_new_event']['prvid'];
					$eventsDetail[0]['mnst_new_event']['prv_event_name'] = $eventPrev[0]['mnst_new_event']['url_name'];
				}
				
				$eventsDetail[0]['mnst_new_event']['event_images'] = $imagefinal;
				$eventsDetail[0]['mnst_new_event']['event_date'] = date("l, jS M Y", strtotime($eventsDetail[0]['mnst_new_event']['event_date']));
				$final_json = json_encode($eventsDetail);
				return $final_json; exit;
			} else 	if($post_cat_subcat['rm_type'] == 'allPosts'){
					$post_id = $post_cat_subcat['id'];
				$cat_type = $post_cat_subcat['rm_type'];
				$user_id = $post_cat_subcat['admin_user_id'];
				/*$final_json = json_encode($post_cat_subcat);
					return $final_json;*/
				$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by, upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_email, upst.address, upst.mobile_num , upst.post_url, upst.phone_national_code FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.id = $post_id AND upst.status = 1");
				
					$finalArray = array();
					$i = 0;
					foreach ($getPostsDetails as $key => $getValue) {
						$finalArray[$i]['mnst_new_event']['id'] = $getValue['upst']['id'];
						$finalArray[$i]['mnst_new_event']['event_name'] = $getValue['upst']['post_name'];
						$event_images = explode(",", $getValue['upst']['post_image']);
						foreach ($event_images as $key => $imgValue) {
							$finalArray[$i]['mnst_new_event']['event_images'][$key] = "../../uploads/post_image/".$imgValue;
						}
						$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url'];
						$finalArray[$i]['mnst_new_event']['event_description'] = $getValue['upst']['description'];
						$finalArray[$i]['mnst_new_event']['post_email'] = $getValue['upst']['post_email'];
						$finalArray[$i]['mnst_new_event']['address'] = str_replace(",", ",<br>", $getValue['upst']['address']);
						$finalArray[$i]['mnst_new_event']['mobile_num'] = $getValue['upst']['mobile_num'];
						$finalArray[$i]['mnst_new_event']['created_date'] = date("l, jS M Y", strtotime($getValue['upst']['created_at']));
						$finalArray[$i]['mnst_new_event']['creted_by'] = $getValue[0]['creted_by'];
						if(isset($getValue['upst']['post_url'])){ 
							$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url']; 
						} else { 
							$finalArray[$i]['mnst_new_event']['post_url'] =  'N/A'; 
						};
						
						/*if(isset($getValue['upst']['phone_national_code']) && isset($getValue['upst']['mobile_num'])){ 
							$finalArray[$i]['mnst_new_event']['phone_national_code'] = $getValue['upst']['phone_national_code'].''.$getValue['upst']['mobile_num']; 
						} else { 
							$finalArray[$i]['mnst_new_event']['phone_national_code'] =  'N/A'; 
						};*/
						$i++;
					}
				$finalArray[0][0]['created_date'] = $finalArray[0]['mnst_new_event']['created_date'];
				$eventPrev = $this->User->query("SELECT  id as prvid, url_name FROM mnst_user_posts WHERE id < $post_id AND create_by = $user_id AND status=1 order by id desc");
				$eventNext = $this->User->query("SELECT  id as nxtid, url_name FROM mnst_user_posts WHERE id > $post_id AND create_by = $user_id AND status=1");
				if(count($eventPrev[0]['mnst_user_posts']['prvid']) <= 0 && count($eventNext[0]['mnst_user_posts']['nxtid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'nnn'; 
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventNext[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) <= 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'ppp'; 
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) > 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) > 0){
					$finalArray[0]['mnst_user_posts']['record'] = 'eee';
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				}
				$final_json = json_encode($finalArray);
				return $final_json;exit;
				}else{
				$post_id = $post_cat_subcat['id'];
				$cat_type = $post_cat_subcat['rm_type'];
				$getPostsDetails = $this->User->query("SELECT CONCAT(usr.firstname,' ',usr.lastname) creted_by, upst.id, upst.post_name, upst.post_image, upst.description, upst.created_at, upst.post_email,upst.address, upst.mobile_num , upst.post_url, upst.phone_national_code FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by WHERE upst.id = $post_id AND  upst.catagory_id = $cat_type AND upst.status = 1");
				
					$finalArray = array();
					$i = 0;
					foreach ($getPostsDetails as $key => $getValue) {
						$finalArray[$i]['mnst_new_event']['id'] = $getValue['upst']['id'];
						$finalArray[$i]['mnst_new_event']['event_name'] = $getValue['upst']['post_name'];
						$event_images = explode(",", $getValue['upst']['post_image']);
						foreach ($event_images as $key => $imgValue) {
							$finalArray[$i]['mnst_new_event']['event_images'][$key] = "../../uploads/post_image/".$imgValue;
						}
						$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url'];
						$finalArray[$i]['mnst_new_event']['event_description'] = $getValue['upst']['description'];
						$finalArray[$i]['mnst_new_event']['post_email'] = $getValue['upst']['post_email'];
						$finalArray[$i]['mnst_new_event']['address'] = str_replace(",", ",<br>", $getValue['upst']['address']);
						//$finalArray[$i]['mnst_new_event']['mobile'] = $getValue['upst']['mobile_num'];
						$finalArray[$i]['mnst_new_event']['created_date'] = date("l, jS M Y", strtotime($getValue['upst']['created_at']));
						$finalArray[$i]['mnst_new_event']['creted_by'] = $getValue[0]['creted_by'];
						if(isset($getValue['upst']['post_url'])){ 
							$finalArray[$i]['mnst_new_event']['post_url'] = $getValue['upst']['post_url']; 
						} else { 
							$finalArray[$i]['mnst_new_event']['post_url'] =  'N/A'; 
						};
						/*if(isset($getValue['upst']['phone_national_code']) && isset($getValue['upst']['mobile_num'])){ 
							$finalArray[$i]['mnst_new_event']['phone_national_code'] = $getValue['upst']['phone_national_code'].''.$getValue['upst']['mobile_num']; 
						} else { 
							$finalArray[$i]['mnst_new_event']['phone_national_code'] =  'N/A'; 
						};*/
						$i++;
					}
				$finalArray[0][0]['created_date'] = $finalArray[0]['mnst_new_event']['created_date'];
				$eventPrev = $this->User->query("SELECT  id as prvid, url_name FROM mnst_user_posts WHERE id < $post_id AND catagory_id = $cat_type AND status=1 order by id desc");
				$eventNext = $this->User->query("SELECT  id as nxtid, url_name FROM mnst_user_posts WHERE id > $post_id AND catagory_id = $cat_type AND status=1");
				if(count($eventPrev[0]['mnst_user_posts']['prvid']) <= 0 && count($eventNext[0]['mnst_user_posts']['nxtid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'nnn'; 
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventNext[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) <= 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) >= 0) {
					$finalArray[0]['mnst_user_posts']['record'] = 'ppp'; 
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				} else if(count($eventNext[0]['mnst_user_posts']['nxtid']) > 0 && count($eventPrev[0]['mnst_user_posts']['prvid']) > 0){
					$finalArray[0]['mnst_user_posts']['record'] = 'eee';
					$finalArray[0]['mnst_user_posts']['nxtid'] = $eventNext[0]['mnst_user_posts']['nxtid'];
					$finalArray[0]['mnst_user_posts']['nxt_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
					$finalArray[0]['mnst_user_posts']['prvid'] = $eventPrev[0]['mnst_user_posts']['prvid'];
					$finalArray[0]['mnst_user_posts']['prv_post_name'] = $eventPrev[0]['mnst_user_posts']['url_name'];
				}
				$final_json = json_encode($finalArray);
				return $final_json;exit;
				}
				
			
			if(count($eventsDetail) > 0 && $eventsDetail[0]['mnst_new_event']['event_name'] != ''){
				foreach ($eventsDetail as $key=>$value) {
					$event_images = explode(',', $value['mnst_new_event']['event_images']);
					$eventsDetail[$key]['mnst_new_event']['event_images'] = $event_images;
				}
			}else{
				$eventsDetail = array('noEvents' => 0);
				$final_json = json_encode($eventsDetail);
			}
					$final_json = json_encode($eventsDetail);
					return $final_json;
		}
	public function emailStatus(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$test_val = $this->request->data;
		$user_id = $test_val['user_id'];
		$emailUpdates = $this->User->query("UPDATE mnst_users SET `email_status` = 1 WHERE `id` = $user_id");
		$getDataDetails = array('data' => $emailUpdates);
		$final_json = json_encode($getDataDetails);
		return $final_json;
	}
	public function getDefaultPassword(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$test_val = $this->request->data;
		$email = $test_val['email'];
		$new_password  = $test_val['defaultPass'];
		$updated_at = date('Y-m-d H:i:s');
		$emailUpdates = $this->User->query("UPDATE mnst_users SET `password` = '$new_password', `updated_at` = '$updated_at' WHERE email = '$email'");
		$updateusr = "UPDATE mnst_users SET `password` = '$new_password', `updated_at` = '$updated_at' WHERE email = '$email'";
		$getDataDetails = array('data' => $updateusr);
		$final_json = json_encode($getDataDetails);
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
	public function getFromUrl(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$url_data = $this->request->data;
		$cat_val = $url_data['url_id_cat'];
		$subcat_val = $url_data['url_id_subcat'];
		$post_val = $url_data['url_id_post_name'];
      
		$finalArray = array();
		if($cat_val == 'allPosts'){
		$getPostName = $this->User->query("SELECT id FROM mnst_user_posts WHERE url_name = '$post_val'");
		$finalArray['id'] = 'allPosts';
		$finalArray['post_id'] = $getPostName[0]['mnst_user_posts']['id'];
	}else{
		$getCategoryName = $this->User->query("SELECT id FROM mnst_category WHERE category_name   = '$cat_val'");
		$finalArray['id'] = $getCategoryName[0]['mnst_category']['id'];
		$getSubCategoryName = $this->User->query("SELECT id FROM mnst_subcategory WHERE subcategory_name = '$subcat_val'");
		$subCatId = $getSubCategoryName[0]['mnst_subcategory']['id'];
		$getPostName = $this->User->query("SELECT id , catagory_id, sub_catagory_id FROM mnst_user_posts WHERE url_name = '$post_val' AND sub_catagory_id = '$subCatId' ");
		
		$finalArray['post_id'] = $getPostName[0]['mnst_user_posts']['id'];
		$finalArray['catagory_id'] = $getPostName[0]['mnst_user_posts']['catagory_id'];
		$finalArray['sub_catagory_id'] = $getPostName[0]['mnst_user_posts']['sub_catagory_id'];
	}
		$final_json = json_encode($finalArray);
		return $final_json;
	} 
	public function get_Cat_Subcat_FromUrl(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$url_data = $this->request->data;
		$cat_val = $url_data['url_id_cat'];
		$subcat_val = $url_data['url_id_subcat'];
      
		$finalArray = array();
		
		$getCategoryName = $this->User->query("SELECT id FROM mnst_category WHERE category_name   = '$cat_val'");
		$finalArray['category_id'] = $getCategoryName[0]['mnst_category']['id'];
		$getSubcatName = $this->User->query("SELECT id FROM mnst_subcategory WHERE subcategory_name = '$subcat_val'");
		
		$finalArray['sub_cat_id'] = $getSubcatName[0]['mnst_subcategory']['id'];
		$final_json = json_encode($finalArray);
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
	// get similar posts
	public function getSimilarPosts(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => 0);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$sub_cat_id = $this->request->data['sub_catagory_id'];
		$post_id = $this->request->data['id'];
		$user_id = $this->request->data['admin_user_id'];
		$rm_type = $this->request->data['rm_type'];
		if($rm_type == 'allPosts'){
		$sililarPosts = $this->User->query("SELECT id,post_name,url_name,post_image,address,street,city,country,created_at FROM mnst_user_posts WHERE create_by = '$user_id' AND id != $post_id AND status = 1 ORDER BY RAND() DESC LIMIT 4");
	}else{
		$sililarPosts = $this->User->query("SELECT id,post_name,url_name,post_image,address,street,city,country,created_at FROM mnst_user_posts WHERE sub_catagory_id = '$sub_cat_id' AND id != $post_id AND status = 1 ORDER BY RAND() DESC LIMIT 4");
	}
		$final_json = json_encode($sililarPosts);
		return $final_json; 
	}
	// get user all posts
	public function getUserAllPosts(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => 0);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$user_name = $this->request->data['username'];
		$pagination = $this->request->data['pagination'];
		$user_id = $this->User->query("SELECT id FROM mnst_users WHERE username = '$user_name'");
		$user_id = $user_id[0]['mnst_users']['id'];
		$page_no = (isset($pagination) && $pagination > 1) ? ($pagination-1) : "0";
		$from_limit = $page_no * 5;
		
		$userPosts = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by='$user_id' AND status = 1) as counts, upst.id,upst.create_by,upst.post_name,upst.url_name,upst.post_image,upst.post_url,upst.catagory_id,upst.sub_catagory_id,upst.post_email,upst.mobile_num,upst.address,upst.description,upst.created_at,usr.firstname,usr.lastname,usr.id as user_id, usr.username,usr.user_image, usr.phone,usr.email,usr.created_at, ct.category_name,sct.subcategory_name, upstd.price FROM mnst_user_posts as upst INNER JOIN mnst_users as usr ON usr.id = upst.create_by  LEFT JOIN mnst_category as ct ON ct.id = upst.catagory_id LEFT JOIN mnst_subcategory as sct ON sct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id  WHERE upst.create_by = $user_id AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($userPosts as $key => $value) {
			$finalArray[$i]['mnst_user_posts']['counts'] = $value[0]['counts'];
			$finalArray[$i]['mnst_user_posts']['user_id'] = $value['usr']['user_id'];
			$finalArray[$i]['mnst_user_posts']['create_by'] = $value['usr']['username'];
			$finalArray[$i]['mnst_user_posts']['firstname'] = $value['usr']['firstname'];
			$finalArray[$i]['mnst_user_posts']['lastname'] = $value['usr']['lastname'];
			$finalArray[$i]['mnst_user_posts']['user_image'] = $value['usr']['user_image'];
			$finalArray[$i]['mnst_user_posts']['user_email'] = $value['usr']['email'];
			$finalArray[$i]['mnst_user_posts']['user_phone'] = $value['usr']['phone'];
			$finalArray[$i]['mnst_user_posts']['created_at'] = date('d M Y',strtotime($value['usr']['created_at']));
			$finalArray[$i]['mnst_user_posts']['post_name'] = $value['upst']['post_name'];
			$finalArray[$i]['mnst_user_posts']['url_name'] = $value['upst']['url_name'];
			$post_images = explode(",", $value['upst']['post_image']);
						foreach ($post_images as $key => $imgValue) {
							$finalArray[$i]['mnst_user_posts']['post_images'][$key] = "../../uploads/post_image/".$imgValue;
						}
			$finalArray[$i]['mnst_user_posts']['post_url'] = $value['upst']['post_url'];
			$finalArray[$i]['mnst_user_posts']['post_email'] = $value['upst']['post_email'];
			$finalArray[$i]['mnst_user_posts']['mobile_num'] = $value['upst']['mobile_num'];
			$finalArray[$i]['mnst_user_posts']['description'] = $value['upst']['description'];
			$finalArray[$i]['mnst_user_posts']['posted_at'] = date('d M Y',strtotime($value['upst']['created_at']));
			$finalArray[$i]['mnst_user_posts']['category_name'] = $value['ct']['category_name'];
			$finalArray[$i]['mnst_user_posts']['subcategory_name'] = $value['sct']['subcategory_name'];
			$finalArray[$i]['mnst_user_posts']['price'] = $value['upstd']['price'];
		$i++;
		}
       
	if(count($finalArray) > 0 && $finalArray[0]['mnst_user_posts']['post_name'] != ''){
			$final_json = json_encode($finalArray);
		}else{
			$getUserDetails = $this->User->query("SELECT id, username FROM mnst_users WHERE id = $user_id");
			$finalArray[0]['username'] = $getUserDetails[0]['mnst_users']['username'];
			$finalArray[0]['noPosts'] = '0';
			$finalArray = array('noPosts' => $finalArray);
			$final_json = json_encode($finalArray);
		}
		return $final_json;
	}
	public function searchUserPosts(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => 0);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$search_val = $this->request->data;
		$user_name = $search_val['user_name'];
		$search_value = $search_val['search_value'];
		$user_id = $this->User->query("SELECT id FROM mnst_users WHERE username = '$user_name'");
		$user_id = $user_id[0]['mnst_users']['id'];
		$page_no = (isset($search_val['pagination']) && $search_val['pagination'] > 1) ? ($search_val['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by='$user_id' AND post_name LIKE '%$search_value%' AND status = 1) as counts, upst.id,upst.create_by,upst.post_name,upst.url_name,upst.post_image,upst.post_url,upst.catagory_id,upst.sub_catagory_id,upst.post_email,upst.mobile_num,upst.address,upst.description,upst.created_at,usr.firstname,usr.lastname,usr.id as user_id, usr.username,usr.user_image, usr.phone,usr.email,usr.created_at, ct.category_name,sct.subcategory_name, upstd.price FROM mnst_user_posts as upst INNER JOIN mnst_users as usr ON usr.id = upst.create_by  LEFT JOIN mnst_category as ct ON ct.id = upst.catagory_id LEFT JOIN mnst_subcategory as sct ON sct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id  WHERE upst.create_by = $user_id AND upst.post_name LIKE '%$search_value%' AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $key => $value) {
			$finalArray[$i]['mnst_user_posts']['counts'] = $value[0]['counts'];
			$finalArray[$i]['mnst_user_posts']['user_id'] = $value['usr']['user_id'];
			$finalArray[$i]['mnst_user_posts']['create_by'] = $value['usr']['username'];
			$finalArray[$i]['mnst_user_posts']['firstname'] = $value['usr']['firstname'];
			$finalArray[$i]['mnst_user_posts']['lastname'] = $value['usr']['lastname'];
			$finalArray[$i]['mnst_user_posts']['user_image'] = $value['usr']['user_image'];
			$finalArray[$i]['mnst_user_posts']['user_email'] = $value['usr']['email'];
			$finalArray[$i]['mnst_user_posts']['user_phone'] = $value['usr']['phone'];
			$finalArray[$i]['mnst_user_posts']['created_at'] = date('d M Y',strtotime($value['usr']['created_at']));
			$finalArray[$i]['mnst_user_posts']['post_name'] = $value['upst']['post_name'];
			$finalArray[$i]['mnst_user_posts']['url_name'] = $value['upst']['url_name'];
			$post_images = explode(",", $value['upst']['post_image']);
						foreach ($post_images as $key => $imgValue) {
							$finalArray[$i]['mnst_user_posts']['post_images'][$key] = "../../uploads/post_image/".$imgValue;
						}
			$finalArray[$i]['mnst_user_posts']['post_url'] = $value['upst']['post_url'];
			$finalArray[$i]['mnst_user_posts']['post_email'] = $value['upst']['post_email'];
			$finalArray[$i]['mnst_user_posts']['mobile_num'] = $value['upst']['mobile_num'];
			$finalArray[$i]['mnst_user_posts']['description'] = $value['upst']['description'];
			$finalArray[$i]['mnst_user_posts']['posted_at'] = date('d M Y',strtotime($value['upst']['created_at']));
			$finalArray[$i]['mnst_user_posts']['category_name'] = $value['ct']['category_name'];
			$finalArray[$i]['mnst_user_posts']['subcategory_name'] = $value['sct']['subcategory_name'];
			$finalArray[$i]['mnst_user_posts']['price'] = $value['upstd']['price'];
		$i++;
		}
	if(count($finalArray) > 0 && $finalArray[0]['mnst_user_posts']['post_name'] != ''){
			$final_json = json_encode($finalArray);
		}else{
			$getUserDetails = $this->User->query("SELECT usr.id, usr.firstname,usr.lastname,usr.username,usr.email,usr.phone,usr.user_image,usr.created_at, count(upst.id) as counts FROM mnst_users as usr LEFT JOIN mnst_user_posts as upst ON upst.create_by = usr.id WHERE create_by= $user_id AND upst.post_name LIKE '%$search_value%' AND upst.status = 1");
			$finalArray[0]['firstname'] = $getUserDetails[0]['usr']['firstname'];
			$finalArray[0]['lastname'] = $getUserDetails[0]['usr']['lastname'];
			$finalArray[0]['username'] = $getUserDetails[0]['usr']['username'];
			$finalArray[0]['email'] = $getUserDetails[0]['usr']['email'];
			$finalArray[0]['phone'] = $getUserDetails[0]['usr']['phone'];
			$finalArray[0]['user_image'] = $getUserDetails[0]['usr']['user_image'];
			$finalArray[0]['created_at'] = $getUserDetails[0]['usr']['created_at'];
			$finalArray[0]['counts'] = $getUserDetails[0]['counts'];
			$finalArray[0]['noPosts'] = '0';
			/*$finalArray = array('noPosts' => $finalArray);*/
			$final_json = json_encode($getUserDetails);
		}
		return $final_json;
	}
	public function getPostCategoryWise(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$location = $this->request->data;
		$city_id = $location['city_id'];
		$stlouisDetails = $this->User->query("SELECT
    COUNT(CASE WHEN `catagory_id`=1 THEN 1 END) AS stlouisPosts,
COUNT(CASE WHEN `catagory_id`=2 THEN 1 END) AS placesofworshipPosts,
COUNT(CASE WHEN `catagory_id`=3 THEN 1 END) AS grocerystoresPosts,
COUNT(CASE WHEN `catagory_id`=4 THEN 1 END) AS restaurantsPosts,
COUNT(CASE WHEN `catagory_id`=5 THEN 1 END) AS healthcarePosts,
COUNT(CASE WHEN `catagory_id`=6 THEN 1 END) AS moviesPosts,
COUNT(CASE WHEN `catagory_id`=7 THEN 1 END) AS pricecomparisonPosts,
COUNT(CASE WHEN `catagory_id`=8 THEN 1 END) AS jobsPosts,
COUNT(CASE WHEN `catagory_id`=9 THEN 1 END) AS classifiedsPosts,
COUNT(CASE WHEN `catagory_id`=10 THEN 1 END) AS servicesPosts,
COUNT(CASE WHEN `catagory_id`=11 THEN 1 END) AS eventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 1 THEN 1 END) AS touristplacesPosts,
COUNT(CASE WHEN `sub_catagory_id` = 2 THEN 1 END) AS usefulplacesPosts,
COUNT(CASE WHEN `sub_catagory_id` = 3 THEN 1 END) AS apartmentsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 4 THEN 1 END) AS universitiesPosts,
COUNT(CASE WHEN `sub_catagory_id` = 5 THEN 1 END) AS templesPosts,
COUNT(CASE WHEN `sub_catagory_id` = 6 THEN 1 END) AS churchesPosts,
COUNT(CASE WHEN `sub_catagory_id` = 7 THEN 1 END) AS mosquesPosts,
COUNT(CASE WHEN `sub_catagory_id` = 8 THEN 1 END) AS othersPosts,
COUNT(CASE WHEN `sub_catagory_id` = 9 THEN 1 END) AS desistoresPosts,
COUNT(CASE WHEN `sub_catagory_id` = 10 THEN 1 END) AS otherstoresPosts,
COUNT(CASE WHEN `sub_catagory_id` = 11 THEN 1 END) AS indianPosts,
COUNT(CASE WHEN `sub_catagory_id` = 12 THEN 1 END) AS thaiPosts,
COUNT(CASE WHEN `sub_catagory_id` = 13 THEN 1 END) AS americanPosts,
COUNT(CASE WHEN `sub_catagory_id` = 14 THEN 1 END) AS italianPosts,
COUNT(CASE WHEN `sub_catagory_id` = 15 THEN 1 END) AS mexicanPosts,
COUNT(CASE WHEN `sub_catagory_id` = 16 THEN 1 END) AS doctorclinicsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 17 THEN 1 END) AS hospitalsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 18 THEN 1 END) AS diagnosticlabsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 19 THEN 1 END) AS physiotherapyPosts,
COUNT(CASE WHEN `sub_catagory_id` = 20 THEN 1 END) AS urgentcaresPosts,
COUNT(CASE WHEN `sub_catagory_id` = 21 THEN 1 END) AS hindiPosts,
COUNT(CASE WHEN `sub_catagory_id` = 22 THEN 1 END) AS teluguPosts,
COUNT(CASE WHEN `sub_catagory_id` = 23 THEN 1 END) AS englishPosts,
COUNT(CASE WHEN `sub_catagory_id` = 24 THEN 1 END) AS tamilPosts,
COUNT(CASE WHEN `sub_catagory_id` = 25 THEN 1 END) AS malayalamPosts,
COUNT(CASE WHEN `sub_catagory_id` = 26 THEN 1 END) AS dollerPosts,
COUNT(CASE WHEN `sub_catagory_id` = 27 THEN 1 END) AS rupeesPosts,
COUNT(CASE WHEN `sub_catagory_id` = 28 THEN 1 END) AS parttimePosts,
COUNT(CASE WHEN `sub_catagory_id` = 29 THEN 1 END) AS fulltimePosts,
COUNT(CASE WHEN `sub_catagory_id` = 30 THEN 1 END) AS accomodationPosts,
COUNT(CASE WHEN `sub_catagory_id` = 31 THEN 1 END) AS childcarePosts,
COUNT(CASE WHEN `sub_catagory_id` = 32 THEN 1 END) AS cateringPosts,
COUNT(CASE WHEN `sub_catagory_id` = 33 THEN 1 END) AS forsalePosts,
COUNT(CASE WHEN `sub_catagory_id` = 34 THEN 1 END) AS lawyersPosts,
COUNT(CASE WHEN `sub_catagory_id` = 35 THEN 1 END) AS insuranceagentsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 36 THEN 1 END) AS travelagentsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 37 THEN 1 END) AS accountantsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 38 THEN 1 END) AS templeeventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 39 THEN 1 END) AS mosqueeventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 40 THEN 1 END) AS churcheventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 41 THEN 1 END) AS movieeventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 42 THEN 1 END) AS artsandentertainmenteventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 43 THEN 1 END) AS musiceventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 44 THEN 1 END) AS sportseventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 45 THEN 1 END) AS danceeventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 46 THEN 1 END) AS universitieseventsPosts,
COUNT(CASE WHEN `sub_catagory_id` = 47 THEN 1 END) AS otherseventsPosts
FROM `mnst_user_posts` WHERE city_id = $city_id AND status=1 AND post_name IS NOT NULL");
		$final_json = json_encode($stlouisDetails);
		return $final_json;
	}
	public function addPostFirstGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$FirstGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $FirstGroupPost);
		$create_by = $FirstGroupPost['created_by'];
		   $catagory_id = $FirstGroupPost['catagory_id'];
		   $sub_catagory_id = $FirstGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $FirstGroupPost['post_name']);
			$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($FirstGroupPost['post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $FirstGroupPost['post_url'];
		   $email = $FirstGroupPost['email'];		   
		   $mobile_num = $FirstGroupPost['mobile_num'];
		   $address = str_replace("'", "&apos;", $FirstGroupPost['location']);
		   $street = str_replace("'", "&apos;", $FirstGroupPost['st-street']);
		   $city = str_replace("'", "&apos;", $FirstGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $FirstGroupPost['st-country']);
		   $zip = $FirstGroupPost['st-zip'];
		   $open_close_monday = isset($FirstGroupPost['open_monday']) ? "Open":"Close";
		   $open_close_tuesday = isset($FirstGroupPost['open_tuesday']) ? "Open":"Close";
		   $open_close_wednesday = isset($FirstGroupPost['open_wednesday']) ? "Open":"Close";
		   $open_close_thursday = isset($FirstGroupPost['open_thursday']) ? "Open":"Close";
		   $open_close_friday = isset($FirstGroupPost['open_friday']) ? "Open":"Close";
		   $open_close_saturday = isset($FirstGroupPost['open_saturday']) ? "Open":"Close";
		   $open_close_sunday = isset($FirstGroupPost['open_sunday']) ? "Open":"Close";
		   $monday_usr_time_from = $FirstGroupPost['monday_usr_time_from'];
		   $monday_usr_time_to = $FirstGroupPost['monday_usr_time_to'];
		   $tuesday_usr_time_from = $FirstGroupPost['tuesday_usr_time_from'];
		   $tuesday_usr_time_to = $FirstGroupPost['tuesday_usr_time_to'];
		   $wednesday_usr_time_from = $FirstGroupPost['wednesday_usr_time_from'];
		   $wednesday_usr_time_to = $FirstGroupPost['wednesday_usr_time_to'];
		   $thursday_usr_time_from = $FirstGroupPost['thursday_usr_time_from'];
		   $thursday_usr_time_to = $FirstGroupPost['thursday_usr_time_to'];
		   $friday_usr_time_from = $FirstGroupPost['friday_usr_time_from'];
		   $friday_usr_time_to = $FirstGroupPost['friday_usr_time_to'];
		   $saturday_usr_time_from = $FirstGroupPost['saturday_usr_time_from'];
		   $saturday_usr_time_to = $FirstGroupPost['saturday_usr_time_to'];
		   $sunday_usr_time_from = $FirstGroupPost['sunday_usr_time_from'];
		   $sunday_usr_time_to = $FirstGroupPost['sunday_usr_time_to'];
		   $description = str_replace("'", "&apos;", $FirstGroupPost['description']);
		   $post_image = $FirstGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addTouristPlaces = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `post_url`, `catagory_id`, `sub_catagory_id`, `address`, `street`,`city`,`country`,`zip`,`mobile_num`,`post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$post_url', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
		$addTouristPlacesDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `open_close_monday`, `open_close_tuesday`, `open_close_wednesday`, `open_close_thursday`, `open_close_friday`, `open_close_saturday`, `open_close_sunday`, `monday_usr_time_from`, `monday_usr_time_to`, `tuesday_usr_time_from`, `tuesday_usr_time_to`, `wednesday_usr_time_from`, `wednesday_usr_time_to`, `thursday_usr_time_from`, `thursday_usr_time_to`, `friday_usr_time_from`, `friday_usr_time_to`, `saturday_usr_time_from`, `saturday_usr_time_to`, `sunday_usr_time_from`, `sunday_usr_time_to` ) VALUES ('$post_id', '$open_close_monday', '$open_close_tuesday', '$open_close_wednesday', '$open_close_thursday', '$open_close_friday', '$open_close_saturday', '$open_close_sunday', '$monday_usr_time_from', '$monday_usr_time_to', '$tuesday_usr_time_from', '$tuesday_usr_time_to', '$wednesday_usr_time_from', '$wednesday_usr_time_to', '$thursday_usr_time_from', '$thursday_usr_time_to', '$friday_usr_time_from', '$friday_usr_time_to', '$saturday_usr_time_from', '$saturday_usr_time_to', '$sunday_usr_time_from', '$sunday_usr_time_to')");
		$addTouristPlaces = array('success' => "1");
		$final_json = json_encode($addTouristPlaces);
		return $final_json;
	}
	public function addPostSecondGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$SecondGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $SecondGroupPost);
		$create_by = $SecondGroupPost['created_by'];
		   $catagory_id = $SecondGroupPost['catagory_id'];
		   $sub_catagory_id = $SecondGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $SecondGroupPost['two_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($SecondGroupPost['two_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $email = $SecondGroupPost['two_email'];		   
		   $address = str_replace("'", "&apos;", $SecondGroupPost['two_address']);
		   $street = str_replace("'", "&apos;", $SecondGroupPost['two_street']);
		   $city = str_replace("'", "&apos;", $SecondGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $SecondGroupPost['st-country']);
		   $zip = $SecondGroupPost['two_zip'];
		   $mobile_num = $SecondGroupPost['two_mobile_num'];
		   $price = $SecondGroupPost['two_price'];
		   $owner_name = str_replace("'", "&apos;", $SecondGroupPost['two_owner_name']);
		   $description = str_replace("'", "&apos;", $SecondGroupPost['two_description']);
		   $post_image = $SecondGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addSecondGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`, `mobile_num`,`post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addSecondGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `price`, `owner_name`) VALUES ('$post_id', '$price', '$owner_name')");
		$addSecondGroup = array('success' => "1");
		$final_json = json_encode($addSecondGroup);
	}else{
		$addSecondGroup = array('success' => "0");
		$final_json = json_encode($addSecondGroup);
	}
		return $final_json;
	}
	public function addPostThirdGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$ThirdGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $ThirdGroupPost);
		$create_by = $ThirdGroupPost['created_by'];
		   $catagory_id = $ThirdGroupPost['catagory_id'];
		   $sub_catagory_id = $ThirdGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $ThirdGroupPost['three_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($ThirdGroupPost['three_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $ThirdGroupPost['three_post_url'];
		   $email = $ThirdGroupPost['three_email'];		   
		   $address = str_replace("'", "&apos;", $ThirdGroupPost['three_address']);
		   $street = str_replace("'", "&apos;", $ThirdGroupPost['three_street']);
		   $city = str_replace("'", "&apos;", $ThirdGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $ThirdGroupPost['st-country']);
		   $zip = $ThirdGroupPost['three_zip'];
		   $mobile_num = $ThirdGroupPost['three_mobile_num'];
		   $price = $ThirdGroupPost['three_price'];
		   $intakes = str_replace("'", "&apos;", $ThirdGroupPost['three_intakes']);
		   $open_close_monday = isset($ThirdGroupPost['three_open_monday']) ? "Open":"Close";
		   $open_close_tuesday = isset($ThirdGroupPost['three_open_tuesday']) ? "Open":"Close";
		   $open_close_wednesday = isset($ThirdGroupPost['three_open_wednesday']) ? "Open":"Close";
		   $open_close_thursday = isset($ThirdGroupPost['three_open_thursday']) ? "Open":"Close";
		   $open_close_friday = isset($ThirdGroupPost['three_open_friday']) ? "Open":"Close";
		   $open_close_saturday = isset($ThirdGroupPost['three_open_saturday']) ? "Open":"Close";
		   $open_close_sunday = isset($ThirdGroupPost['three_open_sunday']) ? "Open":"Close";
		   $description = str_replace("'", "&apos;", $ThirdGroupPost['three_description']);
		   $post_image = $ThirdGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostThirdGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `post_url`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`, `mobile_num`, `post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$post_url', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostThirdGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `open_close_monday`, `open_close_tuesday`, `open_close_wednesday`, `open_close_thursday`, `open_close_friday`, `open_close_saturday`, `open_close_sunday`, `price`, `intakes` ) VALUES ('$post_id', '$open_close_monday', '$open_close_tuesday', '$open_close_wednesday', '$open_close_thursday', '$open_close_friday', '$open_close_saturday', '$open_close_sunday', '$price', '$intakes')");
		$addPostThirdGroup = array('success' => "1");
		$final_json = json_encode($addPostThirdGroup);
	}else{
		$addPostThirdGroup = array('success' => "0");
		$final_json = json_encode($addPostThirdGroup);
	}
		return $final_json;
	}
	public function addPostFourthGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$FourthGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $FourthGroupPost);
		$create_by = $FourthGroupPost['created_by'];
		   $catagory_id = $FourthGroupPost['catagory_id'];
		   $sub_catagory_id = $FourthGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $FourthGroupPost['four_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($FourthGroupPost['four_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $FourthGroupPost['four_post_url'];		   
		   $address = str_replace("'", "&apos;", $FourthGroupPost['four_address']);
		   $street = str_replace("'", "&apos;", $FourthGroupPost['four_street']);
		   $city = str_replace("'", "&apos;", $FourthGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $FourthGroupPost['st-country']);
		   $zip = $FourthGroupPost['four_zip'];
		   $open_close_monday = isset($FourthGroupPost['four_open_monday']) ? "Open":"Close";
		   $open_close_tuesday = isset($FourthGroupPost['four_open_tuesday']) ? "Open":"Close";
		   $open_close_wednesday = isset($FourthGroupPost['four_open_wednesday']) ? "Open":"Close";
		   $open_close_thursday = isset($FourthGroupPost['four_open_thursday']) ? "Open":"Close";
		   $open_close_friday = isset($FourthGroupPost['four_open_friday']) ? "Open":"Close";
		   $open_close_saturday = isset($FourthGroupPost['four_open_saturday']) ? "Open":"Close";
		   $open_close_sunday = isset($FourthGroupPost['four_open_sunday']) ? "Open":"Close";
		   $monday_usr_time_from = $FourthGroupPost['four_monday_usr_time_from'];
		   $monday_usr_time_to = $FourthGroupPost['four_monday_usr_time_to'];
		   $tuesday_usr_time_from = $FourthGroupPost['four_tuesday_usr_time_from'];
		   $tuesday_usr_time_to = $FourthGroupPost['four_tuesday_usr_time_to'];
		   $wednesday_usr_time_from = $FourthGroupPost['four_wednesday_usr_time_from'];
		   $wednesday_usr_time_to = $FourthGroupPost['four_wednesday_usr_time_to'];
		   $thursday_usr_time_from = $FourthGroupPost['four_thursday_usr_time_from'];
		   $thursday_usr_time_to = $FourthGroupPost['four_thursday_usr_time_to'];
		   $friday_usr_time_from = $FourthGroupPost['four_friday_usr_time_from'];
		   $friday_usr_time_to = $FourthGroupPost['four_friday_usr_time_to'];
		   $saturday_usr_time_from = $FourthGroupPost['four_saturday_usr_time_from'];
		   $saturday_usr_time_to = $FourthGroupPost['four_saturday_usr_time_to'];
		   $sunday_usr_time_from = $FourthGroupPost['four_sunday_usr_time_from'];
		   $sunday_usr_time_to = $FourthGroupPost['four_sunday_usr_time_to'];
		   $pooja_monday_usr_time_from = $FourthGroupPost['pooja_four_monday_usr_time_from'];
		   $pooja_monday_usr_time_to = $FourthGroupPost['pooja_four_monday_usr_time_to'];
		   $pooja_tuesday_usr_time_from = $FourthGroupPost['pooja_four_tuesday_usr_time_from'];
		   $pooja_tuesday_usr_time_to = $FourthGroupPost['pooja_four_tuesday_usr_time_to'];
		   $pooja_wednesday_usr_time_from = $FourthGroupPost['pooja_four_wednesday_usr_time_from'];
		   $pooja_wednesday_usr_time_to = $FourthGroupPost['pooja_four_wednesday_usr_time_to'];
		   $pooja_thursday_usr_time_from = $FourthGroupPost['pooja_four_thursday_usr_time_from'];
		   $pooja_thursday_usr_time_to = $FourthGroupPost['pooja_four_thursday_usr_time_to'];
		   $pooja_friday_usr_time_from = $FourthGroupPost['pooja_four_friday_usr_time_from'];
		   $pooja_friday_usr_time_to = $FourthGroupPost['pooja_four_friday_usr_time_to'];
		   $pooja_saturday_usr_time_from = $FourthGroupPost['pooja_four_saturday_usr_time_from'];
		   $pooja_saturday_usr_time_to = $FourthGroupPost['pooja_four_saturday_usr_time_to'];
		   $pooja_sunday_usr_time_from = $FourthGroupPost['pooja_four_sunday_usr_time_from'];
		   $pooja_sunday_usr_time_to = $FourthGroupPost['pooja_four_sunday_usr_time_to'];
		   $description = str_replace("'", "&apos;", $FourthGroupPost['four_description']); 
		   $post_image = $FourthGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostFourthGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `catagory_id`, `sub_catagory_id`, `address`, `street`,`city`,`country`,`zip`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostFourthGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `open_close_monday`, `open_close_tuesday`, `open_close_wednesday`, `open_close_thursday`, `open_close_friday`, `open_close_saturday`, `open_close_sunday`, `monday_usr_time_from`, `monday_usr_time_to`, `tuesday_usr_time_from`, `tuesday_usr_time_to`, `wednesday_usr_time_from`, `wednesday_usr_time_to`, `thursday_usr_time_from`, `thursday_usr_time_to`, `friday_usr_time_from`, `friday_usr_time_to`, `saturday_usr_time_from`, `saturday_usr_time_to`, `sunday_usr_time_from`, `sunday_usr_time_to`,`pooja_monday_usr_time_from`, `pooja_monday_usr_time_to`, `pooja_tuesday_usr_time_from`, `pooja_tuesday_usr_time_to`, `pooja_wednesday_usr_time_from`, `pooja_wednesday_usr_time_to`, `pooja_thursday_usr_time_from`, `pooja_thursday_usr_time_to`, `pooja_friday_usr_time_from`, `pooja_friday_usr_time_to`, `pooja_saturday_usr_time_from`, `pooja_saturday_usr_time_to`, `pooja_sunday_usr_time_from`, `pooja_sunday_usr_time_to` ) VALUES ('$post_id', '$open_close_monday', '$open_close_tuesday', '$open_close_wednesday', '$open_close_thursday', '$open_close_friday', '$open_close_saturday', '$open_close_sunday', '$monday_usr_time_from', '$monday_usr_time_to', '$tuesday_usr_time_from', '$tuesday_usr_time_to', '$wednesday_usr_time_from', '$wednesday_usr_time_to', '$thursday_usr_time_from', '$thursday_usr_time_to', '$friday_usr_time_from', '$friday_usr_time_to', '$saturday_usr_time_from', '$saturday_usr_time_to', '$sunday_usr_time_from', '$sunday_usr_time_to', '$pooja_monday_usr_time_from', '$pooja_monday_usr_time_to', '$pooja_tuesday_usr_time_from', '$pooja_tuesday_usr_time_to', '$pooja_wednesday_usr_time_from', '$pooja_wednesday_usr_time_to', '$pooja_thursday_usr_time_from', '$pooja_thursday_usr_time_to', '$pooja_friday_usr_time_from', '$pooja_friday_usr_time_to', '$pooja_saturday_usr_time_from', '$pooja_saturday_usr_time_to', '$pooja_sunday_usr_time_from', '$pooja_sunday_usr_time_to' )");
		$addPostFourthGroup = array('success' => "1");
		$final_json = json_encode($addPostFourthGroup);
	}else{
		$addPostFourthGroup = array('success' => "0");
		$final_json = json_encode($addPostFourthGroup);
	}
		return $final_json;
	}
	public function addPostFifthGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$FifthGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $FifthGroupPost);
		$create_by = $FifthGroupPost['created_by'];
		   $catagory_id = $FifthGroupPost['catagory_id'];
		   $sub_catagory_id = $FifthGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $FifthGroupPost['five_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($FifthGroupPost['five_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $FifthGroupPost['five_post_url'];		   
		   $address = str_replace("'", "&apos;", $FifthGroupPost['five_address']);
		   $street = str_replace("'", "&apos;", $FifthGroupPost['five_street']);
		   $city = str_replace("'", "&apos;", $FifthGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $FifthGroupPost['st-country']);
		   $zip = $FifthGroupPost['five_zip'];
		   $open_close_monday = isset($FifthGroupPost['five_open_monday']) ? "Open":"Close";
		   $open_close_tuesday = isset($FifthGroupPost['five_open_tuesday']) ? "Open":"Close";
		   $open_close_wednesday = isset($FifthGroupPost['five_open_wednesday']) ? "Open":"Close";
		   $open_close_thursday = isset($FifthGroupPost['five_open_thursday']) ? "Open":"Close";
		   $open_close_friday = isset($FifthGroupPost['five_open_friday']) ? "Open":"Close";
		   $open_close_saturday = isset($FifthGroupPost['five_open_saturday']) ? "Open":"Close";
		   $open_close_sunday = isset($FifthGroupPost['five_open_sunday']) ? "Open":"Close";
		   $monday_usr_time_from = $FifthGroupPost['five_monday_usr_time_from'];
		   $monday_usr_time_to = $FifthGroupPost['five_monday_usr_time_to'];
		   $tuesday_usr_time_from = $FifthGroupPost['five_tuesday_usr_time_from'];
		   $tuesday_usr_time_to = $FifthGroupPost['five_tuesday_usr_time_to'];
		   $wednesday_usr_time_from = $FifthGroupPost['five_wednesday_usr_time_from'];
		   $wednesday_usr_time_to = $FifthGroupPost['five_wednesday_usr_time_to'];
		   $thursday_usr_time_from = $FifthGroupPost['five_thursday_usr_time_from'];
		   $thursday_usr_time_to = $FifthGroupPost['five_thursday_usr_time_to'];
		   $friday_usr_time_from = $FifthGroupPost['five_friday_usr_time_from'];
		   $friday_usr_time_to = $FifthGroupPost['five_friday_usr_time_to'];
		   $saturday_usr_time_from = $FifthGroupPost['five_saturday_usr_time_from'];
		   $saturday_usr_time_to = $FifthGroupPost['five_saturday_usr_time_to'];
		   $sunday_usr_time_from = $FifthGroupPost['five_sunday_usr_time_from'];
		   $sunday_usr_time_to = $FifthGroupPost['five_sunday_usr_time_to'];
		   $pooja_monday_usr_time_from = $FifthGroupPost['prayer_five_monday_usr_time_from'];
		   $pooja_monday_usr_time_to = $FifthGroupPost['prayer_five_monday_usr_time_to'];
		   $pooja_tuesday_usr_time_from = $FifthGroupPost['prayer_five_tuesday_usr_time_from'];
		   $pooja_tuesday_usr_time_to = $FifthGroupPost['prayer_five_tuesday_usr_time_to'];
		   $pooja_wednesday_usr_time_from = $FifthGroupPost['prayer_five_wednesday_usr_time_from'];
		   $pooja_wednesday_usr_time_to = $FifthGroupPost['prayer_five_wednesday_usr_time_to'];
		   $pooja_thursday_usr_time_from = $FifthGroupPost['prayer_five_thursday_usr_time_from'];
		   $pooja_thursday_usr_time_to = $FifthGroupPost['prayer_five_thursday_usr_time_to'];
		   $pooja_friday_usr_time_from = $FifthGroupPost['prayer_five_friday_usr_time_from'];
		   $pooja_friday_usr_time_to = $FifthGroupPost['prayer_five_friday_usr_time_to'];
		   $pooja_saturday_usr_time_from = $FifthGroupPost['prayer_five_saturday_usr_time_from'];
		   $pooja_saturday_usr_time_to = $FifthGroupPost['prayer_five_saturday_usr_time_to'];
		   $pooja_sunday_usr_time_from = $FifthGroupPost['prayer_five_sunday_usr_time_from'];
		   $pooja_sunday_usr_time_to = $FifthGroupPost['prayer_five_sunday_usr_time_to'];
		   $description = str_replace("'", "&apos;", $FifthGroupPost['five_description']);
		   $post_image = $FifthGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostFifthGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `catagory_id`, `sub_catagory_id`, `address`, `street`,`city`,`country`,`zip`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostFifthGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `open_close_monday`, `open_close_tuesday`, `open_close_wednesday`, `open_close_thursday`, `open_close_friday`, `open_close_saturday`, `open_close_sunday`, `monday_usr_time_from`, `monday_usr_time_to`, `tuesday_usr_time_from`, `tuesday_usr_time_to`, `wednesday_usr_time_from`, `wednesday_usr_time_to`, `thursday_usr_time_from`, `thursday_usr_time_to`, `friday_usr_time_from`, `friday_usr_time_to`, `saturday_usr_time_from`, `saturday_usr_time_to`, `sunday_usr_time_from`, `sunday_usr_time_to`,`pooja_monday_usr_time_from`, `pooja_monday_usr_time_to`, `pooja_tuesday_usr_time_from`, `pooja_tuesday_usr_time_to`, `pooja_wednesday_usr_time_from`, `pooja_wednesday_usr_time_to`, `pooja_thursday_usr_time_from`, `pooja_thursday_usr_time_to`, `pooja_friday_usr_time_from`, `pooja_friday_usr_time_to`, `pooja_saturday_usr_time_from`, `pooja_saturday_usr_time_to`, `pooja_sunday_usr_time_from`, `pooja_sunday_usr_time_to` ) VALUES ('$post_id', '$open_close_monday', '$open_close_tuesday', '$open_close_wednesday', '$open_close_thursday', '$open_close_friday', '$open_close_saturday', '$open_close_sunday', '$monday_usr_time_from', '$monday_usr_time_to', '$tuesday_usr_time_from', '$tuesday_usr_time_to', '$wednesday_usr_time_from', '$wednesday_usr_time_to', '$thursday_usr_time_from', '$thursday_usr_time_to', '$friday_usr_time_from', '$friday_usr_time_to', '$saturday_usr_time_from', '$saturday_usr_time_to', '$sunday_usr_time_from', '$sunday_usr_time_to', '$pooja_monday_usr_time_from', '$pooja_monday_usr_time_to', '$pooja_tuesday_usr_time_from', '$pooja_tuesday_usr_time_to', '$pooja_wednesday_usr_time_from', '$pooja_wednesday_usr_time_to', '$pooja_thursday_usr_time_from', '$pooja_thursday_usr_time_to', '$pooja_friday_usr_time_from', '$pooja_friday_usr_time_to', '$pooja_saturday_usr_time_from', '$pooja_saturday_usr_time_to', '$pooja_sunday_usr_time_from', '$pooja_sunday_usr_time_to' )");
		$addPostFifthGroup = array('success' => "1");
		$final_json = json_encode($addPostFifthGroup);
	}else{
		$addPostFifthGroup = array('success' => "0");
		$final_json = json_encode($addPostFifthGroup);
	}
		return $final_json;
	}
	public function addPostSixthGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$SixthGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $SixthGroupPost);
		$create_by = $SixthGroupPost['created_by'];
		   $catagory_id = $SixthGroupPost['catagory_id'];
		   $sub_catagory_id = $SixthGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $SixthGroupPost['six_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($SixthGroupPost['six_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $SixthGroupPost['six_post_url'];		   
		   $address = str_replace("'", "&apos;", $SixthGroupPost['six_address']);
		   $street = str_replace("'", "&apos;", $SixthGroupPost['six_street']);
		   $city = str_replace("'", "&apos;", $SixthGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $SixthGroupPost['st-country']);
		   $zip = $SixthGroupPost['six_zip'];
		   $open_close_monday = isset($SixthGroupPost['six_open_monday']) ? "Open":"Close";
		   $open_close_tuesday = isset($SixthGroupPost['six_open_tuesday']) ? "Open":"Close";
		   $open_close_wednesday = isset($SixthGroupPost['six_open_wednesday']) ? "Open":"Close";
		   $open_close_thursday = isset($SixthGroupPost['six_open_thursday']) ? "Open":"Close";
		   $open_close_friday = isset($SixthGroupPost['six_open_friday']) ? "Open":"Close";
		   $open_close_saturday = isset($SixthGroupPost['six_open_saturday']) ? "Open":"Close";
		   $open_close_sunday = isset($SixthGroupPost['six_open_sunday']) ? "Open":"Close";
		   $monday_usr_time_from = $SixthGroupPost['six_monday_usr_time_from'];
		   $monday_usr_time_to = $SixthGroupPost['six_monday_usr_time_to'];
		   $tuesday_usr_time_from = $SixthGroupPost['six_tuesday_usr_time_from'];
		   $tuesday_usr_time_to = $SixthGroupPost['six_tuesday_usr_time_to'];
		   $wednesday_usr_time_from = $SixthGroupPost['six_wednesday_usr_time_from'];
		   $wednesday_usr_time_to = $SixthGroupPost['six_wednesday_usr_time_to'];
		   $thursday_usr_time_from = $SixthGroupPost['six_thursday_usr_time_from'];
		   $thursday_usr_time_to = $SixthGroupPost['six_thursday_usr_time_to'];
		   $friday_usr_time_from = $SixthGroupPost['six_friday_usr_time_from'];
		   $friday_usr_time_to = $SixthGroupPost['six_friday_usr_time_to'];
		   $saturday_usr_time_from = $SixthGroupPost['six_saturday_usr_time_from'];
		   $saturday_usr_time_to = $SixthGroupPost['six_saturday_usr_time_to'];
		   $sunday_usr_time_from = $SixthGroupPost['six_sunday_usr_time_from'];
		   $sunday_usr_time_to = $SixthGroupPost['six_sunday_usr_time_to'];
		   $pooja_monday_usr_time_from = $SixthGroupPost['namaz_six_monday_usr_time_from'];
		   $pooja_monday_usr_time_to = $SixthGroupPost['namaz_six_monday_usr_time_to'];
		   $pooja_tuesday_usr_time_from = $SixthGroupPost['namaz_six_tuesday_usr_time_from'];
		   $pooja_tuesday_usr_time_to = $SixthGroupPost['namaz_six_tuesday_usr_time_to'];
		   $pooja_wednesday_usr_time_from = $SixthGroupPost['namaz_six_wednesday_usr_time_from'];
		   $pooja_wednesday_usr_time_to = $SixthGroupPost['namaz_six_wednesday_usr_time_to'];
		   $pooja_thursday_usr_time_from = $SixthGroupPost['namaz_six_thursday_usr_time_from'];
		   $pooja_thursday_usr_time_to = $SixthGroupPost['namaz_six_thursday_usr_time_to'];
		   $pooja_friday_usr_time_from = $SixthGroupPost['namaz_six_friday_usr_time_from'];
		   $pooja_friday_usr_time_to = $SixthGroupPost['namaz_six_friday_usr_time_to'];
		   $pooja_saturday_usr_time_from = $SixthGroupPost['namaz_six_saturday_usr_time_from'];
		   $pooja_saturday_usr_time_to = $SixthGroupPost['namaz_six_saturday_usr_time_to'];
		   $pooja_sunday_usr_time_from = $SixthGroupPost['namaz_six_sunday_usr_time_from'];
		   $pooja_sunday_usr_time_to = $SixthGroupPost['namaz_six_sunday_usr_time_to'];
		   $description = str_replace("'", "&apos;", $SixthGroupPost['six_description']);
		   $post_image = $SixthGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostSixthGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`,  `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostSixthGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `open_close_monday`, `open_close_tuesday`, `open_close_wednesday`, `open_close_thursday`, `open_close_friday`, `open_close_saturday`, `open_close_sunday`, `monday_usr_time_from`, `monday_usr_time_to`, `tuesday_usr_time_from`, `tuesday_usr_time_to`, `wednesday_usr_time_from`, `wednesday_usr_time_to`, `thursday_usr_time_from`, `thursday_usr_time_to`, `friday_usr_time_from`, `friday_usr_time_to`, `saturday_usr_time_from`, `saturday_usr_time_to`, `sunday_usr_time_from`, `sunday_usr_time_to`,`pooja_monday_usr_time_from`, `pooja_monday_usr_time_to`, `pooja_tuesday_usr_time_from`, `pooja_tuesday_usr_time_to`, `pooja_wednesday_usr_time_from`, `pooja_wednesday_usr_time_to`, `pooja_thursday_usr_time_from`, `pooja_thursday_usr_time_to`, `pooja_friday_usr_time_from`, `pooja_friday_usr_time_to`, `pooja_saturday_usr_time_from`, `pooja_saturday_usr_time_to`, `pooja_sunday_usr_time_from`, `pooja_sunday_usr_time_to` ) VALUES ('$post_id', '$open_close_monday', '$open_close_tuesday', '$open_close_wednesday', '$open_close_thursday', '$open_close_friday', '$open_close_saturday', '$open_close_sunday', '$monday_usr_time_from', '$monday_usr_time_to', '$tuesday_usr_time_from', '$tuesday_usr_time_to', '$wednesday_usr_time_from', '$wednesday_usr_time_to', '$thursday_usr_time_from', '$thursday_usr_time_to', '$friday_usr_time_from', '$friday_usr_time_to', '$saturday_usr_time_from', '$saturday_usr_time_to', '$sunday_usr_time_from', '$sunday_usr_time_to', '$pooja_monday_usr_time_from', '$pooja_monday_usr_time_to', '$pooja_tuesday_usr_time_from', '$pooja_tuesday_usr_time_to', '$pooja_wednesday_usr_time_from', '$pooja_wednesday_usr_time_to', '$pooja_thursday_usr_time_from', '$pooja_thursday_usr_time_to', '$pooja_friday_usr_time_from', '$pooja_friday_usr_time_to', '$pooja_saturday_usr_time_from', '$pooja_saturday_usr_time_to', '$pooja_sunday_usr_time_from', '$pooja_sunday_usr_time_to' )");
		$addPostSixthGroup = array('success' => "1");
		$final_json = json_encode($addPostSixthGroup);
	}else{
		$addPostSixthGroup = array('success' => "0");
		$final_json = json_encode($addPostSixthGroup);
	}
		return $final_json;
	}
	public function addPostSevenGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$SevenGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $SevenGroupPost);
		$create_by = $SevenGroupPost['created_by'];
		   $catagory_id = $SevenGroupPost['catagory_id'];
		   $sub_catagory_id = $SevenGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $SevenGroupPost['seven_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($SevenGroupPost['seven_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $SevenGroupPost['seven_post_url'];		   
		   $address = str_replace("'", "&apos;", $SevenGroupPost['seven_address']);
		   $street = str_replace("'", "&apos;", $SevenGroupPost['seven_street']);
		   $city = str_replace("'", "&apos;", $SevenGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $SevenGroupPost['st-country']);
		   $zip = $SevenGroupPost['seven_zip'];
		   $open_close_monday = isset($SevenGroupPost['seven_open_monday']) ? "Open":"Close";
		   $open_close_tuesday = isset($SevenGroupPost['seven_open_tuesday']) ? "Open":"Close";
		   $open_close_wednesday = isset($SevenGroupPost['seven_open_wednesday']) ? "Open":"Close";
		   $open_close_thursday = isset($SevenGroupPost['seven_open_thursday']) ? "Open":"Close";
		   $open_close_friday = isset($SevenGroupPost['seven_open_friday']) ? "Open":"Close";
		   $open_close_saturday = isset($SevenGroupPost['seven_open_saturday']) ? "Open":"Close";
		   $open_close_sunday = isset($SevenGroupPost['seven_open_sunday']) ? "Open":"Close";
		   $monday_usr_time_from = $SevenGroupPost['seven_monday_usr_time_from'];
		   $monday_usr_time_to = $SevenGroupPost['seven_monday_usr_time_to'];
		   $tuesday_usr_time_from = $SevenGroupPost['seven_tuesday_usr_time_from'];
		   $tuesday_usr_time_to = $SevenGroupPost['seven_tuesday_usr_time_to'];
		   $wednesday_usr_time_from = $SevenGroupPost['seven_wednesday_usr_time_from'];
		   $wednesday_usr_time_to = $SevenGroupPost['seven_wednesday_usr_time_to'];
		   $thursday_usr_time_from = $SevenGroupPost['seven_thursday_usr_time_from'];
		   $thursday_usr_time_to = $SevenGroupPost['seven_thursday_usr_time_to'];
		   $friday_usr_time_from = $SevenGroupPost['seven_friday_usr_time_from'];
		   $friday_usr_time_to = $SevenGroupPost['seven_friday_usr_time_to'];
		   $saturday_usr_time_from = $SevenGroupPost['seven_saturday_usr_time_from'];
		   $saturday_usr_time_to = $SevenGroupPost['seven_saturday_usr_time_to'];
		   $sunday_usr_time_from = $SevenGroupPost['seven_sunday_usr_time_from'];
		   $sunday_usr_time_to = $SevenGroupPost['seven_sunday_usr_time_to'];
		   $pooja_monday_usr_time_from = $SevenGroupPost['other_seven_monday_usr_time_from'];
		   $pooja_monday_usr_time_to = $SevenGroupPost['other_seven_monday_usr_time_to'];
		   $pooja_tuesday_usr_time_from = $SevenGroupPost['other_seven_tuesday_usr_time_from'];
		   $pooja_tuesday_usr_time_to = $SevenGroupPost['other_seven_tuesday_usr_time_to'];
		   $pooja_wednesday_usr_time_from = $SevenGroupPost['other_seven_wednesday_usr_time_from'];
		   $pooja_wednesday_usr_time_to = $SevenGroupPost['other_seven_wednesday_usr_time_to'];
		   $pooja_thursday_usr_time_from = $SevenGroupPost['other_seven_thursday_usr_time_from'];
		   $pooja_thursday_usr_time_to = $SevenGroupPost['other_seven_thursday_usr_time_to'];
		   $pooja_friday_usr_time_from = $SevenGroupPost['other_seven_friday_usr_time_from'];
		   $pooja_friday_usr_time_to = $SevenGroupPost['other_seven_friday_usr_time_to'];
		   $pooja_saturday_usr_time_from = $SevenGroupPost['other_seven_saturday_usr_time_from'];
		   $pooja_saturday_usr_time_to = $SevenGroupPost['other_seven_saturday_usr_time_to'];
		   $pooja_sunday_usr_time_from = $SevenGroupPost['other_seven_sunday_usr_time_from'];
		   $pooja_sunday_usr_time_to = $SevenGroupPost['other_seven_sunday_usr_time_to'];
		   $description = str_replace("'", "&apos;", $SevenGroupPost['seven_description']); 
		   $post_image = $SevenGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostSevenGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`,  `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostSevenGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `open_close_monday`, `open_close_tuesday`, `open_close_wednesday`, `open_close_thursday`, `open_close_friday`, `open_close_saturday`, `open_close_sunday`, `monday_usr_time_from`, `monday_usr_time_to`, `tuesday_usr_time_from`, `tuesday_usr_time_to`, `wednesday_usr_time_from`, `wednesday_usr_time_to`, `thursday_usr_time_from`, `thursday_usr_time_to`, `friday_usr_time_from`, `friday_usr_time_to`, `saturday_usr_time_from`, `saturday_usr_time_to`, `sunday_usr_time_from`, `sunday_usr_time_to`,`pooja_monday_usr_time_from`, `pooja_monday_usr_time_to`, `pooja_tuesday_usr_time_from`, `pooja_tuesday_usr_time_to`, `pooja_wednesday_usr_time_from`, `pooja_wednesday_usr_time_to`, `pooja_thursday_usr_time_from`, `pooja_thursday_usr_time_to`, `pooja_friday_usr_time_from`, `pooja_friday_usr_time_to`, `pooja_saturday_usr_time_from`, `pooja_saturday_usr_time_to`, `pooja_sunday_usr_time_from`, `pooja_sunday_usr_time_to`) VALUES ('$post_id', '$open_close_monday', '$open_close_tuesday', '$open_close_wednesday', '$open_close_thursday', '$open_close_friday', '$open_close_saturday', '$open_close_sunday', '$monday_usr_time_from', '$monday_usr_time_to', '$tuesday_usr_time_from', '$tuesday_usr_time_to', '$wednesday_usr_time_from', '$wednesday_usr_time_to', '$thursday_usr_time_from', '$thursday_usr_time_to', '$friday_usr_time_from', '$friday_usr_time_to', '$saturday_usr_time_from', '$saturday_usr_time_to', '$sunday_usr_time_from', '$sunday_usr_time_to', '$pooja_monday_usr_time_from', '$pooja_monday_usr_time_to', '$pooja_tuesday_usr_time_from', '$pooja_tuesday_usr_time_to', '$pooja_wednesday_usr_time_from', '$pooja_wednesday_usr_time_to', '$pooja_thursday_usr_time_from', '$pooja_thursday_usr_time_to', '$pooja_friday_usr_time_from', '$pooja_friday_usr_time_to', '$pooja_saturday_usr_time_from', '$pooja_saturday_usr_time_to', '$pooja_sunday_usr_time_from', '$pooja_sunday_usr_time_to')");
		$addPostSevenGroup = array('success' => "1");
		$final_json = json_encode($addPostSevenGroup);
	}else{
		$addPostSevenGroup = array('success' => "0");
		$final_json = json_encode($addPostSevenGroup);
	}
		return $final_json;
	}
	public function addPostEightGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$EightGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $EightGroupPost);
		$create_by = $EightGroupPost['created_by'];
		   $catagory_id = $EightGroupPost['catagory_id'];
		   $sub_catagory_id = $EightGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $EightGroupPost['eight_post_name']);
		   $post_url = $EightGroupPost['eight_post_url'];
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($EightGroupPost['eight_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $email = $EightGroupPost['eight_email'];		   
		   $address = str_replace("'", "&apos;", $EightGroupPost['eight_address']);
		   $street = str_replace("'", "&apos;", $EightGroupPost['eight_street']);
		   $city = str_replace("'", "&apos;", $EightGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $EightGroupPost['st-country']);
		   $zip = $EightGroupPost['eight_zip'];
		   $address = str_replace("'", "&apos;", $EightGroupPost['eight_address']);
		   $mobile_num = $EightGroupPost['eight_mobile_num'];
		   $open_close_monday = isset($EightGroupPost['eight_open_monday']) ? "Open":"Close";
		   $open_close_tuesday = isset($EightGroupPost['eight_open_tuesday']) ? "Open":"Close";
		   $open_close_wednesday = isset($EightGroupPost['eight_open_wednesday']) ? "Open":"Close";
		   $open_close_thursday = isset($EightGroupPost['eight_open_thursday']) ? "Open":"Close";
		   $open_close_friday = isset($EightGroupPost['eight_open_friday']) ? "Open":"Close";
		   $open_close_saturday = isset($EightGroupPost['eight_open_saturday']) ? "Open":"Close";
		   $open_close_sunday = isset($EightGroupPost['eight_open_sunday']) ? "Open":"Close";
		   $monday_usr_time_from = $EightGroupPost['eight_monday_usr_time_from'];
		   $monday_usr_time_to = $EightGroupPost['eight_monday_usr_time_to'];
		   $tuesday_usr_time_from = $EightGroupPost['eight_tuesday_usr_time_from'];
		   $tuesday_usr_time_to = $EightGroupPost['eight_tuesday_usr_time_to'];
		   $wednesday_usr_time_from = $EightGroupPost['eight_wednesday_usr_time_from'];
		   $wednesday_usr_time_to = $EightGroupPost['eight_wednesday_usr_time_to'];
		   $thursday_usr_time_from = $EightGroupPost['eight_thursday_usr_time_from'];
		   $thursday_usr_time_to = $EightGroupPost['eight_thursday_usr_time_to'];
		   $friday_usr_time_from = $EightGroupPost['eight_friday_usr_time_from'];
		   $friday_usr_time_to = $EightGroupPost['eight_friday_usr_time_to'];
		   $saturday_usr_time_from = $EightGroupPost['eight_saturday_usr_time_from'];
		   $saturday_usr_time_to = $EightGroupPost['eight_saturday_usr_time_to'];
		   $sunday_usr_time_from = $EightGroupPost['eight_sunday_usr_time_from'];
		   $sunday_usr_time_to = $EightGroupPost['eight_sunday_usr_time_to'];
		   $description = str_replace("'", "&apos;", $EightGroupPost['eight_description']);
		   $post_image = $EightGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostEightGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `post_url`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`, `mobile_num`,`post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$post_url', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostEightGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `open_close_monday`, `open_close_tuesday`, `open_close_wednesday`, `open_close_thursday`, `open_close_friday`, `open_close_saturday`, `open_close_sunday`, `monday_usr_time_from`, `monday_usr_time_to`, `tuesday_usr_time_from`, `tuesday_usr_time_to`, `wednesday_usr_time_from`, `wednesday_usr_time_to`, `thursday_usr_time_from`, `thursday_usr_time_to`, `friday_usr_time_from`, `friday_usr_time_to`, `saturday_usr_time_from`, `saturday_usr_time_to`, `sunday_usr_time_from`, `sunday_usr_time_to` ) VALUES ('$post_id', '$open_close_monday', '$open_close_tuesday', '$open_close_wednesday', '$open_close_thursday', '$open_close_friday', '$open_close_saturday', '$open_close_sunday', '$monday_usr_time_from', '$monday_usr_time_to', '$tuesday_usr_time_from', '$tuesday_usr_time_to', '$wednesday_usr_time_from', '$wednesday_usr_time_to', '$thursday_usr_time_from', '$thursday_usr_time_to', '$friday_usr_time_from', '$friday_usr_time_to', '$saturday_usr_time_from', '$saturday_usr_time_to', '$sunday_usr_time_from', '$sunday_usr_time_to')");
		$addPostEightGroup = array('success' => "1");
		$final_json = json_encode($addPostEightGroup);
	}else{
		$addPostEightGroup = array('success' => "0");
		$final_json = json_encode($addPostEightGroup);
	}
		return $final_json;
	}
	public function addPostNineGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$NineGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $NineGroupPost);
		$create_by = $NineGroupPost['created_by'];
		   $catagory_id = $NineGroupPost['catagory_id'];
		   $sub_catagory_id = str_replace("'", "&apos;", $NineGroupPost['sub_catagory_id']);
		   $post_name = $NineGroupPost['nine_post_name'];
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($NineGroupPost['nine_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
			if($sub_catagory_id == 21){
				$url_name = $url_name.'-hindi';
			}
			if($sub_catagory_id == 22){
				$url_name = $url_name.'-telugu';
			}
			if($sub_catagory_id == 23){
				$url_name = $url_name.'-english';
			}
			if($sub_catagory_id == 24){
				$url_name = $url_name.'-tamil';
			}
			if($sub_catagory_id == 21){
				$url_name = $url_name.'-malayalam';
			}
			
		   $address = str_replace("'", "&apos;", $NineGroupPost['nine_address']);
		   $street = str_replace("'", "&apos;", $NineGroupPost['nine_street']);
		   $city = str_replace("'", "&apos;", $NineGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $NineGroupPost['st-country']);
		   $zip = $NineGroupPost['nine_zip'];
		   $director = str_replace("'", "&apos;", $NineGroupPost['nine_director']);
		   $producer = str_replace("'", "&apos;", $NineGroupPost['nine_producer']);		   
		   $music = str_replace("'", "&apos;", $NineGroupPost['nine_music']);
		   $theaters = str_replace("'", "&apos;", $NineGroupPost['nine_theaters']);
		   $cast_crew = str_replace("'", "&apos;", $NineGroupPost['nine_cast_crew']);
		   $release_date = $NineGroupPost['nine_date'];
		   $description = str_replace("'", "&apos;", $NineGroupPost['nine_description']);
		   $post_image = $NineGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostNineGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostNineGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `director`, `producer`, `music`, `theaters`, `cast_crew`, `release_date` ) VALUES ('$post_id', '$director', '$producer', '$music', '$theaters', '$cast_crew', '$release_date')");
		$addPostNineGroup = array('success' => "1");
		$final_json = json_encode($addPostNineGroup);
	}else{
		$addPostNineGroup = array('success' => "0");
		$final_json = json_encode($addPostNineGroup);
	}
		return $final_json;
	}
	public function addPostTenGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$TenGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $TenGroupPost);
		$create_by = $TenGroupPost['created_by'];
		   $catagory_id = $TenGroupPost['catagory_id'];
		   $sub_catagory_id = $TenGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $TenGroupPost['ten_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($TenGroupPost['ten_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $TenGroupPost['ten_post_url'];
		   $email = $TenGroupPost['ten_email'];		   
		   $mobile_num = $TenGroupPost['ten_mobile_num'];
		   $address = str_replace("'", "&apos;", $TenGroupPost['ten_address']);
		   $street = str_replace("'", "&apos;", $TenGroupPost['ten_street']);
		   $city = str_replace("'", "&apos;", $TenGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $TenGroupPost['st-country']);
		   $zip = $TenGroupPost['ten_zip'];
		   $description = str_replace("'", "&apos;", $TenGroupPost['ten_description']);
		   $post_image = $TenGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
if($url_name !='' && $post_image !=''){
		
		$addPostTenGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `post_url`, `catagory_id`, `sub_catagory_id`, `address`,`street`, `city`, `country`, `zip`,  `mobile_num`,`post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$post_url', '$catagory_id', '$sub_catagory_id', '$address','$street', '$city', '$country', '$zip',  '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$addPostTenGroup = array('success' => "1");
		$final_json = json_encode($addPostTenGroup);
	}else{
		$addPostTenGroup = array('success' => "0");
		$final_json = json_encode($addPostTenGroup);
	}
		return $final_json;
	}
	public function addPostElevenGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$ElevenGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $ElevenGroupPost);
		$create_by = $ElevenGroupPost['created_by'];
		   $catagory_id = $ElevenGroupPost['catagory_id'];
		   $sub_catagory_id = $ElevenGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $ElevenGroupPost['twelve_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($ElevenGroupPost['twelve_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $ElevenGroupPost['twelve_post_url'];
		   $email = $ElevenGroupPost['twelve_email'];		   
		   $address = str_replace("'", "&apos;", $ElevenGroupPost['twelve_address']);
		   $street = str_replace("'", "&apos;", $ElevenGroupPost['twelve_street']);
		   $city = str_replace("'", "&apos;", $ElevenGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $ElevenGroupPost['st-country']);
		   $zip = $ElevenGroupPost['twelve_zip'];
		   $mobile_num = $ElevenGroupPost['twelve_mobile_num'];
		   $owner = str_replace("'", "&apos;", $ElevenGroupPost['twelve_owner']);
		   $description = str_replace("'", "&apos;", $ElevenGroupPost['twelve_description']);
		   $post_image = $ElevenGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostElevenGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `post_url`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`, `mobile_num`, `post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$post_url', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostElevenGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `owner_name`) VALUES ('$post_id', '$owner')");
		$addPostElevenGroup = array('success' => "1");
		$final_json = json_encode($addPostElevenGroup);
	}else{
		$addPostElevenGroup = array('success' => "0");
		$final_json = json_encode($addPostElevenGroup);
	}
		return $final_json;
	}
	public function addPostTwelveGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$TwelveGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $TwelveGroupPost);
		$create_by = $TwelveGroupPost['created_by'];
		   $catagory_id = $TwelveGroupPost['catagory_id'];
		   $sub_catagory_id = $TwelveGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $TwelveGroupPost['thirteen_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($TwelveGroupPost['thirteen_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $post_url = $TwelveGroupPost['thirteen_post_url'];
		   $email = $TwelveGroupPost['thirteen_email'];	
		   $price = $TwelveGroupPost['thirteen_price'];	   
		   $address = str_replace("'", "&apos;", $TwelveGroupPost['thirteen_address']);
		   $street = str_replace("'", "&apos;", $TwelveGroupPost['thirteen_street']);
		   $city = str_replace("'", "&apos;", $TwelveGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $TwelveGroupPost['st-country']);
		   $zip = $TwelveGroupPost['thirteen_zip'];
		   $mobile_num = $TwelveGroupPost['thirteen_mobile_num'];
		   $owner = str_replace("'", "&apos;", $TwelveGroupPost['thirteen_owner']);
		   $event_start_date = $TwelveGroupPost['event_start_date'];
		   $event_end_date = $TwelveGroupPost['event_end_date'];
		   $event_start_time = $TwelveGroupPost['event_start_time'];
		   $event_end_time = $TwelveGroupPost['event_end_time'];
		   $description = str_replace("'", "&apos;", $TwelveGroupPost['thirteen_description']);
		   $post_image = $TwelveGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addPostTwelveGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`, `post_image`, `post_url`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`, `mobile_num`, `post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_image', '$post_url', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addPostTwelveGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `price`, `owner_name`, `event_start_date`, `event_end_date`, `event_start_time`, `event_end_time`) VALUES ('$post_id', '$price','$owner','$event_start_date','$event_end_date','$event_start_time','$event_end_time')");
		$addPostTwelveGroup = array('success' => "1");
		$final_json = json_encode($addPostTwelveGroup);
	}else{
		$addPostTwelveGroup = array('success' => "0");
		$final_json = json_encode($addPostTwelveGroup);
	}
		return $final_json;
	}
	public function addPostThirteenGroupPost(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$ThirteenGroupPost = $this->request->data;
		$TouristPlacesPostDetail = array('noStates' => $ThirteenGroupPost);
		$create_by = $ThirteenGroupPost['created_by'];
		   $catagory_id = $ThirteenGroupPost['catagory_id'];
		   $sub_catagory_id = $ThirteenGroupPost['sub_catagory_id'];
		   $post_name = str_replace("'", "&apos;", $ThirteenGroupPost['eleven_post_name']);
		   $url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($ThirteenGroupPost['eleven_post_name'], 'UTF-8'));
			$url_name = str_replace("-", " ",$url_name);
			$url_name = preg_replace('/\s\s+/', ' ', $url_name);
			$url_name = str_replace(" ", "-",$url_name);
			$url_name = trim($url_name,'-');
		   $email = $ThirteenGroupPost['eleven_email'];		   
		   $address = str_replace("'", "&apos;", $ThirteenGroupPost['eleven_address']);
		   $street = str_replace("'", "&apos;", $ThirteenGroupPost['eleven_street']);
		   $city = str_replace("'", "&apos;", $ThirteenGroupPost['st-city']);
		   $country = str_replace("'", "&apos;", $ThirteenGroupPost['st-country']);
		   $zip = $ThirteenGroupPost['eleven_zip'];
		   $mobile_num = $ThirteenGroupPost['eleven_mobile_num'];
		   $post_url = $ThirteenGroupPost['eleven_post_url'];
		   $price = $ThirteenGroupPost['eleven_price'];
		   $owner_name = str_replace("'", "&apos;", $ThirteenGroupPost['eleven_owner_name']);
		   $description = str_replace("'", "&apos;", $ThirteenGroupPost['eleven_description']);
		   $post_image = $ThirteenGroupPost['post_image'];
		   $post_status = 1;
		   $created_at = date('Y-m-d H:i:s');
		$addThirteenGroup = $this->User->query("INSERT INTO mnst_user_posts(`create_by`, `post_name`,`url_name`,`post_url`, `post_image`, `catagory_id`, `sub_catagory_id`, `address`,`street`,`city`,`country`,`zip`, `mobile_num`,`post_email`, `description`,`status`, `created_at`) VALUES ('$create_by', '$post_name','$url_name', '$post_url', '$post_image', '$catagory_id', '$sub_catagory_id', '$address','$street','$city','$country','$zip', '$mobile_num','$email', '$description','$post_status', '$created_at')");
		$last_id = $this->User->query("SELECT id FROM mnst_user_posts ORDER BY id DESC LIMIT 1");
		$post_id = $last_id[0]['mnst_user_posts']['id'];
if($post_id !=''){
		$addThirteenGroupDetails = $this->User->query("INSERT INTO mnst_user_post_details(`post_id`, `price`, `owner_name`) VALUES ('$post_id', '$price', '$owner_name')");
		$ThirteenGroup = array('success' => "1");
		$final_json = json_encode($ThirteenGroup);
	}else{
		$ThirteenGroup = array('success' => "0");
		$final_json = json_encode($ThirteenGroup);
	}
		return $final_json;
	}
	public function getPostBySubCategorySearch(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $sub_category);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_cat_subcat = $this->request->data;
		$page_no = (isset($post_cat_subcat['pagination']) && $post_cat_subcat['pagination'] > 1) ? ($post_cat_subcat['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$category_id = $post_cat_subcat['category_id'];
		$sub_cat_id = $post_cat_subcat['sub_category_id'];
		$sub_cat_name = $post_cat_subcat['url_id_cat'];
		$post_search = $post_cat_subcat['search_contain'];
	
if($sub_cat_name == 'all posts'){
	$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $postUserId AND status = 1) AS counts,  CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = $postUserId LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
}else{
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE post_name  LIKE '%$post_search%' AND catagory_id = $category_id AND sub_catagory_id = $sub_cat_id AND status = 1) AS counts, (SELECT category_name FROM mnst_category WHERE id = $category_id AND category_status = 1) AS category_name,(SELECT subcategory_name FROM mnst_subcategory WHERE id = $sub_cat_id AND subcategory_status = 1) AS subcategory_name, CONCAT(usr.firstname,' ',usr.lastname) creted_by,  upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num ,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.post_name  LIKE '%$post_search%' AND  upst.catagory_id = $category_id AND upst.sub_catagory_id = $sub_cat_id AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		
}
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['subcategory_name'] = $getValue['upst']['subcategory_name'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['price'] = $getValue['upst']['price'];
			$finalArray[$i]['created_at'] = date("d-M-Y", strtotime($getValue['upst']['created_at']));
			$finalArray[$i]['creted_by'] = $getValue[0]['creted_by'];
			$finalArray[$i]['subcategory_name'] = $getValue[0]['subcategory_name'];
			$finalArray[$i]['category_name'] = $getValue[0]['category_name'];
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			if(isset($getValue['upst']['post_url'])){ 
				$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			} else { 
				$finalArray[$i]['post_url'] =  'N/A'; 
			};
			if(isset($getValue['upst']['phone_national_code']) && isset($getValue['upst']['mobile_num'])){ 
				$finalArray[$i]['phone_national_code'] = $getValue['upst']['phone_national_code'].''.$getValue['upst']['mobile_num']; 
			} else { 
				$finalArray[$i]['phone_national_code'] =  'N/A'; 
			};
			$i++;
		}
		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){
			$finalArray[0]['search_contain'] = $post_search;
			$final_json = json_encode($finalArray);
		}else{
			$getPostsCategoryDetails = $this->User->query("SELECT category_name FROM mnst_category WHERE id = $category_id");
			$finalArray[0]['category_name'] = $getPostsCategoryDetails[0]['mnst_category']['category_name'];
			$getPostsSubcategoryDetails = $this->User->query("SELECT subcategory_name FROM mnst_subcategory WHERE id = $sub_cat_id");
			$finalArray[0]['subcategory_name'] = $getPostsSubcategoryDetails[0]['mnst_subcategory']['subcategory_name'];
			$finalArray[0]['search_contain'] = $post_search;
			$finalArray[0]['noPosts'] = '0';
			$finalArray = array('noPosts' => $finalArray);
			$final_json = json_encode($finalArray);
		}
		return $final_json;
	}
	public function userPostListSearch(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $this->request->data);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_user_id = $this->request->data;
		$user_id = $post_user_id['id'];
		$post_category = $post_user_id['category_id'];
		$post_search = $post_user_id['search_value'];
		if($post_category == 'allPosts'){
			$post_cat_condition = " ";
			$category_name_condition = " ";
			$post_count_user = "(SELECT count(id) FROM mnst_user_posts WHERE post_name  LIKE '%$post_search%' AND create_by = $user_id AND status = 1) as counts";
		}else{
			$category_name_condition = "(SELECT category_name FROM mnst_category WHERE id = $post_category) AS category_name,";
			$post_cat_condition = " AND upst.catagory_id = $post_category"; 
			$post_count_user = "(SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND catagory_id = $post_category AND status = 1) as counts";
		}
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT $post_count_user, $category_name_condition usr.id,usr.firstname,usr.lastname, CONCAT(usr.firstname,' ',usr.lastname) create_by, usr.email,usr.phone,usr.user_image,usr.created_at, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_users AS usr ON usr.id = upst.create_by INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.post_name  LIKE '%$post_search%' AND  usr.id = $user_id $post_cat_condition AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));
			$finalArray[$i]['create_by'] = $getValue[0]['create_by'];
			$finalArray[$i]['user_id'] = $getValue['usr']['id'];
			$finalArray[$i]['firstname'] = $getValue['usr']['firstname'];
			$finalArray[$i]['lastname'] = $getValue['usr']['lastname'];
			$finalArray[$i]['email'] = $getValue['usr']['email'];
			$finalArray[$i]['phone'] = $getValue['usr']['phone'];
			$finalArray[$i]['user_image'] = $getValue['usr']['user_image'];
			$finalArray[$i]['user_created_at'] = date('M d, Y',strtotime($getValue['usr']['created_at']));
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			$finalArray[$i]['category_name'] = $getValue['mct']['category_name'];
			$finalArray[$i]['subcategory_name'] = $getValue['msct']['subcategory_name'];
			if(isset($getValue['upst']['post_url'])){ 
				$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			} else { 
				$finalArray[$i]['post_url'] =  'N/A'; 
			};
			if(isset($getValue['upst']['phone_national_code']) && isset($getValue['upst']['mobile_num'])){ 
				$finalArray[$i]['phone_national_code'] = $getValue['upst']['phone_national_code'].''.$getValue['upst']['mobile_num']; 
			} else { 
				$finalArray[$i]['phone_national_code'] =  'N/A'; 
			};
			$i++;
		}
		if(count($finalArray) > 0 && $finalArray[0]['post_name'] != ''){
			$final_json = json_encode($finalArray);
		}else{
			$getPostsDetails = $this->User->query("SELECT usr.id,usr.firstname,usr.lastname,usr.username,usr.email,usr.user_image,usr.phone,usr.created_at,count(upst.id) as counts FROM mnst_users as usr LEFT JOIN mnst_user_posts as upst ON upst.create_by = usr.id WHERE usr.id = $user_id AND upst.post_name  LIKE '%$post_search%' AND upst.status = 1");
			$finalArray[0]['id'] = $getPostsDetails[0]['usr']['id'];
			$finalArray[0]['firstname'] = $getPostsDetails[0]['usr']['firstname'];
			$finalArray[0]['lastname'] = $getPostsDetails[0]['usr']['lastname'];
			$finalArray[0]['create_by'] = $getPostsDetails[0]['usr']['username'];
			$finalArray[0]['email'] = $getPostsDetails[0]['usr']['email'];
			$finalArray[0]['phone'] = $getPostsDetails[0]['usr']['phone'];
			$finalArray[0]['user_image'] = $getPostsDetails[0]['usr']['user_image'];
			$finalArray[0]['user_created_at'] = date('M d, Y',strtotime($getPostsDetails[0]['usr']['created_at']));
			$finalArray[0]['counts'] = $getPostsDetails[0][0]['counts'];
			$finalArray[0]['noPosts'] = '0';
			/*$getPostsCategoryDetails = $this->User->query("SELECT category_name FROM mnst_category WHERE id = $post_category");
				$finalArray[0]['category_name'] = $getPostsCategoryDetails[0]['mnst_category']['category_name'];*/
			
			$final_json = json_encode($finalArray);
		}
		return $final_json;
	}
	// for myposts search 
	public function myPostsSearch(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$searchDetails = $this->request->data;
		$user_id = $searchDetails['user_id'];
		$search_value = $searchDetails['search_value'];
		$pagination = $searchDetails['pagination'];	
		
		
		$page_no = (isset($searchDetails['pagination']) && $searchDetails['pagination'] > 1) ? ($searchDetails['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND post_name LIKE '%$search_value%' AND status = 1) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.post_name LIKE '%$search_value%' AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		if($getPostsDetails[0][0]['counts'] == ''){
			$getPostsDetails['s']['cnts']['counts'] = 0;
			$final_json = json_encode($getPostsDetails);
		}else{
        $getPostsDetails['s']['cnts']['counts'] = $getPostsDetails[0][0]['counts'];
		$final_json = json_encode($getPostsDetails);
		}
		return $final_json; exit;
	}
	// for myposts search 
	public function pendingPostsSearch(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$searchDetails = $this->request->data;
		$user_id = $searchDetails['user_id'];
		$search_value = $searchDetails['search_value'];
		$pagination = $searchDetails['pagination'];	
		$page_no = (isset($searchDetails['pagination']) && $searchDetails['pagination'] > 1) ? ($searchDetails['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND post_name LIKE '%$search_value%' AND status = 2) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.post_name LIKE '%$search_value%' AND upst.status = 2 ORDER BY upst.id DESC LIMIT $from_limit,5");
		if($getPostsDetails[0][0]['counts'] == ''){
			$getPostsDetails['pendingPosts']['cnts']['counts'] = 0;
			$final_json = json_encode($getPostsDetails);
		}else{
        $getPostsDetails['pendingPosts']['cnts']['counts'] = $getPostsDetails[0][0]['counts'];
		$final_json = json_encode($getPostsDetails);
		}
		return $final_json; exit;
	}
	// for myposts search 
	public function disaprovalPostsSearch(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$searchDetails = $this->request->data;
		$user_id = $searchDetails['user_id'];
		$search_value = $searchDetails['search_value'];
		$pagination = $searchDetails['pagination'];	
		$page_no = (isset($searchDetails['pagination']) && $searchDetails['pagination'] > 1) ? ($searchDetails['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND post_name LIKE '%$search_value%' AND status = 0) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.post_name LIKE '%$search_value%' AND upst.status = 0 ORDER BY upst.id DESC LIMIT $from_limit,5");
		if($getPostsDetails[0][0]['counts'] == ''){
			$getPostsDetails['disaprovalPosts']['cnts']['counts'] = 0;
			$final_json = json_encode($getPostsDetails);
		}else{
        $getPostsDetails['disaprovalPosts']['cnts']['counts'] = $getPostsDetails[0][0]['counts'];
		$final_json = json_encode($getPostsDetails);
		}
		return $final_json; exit;
	}
		
	// get edit Post Details
	public function getEditPostDetails(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$edit_post_details = $this->request->data;
		$user_id = $edit_post_details['post_user_id'];
		$post_name = $edit_post_details['edit_post_id'];
		$getPostsDetails = $this->User->query("SELECT upst.id, upst.create_by, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_email,upst.address,upst.street,upst.city,upst.country,upst.zip, upst.mobile_num , upst.post_url, upst.phone_national_code , upst.catagory_id,upst.sub_catagory_id , mcat.category_name,msbct.subcategory_name, mupd.open_close_monday,mupd.open_close_tuesday,mupd.open_close_wednesday,mupd.open_close_thursday,mupd.open_close_friday,mupd.open_close_saturday,mupd.open_close_sunday,mupd.monday_usr_time_from,mupd.monday_usr_time_to,mupd.tuesday_usr_time_from,mupd.tuesday_usr_time_to,mupd.wednesday_usr_time_from,mupd.wednesday_usr_time_to,mupd.thursday_usr_time_from,mupd.thursday_usr_time_to,mupd.friday_usr_time_from,mupd.friday_usr_time_to,mupd.saturday_usr_time_from,mupd.saturday_usr_time_to,mupd.sunday_usr_time_from,mupd.sunday_usr_time_to,mupd.price,mupd.owner_name,mupd.intakes,mupd.pooja_monday_usr_time_from,mupd.pooja_monday_usr_time_to,mupd.pooja_tuesday_usr_time_from,mupd.pooja_tuesday_usr_time_to,mupd.pooja_wednesday_usr_time_from,mupd.pooja_wednesday_usr_time_to,mupd.pooja_thursday_usr_time_from,mupd.pooja_thursday_usr_time_to,mupd.pooja_friday_usr_time_from,mupd.pooja_friday_usr_time_to,mupd.pooja_saturday_usr_time_from,mupd.pooja_saturday_usr_time_to,mupd.pooja_sunday_usr_time_from,mupd.pooja_sunday_usr_time_to,mupd.director,mupd.producer,mupd.music,mupd.theaters,mupd.cast_crew,mupd.release_date,mupd.event_start_date,mupd.event_end_date,mupd.event_start_time,mupd.event_end_time FROM mnst_user_posts AS upst LEFT JOIN mnst_user_post_details AS mupd ON upst.id = mupd.post_id INNER JOIN mnst_category AS mcat ON mcat.id = upst.catagory_id INNER JOIN mnst_subcategory AS msbct ON msbct.id = upst.sub_catagory_id WHERE upst.create_by = $user_id AND  upst.url_name = '$post_name'");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['create_by'] = $getValue['upst']['create_by'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['post_email'] = $getValue['upst']['post_email'];
			$finalArray[$i]['address'] = $getValue['upst']['address'];
			$finalArray[$i]['street'] = $getValue['upst']['street'];
			$finalArray[$i]['city'] = $getValue['upst']['city'];
			$finalArray[$i]['country'] = $getValue['upst']['country'];
			$finalArray[$i]['zip'] = $getValue['upst']['zip'];
			$finalArray[$i]['mobile_num'] = $getValue['upst']['mobile_num']; 
			$finalArray[$i]['category_name'] = $getValue['mcat']['category_name'];
			$finalArray[$i]['category_id'] = $getValue['upst']['catagory_id'];
			$finalArray[$i]['subcategory_name'] = $getValue['msbct']['subcategory_name'];
			$finalArray[$i]['subcategory_id'] = $getValue['upst']['sub_catagory_id'];
			$finalArray[$i]['open_close_monday'] = $getValue['mupd']['open_close_monday'];
			$finalArray[$i]['open_close_tuesday'] = $getValue['mupd']['open_close_tuesday'];
			$finalArray[$i]['open_close_wednesday'] = $getValue['mupd']['open_close_wednesday'];
			$finalArray[$i]['open_close_thursday'] = $getValue['mupd']['open_close_thursday'];
			$finalArray[$i]['open_close_friday'] = $getValue['mupd']['open_close_friday'];
			$finalArray[$i]['open_close_saturday'] = $getValue['mupd']['open_close_saturday'];
			$finalArray[$i]['open_close_sunday'] = $getValue['mupd']['open_close_sunday'];
			$finalArray[$i]['monday_usr_time_from'] = $getValue['mupd']['monday_usr_time_from'];
			$finalArray[$i]['monday_usr_time_to'] = $getValue['mupd']['monday_usr_time_to'];
			$finalArray[$i]['tuesday_usr_time_from'] = $getValue['mupd']['tuesday_usr_time_from'];
			$finalArray[$i]['tuesday_usr_time_to'] = $getValue['mupd']['tuesday_usr_time_to'];
			$finalArray[$i]['wednesday_usr_time_from'] = $getValue['mupd']['wednesday_usr_time_from'];
			$finalArray[$i]['wednesday_usr_time_to'] = $getValue['mupd']['wednesday_usr_time_to'];
			$finalArray[$i]['thursday_usr_time_from'] = $getValue['mupd']['thursday_usr_time_from'];
			$finalArray[$i]['thursday_usr_time_to'] = $getValue['mupd']['thursday_usr_time_to'];
			$finalArray[$i]['friday_usr_time_from'] = $getValue['mupd']['friday_usr_time_from'];
			$finalArray[$i]['friday_usr_time_to'] = $getValue['mupd']['friday_usr_time_to'];
			$finalArray[$i]['saturday_usr_time_from'] = $getValue['mupd']['saturday_usr_time_from'];
			$finalArray[$i]['saturday_usr_time_to'] = $getValue['mupd']['saturday_usr_time_to'];
			$finalArray[$i]['sunday_usr_time_from'] = $getValue['mupd']['sunday_usr_time_from'];
			$finalArray[$i]['sunday_usr_time_to'] = $getValue['mupd']['sunday_usr_time_to'];
			$finalArray[$i]['price'] = $getValue['mupd']['price'];
			$finalArray[$i]['owner_name'] = $getValue['mupd']['owner_name'];
			$finalArray[$i]['intakes'] = $getValue['mupd']['intakes'];
			$finalArray[$i]['pooja_monday_usr_time_from'] = $getValue['mupd']['pooja_monday_usr_time_from'];
			$finalArray[$i]['pooja_monday_usr_time_to'] = $getValue['mupd']['pooja_monday_usr_time_to'];
			$finalArray[$i]['pooja_tuesday_usr_time_from'] = $getValue['mupd']['pooja_tuesday_usr_time_from'];
			$finalArray[$i]['pooja_tuesday_usr_time_to'] = $getValue['mupd']['pooja_tuesday_usr_time_to'];
			$finalArray[$i]['pooja_wednesday_usr_time_from'] = $getValue['mupd']['pooja_wednesday_usr_time_from'];
			$finalArray[$i]['pooja_wednesday_usr_time_to'] = $getValue['mupd']['pooja_wednesday_usr_time_to'];
			$finalArray[$i]['pooja_thursday_usr_time_from'] = $getValue['mupd']['pooja_thursday_usr_time_from'];
			$finalArray[$i]['pooja_thursday_usr_time_to'] = $getValue['mupd']['pooja_thursday_usr_time_to'];
			$finalArray[$i]['pooja_friday_usr_time_from'] = $getValue['mupd']['pooja_friday_usr_time_from'];
			$finalArray[$i]['pooja_friday_usr_time_to'] = $getValue['mupd']['pooja_friday_usr_time_to'];
			$finalArray[$i]['pooja_saturday_usr_time_from'] = $getValue['mupd']['pooja_saturday_usr_time_from'];
			$finalArray[$i]['pooja_saturday_usr_time_to'] = $getValue['mupd']['pooja_saturday_usr_time_to'];
			$finalArray[$i]['pooja_sunday_usr_time_from'] = $getValue['mupd']['pooja_sunday_usr_time_from'];
			$finalArray[$i]['pooja_sunday_usr_time_to'] = $getValue['mupd']['pooja_sunday_usr_time_to'];
			$finalArray[$i]['event_start_date'] = $getValue['mupd']['event_start_date'];
			if($finalArray[$i]['event_start_date'] == ''){
				$finalArray[$i]['event_start_date'] = '';
			}
			$finalArray[$i]['event_end_date'] = $getValue['mupd']['event_end_date'];
			if($finalArray[$i]['event_end_date'] == ''){
				$finalArray[$i]['event_end_date'] = '';
			}
			$finalArray[$i]['event_start_time'] = $getValue['mupd']['event_start_time'];
			if($finalArray[$i]['event_start_time'] == ''){
				$finalArray[$i]['event_start_time'] = '';
			}
			$finalArray[$i]['event_end_time'] = $getValue['mupd']['event_end_time'];
			if($finalArray[$i]['event_end_time'] == '' ){
				$finalArray[$i]['event_end_time'] = '';
			}
			$finalArray[$i]['director'] = $getValue['mupd']['director'];
			$finalArray[$i]['producer'] = $getValue['mupd']['producer'];
			$finalArray[$i]['music'] = $getValue['mupd']['music'];
			$finalArray[$i]['theaters'] = $getValue['mupd']['theaters'];
			$finalArray[$i]['cast_crew'] = $getValue['mupd']['cast_crew'];
			$finalArray[$i]['release_date'] = date('Y-m-d',strtotime($getValue['mupd']['release_date']));
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
	public function updatePostFirstGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = $updatePost['edit_post_name'];
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_address = $updatePost['edit_post_address'];
		$edit_post_street = $updatePost['edit_post_street'];
		$edit_post_zip = $updatePost['edit_post_zip'];
		$open_close_monday = isset($updatePost['open_close_monday']) ? "Open":"Close";
	   $open_close_tuesday = isset($updatePost['open_close_tuesday']) ? "Open":"Close";
	   $open_close_wednesday = isset($updatePost['open_close_wednesday']) ? "Open":"Close";
	   $open_close_thursday = isset($updatePost['open_close_thursday']) ? "Open":"Close";
	   $open_close_friday = isset($updatePost['open_close_friday']) ? "Open":"Close";
	   $open_close_saturday = isset($updatePost['open_close_saturday']) ? "Open":"Close";
	   $open_close_sunday = isset($updatePost['open_close_sunday']) ? "Open":"Close";
		$monday_usr_time_from = $updatePost['monday_usr_time_from'];
		$monday_usr_time_to = $updatePost['monday_usr_time_to'];
		$tuesday_usr_time_from = $updatePost['tuesday_usr_time_from'];
		$tuesday_usr_time_to = $updatePost['tuesday_usr_time_to'];
		$wednesday_usr_time_from = $updatePost['wednesday_usr_time_from'];
		$wednesday_usr_time_to = $updatePost['wednesday_usr_time_to'];
		$thursday_usr_time_from = $updatePost['thursday_usr_time_from'];
		$thursday_usr_time_to = $updatePost['thursday_usr_time_to'];
		$friday_usr_time_from = $updatePost['friday_usr_time_from'];
		$friday_usr_time_to = $updatePost['friday_usr_time_to'];
		$saturday_usr_time_from = $updatePost['saturday_usr_time_from'];
		$saturday_usr_time_to = $updatePost['saturday_usr_time_to'];
		$sunday_usr_time_from = $updatePost['sunday_usr_time_from'];
		$sunday_usr_time_to = $updatePost['sunday_usr_time_to'];
		$edit_post_description = $updatePost['edit_post_description'];
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image', `post_url` = '$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address'
			, `street` = '$edit_post_street', `zip` = '$edit_post_zip', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday', `monday_usr_time_from` = '$monday_usr_time_from',`monday_usr_time_to` = '$monday_usr_time_to',`tuesday_usr_time_from` = '$tuesday_usr_time_from',`tuesday_usr_time_to` = '$tuesday_usr_time_to',`wednesday_usr_time_from` = '$wednesday_usr_time_from',`wednesday_usr_time_to` = '$wednesday_usr_time_to',`thursday_usr_time_from` = '$thursday_usr_time_from',`thursday_usr_time_to` = '$thursday_usr_time_to',`friday_usr_time_from` = '$friday_usr_time_from',`friday_usr_time_to` = '$friday_usr_time_to',`saturday_usr_time_from` = '$saturday_usr_time_from',`saturday_usr_time_to` = '$saturday_usr_time_to',`sunday_usr_time_from` = '$sunday_usr_time_from',`sunday_usr_time_to` = '$sunday_usr_time_to' WHERE post_id = '$edit_post_id'");
		} else {
			$updatePost = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name', `post_url` = '$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `street` = '$edit_post_street', `zip` = '$edit_post_zip', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
		   $updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday', `monday_usr_time_from` = '$monday_usr_time_from',`monday_usr_time_to` = '$monday_usr_time_to',`tuesday_usr_time_from` = '$tuesday_usr_time_from',`tuesday_usr_time_to` = '$tuesday_usr_time_to',`wednesday_usr_time_from` = '$wednesday_usr_time_from',`wednesday_usr_time_to` = '$wednesday_usr_time_to',`thursday_usr_time_from` = '$thursday_usr_time_from',`thursday_usr_time_to` = '$thursday_usr_time_to',`friday_usr_time_from` = '$friday_usr_time_from',`friday_usr_time_to` = '$friday_usr_time_to',`saturday_usr_time_from` = '$saturday_usr_time_from',`saturday_usr_time_to` = '$saturday_usr_time_to',`sunday_usr_time_from` = '$sunday_usr_time_from',`sunday_usr_time_to` = '$sunday_usr_time_to' WHERE post_id = '$edit_post_id'");
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostSecondGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = $updatePost['edit_post_name'];
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_address = $updatePost['edit_post_address'];
		$edit_post_street = $updatePost['edit_post_street'];
		$edit_post_owner_name = $updatePost['edit_post_owner_name'];
		$edit_post_price = $updatePost['edit_post_price'];
		$edit_post_zip = $updatePost['edit_post_zip'];
		$edit_post_description = str_replace("'", "&apos;", $updatePost['edit_post_description']);
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`street`='$edit_post_street',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price', `owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");
		} else {
			$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`street`='$edit_post_street',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price', `owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostThirdGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = str_replace("'", "&apos;",$updatePost['edit_post_name']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_address = str_replace("'", "&apos;",$updatePost['edit_post_address']);
		$edit_post_street = str_replace("'", "&apos;",$updatePost['edit_post_street']);
		$edit_post_owner_name = str_replace("'", "&apos;",$updatePost['edit_post_owner_name']);
		$edit_post_price = $updatePost['edit_post_price'];
		$edit_post_intakes = str_replace("'", "&apos;",$updatePost['edit_post_intakes']);
		$edit_post_zip = $updatePost['edit_post_zip'];
		$open_close_monday = isset($updatePost['open_close_monday']) ? "Open":"Close";
	   $open_close_tuesday = isset($updatePost['open_close_tuesday']) ? "Open":"Close";
	   $open_close_wednesday = isset($updatePost['open_close_wednesday']) ? "Open":"Close";
	   $open_close_thursday = isset($updatePost['open_close_thursday']) ? "Open":"Close";
	   $open_close_friday = isset($updatePost['open_close_friday']) ? "Open":"Close";
	   $open_close_saturday = isset($updatePost['open_close_saturday']) ? "Open":"Close";
	   $open_close_sunday = isset($updatePost['open_close_sunday']) ? "Open":"Close";
		$edit_post_description = str_replace("'", "&apos;",$updatePost['edit_post_description']);
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image',`post_url`='$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`street`='$edit_post_street',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price',`intakes`='$edit_post_intakes',`open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday'  WHERE post_id = '$edit_post_id'");
		} else {
			$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_url`='$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`street`='$edit_post_street',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price',`intakes`='$edit_post_intakes',`open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday'  WHERE post_id = '$edit_post_id'");
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostFourthGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = $updatePost['edit_post_name'];
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_address = $updatePost['edit_post_address'];
		$edit_post_street = $updatePost['edit_post_street'];
		$edit_post_zip = $updatePost['edit_post_zip'];
		$open_close_monday = isset($updatePost['open_close_monday']) ? "Open":"Close";
	   $open_close_tuesday = isset($updatePost['open_close_tuesday']) ? "Open":"Close";
	   $open_close_wednesday = isset($updatePost['open_close_wednesday']) ? "Open":"Close";
	   $open_close_thursday = isset($updatePost['open_close_thursday']) ? "Open":"Close";
	   $open_close_friday = isset($updatePost['open_close_friday']) ? "Open":"Close";
	   $open_close_saturday = isset($updatePost['open_close_saturday']) ? "Open":"Close";
	   $open_close_sunday = isset($updatePost['open_close_sunday']) ? "Open":"Close";
		$monday_usr_time_from = $updatePost['monday_usr_time_from'];
		$monday_usr_time_to = $updatePost['monday_usr_time_to'];
		$tuesday_usr_time_from = $updatePost['tuesday_usr_time_from'];
		$tuesday_usr_time_to = $updatePost['tuesday_usr_time_to'];
		$wednesday_usr_time_from = $updatePost['wednesday_usr_time_from'];
		$wednesday_usr_time_to = $updatePost['wednesday_usr_time_to'];
		$thursday_usr_time_from = $updatePost['thursday_usr_time_from'];
		$thursday_usr_time_to = $updatePost['thursday_usr_time_to'];
		$friday_usr_time_from = $updatePost['friday_usr_time_from'];
		$friday_usr_time_to = $updatePost['friday_usr_time_to'];
		$saturday_usr_time_from = $updatePost['saturday_usr_time_from'];
		$saturday_usr_time_to = $updatePost['saturday_usr_time_to'];
		$sunday_usr_time_from = $updatePost['sunday_usr_time_from'];
		$sunday_usr_time_to = $updatePost['sunday_usr_time_to'];
		$pooja_monday_usr_time_from = $updatePost['pooja_monday_usr_time_from'];
		$pooja_monday_usr_time_to = $updatePost['pooja_monday_usr_time_to'];
		$pooja_tuesday_usr_time_from = $updatePost['pooja_tuesday_usr_time_from'];
		$pooja_tuesday_usr_time_to = $updatePost['pooja_tuesday_usr_time_to'];
		$pooja_wednesday_usr_time_from = $updatePost['pooja_wednesday_usr_time_from'];
		$pooja_wednesday_usr_time_to = $updatePost['pooja_wednesday_usr_time_to'];
		$pooja_thursday_usr_time_from = $updatePost['pooja_thursday_usr_time_from'];
		$pooja_thursday_usr_time_to = $updatePost['pooja_thursday_usr_time_to'];
		$pooja_friday_usr_time_from = $updatePost['pooja_friday_usr_time_from'];
		$pooja_friday_usr_time_to = $updatePost['pooja_friday_usr_time_to'];
		$pooja_saturday_usr_time_from = $updatePost['pooja_saturday_usr_time_from'];
		$pooja_saturday_usr_time_to = $updatePost['pooja_saturday_usr_time_to'];
		$pooja_sunday_usr_time_from = $updatePost['pooja_sunday_usr_time_from'];
		$pooja_sunday_usr_time_to = $updatePost['pooja_sunday_usr_time_to'];
		$edit_post_description = $updatePost['edit_post_description'];
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image', `post_url` = '$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `mobile_num` = '$edit_post_mobile_num',`street`='$edit_post_street',`zip`='$edit_post_zip', `description` = '$edit_post_description',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday', `monday_usr_time_from` = '$monday_usr_time_from',`monday_usr_time_to` = '$monday_usr_time_to',`tuesday_usr_time_from` = '$tuesday_usr_time_from',`tuesday_usr_time_to` = '$tuesday_usr_time_to',`wednesday_usr_time_from` = '$wednesday_usr_time_from',`wednesday_usr_time_to` = '$wednesday_usr_time_to',`thursday_usr_time_from` = '$thursday_usr_time_from',`thursday_usr_time_to` = '$thursday_usr_time_to',`friday_usr_time_from` = '$friday_usr_time_from',`friday_usr_time_to` = '$friday_usr_time_to',`saturday_usr_time_from` = '$saturday_usr_time_from',`saturday_usr_time_to` = '$saturday_usr_time_to',`sunday_usr_time_from` = '$sunday_usr_time_from',`sunday_usr_time_to` = '$sunday_usr_time_to',`pooja_monday_usr_time_from` = '$pooja_monday_usr_time_from',`pooja_monday_usr_time_to` = '$pooja_monday_usr_time_to',`pooja_tuesday_usr_time_from` = '$pooja_tuesday_usr_time_from',`pooja_tuesday_usr_time_to` = '$pooja_tuesday_usr_time_to',`pooja_wednesday_usr_time_from` = '$pooja_wednesday_usr_time_from',`pooja_wednesday_usr_time_to` = '$pooja_wednesday_usr_time_to',`pooja_thursday_usr_time_from` = '$pooja_thursday_usr_time_from',`pooja_thursday_usr_time_to` = '$pooja_thursday_usr_time_to',`pooja_friday_usr_time_from` = '$pooja_friday_usr_time_from',`pooja_friday_usr_time_to` = '$pooja_friday_usr_time_to',`pooja_saturday_usr_time_from` = '$pooja_saturday_usr_time_from',`pooja_saturday_usr_time_to` = '$pooja_saturday_usr_time_to',`pooja_sunday_usr_time_from` = '$pooja_sunday_usr_time_from',`pooja_sunday_usr_time_to` = '$pooja_sunday_usr_time_to' WHERE post_id = '$edit_post_id'");
		} else {
			$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name', `post_url` = '$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `mobile_num` = '$edit_post_mobile_num',`street`='$edit_post_street',`zip`='$edit_post_zip', `description` = '$edit_post_description',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday', `monday_usr_time_from` = '$monday_usr_time_from',`monday_usr_time_to` = '$monday_usr_time_to',`tuesday_usr_time_from` = '$tuesday_usr_time_from',`tuesday_usr_time_to` = '$tuesday_usr_time_to',`wednesday_usr_time_from` = '$wednesday_usr_time_from',`wednesday_usr_time_to` = '$wednesday_usr_time_to',`thursday_usr_time_from` = '$thursday_usr_time_from',`thursday_usr_time_to` = '$thursday_usr_time_to',`friday_usr_time_from` = '$friday_usr_time_from',`friday_usr_time_to` = '$friday_usr_time_to',`saturday_usr_time_from` = '$saturday_usr_time_from',`saturday_usr_time_to` = '$saturday_usr_time_to',`sunday_usr_time_from` = '$sunday_usr_time_from',`sunday_usr_time_to` = '$sunday_usr_time_to',`pooja_monday_usr_time_from` = '$pooja_monday_usr_time_from',`pooja_monday_usr_time_to` = '$pooja_monday_usr_time_to',`pooja_tuesday_usr_time_from` = '$pooja_tuesday_usr_time_from',`pooja_tuesday_usr_time_to` = '$pooja_tuesday_usr_time_to',`pooja_wednesday_usr_time_from` = '$pooja_wednesday_usr_time_from',`pooja_wednesday_usr_time_to` = '$pooja_wednesday_usr_time_to',`pooja_thursday_usr_time_from` = '$pooja_thursday_usr_time_from',`pooja_thursday_usr_time_to` = '$pooja_thursday_usr_time_to',`pooja_friday_usr_time_from` = '$pooja_friday_usr_time_from',`pooja_friday_usr_time_to` = '$pooja_friday_usr_time_to',`pooja_saturday_usr_time_from` = '$pooja_saturday_usr_time_from',`pooja_saturday_usr_time_to` = '$pooja_saturday_usr_time_to',`pooja_sunday_usr_time_from` = '$pooja_sunday_usr_time_from',`pooja_sunday_usr_time_to` = '$pooja_sunday_usr_time_to' WHERE post_id = '$edit_post_id'");
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostFifthGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = $updatePost['edit_post_name'];
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_address = $updatePost['edit_post_address'];
		$edit_post_street = $updatePost['edit_post_street'];
		$edit_post_zip = $updatePost['edit_post_zip'];
		$open_close_monday = isset($updatePost['open_close_monday']) ? "Open":"Close";
	   $open_close_tuesday = isset($updatePost['open_close_tuesday']) ? "Open":"Close";
	   $open_close_wednesday = isset($updatePost['open_close_wednesday']) ? "Open":"Close";
	   $open_close_thursday = isset($updatePost['open_close_thursday']) ? "Open":"Close";
	   $open_close_friday = isset($updatePost['open_close_friday']) ? "Open":"Close";
	   $open_close_saturday = isset($updatePost['open_close_saturday']) ? "Open":"Close";
	   $open_close_sunday = isset($updatePost['open_close_sunday']) ? "Open":"Close";
		$monday_usr_time_from = $updatePost['monday_usr_time_from'];
		$monday_usr_time_to = $updatePost['monday_usr_time_to'];
		$tuesday_usr_time_from = $updatePost['tuesday_usr_time_from'];
		$tuesday_usr_time_to = $updatePost['tuesday_usr_time_to'];
		$wednesday_usr_time_from = $updatePost['wednesday_usr_time_from'];
		$wednesday_usr_time_to = $updatePost['wednesday_usr_time_to'];
		$thursday_usr_time_from = $updatePost['thursday_usr_time_from'];
		$thursday_usr_time_to = $updatePost['thursday_usr_time_to'];
		$friday_usr_time_from = $updatePost['friday_usr_time_from'];
		$friday_usr_time_to = $updatePost['friday_usr_time_to'];
		$saturday_usr_time_from = $updatePost['saturday_usr_time_from'];
		$saturday_usr_time_to = $updatePost['saturday_usr_time_to'];
		$sunday_usr_time_from = $updatePost['sunday_usr_time_from'];
		$sunday_usr_time_to = $updatePost['sunday_usr_time_to'];
		$edit_post_description = $updatePost['edit_post_description'];
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image', `post_url` = '$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address'
			, `street` = '$edit_post_street', `zip` = '$edit_post_zip', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday', `monday_usr_time_from` = '$monday_usr_time_from',`monday_usr_time_to` = '$monday_usr_time_to',`tuesday_usr_time_from` = '$tuesday_usr_time_from',`tuesday_usr_time_to` = '$tuesday_usr_time_to',`wednesday_usr_time_from` = '$wednesday_usr_time_from',`wednesday_usr_time_to` = '$wednesday_usr_time_to',`thursday_usr_time_from` = '$thursday_usr_time_from',`thursday_usr_time_to` = '$thursday_usr_time_to',`friday_usr_time_from` = '$friday_usr_time_from',`friday_usr_time_to` = '$friday_usr_time_to',`saturday_usr_time_from` = '$saturday_usr_time_from',`saturday_usr_time_to` = '$saturday_usr_time_to',`sunday_usr_time_from` = '$sunday_usr_time_from',`sunday_usr_time_to` = '$sunday_usr_time_to' WHERE post_id = '$edit_post_id'");
		} else {
			$updatePost = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name', `post_url` = '$edit_post_url', `post_email` = '$edit_post_email', `address` = '$edit_post_address', `street` = '$edit_post_street', `zip` = '$edit_post_zip', `mobile_num` = '$edit_post_mobile_num', `description` = '$edit_post_description',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
		   $updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `open_close_monday` = '$open_close_monday',`open_close_tuesday` = '$open_close_tuesday',`open_close_wednesday` = '$open_close_wednesday', `open_close_thursday` = '$open_close_thursday', `open_close_friday` = '$open_close_friday', `open_close_saturday` = '$open_close_saturday', `open_close_sunday` = '$open_close_sunday', `monday_usr_time_from` = '$monday_usr_time_from',`monday_usr_time_to` = '$monday_usr_time_to',`tuesday_usr_time_from` = '$tuesday_usr_time_from',`tuesday_usr_time_to` = '$tuesday_usr_time_to',`wednesday_usr_time_from` = '$wednesday_usr_time_from',`wednesday_usr_time_to` = '$wednesday_usr_time_to',`thursday_usr_time_from` = '$thursday_usr_time_from',`thursday_usr_time_to` = '$thursday_usr_time_to',`friday_usr_time_from` = '$friday_usr_time_from',`friday_usr_time_to` = '$friday_usr_time_to',`saturday_usr_time_from` = '$saturday_usr_time_from',`saturday_usr_time_to` = '$saturday_usr_time_to',`sunday_usr_time_from` = '$sunday_usr_time_from',`sunday_usr_time_to` = '$sunday_usr_time_to' WHERE post_id = '$edit_post_id'");
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostSixthGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = str_replace("'", "&apos;",$updatePost['edit_post_name']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_director = str_replace("'", "&apos;",$updatePost['edit_post_director']);
		$edit_post_producer = str_replace("'", "&apos;",$updatePost['edit_post_producer']);
		$edit_post_music = str_replace("'", "&apos;",$updatePost['edit_post_music']);
		$edit_post_theaters = str_replace("'", "&apos;",$updatePost['edit_post_theaters']);
		$edit_post_cast_crew = str_replace("'", "&apos;",$updatePost['edit_post_cast_crew']);
		$edit_post_release_date = $updatePost['edit_post_release_date'];
		$edit_post_address = str_replace("'", "&apos;",$updatePost['edit_post_address']);
		$edit_post_street = str_replace("'", "&apos;",$updatePost['edit_post_street']);
		$edit_post_owner_name = str_replace("'", "&apos;",$updatePost['edit_post_owner_name']);
		$edit_post_zip = $updatePost['edit_post_zip'];
		$edit_post_description = str_replace("'", "&apos;",$updatePost['edit_post_description']);
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `director`='$edit_post_director',`producer`='$edit_post_producer',`music` = '$edit_post_music',`theaters` = '$edit_post_theaters',`cast_crew` = '$edit_post_cast_crew', `release_date` = '$edit_post_release_date' WHERE post_id = '$edit_post_id'");
		
		} else {
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `director`='$edit_post_director',`producer`='$edit_post_producer',`music` = '$edit_post_music',`theaters` = '$edit_post_theaters',`cast_crew` = '$edit_post_cast_crew', `release_date` = '$edit_post_release_date' WHERE post_id = '$edit_post_id'");
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostSeventhGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = str_replace("'", "&apos;",$updatePost['edit_post_name']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_address = str_replace("'", "&apos;",$updatePost['edit_post_address']);
		$edit_post_street = str_replace("'", "&apos;",$updatePost['edit_post_street']);
		$edit_post_zip = $updatePost['edit_post_zip'];
		$edit_post_description = str_replace("'", "&apos;",$updatePost['edit_post_description']);
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image',`post_url`='$edit_post_url',`post_email`='edit_post_email',`mobile_num`='$edit_post_mobile_num', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");		
		} else {
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_url`='$edit_post_url',`post_email`='edit_post_email',`mobile_num`='$edit_post_mobile_num', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");
			
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
public function updatePostEighthGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = str_replace("'", "&apos;",$updatePost['edit_post_name']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_price = $updatePost['edit_post_price'];
		$edit_post_owner_name = $updatePost['edit_post_owner_name'];
		$edit_post_address = str_replace("'", "&apos;",$updatePost['edit_post_address']);
		$edit_post_street = str_replace("'", "&apos;",$updatePost['edit_post_street']);
		$edit_post_zip = $updatePost['edit_post_zip'];
		$edit_post_description = str_replace("'", "&apos;",$updatePost['edit_post_description']);
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image',`post_url`='$edit_post_url',`post_email`='$edit_post_email',`mobile_num`='$edit_post_mobile_num', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$updated_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");	
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price',`owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");	
		} else {
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_url`='$edit_post_url',`post_email`='edit_post_email',`mobile_num`='$edit_post_mobile_num', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");	
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price',`owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");
			
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostNinthGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = str_replace("'", "&apos;",$updatePost['edit_post_name']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_mobile_num = $updatePost['edit_post_mobile_num'];
		$edit_post_owner_name = $updatePost['edit_post_owner_name'];
		$edit_post_address = str_replace("'", "&apos;",$updatePost['edit_post_address']);
		$edit_post_street = str_replace("'", "&apos;",$updatePost['edit_post_street']);
		$edit_post_zip = $updatePost['edit_post_zip'];
		$edit_post_description = str_replace("'", "&apos;",$updatePost['edit_post_description']);
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image',`post_url`='$edit_post_url',`post_email`='$edit_post_email',`mobile_num`='$edit_post_mobile_num', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$updated_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");	
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");	
		} else {
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_url`='$edit_post_url',`post_email`='edit_post_email',`mobile_num`='$edit_post_mobile_num', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$update_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");	
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");
			
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	public function updatePostTenthGroup(){
		self::noView();
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$updatePost = $this->request->data;
		$edit_post_id = $updatePost['edit_post_id'];
		$user_id = $updatePost['user_id'];
		$edit_post_name = str_replace("'", "&apos;",$updatePost['edit_post_name']);
		$url_name = preg_replace('/[^A-Za-z0-9\- ]/', '-', mb_strtolower($updatePost['edit_post_name'], 'UTF-8'));
		$url_name = str_replace("-", " ",$url_name);
		$url_name = preg_replace('/\s\s+/', ' ', $url_name);
		$url_name = str_replace(" ", "-",$url_name);
		$url_name = trim($url_name,'-');
		$edit_post_url = $updatePost['edit_post_url'];
		$edit_post_email = $updatePost['edit_post_email'];
		$edit_post_price = $updatePost['edit_post_price'];
		$edit_post_owner_name = $updatePost['edit_post_owner_name'];
		$event_start_date = $updatePost['event_start_date'];
		$event_start_time = $updatePost['event_start_time'];
		$event_end_date = $updatePost['event_end_date'];
		$event_end_time = $updatePost['event_end_time'];
		$edit_post_address = str_replace("'", "&apos;",$updatePost['edit_post_address']);
		$edit_post_street = str_replace("'", "&apos;",$updatePost['edit_post_street']);
		$edit_post_zip = $updatePost['edit_post_zip'];
		$edit_post_description = str_replace("'", "&apos;",$updatePost['edit_post_description']);
		$post_image = $updatePost['post_image'];
		$updated_at = date('Y-m-d H:i:s');
		$status = 1;
		$info = pathinfo($post_image);
		if(isset($updatePost['edit_post_id']) && $updatePost['edit_post_id'] !=''){
		if(isset( $updatePost['post_image']) &&  $updatePost['post_image'] != '' && $info["extension"] != ""){
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_image` = '$post_image',`post_url`='$edit_post_url',`post_email`='$edit_post_email', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$updated_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");	
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price',`event_start_date`='$event_start_date',`event_end_date`='$event_end_date',`event_start_time`='$event_start_time',`event_end_date`='$event_end_date', `owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");	
		} else {
		$updatePostDetail = $this->User->query("UPDATE mnst_user_posts SET `post_name` = '$edit_post_name',`url_name` = '$url_name',`post_url`='$edit_post_url',`post_email`='$edit_post_email', `address` = '$edit_post_address',`street`='$edit_post_street', `description` = '$edit_post_description',`zip`='$edit_post_zip',`status` = '$status',`updated_at` = '$updated_at' WHERE id = '$edit_post_id' AND create_by = '$user_id'");	
		$updatePostDetail = $this->User->query("UPDATE mnst_user_post_details SET `price`='$edit_post_price',`event_start_date`='$event_start_date',`event_end_date`='$event_end_date',`event_start_time`='$event_start_time',`event_end_date`='$event_end_date', `owner_name`='$edit_post_owner_name' WHERE post_id = '$edit_post_id'");
			
		}
		$updatePostDetail = array('success' => "1");
		$final_json = json_encode($updatePostDetail);
	}else{
		$updatePostDetail = array('noPost' => "0");
		$final_json = json_encode($updatePostDetail);
	}
		return $final_json;
		
	}
	// my account page new services for user posts
	public function myPosts(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $this->request->data);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_user_id = $this->request->data;
		$user_id = $post_user_id['id'];
		$pagination = $post_user_id['pagination'];	
		
		
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 1) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['i'] = $i;
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));			
			
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			$finalArray[$i]['category_name'] = $getValue['mct']['category_name'];
			$finalArray[$i]['subcategory_name'] = $getValue['msct']['subcategory_name'];
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			$finalArray[$i]['price'] = $getValue['upstd']['price'];
			
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
	public function myPostsPagination(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $this->request->data);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_user_id = $this->request->data;
		$user_id = $post_user_id['id'];
		$pagination = $post_user_id['pagination'];	
		
		
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 1) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.status = 1 ORDER BY upst.id DESC LIMIT $from_limit,5");
		if(count($getPostsDetails) > 0 ){
			$final_json = json_encode($getPostsDetails);
		}else{
			
			$finalArray[0]['noPosts'] = '0';
			$finalArray = array('noPosts' => $finalArray);
			$final_json = json_encode($finalArray);
		}
		return $final_json;
	}	
	
	
	public function pendingPosts(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $this->request->data);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_user_id = $this->request->data;
		$user_id = $post_user_id['id'];
		$pagination = $post_user_id['pagination'];	
		
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 2) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.status = 2 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['i'] = $i;
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));			
			
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			$finalArray[$i]['category_name'] = $getValue['mct']['category_name'];
			$finalArray[$i]['subcategory_name'] = $getValue['msct']['subcategory_name'];
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			$finalArray[$i]['price'] = $getValue['upstd']['price']; 
			
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
	public function pendingPostsPagination(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $this->request->data);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_user_id = $this->request->data;
		$user_id = $post_user_id['id'];
		$pagination = $post_user_id['pagination'];	
		
		
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 2) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.status = 2 ORDER BY upst.id DESC LIMIT $from_limit,5");
		if(count($getPostsDetails) > 0 ){
			$final_json = json_encode($getPostsDetails);
		}else{
			
			$finalArray[0]['noPosts'] = '0';
			$finalArray = array('noPosts' => $finalArray);
			$final_json = json_encode($finalArray);
		}
		return $final_json;
	}
	public function disapprovalPosts(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $this->request->data);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_user_id = $this->request->data;
		$user_id = $post_user_id['id'];
		$pagination = $post_user_id['pagination'];	
		
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 0) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.status = 0 ORDER BY upst.id DESC LIMIT $from_limit,5");
		$finalArray = array();
		$i = 0;
		foreach ($getPostsDetails as $getValue) {
			$finalArray[$i]['i'] = $i;
			$finalArray[$i]['id'] = $getValue['upst']['id'];
			$finalArray[$i]['post_name'] = $getValue['upst']['post_name'];
			$finalArray[$i]['url_name'] = $getValue['upst']['url_name'];
			$finalArray[$i]['post_image'] = explode(",", $getValue['upst']['post_image']);
			//$finalArray[$i]['post_url'] = $getValue['upst']['post_url'];
			$finalArray[$i]['description'] = $getValue['upst']['description'];
			$finalArray[$i]['created_at'] = date("m-d-Y", strtotime($getValue['upst']['created_at']));			
			
			$finalArray[$i]['counts'] = $getValue[0]['counts'];
			$finalArray[$i]['category_name'] = $getValue['mct']['category_name'];
			$finalArray[$i]['subcategory_name'] = $getValue['msct']['subcategory_name'];
			$finalArray[$i]['post_url'] = $getValue['upst']['post_url']; 
			$finalArray[$i]['price'] = $getValue['upstd']['price'];
			
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
	public function disaprovalPostsPagination(){
		self::noView();
		/*$getPostsDetails = array('noPosts' => $this->request->data);
		$final_json = json_encode($getPostsDetails);
		return $final_json;*/
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$post_user_id = $this->request->data;
		$user_id = $post_user_id['id'];
		$pagination = $post_user_id['pagination'];	
		
		$page_no = (isset($post_user_id['pagination']) && $post_user_id['pagination'] > 1) ? ($post_user_id['pagination']-1) : "0";
		$from_limit = $page_no * 5;
		$getPostsDetails = $this->User->query("SELECT (SELECT count(id) FROM mnst_user_posts WHERE create_by = $user_id AND status = 0) as counts, upst.id, upst.post_name, upst.url_name, upst.post_image, upst.description, upst.created_at, upst.post_url, upst.phone_national_code, upst.mobile_num, upst.catagory_id,upst.sub_catagory_id,mct.id,mct.category_name,msct.id,msct.subcategory_name,upstd.price FROM mnst_user_posts AS upst INNER JOIN mnst_category AS mct ON mct.id = upst.catagory_id INNER JOIN mnst_subcategory AS msct ON msct.id = upst.sub_catagory_id LEFT JOIN mnst_user_post_details as upstd ON upstd.post_id = upst.id WHERE upst.create_by = $user_id AND upst.status = 0 ORDER BY upst.id DESC LIMIT $from_limit,5");
		if(count($getPostsDetails) > 0 ){
			$final_json = json_encode($getPostsDetails);
		}else{
			
			$finalArray[0]['noPosts'] = '0';
			$finalArray = array('noPosts' => $finalArray);
			$final_json = json_encode($finalArray);
		}
		return $final_json;
	}
	public function updatePostStatus(){
		self::noView();
		
		header("Content-Type:application/json");
		$this->request->data = json_decode(file_get_contents('php://input'), true);
		$update_post = $this->request->data;
		$user_id = $update_post['user_id'];
		$post_id = $update_post['post_id'];
		$post_status = $update_post['post_status'];
		if($post_status == 0){
			$updtPostStatus = $this->User->query("UPDATE mnst_user_post_details SET `post_status` = 1 WHERE post_id = '$post_id'");
			$finalArray = array('update' => 1);
		}elseif($post_status == 1){
			
			$updtPostStatus = $this->User->query("UPDATE mnst_user_post_details SET `post_status` = 1  WHERE post_id = '$post_id'");
			$finalArray = array('update' => 1);
		}
		$final_json = json_encode($finalArray);
		
		return $final_json;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['manage'] = "manage/Authuser";
$route['signout'] = "manage/Authuser/signout";
$route['manage/forgot-pwd'] = "manage/Authuser/forgot_password";
$route['manage/reset-password'] = "manage/Authuser/reset_password";
$route['manage/reset-password/(:any)'] = "manage/Authuser/reset_password/$1";
$route['manage/reset-password/(:any)/(:any)'] = "manage/Authuser/reset_password/$1/$2";

$route['login'] = "user/Authlocaluser";
$route['user/checklogin'] = "user/Authlocaluser/checkLogin";
$route['user/resend-email'] = "user/Authlocaluser/resend_email";
$route['user/forgot-password'] = "user/Authlocaluser/forgot_password";
$route['user/verify-email/(:any)/(:any)'] = "user/Authlocaluser/verify_email/$1/$2";
$route['user/reset-password'] = "user/Authlocaluser/reset_password";
$route['user/reset-password/(:any)'] = "user/Authlocaluser/reset_password/$1";
$route['user/reset-password/(:any)/(:any)'] = "user/Authlocaluser/reset_password/$1/$2";
$route['user/resend-verification'] = "user/Authlocaluser/resendEmailVerification";
$route['checkauth/(:any)'] = "user/Authlocaluser/checkAuthLog/$1";
$route['logout'] = "user/Authlocaluser/logout";
$route['loadcaptcha'] = "user/Authlocaluser/loadcaptcha";
$route['register'] = "user/Authlocaluser/register";
$route['registerview'] = "user/Authlocaluser/registerview";

$route['user/communication-view/(:any)'] = "user/Communication/view/$1";
$route['user/communication-reply/(:any)'] = "user/Communication/update/$1";
$route['user/communication-inbox'] = "user/Communication/index";
$route['user/communication-sent'] = "user/Communication/sent";
$route['user/communication-add'] = "user/Communication/add";

$route['individual/registration/getotp'] = "individual/Individual/getAadharOtp";
$route['individual/registration/verifiyotp'] = "individual/Individual/verifiyAadharOtp";
$route['individual/registration'] = "individual/Individual/index";
$route['individual/dashboard'] = "individual/Dashboard/index";
$route['individual/profile'] = "individual/Individualmaster/index";
$route['individual/change-password'] = "individual/Individualmaster/changePass";

$route['default_controller'] = 'Home';
$route['about-us/(:any)'] = "Home/about/$1";
$route['about'] = "Home/about";
$route['view-message/cid/(:any)'] = "Home/view_message/$1";
$route['important-websites'] = "ImportantWebsites/index";
$route['important-links'] = "ImportantLinks/index";
$route['notice-board'] = "NoticeBoard/index";
$route['notice-board/archive'] = "NoticeBoard/archive";
$route['whats-new'] = "WhatsNew/index";
$route['whats-new/archive'] = "WhatsNew/archive";
$route['whats-new/nid/(:any)'] = "WhatsNew/view/$1";
$route['photo-gallery'] = "PhotoGallery/index";
$route['photo-gallery-view'] = "PhotoGallery/galleryByCategory/";
$route['photo-gallery-view/(:any)'] = "PhotoGallery/galleryByCategory/$1";
$route['video-gallery'] = "VideoGallery/index";
$route['circular'] = "Circular/index";
$route['download'] = "Download/index";
$route['news-details'] = "NewsDetails/index";
$route['message'] = "Message/index";
$route['news-details/archive'] = "NewsDetails/archive";
$route['news-details/nid/(:any)'] = "NewsDetails/view/$1";
$route['search'] = "Page/search";
$route['search/(:any)'] = "Page/search/$1";
$route['search-details/(:any)'] = "Page/search_details/$1";
$route['rti'] = "Rti/index";
$route['whos-who'] = "Whoswho/index";
$route['head-office'] = "Whoswho/head_office";
$route['rulesacts'] = "RulesActs/index";
$route['actsrules'] = "RulesActs/index";
$route['acts'] = "RulesActs/index";
$route['rules'] = "RulesActs/index";
$route['laws'] = "RulesActs/index";
$route['entitlement'] = "Entitlement/index";
$route['entitlement/view/(:any)'] = "Entitlement/view/$1";
$route['contact-us'] = "ContactUs/index";
$route['contact-us/add'] = "ContactUs/add";
$route['hospital'] = "Hospital/index/";
$route['hospital/(:any)'] = "Hospital/index/$1";
$route['hospital/view/(:any)'] = "Hospital/view/$1";
$route['project'] = "Project/index";
$route['project-view'] = "Project/projectByCategory/";
$route['project-view/(:any)'] = "Project/projectByCategory/$1";

$route['publication/view/(:any)'] =  "Publication/getPublicationByCategory/$1";
$route['publication/archive'] = "Publication/archive";
$route['publication/archive/(:any)'] = "Publication/getArcByCategory/$1";
$route['news-details/pressrelease'] = "NewsDetails/getPressReleaseNews";

$route['testimonial/(:any)'] =  "Testimonial/view/$1";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['feedback/add'] = "Feedback/add";
$route['empanelment-consultancy'] = "ProjectMonitoring/index";

$route['test'] ="test/TestFront";

include_once("application/cache/routes.php");
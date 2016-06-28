<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "homepage";
$route['404_override'] = '';

/*
| -------------------------------------------------------------------------
| HOME ROUTES
| -------------------------------------------------------------------------
*/

$route['homepage'] = "homepage";
$route['homepage/(:any)'] = "homepage/$1";

/*
| -------------------------------------------------------------------------
| BLOG ROUTES
| -------------------------------------------------------------------------
*/

$route['blog'] = "blog";
$route['blog/(:any)'] = "blog/$1";

/*
| -------------------------------------------------------------------------
| MESSAGES ROUTES
| -------------------------------------------------------------------------
*/

$route['messages'] = "messages";
$route['messages/(:any)'] = "messages/$1";

/*
| -------------------------------------------------------------------------
| MEMBERS ROUTES
| -------------------------------------------------------------------------
*/

$route['members'] = "members";
$route['members/(:any)'] = "members/$1";

/*
| -------------------------------------------------------------------------
| FORUMS ROUTES
| -------------------------------------------------------------------------
*/

$route['forums'] = "forums";
$route['forums/(:any)'] = "forums/$1";

/*
| -------------------------------------------------------------------------
| NEWS ROUTES
| -------------------------------------------------------------------------
*/

$route['news'] = "news";
$route['news/(:any)'] = "news/$1";

/*
| -------------------------------------------------------------------------
| ADMINISTRATION ROUTES
| -------------------------------------------------------------------------
*/

$route['administration'] = "administration";
$route['administration/(:any)'] = "administration/$1";

/*
| -------------------------------------------------------------------------
| THREADS ROUTES
| -------------------------------------------------------------------------
*/

$route['threads'] = "threads";
$route['threads/(:any)'] = "threads/$1";

/*
| -------------------------------------------------------------------------
| TICKETS ROUTES
| -------------------------------------------------------------------------
*/

$route['tickets'] = "tickets";
$route['tickets/(:any)'] = "tickets/$1";

/*
| -------------------------------------------------------------------------
| USER ROUTES
| -------------------------------------------------------------------------
*/

$route['user'] = "user";
$route['user/(:any)'] = "user/$1";

/*
| -------------------------------------------------------------------------
| VIDEOS ROUTES
| -------------------------------------------------------------------------
*/

$route['videos'] = "videos";
$route['videos/(:any)'] = "videos/$1";

/*
| -------------------------------------------------------------------------
| GALLERY ROUTES
| -------------------------------------------------------------------------
*/

$route['galleries'] = "galleries";
$route['galleries/(:any)'] = "galleries/$1";

/*
| -------------------------------------------------------------------------
| PROFILE ROUTES
| -------------------------------------------------------------------------
*/

$route['profile'] = "profile";
$route['profile/(:any)'] = "profile/view/$1";

/*
| -------------------------------------------------------------------------
| ANY ROUTES
| -------------------------------------------------------------------------
*/

$route['(:any)'] = "pages/view/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */

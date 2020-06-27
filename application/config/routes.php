<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
| https:   //codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/** Default Controller */
$route['default_controller'] = DEFAULT_CONTROLLER;
$route['default_controller'] = 'page/home';

/** All Pages */
// $route['properties'] = 'page/list';
$route['search/property']       = 'page/search/$1';
$route['hot-deals']             = 'page/hot_deals/hot-deals';
$route['project/(:any)']        = 'page/project/$1';
$route['blog/(:any)']           = 'page/blog/$1';
$route['property/(:any)']       = 'page/property/$1';
$route['about-us']              = 'page/about_us';

$route['gallery']               = 'page/gallery';
$route['blogs']                 = 'page/blogs';
$route['contact']               = 'page/contact_us';
$route['gallery-images/(:any)'] = 'page/galleryView/$1';
$route['get-a-call-back']       = 'page/get_call';
$route['disclaimer']            = 'page/disclaimer';
$route['privacy-policy']        = 'page/privacy';
$route['third-party']           = 'page/thirdparty';
$route['service/(:any)']        = 'page/service/$1';
$route['course/(:any)']         = 'page/course/$1';
$route['shop/(:any)']           = 'page/shop/$1';
$route['register']              = 'page/register';


/** Dashboard */
$route['dashboard/login']  = 'admin/login';
$route['dashboard/logout'] = 'admin/logout';
$route['dashboard']        = 'admin/home';

/** Profile */
$route['user/(:any)'] = 'user/view_user/$1';

/** List */
// $route['list/([^/]+)/?']  = 'user/list_user/$1'; // To Show List/Super-admin or List/admin or List/manager
$route['list/all/([^/]+)/?'] = 'user/list_users/$1';
$route['list/assign-users']  = 'UserRole/list_roles';
$route['list/categories']    = 'category/list_category';
/* content_route additional module */
$route['list/content']    = 'Content/list_content';
/* content_route additional module end */
$route['list/comments']      = 'comment/list_comment';
$route['list/contact-us']    = 'lead/list_contactus';
$route['list/customers']     = 'lead/list_customers';
$route['list/filters']       = 'filter/list_filter';
$route['list/galleries']     = 'gallery/list_galleries';
$route['list/leads']         = 'lead/list_leads';
$route['list/orders']        = 'order/list_orders';
$route['list/posts']         = 'post/list_post';
$route['list/products']      = 'product/list_products';
$route['list/projects']      = 'project/list_projects';
$route['list/properties']    = 'property/list_property';
$route['list/roles']         = 'UserRole/list_roles';
$route['list/scraped']       = 'lead/list_scraped';
$route['list/sliders']       = 'slider/list_sliders';
$route['list/testimonials']  = 'testimonial/list_testimonial';
$route['list/tests']         = 'test/list_test';
$route['list/settings']      = 'setting/list_setting';


/** Add */
$route['add/category']    = 'category/add_category';
$route['add/comment']     = 'comment/add_comment';
$route['add/filter']      = 'filter/add_filter';
$route['add/gallery']     = 'gallery/add_gallery';
$route['add/lead']        = 'lead/add_lead';
$route['add/order']       = 'order/add_order';
$route['add/post']        = 'post/add_post';
$route['add/product']     = 'product/add_product';
$route['add/project']     = 'project/add_project';
$route['add/property']    = 'property/add_property';
$route['add/slider']      = 'slider/add_slider';
$route['add/test']        = 'test/add_test';
$route['add/testimonial'] = 'testimonial/add_testimonial';
$route['add/user-role']   = 'UserRole/add_role';
$route['add/user']        = 'user/add_user';
$route['add/content']        = 'Content/add_content';


/** Edit */
$route['edit/category/(:any)']    = 'category/edit_category/$1';
$route['edit/comment/(:any)']     = 'comment/edit_comment/$1';
$route['edit/filter/(:any)']      = 'filter/edit_filter/$1';
$route['edit/gallery/(:any)']     = 'gallery/edit_gallery/$1';
$route['edit/lead/(:any)']        = 'lead/edit_lead/$1';
$route['edit/order/(:any)']       = 'order/edit_order/$1';
$route['edit/post/(:any)']        = 'post/edit_post/$1';
$route['edit/product/(:any)']     = 'product/edit_product/$1';
$route['edit/project/(:any)']     = 'project/edit_project/$1';
$route['edit/property/(:any)']    = 'property/edit_property/$1';
$route['edit/slider/(:any)']      = 'slider/edit_slider/$1';
$route['edit/test/(:any)']        = 'test/edit_test/$1';
$route['edit/testimonial/(:any)'] = 'testimonial/edit_testimonial/$1';
$route['edit/user-role/(:any)']   = 'UserRole/edit_role/$1';
$route['edit/user/(:any)']        = 'user/edit_user/$1';
$route['edit/setting/(:any)']     = 'setting/edit_setting/$1';


/** Delete */
$route['delete/category/(:any)']    = 'category/delete_category/$1';
$route['delete/comment/(:any)']     = 'comment/delete_comment/$1';
$route['delete/filter/(:any)']      = 'filter/delete_filter/$1';
$route['delete/gallery/(:any)']     = 'gallery/delete_gallery/$1';
$route['delete/lead/(:any)']        = 'lead/delete_lead/$1';
$route['delete/order/(:any)']       = 'order/delete_order/$1';
$route['delete/post/(:any)']        = 'post/delete_post/$1';
$route['delete/product/(:any)']     = 'product/delete_product/$1';
$route['delete/project/(:any)']     = 'project/delete_project/$1';
$route['delete/property/(:any)']    = 'property/delete_property/$1';
$route['delete/slider/(:any)']      = 'slider/delete_slider/$1';
$route['delete/test/(:any)']        = 'test/delete_test/$1';
$route['delete/testimonial/(:any)'] = 'testimonial/delete_testimonial/$1';
$route['delete/user-role/(:any)']   = 'UserRole/delete_role/$1';


$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

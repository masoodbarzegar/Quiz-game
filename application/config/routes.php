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
$route['news/:num'] = 'news/view/$1';
$route['news'] = 'news';

$route['admin/:any'] = 'error/404';
$route['admin'] = 'error/404';
$route['_p123'] = 'admin';

$route['_p123/eques'] = 'admin/ques_edite';
$route['_p123/eques/:num'] = 'admin/ques_edite/$1';
$route['_p123/cques'] = 'admin/ques_create';

$route['_p123/edisc'] = 'admin/discont_edite';
$route['_p123/edisc/:num'] = 'admin/discont_edite/$1';
$route['_p123/cdisc'] = 'admin/discont_create';

$route['_p123/eaward'] = 'admin/award_edite';
$route['_p123/eaward/:num'] = 'admin/award_edite/$1';
$route['_p123/caward'] = 'admin/award_create';

$route['_p123/lplayer'] = 'admin/player_log';
$route['_p123/lplayergame/:num'] = 'admin/player_game_log/$1';
$route['_p123/lgame'] = 'admin/game_log';
$route['_p123/lgame/:num'] = 'admin/game_log/$1';

$route['_p123/show_award/3/:num'] = 'admin/show_award/3/$1';


$route['game'] = 'game';
$route['game/:any'] = 'game/index/$1';

$route['auth/:any'] = 'error/404';
$route['auth']      = 'error/404';
$route['_l123game'] = 'auth';
$route['_r123game'] = 'error/404';
$route['_o123game'] = 'auth/logout';


$route['pages/view'] = 'pages/view/1';
$route['pages/:num'] = 'pages/index/$1';

$route['project/:num'] = 'project/index/$1';


$route['default_controller'] = 'pages';
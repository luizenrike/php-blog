<?php 
require "vendor/autoload.php";

use Pecee\SimpleRouter\SimpleRouter;
use Sistema\Controller\Admin\AdminController;
use Sistema\helpers;

    try {
        SimpleRouter::setDefaultNamespace('Sistema\Controller');

        SimpleRouter::get(URL_SITE, 'SiteController@index');
        SimpleRouter::get(URL_SITE.'sobre', "SiteController@sobre" );
        SimpleRouter::get(URL_SITE.'teste', 'SiteController@teste');
        SimpleRouter::get(URL_SITE.'post/{id}', 'SiteController@post');
        SimpleRouter::get(URL_SITE.'categorias/{id}', 'SiteController@categorias');
        SimpleRouter::get(URL_SITE.'buscar', 'SiteController@buscar');
       // SimpleRouter::get(URL_SITE.'404', 'SiteController@error404');
        
        SimpleRouter::group(['namespace' => 'Admin'], function() {
            SimpleRouter::get(URL_ADMIN.'dashboard', 'AdminController@dashboard');
            SimpleRouter::get(URL_ADMIN.'posts/listar', 'AdminController@listar');
            SimpleRouter::get(URL_ADMIN.'categorias/listar', 'AdminController@categorias');

            // utilizando dois métodos, GET e POST para cadastrar categorias:
            SimpleRouter::match(['get', 'post'], URL_ADMIN.'categorias/cadastrar', 'AdminController@categoriasCadastrar');

            // utilizando dois métodos GET e POST para cadastrar tópico(post)
            SimpleRouter::match(['get', 'post'], URL_ADMIN.'posts/cadastrar', 'AdminController@postsCadastrar');
            SimpleRouter::match(['get', 'post'], URL_ADMIN.'post/editar/{id}', 'AdminController@postEditar');
            

        });
        
        
        SimpleRouter::start();

    } catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {
        echo $ex;
        //helpers::redirecionar404();
    }



?>
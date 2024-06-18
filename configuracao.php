<?php

/**
 * Função para formatar o fuso horário
 */
date_default_timezone_set("America/Sao_Paulo");

/**
 * CONSTANTES DE CONEXÃO
 */

define('DB_PORTA', '3306');
define('DB_HOST', 'localhost');
define('DB_NOME', 'blog');
define('DB_USER', 'root');
define('DB_PASSWORD', '');



/**Declaração das constantes do projeto:
 */
define('SITE_NOME', 'Engenharia PHP');
define('SITE_DESCRICAO', 'Engenharia de Software');
define('URL_PRODUCAO', 'http://luizenrik-es.com.br');
define('URL_DESENVOLVIMENTO', 'http://localhost:3000/blog');

define('URL_SITE', 'blog/');
define('URL_ADMIN', 'blog/admin/');

define('SITE_TEMPLATE_VIEW_ROUTE', 'Templates/Site/Views');
define('ADMIN_TEMPLATE_VIEW_ROUTE', 'Templates/Admin/Views');

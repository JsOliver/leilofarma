<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Parte dos users Route

$route['default_controller'] = 'UserController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['home'] = 'UserController/index';
$route['loja/(.+)'] = 'UserController/loja/$1';
$route['produto/(.+)'] = 'UserController/produto/$1';
$route['entrar'] = 'UserController/logcad';
$route['minha-conta'] = 'UserController/profile';
$route['meus-lances'] = 'UserController/meus_lances';
$route['minha-loja'] = 'UserController/minha_loja';
$route['itens-salvos'] = 'UserController/itens_salvos';
$route['farmacias-salvas'] = 'UserController/farmacias_salvas';
$route['historico'] = 'UserController/historico';
$route['configuracoes'] = 'UserController/configuracao';
$route['carrinho'] = 'UserController/carrinho';
$route['busca'] = 'UserController/busca';
$route['busca/(.+)'] = 'UserController/busca/$1';
$route['imagem'] = 'AjaxControler/exibir';
$route['ajaxlance'] = 'AjaxControler/lance';
$route['ajaxcard'] = 'AjaxControler/card';
$route['ajaxalterdata'] = 'AjaxControler/cogs';
$route['ajaxalterdataus'] = 'AjaxControler/alts';
$route['ajaxmapsapi'] = 'AjaxControler/maps';
$route['ajaxnewfarma'] = 'AjaxControler/addfarma';
$route['ajaxalteritemread'] = 'AjaxControler/readitem';
$route['ajaxrespostaitem'] = 'AjaxControler/respostaitem';
$route['ajaxalteritem'] = 'AjaxControler/alteritem';
$route['ajaxupdadopd'] = 'AjaxControler/alteritem';
$route['ajaxremoveItem'] = 'AjaxControler/removeitem';
$route['actionpedido'] = 'AjaxControler/actionpedido';
$route['removelistaped'] = 'AjaxControler/removelistaped';
$route['ajaxdeletestore'] = 'AjaxControler/ajaxdeletestore';
$route['facebookloginapi'] = 'AjaxControler/facebookloginapi';

$route['termos-de-uso'] = 'ContentController/termos';



//Parte do Admin Routes

$route['admin'] = 'AdminControler/index';
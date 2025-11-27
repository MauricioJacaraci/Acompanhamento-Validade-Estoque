<?php

use Pecee\SimpleRouter\SimpleRouter;

try {
   // Grupo de rotas do Cliente
   SimpleRouter::group(['namespace' => 'sistema\controladores\PainelAdministrativo'], function () {

      
      // ----------------------------------------------------------
      SimpleRouter::match(['get', 'post'], URL_SITE, 'SiteControlador@index');
      SimpleRouter::match(['get', 'post'], URL_SITE . 'index', 'SiteControlador@index');
      // ----------------------------------------------------------
      //ROTA DE CADASTRAR PRODUTO
      SimpleRouter::match(['get', 'post'], URL_SITE . 'cadastrarProduto', 'SiteControlador@cadastrarProduto');
      // ----------------------------------------------------------
      //ROTA DE CADASTRAR CATEGORIA
      SimpleRouter::match(['get', 'post'], URL_SITE . 'cadastrarCategoria', 'SiteControlador@cadastrarCategoria');
      // ----------------------------------------------------------
      //ROTA DE EXCLUIR PRODUTO
      SimpleRouter::match(['get', 'post'], URL_SITE . 'produtoExcluir/{id}', 'SiteControlador@excluirProduto');
      // ----------------------------------------------------------
      //ROTA DE ATUALIZAR QUANTIDADE
      SimpleRouter::match(['get', 'post'], URL_SITE . 'quantidade/atualizar', 'SiteControlador@atualizarQuantidade');
      // ----------------------------------------------------------
      //ROTA DE VERIFICAR VALIDADE
      SimpleRouter::match(['get', 'post'], URL_SITE . 'verificarValidade', 'SiteControlador@verificarValidade');
      // ----------------------------------------------------------
      //ROTA DE VERIFICAR VALIDADE
      SimpleRouter::match(['get', 'post'], URL_SITE . 'pesquisa', 'SiteControlador@pesquisa');
      // ----------------------------------------------------------
   });

   // Executa o direcionamento das rotas
   SimpleRouter::start();
} catch (\Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {

   // Mostra a mensagem de erro para debug
   echo $ex->getMessage();
}

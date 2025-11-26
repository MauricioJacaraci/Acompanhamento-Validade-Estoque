<?php
//ARQUIVO DE CONFIGURAÇÃO DO SISTEMA


// Definindo o fuso horário padrão para o Brasil
date_default_timezone_set('America/Sao_Paulo');
define('FUSO_HORARIO', date_default_timezone_get());

######## DATA E HORA BRASIL #############
$now = time();
// LINHA COM HORA
$hora_brasil = date('H:i:s', $now);
define('HORA_BRASIL', date('H:i:s', $now));
define('HORA_BANCO', date('H:i:s', $now));
// LINHA COM DATA
$data_brasil = date('d/m/Y', $now);
define('DATA_ATUAL_BRASIL', date('d/m/Y', $now));
define('DATA_ATUAL_BANCO', date('Y/m/d', $now));

// CONFIGURAÇÕES DO BANCO DE DADOS
// Definindo o banco de dados, servidor, usuário, senha e nome do banco
define('DB_SERVIDOR', 'localhost');
define('DB_USUARIO', 'root');
define('DB_SENHA', '');
define('DB_NOME_DO_BANCO', 'controle_validade_lider_distribuidora');
define('DB_PORTA', '3306');


// urls da raiz do projeto
define('URL_SITE', 'Acompanhamento-Validade-Estoque/');

// url de desenvolvimento local
define('URL_DESENVOLVIMENTO', 'http://localhost/Acompanhamento-Validade-Estoque');

// url de produção
define('URL_PRODUCAO', 'http://10.0.0.102/Acompanhamento-Validade-Estoque');

// nome do site, geralmente para colocar no nome da pagina
define('NOME_SITE', 'Controle de Validade');












?>
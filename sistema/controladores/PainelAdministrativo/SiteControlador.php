<?php

namespace sistema\controladores\PainelAdministrativo;

use sistema\controladores\Principal\Controlador;
use sistema\modelo\Tab_Produtos;
use sistema\modelo\Tab_Categorias;
use sistema\configuracoes\Helpers;

class SiteControlador extends Controlador
{

    // =====================================================
    // CONSTRUTOR
    // =====================================================
    public function __construct()
    {
        parent::__construct('sistema/template/painel/views');
    }
   

    



    // Página inicial (login)
    public function index()
    {

        
        $produtos = (new Tab_Produtos())->buscarTodas()->ordem('data_validade ASC')->resultado(true);
        $categorias = (new Tab_Categorias())->buscarTodas()->ordem('categoria ASC')->resultadoArray(true);
        $categorias_produtos = (new Tab_Produtos())->buscarTodas()->ordem('categoria ASC')->resultadoArray(true);

        if($produtos){
            foreach ($produtos as $key => $value) {
                $produtos[$key]['dias_restantes'] = (strtotime($value['data_validade']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
            }
        }

        echo $this->template->renderizar('index.html', [
            'nome_pagina' => 'Dashboard - ' . NOME_SITE,
            'rota_atual' => 'index',
            'produtos' => $produtos,
            'categorias' => $categorias,
            'categorias_produtos' => $categorias_produtos

        ]);
    }

    public function pesquisa()
    {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($filtro)) {
            $produtos = (new Tab_Produtos())
                ->buscarTodas("categoria = :cat", "cat={$filtro['categoria']}")
                ->ordem('data_validade ASC')
                ->resultadoArray(true);
        } else {
            $produtos = (new Tab_Produtos())->buscarTodas()->ordem('data_validade ASC')->resultado(true);
        }

        if ($produtos) {
            foreach ($produtos as $key => $value) {
                $produtos[$key]['dias_restantes'] = (strtotime($value['data_validade']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
            }
        }

        $categorias = (new Tab_Categorias())->buscarTodas()->ordem('categoria ASC')->resultadoArray(true);
        $categorias_produtos = (new Tab_Produtos())->buscarTodas()->ordem('categoria ASC')->resultadoArray(true);

        

        echo $this->template->renderizar('index.html', [
            'nome_pagina' => 'Dashboard - ' . NOME_SITE,
            'rota_atual' => 'index',
            'produtos' => $produtos,
            'categorias' => $categorias,
            'categorias_produtos' => $categorias_produtos
        ]);
    }
    


    public function cadastrarProduto()
    {
        // Captura todos os dados enviados via POST e aplica filtro padrão
        $produto = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        // Verifica se a variável $produto existe
        if (!empty($produto)) {            
            (new Tab_Produtos())->cadastrarProduto($produto);
            // echo '<pre>';
            // print_r($produto);
            // echo '</pre>';
            // exit;
        }

        // Redireciona de volta para a rota 'index'
        Helpers::redirecionar('index');
    }
    public function cadastrarCategoria()
    {
        // Captura todos os dados enviados via POST e aplica filtro padrão
        $categoria = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        // Verifica se a variável $categoria existe
        if (!empty($categoria)) {            
            (new Tab_Categorias())->cadastrarCategoria($categoria);
            // echo '<pre>';
            // print_r($categoria);
            // echo '</pre>';
            // exit;
        }

        // Redireciona de volta para a rota 'index'
        Helpers::redirecionar('index');
    }



    // Exclui um produto pelo ID
    public function excluirProduto(int $id)
    {
        (new Tab_Produtos())->excluirProduto($id);
        
        Helpers::redirecionar('index');
    }
    

    // Atualiza a quantidade de um produto
    public function atualizarQuantidade()
    {
        $quantidade = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($quantidade['id']) && isset($quantidade['quantidade'])) {
            $tabCategoriaProdutos = new Tab_Produtos();
            $tabCategoriaProdutos->atualizarQuantidade($quantidade['id'], $quantidade['quantidade']);
        }
    }


    // ESSE TRECHO SÓ É EXECUTADO POR UM NÓ HTTP-REQUEST DO N8N

    // Verifica a validade dos produtos
    public function verificarValidade()
    {
        $resultado = (new Tab_Produtos())->buscarTodas()->resultado(true);

        $produtosAviso = [];

        if ($resultado) {
            foreach ($resultado as $value) {
                $diasRestantes = (strtotime($value['data_validade']) - strtotime(date('Y-m-d'))) / 86400;
                $diasRestantes = (int) $diasRestantes;

                // só exibe dias múltiplos de 5
                if ($diasRestantes > 0 && $diasRestantes % 5 == 0 && $diasRestantes <= 40) {
                    $value['dias_restantes'] = $diasRestantes;
                    $produtosAviso[] = $value;
                }
            }
        }

        // Se não tiver produtos, retorna aviso simples
        if (empty($produtosAviso)) {
            echo "Nenhum produto dentro do período de aviso.";
            exit;
        }

        // Montar mensagem final
        $mensagem  = "⚠️ *ALERTA DE VALIDADE* ⚠️\n\n";
        $mensagem .= "*Os produtos abaixo estão dentro do período de aviso (40 dias / alertas a cada 5 dias):*\n\n";

        foreach ($produtosAviso as $p) {
            $mensagem .= "• Produto: *{$p['produto']}*\n";
            $mensagem .= "  Categoria: {$p['categoria']}\n";
            $mensagem .= "  Quantidade: *{$p['quantidade']} unidades*\n";
            $mensagem .= "  Vencimento: " . date('d/m/Y', strtotime($p['data_validade'])) . "\n";
            $mensagem .= "  Vence em: *{$p['dias_restantes']} dias*\n\n";
        }

        $mensagem .= "✔️ Recomendações:\n";
        $mensagem .= "- Priorizar a venda ou utilização desses produtos.\n";
        $mensagem .= "- Destacar no estoque se necessário.\n";
        $mensagem .= "- Registrar caso algum item seja descartado.\n\n";
        $mensagem .= "📆 Notificação gerada automaticamente às " . date('H:i') . ".";

        header('Content-Type: text/plain; charset=utf-8');
        echo $mensagem;
        exit;
    }
}

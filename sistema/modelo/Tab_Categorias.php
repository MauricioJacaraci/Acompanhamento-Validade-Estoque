<?php

namespace sistema\modelo;

use sistema\configuracoes\Conexao;
use sistema\configuracoes\Modelos;

class Tab_Categorias extends Modelos
{




    public function __construct()
    {
        parent::__construct('categorias');
    }






    public function cadastrarCategoria(array $categoria): void
    {

        $query = "INSERT INTO categorias (categoria) VALUES (:categoria)";

        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->bindValue(':categoria', $categoria['nova_categoria'], \PDO::PARAM_STR);
        $stmt->execute();
    }

}

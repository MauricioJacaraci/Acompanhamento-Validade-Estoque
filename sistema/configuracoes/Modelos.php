<?php

namespace sistema\configuracoes;

use sistema\configuracoes\Conexao;

class Modelos
{

    protected $dados;
    protected $query;
    protected $erro;
    protected $parametros;
    protected $tabela;
    protected $ordem;
    protected $limite;
    protected $offset;



    // CONSTRUTOR //
    //------------------------------------------------------------------------------------------------------------
    public function __construct(string $tabela)
    {
        $this->tabela = $tabela;
    }
    //------------------------------------------------------------------------------------------------------------

 




    public function ordem(string $ordem)
    {
        $this->ordem = " ORDER BY {$ordem}";
        return $this;
    }
    public function limite(string $limite)
    {
        $this->limite = " LIMIT {$limite}";
        return $this;
    }
    public function offset(string $offset)
    {
        $this->offset = " OFFSET {$offset}";
        return $this;
    }
    public function erro()
    {
        return $this->erro;
    }


    
    // METODO MÁGICO PARA PEGAR OS DADOS //
    //------------------------------------------------------------------------------------------------------------
    public function __set($nome, $valor)
    {

        if (empty($this->dados)) {
            $this->dados = new \stdClass();
        }

        $this->dados->$nome = $valor;
    }
    //------------------------------------------------------------------------------------------------------------







    // BUSCAR //
    //------------------------------------------------------------------------------------------------------------
    public function buscarTodas(?string $termos = null, ?string $parametros = null, string $colunas = '*')
    {
        if ($termos) {
            $this->query = "SELECT {$colunas} FROM " . $this->tabela . " WHERE {$termos}";
            parse_str($parametros, $this->parametros);
            return $this;
        }

        $this->query = "SELECT {$colunas} FROM " . $this->tabela;
        return $this;
    }
    //------------------------------------------------------------------------------------------------------------








    // RETORNA O RESULTADO //
    //------------------------------------------------------------------------------------------------------------
    public function resultado(bool $todos = false): ?array
    {
        try {
            if (empty($this->query)) {
                throw new \Exception("A consulta não foi definida. Use o método busca() antes de resultado().");
            }

            $sql = $this->query
                . ($this->ordem ?? '')
                . ($this->limite ?? '')
                . ($this->offset ?? '');

            $stmt = Conexao::getInstancia()->prepare($sql);
            $stmt->execute($this->parametros ?? []);

            if (!$stmt->rowCount()) {
                return null;
            }

            return $todos
                ? $stmt->fetchAll(\PDO::FETCH_ASSOC)
                : $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch (\Throwable $ex) {
            $this->erro = $ex;
            return null;
        }
    }
    public function resultadoArray(bool $todos = false): array|null
    {
        try {
            if (empty($this->query)) {
                throw new \Exception("A consulta não foi definida. Use o método buscar() antes de resultadoArray().");
            }

            $sql = $this->query . ($this->ordem ?? '') . ($this->limite ?? '') . ($this->offset ?? '');

            $stmt = Conexao::getInstancia()->prepare($sql);
            $stmt->execute($this->parametros ?? []);

            if (!$stmt->rowCount()) {
                return null;
            }

            // Usa o mesmo FETCH_CLASS, mas converte os dados internos ($dados) em array
            if ($todos) {
                $dados = $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
                $resultado = [];

                foreach ($dados as $item) {
                    if (isset($item->dados)) {
                        $resultado[] = (array) $item->dados;
                    } else {
                        $resultado[] = (array) $item;
                    }
                }

                return $resultado;
            }

            $item = $stmt->fetchObject(static::class);

            if (!$item) {
                return null;
            }

            return isset($item->dados) ? (array) $item->dados : (array) $item;
        } catch (\PDOException $ex) {
            $this->erro = $ex;
            return null;
        }
    }





    // CADASTRAR //
    //-------------------------------------------------------------------------------------------------------------
    protected function cadastrar(array $dados)
    {
        try {
            $colunas = implode(", ", array_keys($dados));
            $valores = ":" . implode(", :", array_keys($dados));

            $query = "INSERT INTO " . $this->tabela . " ({$colunas}) VALUES ({$valores})";

            $stmt = Conexao::getInstancia()->prepare($query);

            $stmt->execute($this->filtro($dados));

            // Retorna o último ID inserido
            return (int) Conexao::getInstancia()->lastInsertId();


        } catch (\PDOException $ex) {
            $this->erro = $ex;
            return null;
        } catch (\Exception $ex) {
            $this->erro = $ex;
            return null;
        }
    }
    //-------------------------------------------------------------------------------------------------------------






    // ATUALIZAR //
    //-------------------------------------------------------------------------------------------------------------
    protected function atualizar(array $dados, string $termos)
    {
        try {

            $set = [];

            foreach ($dados as $key => $value) {
                $set[] = "{$key} = :{$key}";
            }

            $setString = implode(", ", $set);

            $query = "UPDATE " . $this->tabela . " SET {$setString} WHERE {$termos}";

            $stmt = Conexao::getInstancia()->prepare($query);

            $stmt->execute($this->filtro($dados));

            return $stmt->rowCount() ?? 1;

        } catch (\Throwable $ex) {
            $this->erro = $ex;
            return null;
        }
    }
    //-------------------------------------------------------------------------------------------------------------






    // FILTRAR //
    //-------------------------------------------------------------------------------------------------------------
    private function filtro(array $dados)
    {
        $filtro = [];
        foreach ($dados as $key => $value) {
            $filtro[$key] = (is_null($value) ? null : filter_var($value, FILTER_DEFAULT));
        }

        return $filtro;
    }
    //-------------------------------------------------------------------------------------------------------------





    // DELETAR //
    //-------------------------------------------------------------------------------------------------------------
    protected function deletar(string $termos, array $parametros = []): ?int
    {
        try {
            if (empty($termos)) {
                throw new \Exception("É obrigatório informar uma condição (WHERE) para deletar registros.");
            }

            $query = "DELETE FROM " . $this->tabela . " WHERE {$termos}";
            $stmt = Conexao::getInstancia()->prepare($query);

            foreach ($parametros as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();

            // Retorna quantas linhas foram deletadas
            return $stmt->rowCount();
        } catch (\Throwable $ex) {
            $this->erro = $ex;
            return null;
        }
    }
    //-------------------------------------------------------------------------------------------------------------





    // ARMAZENAR E SALVAR //
    //------------------------------------------------------------------------------------------------------------
    public function armazenar()
    {
        $dados = (array) $this->dados;

        return $dados;
    }
    //------------------------------------------------------------------------------------------------------------




    // SALVAR //
    //------------------------------------------------------------------------------------------------------------
    public function salvar()
    {
      
        if (empty($this->id)) {
            // INSERT
            $id = $this->cadastrar($this->armazenar());

            if ($this->erro()) {
                return false;
            }
            
        } 

        return true;
    }
    //------------------------------------------------------------------------------------------------------------







}

<?php

namespace Sistema\Modelo;

use PDO;
use Sistema\helpers;
use Sistema\Nucleo\Conexao;
use Exception;
use PDOException;

class CategoriaModelo{

    private PDO $service;
    public function __construct()
    {
        $this->service = Conexao::getInstancia();
    }

    public function GetAll() : array{
        $query = 'SELECT * FROM categorias AS c ORDER BY c.titulo ASC ';
        $data = $this->service->query($query)->fetchAll();
        return $data;
    }

    public function GetById(int $id) : object{
        $query = "SELECT * FROM categorias as c WHERE c.id = {$id}";
        $data = $this->service->query($query)->fetchObject();
        if(empty($data))
            helpers::redirecionar404();

        return $data;
    }

    public function Create(string $titulo, string $texto, int $status){
        $query = "INSERT INTO categorias (titulo, texto, status) VALUES  (:titulo, :texto, :status)";
        if($this->ExisteTituloEmCategorias($titulo))
            throw new Exception("Não foi possível adicionar a nova categoria: já existe uma com o mesmo título.");
        try{
            $stmt = $this->service->prepare($query);
            $stmt->execute([
                "titulo" => $titulo,
                "texto" => $texto,
                "status" => $status
            ]);
        }catch(PDOException $e){
            throw new Exception("Erro ao adicionar uma nova categoria no banco de dados.");
        }
    }

    private function ExisteTituloEmCategorias(string $titulo) : bool {
        $query = "SELECT * FROM categorias AS C WHERE LOWER(C.titulo) = :tituloLower";
        $tituloLower = strtolower($titulo);
        $stmt = $this->service->prepare($query);
        $stmt->execute(['tituloLower' => $tituloLower]);
        $resultado = $stmt->fetchObject();

        if($resultado)
            return true;
        return false;

    }
}

?>
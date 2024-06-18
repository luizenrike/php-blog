<?php 

namespace Sistema\Modelo;

use PDOException;
use PDO;
use Exception;
use Sistema\helpers;
use Sistema\Nucleo\Conexao;

class PostModelo{
    private PDO $instancia;

    public function __construct()
    {
        $this->instancia = Conexao::getInstancia();
    }

    public function getAll() : array{

        $query = "SELECT * FROM POSTS";
        $stmt = $this->instancia;

        $data = $stmt->query($query)->fetchAll();

        return $data;

    }

    public function getById(int $id) : object{
        $repository = $this->instancia;
        $query = "SELECT * FROM POSTS as P WHERE P.id = {$id}";
        
        $data = $repository->query($query)->fetchObject();
        
        if(empty($data))
            helpers::redirecionar404();
        
        return $data;
    }

    public function getByCategoria(int $id) : array{
        $repository = $this->instancia;
        $query = "SELECT * FROM posts AS p WHERE p.categoria_id = {$id} ORDER BY p.titulo";

        $data = $repository->query($query)->fetchAll();
        return $data;

    }

    public function getByBuscar(string $strBusca) : array {
        $repository = $this->instancia;
        $query = "SELECT * FROM posts AS p WHERE p.titulo LIKE '%{$strBusca}%'";

        $data = $repository->query($query)->fetchAll();
        return $data;
    }

    public function Create(string $titulo, string $texto, int $categoria_id, int $status){
        $repository = $this->instancia;
        $query = "INSERT INTO posts (titulo, texto, categoria_id, status) VALUES (:titulo, :texto, :categoria_id, :status)";
        
        if($this->ExisteTopicoTitulo($titulo))
            throw new Exception ("Não foi possível adicionar o novo tópico: já existe um com o mesmo título.");

        try{
            $stmt = $repository->prepare($query);
            $stmt->execute(['titulo' => $titulo, 'texto'=>$texto, 'categoria_id' => $categoria_id ,'status' => $status]);
        }catch(PDOException $e){
            throw new Exception ("Erro ao adicionar um novo tópico no banco de dados");
        }


    }

    public function Update(int $id, array $postAtualizado) : void {
        $repository = $this->instancia;
        $query = "UPDATE posts SET titulo = :titulo, texto = :texto, categoria_id = :categoria_id, status = :status WHERE posts.id = :post_id";
        try{
            $stmt = $repository->prepare($query);
            $stmt->execute([
                'post_id' => $id,
                'titulo' => $postAtualizado['titulo'],
                'texto' => $postAtualizado['texto'],
                'categoria_id' => $postAtualizado['categoria_id'],
                'status' => $postAtualizado['status']
        ]);

        }catch(PDOException $e){
            throw new Exception("Um erro ocorreu ao salvar a atualização do tópico no banco de dados.");
        }
    }

    private function ExisteTopicoTitulo(string $titulo) : bool{
        $tituloLower = strtolower($titulo);
        $repository = $this->instancia;
        $query = "SELECT * FROM posts AS p WHERE LOWER(p.titulo) = :tituloLower";

        $stmt = $repository->prepare($query);
        $stmt->execute(['tituloLower' => $tituloLower]);

        $resultado = $stmt->fetchObject();

        if($resultado)
            return true;
        
        return false;
    }
    
}

?>

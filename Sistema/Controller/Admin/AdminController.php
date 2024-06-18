<?php
namespace Sistema\Controller\Admin;

use Sistema\DataTransferObjects\PostCategoria;
use Sistema\Modelo\CategoriaModelo;
use Sistema\Modelo\PostModelo;
use Exception;

class AdminController extends ControladorAdmin{



    public function dashboard() : void{
        echo $this->template->renderizar('dashboard.html', []);
    }

    public function listar() : void{
        $postModelo = new PostModelo();
        $categoriaModelo = new CategoriaModelo();
        $categorias = $categoriaModelo->GetAll();
        $posts = $postModelo->getAll();

        $data = $this->responseListar($posts, $categorias);

        echo $this->template->renderizar('posts/listar.html', [
            "posts" => $data
         ]);
    }

    public function categoriasCadastrar() : void {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $categoriaModelo = new CategoriaModelo();
        if(isset($dados)){
            try{
                $categoriaModelo->Create($dados['titulo'], $dados['texto'], $dados['status']);
                $message = "Nova categoria criada com sucesso!";
                $alert = "success";
            }catch(Exception $e){
                $message = $e->getMessage();
                $alert = "danger";
            }
        }
        echo $this->template->renderizar('categorias/formulario.html', [
            'message' => $message,
            'alert' => $alert
        ]);

    }

    public function postsCadastrar() : void{
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $postModelo = new postModelo();
        $categoriaModelo = new CategoriaModelo();
        $categorias = $categoriaModelo->GetAll();
        $message = "";
        $alert = "";
        if(isset($dados)){
            try{
                $postModelo->Create($dados['titulo'], $dados['texto'], $dados['categoria_id'], $dados['status']);
                $message = "Novo tópico criado com sucesso!";
                $alert = "success";
            }catch(Exception $e){
                $message = $e->getMessage();
                $alert = "danger";
            }
        }
            
    
        echo $this->template->renderizar('posts/formulario.html', [
            'categorias' => $categorias,
            'message' => $message,
            'alert' => $alert,
        ]);
    }

    public function postEditar(int $id) : void{
        $postModelo = new PostModelo();
        $categoriaModelo = new CategoriaModelo();
        $categorias = $categoriaModelo->GetAll();
        $post = $postModelo->getById($id);

        $postAtualizado = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $message = "";
        $alert = "";
        

        if(isset($postAtualizado)){
            try{
                $postModelo->Update($id, $postAtualizado);
                $message = "Tópico atualizado com sucesso!";
                $alert = "success";
            }catch(Exception $e){
                $message = $e->getMessage();
                $alert = "danger";
            }
        }
        echo $this->template->renderizar('posts/formularioEdit.html', [
            'message' => $message,
            'alert' => $alert,
            'post'=> $post,
            'categorias' => $categorias
        ]);
        


    }

    public function categorias() : void{
        $categoriaModelo = new CategoriaModelo();
        $categorias = $categoriaModelo->GetAll();

        echo $this->template->renderizar('categorias/categoriaslistar.html', [
            'categorias' => $categorias
        ]);
    }

    private function responseListar(array $posts, array $categorias) : array{
        $response = [];
        foreach($posts as $post){
            $parameter = $post->categoria_id;
            $categoria = $this->existKeyInArray($categorias, $parameter);

            $postCategoria = new PostCategoria($post->id, $post->titulo, $categoria->titulo, $post->status);
            array_push($response, $postCategoria);
        }

        return $response;

    }

    private function existKeyInArray(array $array, $key){
        foreach($array as $object){
            if($object->id == $key)
                return $object;
        }
    }
}

?>
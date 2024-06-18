<?php

namespace Sistema\Controller;

use Sistema\Nucleo\Controlador;
use Sistema\Modelo\PostModelo;
use Sistema\helpers;
use Sistema\Modelo\CategoriaModelo;

class SiteController extends Controlador{

    public function __construct()
    {
        //acessando e instanciando o construtor da classe pai Controlador
        parent::__construct(SITE_TEMPLATE_VIEW_ROUTE);
    }

    public function index() : void{
        $postService = new PostModelo();
        $data = $postService->getAll();

        echo $this->template->renderizar('index.html', [
            'titulo' => 'Página inicial',
            'posts' => $data,
            'categorias' => $this->GetCategorias()
        ]);

    }

    public function sobre() : void{
        echo $this->template->renderizar('sobre.html', [
            'titulo' => 'Sobre',
            'categorias' => $this->GetCategorias()
        ]);
    }
    
    public function post(int $id) : void{
        $postService = new PostModelo();
        $data = $postService->getById($id);

        echo $this->template->renderizar('post.html',[
            'titulo' => $data->titulo,
            'post' => $data,
            'categorias' => $this->GetCategorias()
        ]);
    }

    public function categorias(int $id) : void{
        $postService = new PostModelo();
        $categoriaService = new CategoriaModelo();
        $categoria = $categoriaService->GetById($id);
        $postsCategoria = $postService->getByCategoria($id);

        echo $this->template->renderizar('postCategoria.html', [
            "titulo" => "{$categoria->titulo}",
            "posts" => $postsCategoria,
            'categorias' => $this->GetCategorias()
        ]);
    }

    // buscando com ajax:
    // public function buscar() : void{

        
    //     $dadosBusca = filter_input(INPUT_POST, 'busca', FILTER_DEFAULT);
    //     $postService = new PostModelo();
        
    //     //BUSCANDO DADOS COM O JQUERY

    //     if(isset($dadosBusca)){
    //         $dados = $postService->getByBuscar($dadosBusca);
            
    //         foreach($dados as $post)
    //             echo "<a class='fw-bold text-dark' href=".helpers::url('post/').$post->id.">$post->titulo<br><hr></a>";
    //     }

    // }

    public function buscar() : void{
        $postService = new PostModelo();
        $dadosBusca = filter_input_array(INPUT_GET, FILTER_DEFAULT);
        if(isset($dadosBusca)){
            $dados = $postService->getByBuscar($dadosBusca['busca']);
        }
        
        echo $this->template->renderizar('busca.html', [
            'titulo' => 'Buscar',
            'posts' => $dados,
            'categorias' => $this->GetCategorias()
        ]);
    }

    public function teste() : void {
        echo $this->template->renderizar('teste.html', [
            'titulo' => 'Página teste'
        ]);
    }

    public function error404() : void{
        echo $this->template->renderizar('erro404.html', [
            'titulo' => 'Página não encontrada',
            'categorias' => $this->GetCategorias()
        ]);
    }

    
    private function GetCategorias() : array{
        $categoriaService = new CategoriaModelo();
        return $categoriaService->GetAll();
    }
}

?>

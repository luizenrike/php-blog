<?php 

namespace Sistema\DataTransferObjects;
class PostCategoria{
    public int $id;
    public string $titulo;
    public string $categoria;
    public int $status;

    public function __construct(int $id, string $titulo, string $categoria, int $status)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->categoria = $categoria;
        $this->status = $status;
    }
}

?>
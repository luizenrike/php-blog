<?php

// utilização do namespace:

namespace Sistema;
class mensagem{

    private string $texto;
    private string $css;

    private function filterTxt(string $txt) : string {
        return strip_tags($txt);
    }


    public function alerta_sucesso(string $txt) : mensagem{
        $this->texto = $this->filterTxt($txt);
        $this->css = "alert alert-success";
        return $this;
    }

    public function alerta_warning(string $txt) : mensagem{
        $this->texto = $this->filterTxt($txt);
        $this->css = "alert alert-warning";
        return $this;
    }

    
    public function alerta_erro(string $txt) : mensagem{
        $this->texto = $this->filterTxt($txt);
        $this->css = "alert alert-danger";
        return $this;
    }

    // método mágicos permitem a conversão de um determinado tipo se precisar chamá-lo
    // exemplo: método mágico __toString(), permite que uma classe seja convertida para string
    // entretanto, é necessário dizer como ocorrerá a conversão da classe para string:

    public function __toString()
    {
        return $this->renderizar();
    }
    private function renderizar() : string{
        return "<div class='{$this->css}'>{$this->texto}</div>";
    }
}



?>
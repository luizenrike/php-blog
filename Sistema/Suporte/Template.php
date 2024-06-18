<?php
namespace Sistema\Suporte;

use Twig\Lexer;
use Twig\TwigFunction;
use Sistema\helpers;

// diretorio é responsável por carregar o diretório dos templates
// função renderizar é responsável por receber o template e os dados e
// renderizar aquele template, onde a $view é o código html da página

class Template{
    private \Twig\Environment $twig;

    public function __construct(string $diretorio)
    {
        $loader = new \Twig\Loader\FilesystemLoader($diretorio);
        $this->twig = new \Twig\Environment($loader);
        $lexer = new Lexer($this->twig, array($this->helpers()));
        $this->twig->setLexer($lexer);
    }

    public function renderizar(string $view, array $dados) : string{
        return $this->twig->render($view, $dados);
    }

    private function helpers() : void{
        array(
            $this->twig->addFunction(new TwigFunction('url', function(string $texto = null){
                return helpers::url($texto);
            })),
            $this->twig->addFunction(new TwigFunction("saudacao_horario", function(string $user){
                return helpers::saudacao_horario($user);
            })),
            $this->twig->addFunction(new TwigFunction('resumirTexto', function(string $texto, int $caracteres){
                return helpers::resumirTexto($texto, $caracteres);
            }))
        );
    }

}


?>
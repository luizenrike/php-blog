<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<?php

//arquivo index
# arquivo index
/*olá */

// include "configuracao.php" // serve para incluir um novo arquivo nessa página index.php, esse arquivo possui informações não fundamentais
// require "configuracao.php" // serve para incluir e também traz as informações desse arquivo para a página index.php, esse arquivo possui informações fundamentais
// require_once "configuracao.php" // utilizado para carregar o arquivo configuracao.php uma única vez

// require_once "configuracao.php";
// include './Sistema/mensagem.php';
// include './Sistema/helpers.php';
// include './Sistema/Controlador.php';

// use Sistema\mensagem;
// use Sistema\helpers;
// use Sistema\Controlador;

//USANDO O COMPOSER:

require "vendor/autoload.php";

use \Bissolli\ValidadorCpfCnpj\CPF;


//var_dump($teste); // utilizado para verificar o tipo de uma variável
// imprimir_vezes(3);
// echo saudacao();

// echo saudacao_horario("Luiz");
// echo "<br>";

// // usando funções nativas para manipular strings:

// $texto = "   bola a  az";
// $textoLimpo = trim($texto, " ");
// // echo $textoLimpo;
// // echo strlen($textoLimpo);


// // limpeza de tags HTML de um texto:

// // $textoHTML = "<h1>TITULO PRINCIPAL</H1> <br> <p>parágrafo geral do texto, etc, etc</p>";
// // echo $textoHTML;

// // $textoLimpo = strip_tags($textoHTML); // função para remoção de tags
// // echo $textoLimpo;


// /* Formatando valores: */

// echo 'R$ ' . formatarValor(1000);
// echo '<hr>';

// echo contarData('2024-04-29 20:00:00')."<br>";
// var_dump(validarEmail("luiz@outlook.com"));
// echo '<hr>';

// // ARRAYS:
// $objetos = ['sala' => 'cadeira', 'cozinha' => 'mesa', 'quarto' => 'cama'];
// var_dump($objetos);
// unset($objetos['sala']); // função utilizada para remover um elemento do array
// PrintArray($objetos);

// $ItensFutebol = ['grama', 'bola', 'rede', 'banco'];
// var_dump($ItensFutebol);
// echo '<br>';
// unset($ItensFutebol[2]);
// var_dump($ItensFutebol);
// echo '<br>';
// $reorder = array_values($ItensFutebol); // função para reordenar as chaves de um array
// var_dump($reorder);
// echo '<br> <br>';

// $itens = array(
//     'frutas' => array('laranja', 'maçã', 'siriguela'),
//     'casa' => array ('mesa','cadeira', 'cama'),
//     'computador' => array('placa-mãe', 'memória', 'teclado')
// );

// foreach($itens as $keyItem => $item_chave){
//     echo "Itens do array: $keyItem<br>";
//     foreach($item_chave as $item){
//         echo $item.' ';
//     }
//     echo '<br>';
// }

// CHAMANDO MÉTODOS ESTÁTICOS DA CLASSE HELPERS:

// if(helpers::par_ou_impar(3))
//     echo "é par";
// else 
//     echo "é ímpar";

// echo RemoveDuplicateSpaces("     OLÁ  EU  TENHO  MÚLTIPLOS  ESPAÇOS   ").'<br>';

// echo LimparNumero('123ab.c');
// echo "<hr>";
// $teste = new teste();
// $msg = new mensagem();
// // método mágico __toString() já realiza o trabalho de renderização na classe
// echo $msg->alerta_sucesso("alerta de sucesso")."<br>";
// // echo $msg->alerta_warning("alerta de warning")->renderizar()."<br>";
// echo $msg->alerta_erro("alerta de erro")->renderizar()."<br>";


$document = new CPF('07365727594');

echo $document->format();




?>

<?php
namespace Sistema;
require_once "configuracao.php";

class helpers{


// criação de função sem segurança no parâmetro
public static function par_ou_impar($var){
    if($var%2 == 0)
        return true;
    else 
        return false;
}

// função com segurança de tipo no parâmetro e tipo de retorno
function par_ou_impar_segura(int $var) : bool{
    if($var%2 == 0)
        return true;
    else 
        return false;
}

function imprimir_vezes(int $vezes){
    for($i = 0; $i < $vezes; ++$i)
        echo "Estou imprimindo pela $i º vez <br>";
}

// definindo uma função e o tipo do retorno:
public static function saudacao() : string{
    return "Olá, estou retornando uma string";
}

/**
 * Documentação para a função: saudacao_horario
 * Objetivo da função: retornar uma saudação (bom dia, boa tarde, boa noite) com base no horário do sistema
 * 
 * 
 * @param string $user  nome do usuário para ser saudado.
 * @return string  texto de saudação para o usuário
 */
public static function saudacao_horario(string $user) : string {
    $hora = date('H');
    if($hora >= 6 && $hora  <= 12)
        return "Olá, $user, bom dia!";
    else if($hora >= 18)
        return "Olá, $user, boa noite!";
    else
        return "Olá, $user, boa tarde!";
}

/**
 * Formata um valor com vírgula e ponto
 * @param float $valor
 * @return string
 */

public static function formatarValor(float $valor) : string{
    return number_format($valor, 2, ',', '.');
}

/**
 * Retorna o tempo de uma postagem com base na data atual
 * @param string $data
 * @return string com o tempo da postagem
 */
public static function contarData(string $data) : string{
    $horaAtual = date('Y-m-d H:i:s');
    echo $horaAtual."<br>";

    $horaAtual_em_segundos = strtotime($horaAtual);
    $horaRecebida_em_segundos = strtotime($data);

    $diferença = $horaAtual_em_segundos - $horaRecebida_em_segundos;
    echo $diferença."<br>";

    $segundos = $diferença;
    $minutos = round($diferença/60);
    $horas = round($diferença/3600);
    $dias = round($diferença/86400);
    $semanas = round($diferença/604800);
    $meses = round($diferença/2419200);
    $anos = round($diferença/29030400);

    echo $minutos;

    echo '<hr>';

    // if($segundos <= 60)
    //     return 'Postado agora';
    // else if($minutos <= 60)
    //     return $minutos == 1 ? "Postado há 1 minuto" : "Postado há $minutos minutos"; 
    // else if($horas <= 24)
    //     return $horas == 1 ? "Postado há 1 hora" : "Postado há $horas horas";
    // else if($dias <= 7)
    //     return $dias == 1 ? "Postado há 1 dia" : "Postado há $dias dias";
    // else if($semanas < 4)
    //     return $semanas == 1 ? "Postado há 1 semana" : "Postado há $semanas semanas";
    // else if($meses < 12)
    //     return $meses == 1 ? "Postado há 1 mês" : "Postado há $meses meses";
    // else
    //     return $anos == 1 ? "Postado há 1 ano" : "Postado há $anos anos";

    // UTILIZANDO A ESTRUTURA DE CONDICIONAL MATCH:
    $response= match(true){
        $segundos <= 60 => 'Postado agora',
        $minutos <= 60 => $minutos == 1 ? "Postado há 1 minuto" : "Postado há $minutos minutos",
        $horas <= 24 => $horas == 1 ? "Postado há 1 hora" : "Postado há $horas horas",
        $dias <= 7 => $dias == 1 ? "Postado há 1 dia" : "Postado há $dias dias",
        $semanas <= 4 => $semanas == 1 ? "Postado há 1 semana" : "Postado há $semanas semanas",
        $meses <= 12 => $meses == 1 ? "Postado há 1 mês" : "Postado há $meses meses",
        default => $anos == 1 ? "Postado há 1 ano" : "Postado há $anos anos"
    };

    return $response;
}

/**
 * Função para validar o email do usuário
 * 
 * @param string $email
 * @return bool true ou false para o email
 */
public static function validarEmail(string $email) : bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL );
}


/**
 * Retorna a URL da aplicação
 */

 public static function url(string $url = null): string
 {
    $servidor = $_SERVER['SERVER_NAME'];
    $ambiente = ($servidor == 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUCAO);
 
    if (str_starts_with($url, '/')) {
         return $ambiente . $url;
    }
    return $ambiente . '/' . $url;
 }


function RemoveDuplicateSpaces(string $dirtyString) : string{
    // a expressão regular: '/\s+/' dentro de preg_replace(), significa
    // que podemos ter espaços em brancos (\s+) uma ou mais vezes, as barras "/" 
    // no ínicio são para informar o início e o fim de uma expressão regular
    
    // remove duplicate white spaces;
    $cleanString = preg_replace('/\s+/', ' ', $dirtyString);
    return $cleanString;
}

function LimparNumero($str){
    $clean = preg_replace('/[^0-9a-z]/', '', $str);
    return $clean;
}

public static function resumirTexto(string $texto, int $caracteres) : string{
    if(strlen($texto) < $caracteres)
        return $texto."...";

    return substr($texto, 0, $caracteres)."...";
}

public static function redirecionar404(){
    header('HTTP/1.1 404 Not Found');
    $local = 'http://localhost:3000/blog/404';
    header("Location: {$local}");
    exit();
}



}

?>
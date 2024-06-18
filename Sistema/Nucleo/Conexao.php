<?php

namespace Sistema\Nucleo;

use PDO;
use PDOException;



class Conexao
{
    private static $instancia;

    public static function getInstancia(): PDO
    {
        if (empty(self::$instancia)) {
            try {
                self::$instancia = new PDO('mysql:host='.DB_HOST.';port='.DB_PORTA.';dbname='.DB_NOME.'', DB_USER, DB_PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // todo erro gera uma exceção
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // transforma os dados retornados em objetos
                    PDO::ATTR_CASE => PDO::CASE_NATURAL // força as colunas ter o mesmo nome das tabelas

                ]);
            } catch (PDOException $e) {
                die("Erro de conexão com banco: " . $e->getMessage());
            }
        }

        return self::$instancia;
    }

    protected function __construct()
    {
        //protected instance of class
    }

    private function __clone() : void{
        //protected clone of class
    }
}

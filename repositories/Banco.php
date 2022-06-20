<?php
include_once("../init.php");

class Banco
{
    private static $dbNome = BD_BANCO;
    private static $dbHost = BD_SERVIDOR;
    private static $dbUsuario = BD_USUARIO;
    private static $dbSenha = BD_SENHA;
    
    private static $cont = null;
    
    public function __construct() 
    {
        
    }
    
    public static function conectar()
    {
        if(null == self::$cont)
        {
            try
            {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbNome, self::$dbUsuario, self::$dbSenha); 
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }
    
    public static function desconectar()
    {
        self::$cont = null;
    }
}
?>

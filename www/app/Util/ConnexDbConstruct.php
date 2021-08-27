<?php

    //AQUI CRIADA A PARTIR DO EXEMPLO DO PROETO MAPA REALIZADO COMO PROJETO PARA A GERÊNCIAL
    //USA O PADRÃO DE CRIAÇÃO A PARTIR DO MÉTODO DE CONSTRUÇÃO PADRÃO DE UMA CLASSE....
    abstract class ConnexDbConstruct
    {

        private static $connDbaseDbase;

        public static function openLinkConnection()
        {
            // $servername = "127.0.0.1";
            $servername = "db";
            // $servername = "localhost"; //LOCAL PHP_MYADMIN_MYSQL
            
            $port = "3306";
            // $port = "3307"; //LOCAL PHP_MYADMIN_MYSQL
            
            // $username = "root";
            $username = "db_user";
            
            // $password = "kabala";
            $password = "db_user_pass";
            // $password = ""; //LOCAL PHP_MYADMIN_MYSQL
            
            $dbasename = "mvcphptest";

            if (self::$connDbaseDbase == null)
            {
                try {

                    // ORIGINAL CONEX STRING.. NO PORT INFO
                    // self::$connDbaseDbase = new PDO("mysql:host=$servername;dbname=$dbasename", $username, $password);
                    self::$connDbaseDbase = new PDO("mysql:dbname=$dbasename;host=$servername;port=$port", $username, $password);
                    self::$connDbaseDbase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      

                } catch (PDOException $e) {

                    echo "___ CLASS: linkConnection.php CONETION failed: " . $e->getMessage() . " This is a PERSONAL ECHO for error!___" . "<br><br>";
                
                }
            }        
            return self::$connDbaseDbase;
        }

        static function closeLinkConnection() 
        {
            self::$connDbaseDbase == null;
        }
    }

?>
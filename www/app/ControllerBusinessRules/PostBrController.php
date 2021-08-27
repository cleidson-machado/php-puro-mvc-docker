<?php

require_once 'app/EntityDao/ComentarioDao.php';

// NO EXTENDS COMENTARIO DAO CLASS...
class PostBrController
{
    // UMA REGRA SIMPLES.. ATERANDO TUDO PARA MAIUSCULO ANTES DE SALVAR NO BANCO
    // SIMPLE RULE TEST.. CHANGE TO UPPERCASE BEFORE SAVE DATA
    public static function insertUpperCaseRule_BKP($reqPost)
    {

        try {

            $nameUpperCase = strtoupper($reqPost['nome']);
            $msnUpperCase = strtoupper($reqPost['msg']);
            
            $comment = new ComentarioEntity;

        } catch (Exception $e) {

            throw new Exception("ERRO AO CRIAR UMA ENTIDADE...");
            
            echo $e->getMessage();

        } finally {

            $comment->setId($reqPost['id']);
            $comment->setNome($nameUpperCase);
            $comment->setMensagem($msnUpperCase);

            try {

                ComentarioDao::insert($comment);

            } catch (Exception $e) {

                throw $e->getMessage();
                // throw new Exception("ERRO AO USAR A ENTIDADE PARA INSERIR NO BANCO...");
            
                // echo $e->getMessage();
            }

        }

    }

    // CREATE FOR TESTE PASS A ERROR TO ANOTHER CLASS, BUT IT NOT WORKING YET..26/08/2021
    public static function insertUpperCaseRule($reqPost)
    {

        $nameUpperCase = strtoupper($reqPost['nome']);
        $msnUpperCase = strtoupper($reqPost['msg']);

        try {

            $comment = new ComentarioEntity;

            $comment->setId($reqPost['id']);
            $comment->setNome($nameUpperCase);
            $comment->setMensagem($msnUpperCase);

            ComentarioDao::insert($comment);

        } catch (Throwable $e) {
            throw $e->getMessage();
        }

    }

    //CREATE ANOTHER METHOD TO FIND IF THE E-MAIL EXISTS BEFORE...


}


?>
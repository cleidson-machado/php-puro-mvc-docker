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
    public static function insertUpperCaseRuleBKP_IS_WORKING($reqPost)
    {

        $nameUpperCase = strtoupper($reqPost['nome']);
        $msnUpperCase = strtoupper($reqPost['msg']);

        try {

            $comment = new ComentarioEntity;

            $comment->setId($reqPost['id']);
            $comment->setNome($nameUpperCase);
            $comment->setMensagem($msnUpperCase);

            ComentarioDao::insert($comment);

        } catch (Exception $e) {
            throw $e->getMessage();
        }

    }

    public static function insertUpperCaseRule($reqPost)
    {
        $emailMsn = $reqPost['msg'];

        $nameUpperCase = strtoupper($reqPost['nome']);
        $msnUpperCase = strtoupper($reqPost['msg']);

        try { //THE FIRST TRY

            $emailValid = PostBrController::emailValidator($emailMsn);

            if (!$emailValid) {
                //JUST RETURN A ERROR MESSAGE IF NOT A VALID E-MAIL...
                //USING THE FIRST CATCH
            } else {
                    try { //THE SECOND TRY

                        $comment = new ComentarioEntity;
            
                        $comment->setId($reqPost['id']);
                        $comment->setNome($nameUpperCase);
                        $comment->setMensagem($msnUpperCase);
            
                        ComentarioDao::insert($comment);

                        //REDIRECT SHORTCUT... PERHAPS THIS IS NOT A BEST PLACE TO USE THAT FUNCTIONALITY.. 
                        header('Location: http://localhost/?pagina=post&metodo=index&id='.$reqPost['id']);
            
                    } catch (Exception $e) { //THE SECOND CATCH
                        
                        throw $e; // RETURN ANOTHER ERROR FROM DAO CLASS
                    }
            }

        } catch (Exception $e) { //THE FIRST CATCH

            throw $e; //RETURN THE ERROR MESSAGE FROM FUNCTION "emailValidator" TO ANOTHER OO CLASS CONTROLLER THAT CALL THIS METHOD BEFORE...
        }

    }

    //CREATE ANOTHER METHOD TO FIND IF THE E-MAIL IS VALID BEFORE... TESTING...
    public static function emailValidator ($email) 
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            throw new Exception("E-MAIL ENVIADO É INVÁLIDO!", 333); //333 IS A TEST TO ID ERRO NUMBER!
            return false;
            // exit;
        else:
            // throw new Exception ("E-MAIL VALIDADO!", 444); //444 IS A TEST TO ID ERRO NUMBER!
            return true;
            // exit;
        endif;
    }


}


?>
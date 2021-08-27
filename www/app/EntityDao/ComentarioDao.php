<?php

require_once 'app/Entity/ComentarioEntity.php';

class ComentarioDao extends ComentarioEntity
    {


        public static function selecionarComentarios($idPost)
        {
            // $con = Connection::getConn();
            $dataBase = ConnexDbConstruct::openLinkConnection();

            $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
            $sql = $dataBase->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('ComentarioDao')) {
                $resultado[] = $row;
            }

            return $resultado;
        }


        public static function inserir_ORIGINAL_WAY_DEV($reqPost)
        {
            //$con = Connection::getConn();
            $dataBase = ConnexDbConstruct::openLinkConnection();

            $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nom, :msg, :idp)";
            $sql = $dataBase->prepare($sql);
            
            $sql->bindValue(':nom', $reqPost['nome']);
            $sql->bindValue(':msg', $reqPost['msg']);
            $sql->bindValue(':idp', $reqPost['id']);
            
            $sql->execute();

           

            throw new Exception("Falha na inserção");
        }

        // CREATE FOR TESTE PASS A ERROR TO ANOTHER CLASS, BUT IT NOT WORKING YET..26/08/2021
        public static function insert(ComentarioEntity $comentarioEntity)
        {

            $dataBase = ConnexDbConstruct::openLinkConnection();

            $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nom, :msg, :idp)";
            $sql = $dataBase->prepare($sql);


            try {
                $sql->bindValue(':nom', $comentarioEntity->getNome());
                $sql->bindValue(':msg', $comentarioEntity->getMensagem());
                $sql->bindValue(':idp', $comentarioEntity->getId());

                $sql->execute();

                if ($sql->rowCount()) {
                    return true;
                }

            } catch (Exception $e) {
                throw new $e("Falha na inserção");
            }

        }

    }

?>
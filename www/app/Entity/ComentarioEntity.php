<?php

    //DBASE CLASS CONECTION
    require_once 'app/Util/ConnexDbConstruct.php';

    class ComentarioEntity
    {

        private $id;
        private $nome;
        private $mensagem;

        private $id_postagem; //FK na tabela comentario

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

          /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }


        /**
         * Get the value of id_postagem
         */ 
        public function getId_postagem()
        {
                return $this->id_postagem;
        }


        /**
         * Get the value of nome
         */ 
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function setNome($nome)
        {
                $this->nome = $nome;

                return $this;
        }

        /**
         * Get the value of mensagem
         */ 
        public function getMensagem()
        {
                return $this->mensagem;
        }

        /**
         * Set the value of mensagem
         *
         * @return  self
         */ 
        public function setMensagem($mensagem)
        {
                $this->mensagem = $mensagem;

                return $this;
        }

      
    }

?>
<?php

    //DBASE CLASS CONECTION
    require_once 'app/Util/ConnexDbConstruct.php';

    class PostagemEntity
    {

        private $id;
        private $titulo;
        private $conteudo;
        private $comentarios;

        //UTIL PARA ESTUDO DE COMO FUNCIONA UMA ENTIDADE NO PHP
        //https://www.youtube.com/watch?v=b6c3B-Cgi38
        //https://www.youtube.com/watch?v=Dh9ETygs-pA&list=PL4cUxeGkcC9hNpT-yVAYxNWOmxjxL51Hy&index=4

        // public function __construct($titulo, $conteudo)
        // {
        //     $this->titulo = $titulo;
        //     $this->conteudo = $conteudo;
        // }

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

        public function __construct()
        {
            //VAZIO DE PROPÓSITO....
        }

        public function getTitulo()
        {
                return $this->titulo;
        }
  
        public function setTitulo($titulo)
        {
                $this->titulo = $titulo;

                return $this;
        }

        public function getConteudo()
        {
                return $this->conteudo;
        }

  
        public function setConteudo($conteudo)
        {
                $this->conteudo = $conteudo;

                return $this;
        }

        /**
         * Get the value of comentarios
         */ 
        public function getComentarios()
        {
                return $this->comentarios;
        }

        /**
         * Set the value of comentarios
         *
         * @return  self
         */ 
        public function setComentarios($comentarios)
        {
                $this->comentarios = $comentarios;

                return $this;
        }

    }

?>
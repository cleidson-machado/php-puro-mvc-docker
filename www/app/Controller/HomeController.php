<?php

    require_once 'app/EntityDao/PostagemDao.php';

    // OK IT IS A CONTROLLER ACTION CLASS
    // UTILIZA FUNÇÃO ESTÁTICA PARA CHAMAR PostagemDao E POR HERANÇA A PostagemEntity
    class HomeController
    {
        private static $instance;

        //REAPROVEITAMENTO DE CÓDIGO... USA O NEW PostagemDao SÓ UMA VEZ AQUI E TODOS OS METODOS COMPARTILHAM...
        public static function daoGetInstace()
        {
                if (!isset(self::$instance))
                    self::$instance = new PostagemDao; // PEGA POR HERANÇA A ENTIDADE RESPECTIVA..
            return self::$instance;
        }

         //FUNCIONANDO... PADRÃO NOVO.. ABAIXO O ANTIGO / ORIGINAL
         public function index_test()
         {
             $this->listar();// REDIRECIONAMENTO USANDO FUNÇÕES BÁSICAS POR ISSO USA O THIS...
         }

        //FUNÇÃO OK... APENAS BKP...
        public function index()
		{
			try {

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);                
                $viewTemplate = $twig->load('home.html');

                $dados = array();
				$dados['postListController'] = HomeController::daoGetInstace()->listAll();
				$viewDataCode = $viewTemplate->render($dados);

			} catch (Exception $e) {
                echo "___Error Reder a Controller View: " . $e->getMessage() . "___";
                
			} finally {
                echo $viewDataCode;
            }

        }

        // TESTE... OK EXEMPLO MAIS BEM ACABADO... NA DAO... FALTA CRIAR A VIEW!!
        public function listar()
        {
            HomeController::daoGetInstace()->listAll();
        }

        //TESTE... OK.. TÁ SALVANDO!! NA DAO.. FALTA CRIAR A VIEW!!
        public function salvar()
        {
            $titulo = "TTTTTT de Teste QQQQQQ";
            $viewDataCode = "CCCCCCC de teste... QQQQQQ";

            // CRIA O OBJETO --> PostagemEntity <-- VIA HERANÇA PELA CLASSE PostagemDao
            $post = HomeController::daoGetInstace();

            $post->setTitulo($titulo);
            $post->setviewDataCode($viewDataCode);

            // var_dump($post);

            // USA MÉTODO COMPATILHADO PARA REAPROVEITAR E CENTRALIZAR A CRIAÇÇAO DO PostagemDao
            HomeController::daoGetInstace()->saveData($post);

        }

         //PARA TEST DEBUG ONLY
        //  public function index()
		// {
        //     echo "passei aqui";
        // }

    }

?>
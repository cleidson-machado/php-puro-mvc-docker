<?php

	require_once 'app/EntityDao/PostagemDao.php';
	// require_once 'app/EntityDao/ComentarioDao.php';
	require_once 'app/ControllerBusinessRules/PostBrController.php';

	class PostController
	{

		public function index($params)
		{
            try {

				$postagem = PostagemDao::selecionaPorId($params);

				$loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
				$viewTemplate = $twig->load('single.html');

				$dados = array();
				$dados['id'] = $postagem->id;
				$dados['titulo'] = $postagem->titulo;
				$dados['conteudo'] = $postagem->conteudo;
				$dados['comentarios'] = $postagem->comentarios;

				$viewDataCode = $viewTemplate->render($dados);

				echo $viewDataCode;
				
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}


		// PAREI AQUI.. EM 11/08/2021 AS 18:30 Hs... add try cath e redirecionamentos / avisos em caso erro aqui??
		// CREATE FOR TESTE PASS A ERROR TO ANOTHER CLASS, BUT IT NOT WORKING YET..26/08/2021
		public function addComent_BKP_IS_WORKING()
		{

			try {
					// SEND RO SAVE... BY RULER CLASS
					PostBrController::insertUpperCaseRule($_POST);
			} catch (Throwable $e) {

				//CREATE A SIMPLE JAVASCRIPT CODE... NO WORK FINE!! CHECK! 
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/?pagina=post&metodo=index&id='.$_POST['id'].'"</script>';

			} finally {

					// JUST TO RELOAD THE PAGE
					header('Location: http://localhost/?pagina=post&metodo=index&id='.$_POST['id']);
			}

		}


		public function addComent()
		{
			try {
				PostBrController::insertUpperCaseRule($_POST);
			} catch (Exception $e) {
				//CREATE A SIMPLE JAVASCRIP ALERT!!
				echo '<script>alert("'.$e->getMessage().'");</script>'; // GET THE ERROR MESSAGE FROM THE PHP CLASSE FILES
				echo '<script>alert("'.$e->getFile().'");</script>'; //GET WHAT IS THE PHP FILE NAME WITH THE ERROR!!
				echo '<script>location.href="http://localhost/?pagina=post&metodo=index&id='.$_POST['id'].'"</script>';
			}
				
		}


		
		// NEW METHOD NOT FINISHED YET!! FOR RULER CLASS.... OLD DEVELOPER PATTERN
		// public function addComent_BKP()
		// {
		// 	try {
		// 		PostBrController::insertRule($_POST);
								
		// 		header('Location: http://localhost/?pagina=post&metodo=index&id='.$_POST['id']);

		// 	} catch (Exception $e) {

		// 		echo '<script>alert("'.$e->getMessage().'");</script>';
		// 		echo '<script>location.href="http://localhost/?pagina=post&metodo=index&id='.$_POST['id'].'"</script>';
		// 	}

		// }

	}	
?>
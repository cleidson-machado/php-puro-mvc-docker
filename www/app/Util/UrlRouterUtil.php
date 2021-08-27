<?php

	// DEFALT URL UTIL TOLL TO ALL WEB SITE / ANTIGA CORE!!
	class UrlRouterUtil
	{
		
		public function redirectAndResolver($urlGet)
		{
			if (isset($urlGet['metodo'])) {
				$acao = $urlGet['metodo'];
			} else {
				$acao = 'index';
			}

			if (isset($urlGet['pagina'])) {
				$controller = ucfirst($urlGet['pagina'].'Controller');
			} else {
				$controller = 'HomeController';
			}

			//PAREI AQUI MERDA!!!
			if (!class_exists($controller)) {
				
				$controller = 'ErroController';

				echo "_________ INICIO da DEPURAÇÃO da URL ENVIADA _________" . "<br><br><br><br>";

				print_r ($urlGet);
				echo "<br><br>" . "veja o nome da CONTROLLER solicitada de forma DETALHADA acima e abaixo:" . "<br><br>";
				var_dump($urlGet);

				echo "<br><br><br>";

				echo "_________ FIM da DEPURAÇÃO da URL ENVIADA _________" . "<br><br><br><br>";
			}

			if (isset($urlGet['id']) && $urlGet['id'] != null) {
				$id = $urlGet['id'];
			} else {
				$id = null;
			}

			// QUANDO O PROETO MIGROU PARA O PHP 8 DEU RUIM AQUI... COCATENAÇÕES?
			// WHEN THE PROJECT WAS MIGRATED TO PHP 8, WE HAVE A ISSUE AT THIS POINT... 
			// I THINK IT HAS HAPPENED BECAUSE WE USE THIS CONCATENATION BELOW
			// call_user_func_array(array(new $controller, $acao), array('id' => $id));

			// ALTERANDO PARA ESSE PADRÃO AQUI!
			// CHANGING THE PATTERN TO TYPE BELOW..
			call_user_func_array(array(new $controller, $acao), array($id));
			
		}

		// _TEST_DBUG_ONLY
		public function redirectAndResolverTest($urlGet)
		{
			$controller = ucfirst($urlGet['pagina'].'Controller');

			if(class_exists($controller)){
				echo "CONTROLLER ENCONTRADA!";
				echo "<br><br>";
				echo $controller;
				// header("?" . "");
			} else {
				echo "OFF! CONTROLLER ";
				echo "<br><br>";
				var_dump($urlGet);
				echo "<br><br>";
				var_dump($controller);
			}
		}



	}
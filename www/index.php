<?php

// ATENÇÃO ESSA PÁGINA É UMA CONCENTRADORA ELA DEVE RECEBER TODAS AS CONTROLADORAS CRIADAS...

//CRIA-FILTRA-REDIRECIONA URLS...
require_once 'app/Util/UrlRouterUtil.php';

//FOR USING TWIG TEMPLATE FOR VIEW HTML PAGES
require_once 'vendor/autoload.php';

//VIEW CONTROLLERS...
// require_once 'app/Controller/HomeController.php';
// require_once 'app/Controller/PostController.php';
// require_once 'app/Controller/ErrorController.php';

//TO LOAD ALL VIEW CONTROLLERS IN THE CONTROLLERS FOLDER...
foreach (glob("app/Controller/*.php") as $phpControllerFileName)
{
    require_once $phpControllerFileName;
}

$template = file_get_contents('app/ViewTemplate/basicWebDesign.html');

ob_start();

    $urlDefault = new UrlRouterUtil;
    $urlDefault->redirectAndResolver($_GET); //ERROR FOR WITE PAGE isn’t working.. HERE!

    $saida = ob_get_contents();

ob_end_clean();

$template_pronto = str_replace('{{area_dinamica}}', $saida, $template );

// var_dump($saida); 

// echo $template;

echo $template_pronto;

?>
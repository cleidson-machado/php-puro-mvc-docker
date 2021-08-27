<?php

	require_once 'app/Entity/PostagemEntity.php';

 	// DAO FUNCIONS
 	class PostagemDao extends PostagemEntity
	{

		public function __construct()
        {
            //USED BY A CONTROLLER
        }

		//OK FINALIZED USING THE CORRECT PARTTERN
		public function listAll()
		{
			$dataBase = ConnexDbConstruct::openLinkConnection();
			$lista = array();

			try {

				$sql = "SELECT * FROM postagem ORDER BY id DESC";
				$sql = $dataBase->prepare($sql);
				$sql->execute();

			} catch (Exception $e) {

				echo "Error on a QUERY IN a DAO CLASS: " . "<br>" . "|". $e->getMessage() . "|" . "<br>";

			} finally {

				while ($row = $sql->fetchObject('PostagemDao')) {
					$lista[] = $row;
				}
	
				if (!$lista) {
					throw new Exception("NO DATA FOUND ON DATABASE!");		
				}

				$dataBase = ConnexDbConstruct::closeLinkConnection();
			}

			return $lista;

		}

		//OK FINALIZED USING THE CORRECT PARTTERN
		public function saveData(PostagemEntity $postagem)
		{
			$dataBase = ConnexDbConstruct::openLinkConnection();

			try {

			$sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)";
			$sql = $dataBase->prepare($sql);

			$sql->bindValue(':titulo', $postagem->getTitulo());
			$sql->bindValue(':conteudo', $postagem->getConteudo());

			$sql->execute();

			} catch (Exception $e) {

			echo "Error on a QUERY IN a DAO CLASS: " . "<br>" . "|". $e->getMessage() . "|" . "<br>";

			} finally {

			$dataBase = ConnexDbConstruct::closeLinkConnection();

			}

		}
		
		//USED BY THE ORIGINAL PROJECT DEVELOPER
		public static function selecionaTodos()
		{
			$dataBase = ConnexDbConstruct::openLinkConnection();

			$sql = "SELECT * FROM postagem ORDER BY id DESC";
			$sql = $dataBase->prepare($sql);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('PostagemDao')) {
				$resultado[] = $row;
			}

			if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco");		
			}

			return $resultado;
		}

		//USED BY THE ORIGINAL PROJECT DEVELOPER
		public static function selecionaPorId($idPost)
		{
			// $con = Connection::getConn();
			$dataBase = ConnexDbConstruct::openLinkConnection();

			$sql = "SELECT * FROM postagem WHERE id = :id";
			$sql = $dataBase->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('PostagemDao');

			if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco");	
			} else {
				// echo "OK.. ENCONTRADO FALTA CRIAR A PROXIMA PARTE!!..";
				// echo "<br><br>";
				$resultado->comentarios = ComentarioDao::selecionarComentarios($resultado->id);
				// $teste = ComentarioDao::selecionarComentarios($resultado->id);
			}

			return $resultado;
		}

		//USED BY THE ORIGINAL PROJECT DEVELOPER
		public static function insert($dadosPost)
		{
			if (empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])) {
				throw new Exception("Preencha todos os campos");

				return false;
			}

			// $con = Connection::getConn();
			$dataBase = ConnexDbConstruct::openLinkConnection();			

			$sql = $dataBase->prepare('INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)');
			$sql->bindValue(':tit', $dadosPost['titulo']);
			$sql->bindValue(':cont', $dadosPost['conteudo']);
			$res = $sql->execute();

			if ($res == 0) {
				throw new Exception("Falha ao inserir publicação");

				return false;
			}

			return true;
		}

		//USED BY THE ORIGINAL PROJECT DEVELOPER
		public static function update($params)
		{
			// $con = Connection::getConn();
			$dataBase = ConnexDbConstruct::openLinkConnection();

			$sql = "UPDATE postagem SET titsulo = :tit, conteudo = :cont WHERE id = :id";
			$sql = $dataBase->prepare($sql);
			$sql->bindValue(':tit', $params['titulo']);
			$sql->bindValue(':cont', $params['conteudo']);
			$sql->bindValue(':id', $params['id']);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao alterar publicação");

				return false;
			}

			return true;
		}

		//USED BY THE ORIGINAL PROJECT DEVELOPER
		public static function delete($id)
		{
			// $con = Connection::getConn();
			$dataBase = ConnexDbConstruct::openLinkConnection();

			$sql = "DELETE FROM postagem WHERE id = :id";
			$sql = $dataBase->prepare($sql);
			$sql->bindValue(':id', $id);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao deletar publicação");

				return false;
			}

			return true;
		}

	}

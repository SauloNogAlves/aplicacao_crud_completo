<?php


class TarefaService {

	private $conexao;
	private $tarefa;

	public function __construct(Conexao $conexao, Tarefa $tarefa){
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	public function inserir(){
		$query = "
		INSERT INTO tb_tarefas(
			tarefa
		)
		VALUES(
			:tarefa

		)
		";

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
		$stmt->execute();

	}
	public function recuperar(){
		$query = "
	   SELECT a.id
			 , b.status
			 , a.tarefa	 
		FROM tb_tarefas a
		LEFT JOIN tb_status b 
        ON a.id_status = b.id 

		";

		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function recuperar_pendentes(){
		$query = "
	   SELECT a.id
			 , b.status
			 , a.tarefa	 
		FROM tb_tarefas a
		LEFT JOIN tb_status b 
        ON a.id_status = b.id 
        WHERE a.id_status = :id_status

		";

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function atualizar(){
		$query = "
		UPDATE tb_tarefas
		SET tarefa = :tarefa
		WHERE id = :id
		";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		return $stmt->execute();
	}
	public function remover(){
		$query = "
		DELETE FROM tb_tarefas
		WHERE id = :id
		";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		$stmt->execute();
	}
	public function marcar_realizada(){
		$query = "
		UPDATE tb_tarefas
		SET id_status = :id_status
		WHERE id = :id
		";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		return $stmt->execute();
	}

}



?>
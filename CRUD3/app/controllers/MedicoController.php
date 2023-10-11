<?php
use models\Medico;


#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class MedicoController {

	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];

		#cria o model
		$model = new Medico();
		
		
		$send['data'] = null;
		#se for diferente de nulo é porque estou editando o registro
		if ($id != null){
			#então busca o registro do banco
			$send['data'] = $model->findById($id);
		}
		

		#busca todos os registros
		$send['lista'] = $model->all();

		$send['especialidades'] = $model->especialidades;
        

		#chama a view
		render("medico", $send);
	}

	
	function salvar($id=null){

		$model = new Medico();
		
		if ($id == null){
			$id = $model->save($_POST);
		} else {
			$id = $model->update($id, $_POST);
		}
		
		redirect("medico/index/$id");
	}

	function deletar(int $id){
		
		$model = new Medico();
		$model->delete($id);

		redirect("medico/index/");
	}


}
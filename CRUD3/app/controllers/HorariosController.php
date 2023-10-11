<?php
use models\Consulta;
use models\Medico;

#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class HorariosController {

	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];

		#cria o model
		$model = new Consulta();
		
		
		$send['data'] = null;
		#se for diferente de nulo é porque estou editando o registro
		if ($id != null){
			#então busca o registro do banco
			$send['data'] = $model->findById($id);
		}
		

		#busca todos os registros
		$send['lista'] = $model->allFiltros();

		$modelmedico = new Medico();
		$send['medicos'] = $modelmedico->all();
        

		#chama a view
		render("horarios", $send);
	}

	
	function salvar($id=null){

		$model = new Consulta();
		
		if ($id == null){
			$id = $model->save($_POST);
		} else {
			$id = $model->update($id, $_POST);
		}
		
		redirect("horarios/index/$id");
	}

	function deletar(int $id){
		
		$model = new Consulta();
		$model->delete($id);

		redirect("horarios/index/");
	}


}
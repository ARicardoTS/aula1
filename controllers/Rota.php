<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rota extends CI_Controller {
	
	// index.php/Rota/rota1
	public function rota1(){
		$this->load->view('rota1');
		$nome = $this->session->userdata("_nome");
		echo "<h3> Bem vindo " . $nome . "</h3";
	}
	// index.php/Rota/rota2
	public function rota2(){
		$this->listar();
		//$this->load->view('rota2');
	}
	// index.php/Rota/rota3
	public function rota3(){
		//$this->listar();
		$this->load->view('rota3');
	}
	// index.php/Rota/rota4
	public function rota4(){
		$this->load->view('rota4');
	}
	// index.php/Rota/auth
    public function auth(){
		$nome = $_POST["nome"];
		$senha = $_POST["senha"];
		$this->load->model("model");
		$usr = $this->model->getUser($nome, $senha);
			if($usr !== false){
				if($usr ==="admin"){
					$this->session->set_userdata("_ID", "admin");
				    redirect("/rota/admin");	
				}else{
					$this->session->set_userdata("_ID", "comum");
					$this->session->set_userdata("_nome", "$nome");
					redirect("/rota/rota1");
				}
		}//  https://github.com/romefeller/phpci
    }
	public function page(){
		if($this->session->userdata("_nome") != null){
			echo "<h3> pagina de usuario </h3>";
		}else{
			redirect("/rota/entrar");
		}
	}
	public function logout(){
		$this->session->unset_userdata("_ID");
		$this->session->unset_userdata("_nome");
		echo "<h3> ate logo </h3)";
	}
	// index.php/Rota/formogin
	public function formlogin(){
		$this->load->view('formlogin');
	}
	public function admin(){
		$a = $this->session->userdata("_ID");
		if($a === "admin"){
			echo "<h3> bem vindo admin </h3>";
		}else{
			echo "<h3> voce não está autorizado a entrar na página </h3>";
		}
		
	}
	// index.php/Rota/index
	public function index()
	{
		$this->load->view('Rota');
	}
	
	public function teste(){
		echo $this->session->userdata("_ID");
	}
	
	public function sess(){
		$this->session->set_userdata("_ID", "123");
		echo "Session setada com sucesso";
	}
	
	
	
	// index.php/Rota/doPost
	public function doPost(){
		// controller enxergar o model
		// APPPATH onde esta o codeIgnitor
		require_once APPPATH."models/user.php";
		// 'model' eh o Model, aqui passa com letra minuscula
		$this->load->model('model');
		$m = $this->model;
		// "nome" eh o nome do campo do formulario que estou extraindo a informacao para gravar no banco
		$m->insert(new Usuario($_POST["nome"],$_POST["endereco"], $_POST["bairro"], $_POST["cidade"])); // new Usuario eh a classe Usuario de user.php

		echo"dados inseridos corretamente";
		$this->listar();
	}
	
	// index.php/Rota/listar
	public function listar(){
		require_once APPPATH."models/user.php";
		$this->load->model('model');
		$m = $this->model;
		// soh para ver se deu certo
		$usuarios = $m->searchAll();
		$data['usuario'] = $usuarios;
		$this->load->view("rota2",$data);	

	} 
}


?>
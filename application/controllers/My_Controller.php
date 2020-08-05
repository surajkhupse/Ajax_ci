<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('ajax_model');
	}

	public function index()
	{
		$this->load->view('ajax');
	}

	public function create()
	{
		$name = $this->input->post('name');
		$message = $this->input->post('message');
		$age = $this->input->post('age');

		$data = array(
			'name'	=> $name,
			'message' => $message,
			'age'	=> $age,
		);
		
		$insert = $this->ajax_model->createData($data);
		echo json_encode($insert);
	}
	


   public function fetchDatafromDatabase(){

	$resultList = $this->ajax_model->fetchAllData('*','person',array());
	
	$result =array();

	// Added a Edit a button
	$button ='';



	$i = 1;
		foreach ($resultList as $key => $value) {
		   $button ='<a class="btn btn-primary " onclick="editFun('.$value['id'].')" href="#">Edit</a> ';
		   $button .=' <a class="btn btn-danger " onclick="deleteFun('.$value['id'].')" href="#">Delete</a>';
			$result['data'][] = array(
				$i++,
				$value['name'],
				$value['message'],
				$value['age'],
				$button


			);
		}
		echo json_encode($result);

   }

   public function getEditData(){

	$id=$this->input->post('id');
	
	$resultData = $this->ajax_model->fetchSingleData('*','person',array('id'=>$id));
       echo json_encode($resultData);

   }


   public function update()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$message = $this->input->post('message');
		$age = $this->input->post('age');

		$data = array(
			'name'	=> $name,
			'message' => $message,
			'age'	=> $age,
		);
		$update = $this->ajax_model->updateData('person',$data,array('id'=>$id));
		if($update==true)
		{
			echo 1;
		}
		else{
			echo 2;
		}
	}


      public function Delete(){

		$id = $this->input->post('id');
		$dataDelete = $this->ajax_model->deletedata('person',array('id'=>$id));
		 if($dataDelete==true)
		 {
			 echo 1;

		 }
		 else
		 {
			 echo 2;
		 }



	  }



}

?>
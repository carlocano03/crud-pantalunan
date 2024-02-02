<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Task_model');
  }

  public function index()
  {
    $this->load->view('add_task');
  }

  public function addTask() {
    $data = array(
      'taskName' => $this->input->post('taskName'),
      'taskDesc' => $this->input->post('taskDesc')
    );

    $added = $this->Task_model->addTask($data);

    if ($added) {
      echo json_encode(array('success' => true, 'message' => 'Task added successfully'));
    } else {
      echo json_encode(array('success' => false, 'message' => 'Failed to add task'));
    }
  }
}
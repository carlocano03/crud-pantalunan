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
    $task = array(
      'taskName' => $this->input->post('taskName'),
      'taskDesc' => $this->input->post('taskDesc')
    );

    $added = $this->Task_model->addTask($task);

    if ($added) {
      echo json_encode(array('success' => true, 'message' => 'Task added successfully'));
    } else {
      echo json_encode(array('success' => false, 'message' => 'Failed to add task'));
    }
  }

  public function getAllTask() {
    $tasks = $this->Task_model->getAllTasks();
    echo json_encode($tasks);
  }

  public function getTaskById($taskId) {
    $task = $this->Task_model->getTaskById($taskId);
    echo json_encode($task);
  }

  public function editTask($taskId) {
    $task = array(
      'taskName' => $this->input->post('taskName'),
      'taskDesc' => $this->input->post('taskDesc')
    );

    $isUpdated = $this->Task_model->editTask($taskId, $task);

    if($isUpdated) {
      echo json_encode(array('success' => true, 'response' => 'Task update successfully'));
    } else {
      echo json_encode(array('success' => false, 'response' => 'Failed to update task'));
    }
  }

  public function deleteTask($taskId) {
    $isDeleted = $this->Task_model->deleteTask($taskId);
    echo json_encode(array('success' => $isDeleted, 'response' => 'Successfully deleted'));
  }
}
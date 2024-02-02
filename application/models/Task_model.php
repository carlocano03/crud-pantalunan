<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {
    // function to add new task to db
    public function addTask($data) {
        return $this->db->insert('tasks', $data);
    }

    // fetch all task from db
    public function getAllTasks() {
        $fetch = $this->db->get('tasks');
        return $fetch->result();
    }

    // fetch specific task by id
    public function getTaskById($taskId) {
        $fetch = $this->db->get_where('tasks', array('taskId' => $taskId));
        return $fetch->row();
    }

    // updated selected task
    public function editTask($taskId, $data) {
        $this->db->where('taskId', $taskId);
        $this->db->update('tasks', $data);
    }

    // remove task from db
    public function deleteTask($taskId) {
        return $this->db->delete('tasks', array('taskId' => $taskId));
    }
}
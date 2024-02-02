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
    public function getTaskById($task_id) {
        $fetch = $this->db->get_where('tasks', array('task_id' => $task_id));
        return $fetch->row();
    }

    // updated selected task
    public function updateTask($task_id, $data) {
        $this->db->where('task_id', $task_id);
        $this->db->update('tasks', $data);
    }

    // remove task from db
    public function deleteTask($task_id) {
        return $this->db->delete('tasks', array('task_id' => $task_id));
    }
}
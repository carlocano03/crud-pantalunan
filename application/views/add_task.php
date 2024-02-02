<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CI3 CRUD</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
  <div class="container-fluid my-3">
    <div class="border border-2 rounded-3 mb-3 p-3">
      <form id="addTaskForm">
        <label class="form-label" for="task">Task Name</label>
        <input type="text" class="form-control mb-4" name="task" id="task" required>

        <label class="form-label" for="desc">Add Description</label>
        <input type="text" class="form-control mb-4" name="desc" id="desc" cols="30" rows="2" required>

        <div>
          <button class="btn btn-success" type="button" onclick="addNewTask($('#task').val(), $('#desc').val())">Add Task</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function addNewTask(task, desc) {

      if(task === '' || desc === '') {
        alert('Please fill in all fields');
        return;
      }

      $.ajax({
        type: 'post',
        url: "<?= base_url() .  'task/addTask'?>",
        data: {
          'task': task,
          'desc': desc
        },
        dataType: 'json',
        success: function(res) {
          alert('Added successfully!');
          console.log(res);
        },
        error: function() {
          alert('Error adding task!');
        }
      });
    }
  </script>
</body>
</html>
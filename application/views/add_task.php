<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do Task CRUD</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
  <div class="container-fluid my-3">
    <div class="border border-2 rounded-3 mb-4 p-3">
      <h2 class="text-center mb-3">To-Do</h2>
      <form id="addTaskForm">
        <label class="form-label" for="task">Task:</label>
        <input type="text" class="form-control mb-4" name="task" id="task" required>

        <label class="form-label" for="desc">Description:</label>
        <textarea type="text" class="form-control mb-4" name="desc" id="desc" cols="30" rows="2" required></textarea>

        <div>
          <button class="btn btn-success" type="button" onclick="addNewTask()">Add Task</button>
        </div>
      </form>
    </div>
    
    <div class="my-2">
      <table class="table table-striped border border-2">
        <thead>
          <tr>
            <th scope="col">Task</th>
            <th scope="col">Description</th>
            <th class="text-center" scope="col">Actions</th>
          </tr>
        </thead>
        <tbody id="tasksTable">
        </tbody>
      </table>
    </div>
  </div>

  <script>
    var editTaskId = null;

    // add new task to db
    function addNewTask() {

      // get task name and description
      var task = $('#task').val();
      var desc = $('#desc').val();

      // validate form if inputs are empty
      if (task === '' || desc === '') {
        alert('Please fill in all fields');
        return;
      }

      $.ajax({
        type: 'post',
        url: "<?= base_url() . 'task/addTask' ?>",
        data: {
          'taskName': task,
          'taskDesc': desc
        },
        dataType: 'json',
        success: function(res) {
          alert('Added successfully!');
          getAllTask();

          // reset form after adding
          $('#task').val('');
          $('#desc').val('');
        },
        error: function() {
          alert('Error adding task!');
          console.log(task, desc);
        }
      });
    }

    // fetch all task from db
    function getAllTask() {
      $.ajax({
        type: 'post',
        url: "<?= base_url() . 'task/getAllTask' ?>",
        dataType: 'json',
        success: function(res) {
          $('#tasksTable').empty();
          $.each(res, function(i, task) {

            // create table row that will handle data from db
            const tblRows = 
              '<tr><td><strong>' + task.taskName + '</strong></td>' +
              '<td>' + task.taskDesc + '</td>' +  
              '<td>' +
                '<div class="d-flex justify-content-center">' +
                  '<button class="btn btn-info me-3 editBtn" onclick="getTaskById('+ task.taskId +')">Edit Task</button>' +
                  '<button class="btn btn-danger delBtn" onclick="deleteTask('+ task.taskId +')">Delete Task</button>'
                '</div>' +
              '</td></tr>';

            // push each row to table body
            $('#tasksTable').append(tblRows);
          });
        },
        error: function() {
          alert('Error fetching all tasks!');
        }
      });
    }

    // fetch task by id from db
    function getTaskById(taskId) {
      editTaskId = taskId;

      $.ajax({
        type: "post",
        url: "<?= base_url() . 'Task/getTaskById/' ?>" + taskId,
        dataType: "json",
        success: function(res) {
          $('#task').val(res.taskName);
          $('#desc').val(res.taskDesc);
          $('button').text('Update Task');
          $('button').attr('onclick', 'updateSelectedTask()');
          $('button').show();
          $('.editBtn').hide();
          $('.delBtn').hide();
        },
        error: function() {
          alert('Failed to retrieve task data!');
        }
      });
    }

    // update task by id
    function updateTask(taskId, task, desc) {

      $.ajax({
        type: "post",
        url: "<?= base_url() . 'Task/editTask/' ?>" + taskId,
        data: {
          'taskName': task,
          'taskDesc': desc,
        },
        dataType: "json",
        success: function (res) {
          alert('Task has been updated!');
          getAllTask();
          $('button').text('Add Task');
          $('button').attr('onclick', 'addNewTask()');

          // reset form after updating
          $('#task').val('');
          $('#desc').val('');
        },
        error: function () {
          alert('Failed to update task!');
        }
      });
    }

    // update selected task
    function updateSelectedTask() {

      // get task name and description
      var task = $('#task').val();
      var desc = $('#desc').val();

      if (editTaskId) {
        updateTask(editTaskId, task, desc);
      }
    }

    // delete task by id
    function deleteTask(taskId) {
      var deleteConfirm = confirm('Are you sure you want to delete this task?');

      if (!deleteConfirm) {
        return
      }
      else {
        $.ajax({
          type: "post",
          url: "<?= base_url() . 'Task/deleteTask/' ?>" + taskId,
          dataType: "json",
          success: function (res) {
            alert('Task has been deleted!');
            getAllTask();
          },
          error: function () {
            alert('Failed to delete task!');
          }
        });
      }
    }

    // initiate getAllTask function
    getAllTask();
  </script>
</body>
</html>
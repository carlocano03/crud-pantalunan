<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
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
        <textarea type="text" class="form-control mb-4" name="desc" id="desc" cols="30" rows="2" required></textarea>

        <div>
          <button class="btn btn-success" type="button" onclick="addNewTask($('#task').val(), $('#desc').val())">Add Task</button>
        </div>
      </form>
    </div>
    
    <div class="my-2">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Task</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody id="tasksTable">
        </tbody>
      </table>
    </div>
  </div>

  <script>
    // add new task to db
    function addNewTask(task, desc) {

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

            // create table row that will handle each task
            var tblRows = 
              '<tr><td>' + task.taskName + '</td>' +
              '<td>' + task.taskDesc + '</td>' +  
              '<td>' +
              '<button class="btn btn-success me-2">Edit Task</button>' +
              '<button class="btn btn-danger">Delete Task</button>'
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
    // initiate getAllTask function
    getAllTask();
  </script>
</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CI3 Crud</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid my-3">
    <div class="border border-2 rounded-3 d-flex flex-column mb-3 p-3">
      <form method="post">
        <label class="form-label" for="task">Task Name</label>
        <input type="text" class="form-control mb-4" name="task" id="task">

        <label class="form-label" for="desc">Add Description</label>
        <textarea class="form-control mb-4" name="desc" id="desc" cols="30" rows="2"></textarea>

        <div>
          <button class="btn btn-success" type="submit">Add Task</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <style>
    .task-modal {
      background-color: #e7f2f7; 
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>

<!-- Edit Task Modal -->
<div id="editTaskModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content -->
    <div class="modal-content task-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Task</h4>
      </div>
      <div class="modal-body">
        <form id="editTaskForm" method="post">
          <div class="form-group">
            <label for="editTaskTitle">Title:</label>
            <input type="text" class="form-control" id="editTaskTitle" name="editTaskTitle" required>
          </div>
          <div class="form-group">
            <label for="editTaskDescription">Description:</label>
            <textarea class="form-control" id="editTaskDescription" name="editTaskDescription" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="editTaskDueDate">Due Date:</label>
            <input type="text" class="form-control" id="editTaskDueDate" name="editTaskDueDate" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD" required>
          </div>
          <div class="form-group">
            <label for="editTaskStatus">Status:</label>
            <select class="form-control" id="editTaskStatus" name="editTaskStatus" required>
              <option value="1">Completed</option>
              <option value="0">Pending</option>
            </select>
          </div>
          <input type="hidden" id="editTaskID" name="editTaskID">
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Initialize date picker
  $('#editTaskDueDate').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
  });

  // Handle form submission
  $('#editTaskForm').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: 'updateTask.php',
      type: 'POST',
      data: formData,
      success: function(response) {
        alert('Task updated successfully');
        $('#editTaskModal').modal('hide');
        location.reload();
      },
      error: function(xhr, status, error) {
        console.error('Error updating task:', error);
        alert('Failed to update task. Please try again.');
      }
    });
  });
});
</script>

</body>
</html>



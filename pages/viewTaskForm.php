<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="../css/addTask.css">
</head>
<body>

<!-- View Task Modal -->
<div id="viewTaskModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content task-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Task</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="viewTaskTitle">Title:</label>
          <input type="text" class="form-control" id="viewTaskTitle" readonly>
        </div>
        <div class="form-group">
          <label for="viewTaskDescription">Description:</label>
          <textarea class="form-control" id="viewTaskDescription" rows="3" readonly></textarea>
        </div>
        <div class="form-group">
          <label for="viewTaskDueDate">Due Date:</label>
          <input type="text" class="form-control" id="viewTaskDueDate" readonly>
        </div>
        <div class="form-group">
          <label for="viewTaskStatus">Status:</label>
          <input type="text" class="form-control" id="viewTaskStatus" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editTaskBtn">Edit</button>
        <button type="button" class="btn btn-danger" id="deleteTaskBtn">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // View Task
  $('.view-task').click(function() {
    var taskID = $(this).data('id');
    $.ajax({
      url: 'viewTask.php',
      type: 'POST',
      data: { taskID: taskID },
      success: function(response) {
        var task = JSON.parse(response);
        $('#viewTaskTitle').val(task.title);
        $('#viewTaskDescription').val(task.description);
        $('#viewTaskDueDate').val(task.due_dates);
        $('#viewTaskStatus').val(task.status == 1 ? 'Completed' : 'Pending');
        $('#viewTaskModal').modal('show');
        $('#editTaskBtn').attr('onclick', 'showEditTaskModal(' + taskID + ')');
        $('#deleteTaskBtn').attr('onclick', 'deleteTask(' + taskID + ')');
      },
      error: function(xhr, status, error) {
        console.error('Error fetching task:', error);
        alert('Failed to fetch task details. Please try again.');
      }
    });
  });
});

function showEditTaskModal(taskID) {
  $.ajax({
    url: 'viewTask.php',
    type: 'POST',
    data: { taskID: taskID },
    success: function(response) {
      var task = JSON.parse(response);
      $('#editTaskTitle').val(task.title);
      $('#editTaskDescription').val(task.description);
      $('#editTaskDueDate').val(task.due_dates);
      $('#editTaskStatus').val(task.status);
      $('#editTaskID').val(task.taskID);
      $('#editTaskModal').modal('show');
    },
    error: function(xhr, status, error) {
      console.error('Error fetching task:', error);
      alert('Failed to fetch task details. Please try again.');
    }
  });
}

function deleteTask(taskID) {
  if (confirm('Are you sure you want to delete this task?')) {
    $.ajax({
      url: 'deleteTask.php',
      type: 'POST',
      data: { taskID: taskID },
      success: function(response) {
        alert('Task deleted successfully');
        $('#viewTaskModal').modal('hide');
        location.reload();
      },
      error: function(xhr, status, error) {
        console.error('Error deleting task:', error);
        alert('Failed to delete task. Please try again.');
      }
    });
  }
}
</script>

</body>
</html>



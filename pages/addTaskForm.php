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

<!-- Add Task Modal -->
<div id="addTaskModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content task-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Task</h4>
      </div>
      <div class="modal-body">
        <!-- Task Form -->
        <form id="addTaskForm">
          <div class="form-group">
            <label for="taskTitle">Title:</label>
            <input type="text" class="form-control" id="taskTitle" name="taskTitle" required>
          </div>
          <div class="form-group">
            <label for="taskDescription">Description:</label>
            <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="taskDueDate">Due Date:</label>
            <div class="input-group date" id="dueDatePicker">
              <input type="text" class="form-control" id="taskDueDate" name="taskDueDate" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD" required>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label>Status:</label><br>
            <input type="checkbox" id="taskStatus" name="taskStatus">
            <span id="statusLabel">Pending</span>
            <input type="hidden" id="taskStatusValue" name="taskStatusValue" value="0">
          </div>
          <button type="button" class="btn btn-primary" onclick="addTask()">Done</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Initialize date picker
  $('#dueDatePicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
  });

  // Toggle switch
  $('#taskStatus').change(function() {
    if ($(this).prop('checked')) {
      $('#statusLabel').text('Completed');
      $('#taskStatusValue').val('1');
    } else {
      $('#statusLabel').text('Pending');
      $('#taskStatusValue').val('0');
    }
  });
});

// Function to add task
function addTask() {
  // Collect form data
  var formData = $('#addTaskForm').serialize();

  // AJAX request to add task
  $.ajax({
    url: 'addTask.php',
    type: 'POST',
    data: formData,
    success: function(response) {
      // Handle success response
      console.log('Task added successfully.');
      $('#addTaskModal').modal('hide'); 
     
      location.reload(); 
    },
    error: function(xhr, status, error) {
      // Handle error
      console.error('Error adding task:', error);
      alert('Failed to add task. Please try again.');
    }
  });
}
</script>

</body>
</html>

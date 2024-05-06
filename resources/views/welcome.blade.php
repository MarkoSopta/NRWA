<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD TManagers</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
  <div class="container mt-5">
    <h2 class="mb-4">CRUD Table</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Location</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data rows will be dynamically generated here -->
      </tbody>
    </table>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add New</button>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add New Entry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form for adding new entry -->
          <form id="addForm">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="location">Location</label>
              <select class="form-control" id="location" name="location_id" required>
                <!-- Options will be dynamically generated here -->
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Entry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form for editing entry -->
          <form id="editForm">
            <input type="hidden" id="editId" name="editId">
            <div class="form-group">
              <label for="editName">Name</label>
              <input type="text" class="form-control" id="editName" name="name">
            </div>
            <div class="form-group">
              <label for="editLocation">Location</label>
              <select class="form-control" id="editLocation" name="location">
                <!-- Options will be dynamically generated here -->
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Your custom JavaScript for CRUD operations -->
  <script>
    $(document).ready(function() {
  // Function to fetch and display managers
  // Function to fetch and display managers
function fetchManagers() {
  $.ajax({
    url: '/api/v1/managers',
    type: 'GET',
    success: function(data) {
      var rows = '';
      $.each(data, function(index, manager) {
        var locationName = manager.location ? manager.location.name : ''; // Access nested location property
        rows += '<tr>' +
          '<td>' + manager.id + '</td>' +
          '<td>' + manager.name + '</td>' +
          '<td>' + locationName + '</td>' + // Display location name instead of location_id
          '<td>' +
          '<button class="btn btn-primary btn-sm mr-2 edit" data-id="' + manager.id + '">Edit</button>' +
          '<button class="btn btn-danger btn-sm delete" data-id="' + manager.id + '">Delete</button>' +
          '</td>' +
          '</tr>';
      });
      $('tbody').html(rows);
    }
  });
}

  // Fetch managers on page load
  fetchManagers();

  // Populate location dropdowns
  function populateLocationDropdowns() {
    $.ajax({
      url: '/api/v1/locations',
      type: 'GET',
      success: function(data) {
        var options = '';
        $.each(data, function(index, location) {
          options += '<option value="' + location.id + '">' + location.name + '</option>';
        });
        $('#location, #editLocation').html(options);
      }
    });
  }

  populateLocationDropdowns(); // Call the function to populate dropdowns on page load

  // Add Manager
  $('#addForm').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: '/api/v1/managers',
      type: 'POST',
      data: formData,
      success: function(data) {
        $('#addModal').modal('hide');
        fetchManagers();
      }
    });
  });

 // Edit Manager
$(document).on('click', '.edit', function() {
    var managerId = $(this).data('id');
    $.ajax({
        url: '/api/v1/managers/' + managerId,
        type: 'GET',
        success: function(manager) {
            $('#editId').val(manager.id);
            $('#editName').val(manager.name);
            $('#editLocation').val(manager.location.id); // Use location ID instead of location_id
            $('#editModal').modal('show');
        }
    });
});

$('#editForm').submit(function(e) {
    e.preventDefault();
    var managerId = $('#editId').val();
    var formData = $(this).serializeArray();

    // Set the correct name for the location parameter
    for (var i = 0; i < formData.length; i++) {
        if (formData[i].name === 'location') {
            formData[i].name = 'location_id';
            break; // Exit the loop once the name is changed
        }
    }

    // Iterate over formData and set empty values to the current values
    for (var i = 0; i < formData.length; i++) {
        if (formData[i].value.trim() === '') {
            if (formData[i].name === 'name') {
                formData[i].value = $('#editName').val();
            } else if (formData[i].name === 'location_id') {
                formData[i].value = $('#editLocation').val();
            }
        }
    }

    $.ajax({
        url: '/api/v1/managers/' + managerId,
        type: 'PUT',
        data: formData,
        success: function(data) {
            $('#editModal').modal('hide');
            fetchManagers();
        }
    });
});

  // Delete Manager
  $(document).on('click', '.delete', function() {
    var managerId = $(this).data('id');
    if (confirm("Are you sure you want to delete this manager?")) {
      $.ajax({
        url: '/api/v1/managers/' + managerId,
        type: 'DELETE',
        success: function(data) {
          fetchManagers();
        }
      });
    }
  });
});
  </script>
</body>
</html>

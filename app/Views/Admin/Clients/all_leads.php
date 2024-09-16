<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Leads</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>All Leads</h2>
        <div class="mb-3">
            <label for="dateRange">Filter by Date Range:</label>
            <input type="date" id="startDate" name="startDate">
            <input type="date" id="endDate" name="endDate">
            <button id="filterBtn" class="btn btn-primary">Filter</button>
        </div>
        <table class="table table-bordered" id="leadsTable">
            <thead>
                <tr>
                    <th>SH_Status</th>
                    <th>Status</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Source</th>
                    <th>Medium</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($leads)): ?>
                    <tr>
                        <td colspan="8">No leads found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?= esc($lead['sh_status']) ?></td>
                            <td><?= esc($lead['status']) ?></td>
                            <td><?= esc($lead['first_name'] ?? '') ?></td>
                            <td><?= esc($lead['last_name'] ?? '') ?></td>
                            <td><?= esc($lead['email_address']) ?></td>
                            <td><?= esc($lead['caller_phone']) ?></td>
                            <td><?= esc($lead['source']) ?></td>
                            <td><?= esc($lead['medium']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#leadsTable').DataTable();

            $('#filterBtn').click(function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                
                
                $.ajax({
                    url: window.location.pathname,
                    type: 'GET',
                    data: {
                        start: startDate,
                        end: endDate
                    },
                    success: function(response) {
                        $('#leadsTable tbody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>

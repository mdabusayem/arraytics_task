<!DOCTYPE html>
<html>
<head>
    <title>Submission Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
<a class="mt-5" href="/arraytics2/public/"><button type="button" class="btn btn-primary"> Go to Form Page</button></a>
        <h1 >Submission Report</h1>

        <form  class="filter" >
            <div class="form-row">
                <div class="col-md-3">
                    <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="userId" name="userId" placeholder="User ID">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </div>
        </form>

        <table class="table mt-4" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Buyer</th>
                    <th>Receipt ID</th>
                    <th>Items</th>
                    <th>Buyer Email</th>
                    <th>Note</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Entry Date</th>
                    <th>Entry By</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <script src="../public/js/script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
    $.ajax({
            url: "/arraytics2/public/index.php?action=fetch", 
            type: "get",
        
            success: function(data) {
                var response = JSON.parse(data);
            tr ='';
            for (var i = 0; i < response.length; i++) {
                tr +=
                    "<tr><td>" + response[i].id + "</td><td>"  + response[i].amount + "</td><td>" + response[i].buyer + "</td>" +
                    "<td>" + response[i].receipt_id + "</td><td>" + response[i].items + "</td>" +
                    "<td>" + response[i].buyer_email + "</td><td>" +response[i].note+ "</td>" +
                    "<td>" + response[i].city + "</td><td>" + response[i].phone + "</td>" +
                    "<td>" + response[i].entry_at + "</td><td>" + response[i].entry_by + "</td>" +
                    "</tr>";
            }
            $('tbody').html(tr);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    $("form").on("submit", function(e) {
        e.preventDefault();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var userId = $("#userId").val();
        $.ajax({
            url: "/arraytics2/public/index.php?action=filter",
            type: "POST",
            data: {
                startDate: startDate,
                endDate: endDate,
                userId: userId
            },
            success: function(data) {
                var response = JSON.parse(data);
            tr ='';
            for (var i = 0; i < response.length; i++) {
                tr +=
                    "<tr><td>" + response[i].id + "</td><td>"  + response[i].amount + "</td><td>" + response[i].buyer + "</td>" +
                    "<td>" + response[i].receipt_id + "</td><td>" + response[i].items + "</td>" +
                    "<td>" + response[i].buyer_email + "</td><td>" +response[i].note+ "</td>" +
                    "<td>" + response[i].city + "</td><td>" + response[i].phone + "</td>" +
                    "<td>" + response[i].entry_at + "</td><td>" + response[i].entry_by + "</td>" +
                    "</tr>";
            }
            $('tbody').html(tr);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    });
});
    </script>
</body>
</html>
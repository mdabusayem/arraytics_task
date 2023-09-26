
    
    <!DOCTYPE html>
<html>
<head>
    <title>Submission Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
    <a href="/arraytics2/public/index.php?action=report"><button type="button" class="btn btn-primary">Go to Report Page</button></a>
        <h1 >Submission Form</h1>

        <form id="submissionForm" action="#" method="post">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="amount">Amount:</label>
                    <input type="number" class="form-control" id="amount" name="amount">
                    <span class="error" id="amount-error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="buyer">Buyer:</label>
                    <input type="text" class="form-control" id="buyer" name="buyer" maxlength="20">
                    <span class="error" id="buyer-error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="receipt_id">Receipt ID:</label>
                    <input type="text" class="form-control" id="receipt_id" name="receipt_id" maxlength="20" >
                    <span class="error" id="receipt_id-error"></span>
                </div>
                <div class="form-group col-md-6" id="itemsContainer">
                    <label for="items">Items:</label><button type="button" class="btn btn-primary" id="addItem">Add Item</button><br>
                    <input type="text" class="form-control" id="items" name="items[]">
                    <span class="error" id="items-error"></span>  
                </div>
                <div class="form-group col-md-6">
                    <label for="buyer_email">Buyer Email:</label>
                    <input type="email" class="form-control" id="buyer_email" name="buyer_email" maxlength="50" >
                    <span class="error" id="buyer_email-error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="note">Note:</label>
                    <textarea class="form-control" id="note" name="note" maxlength="255"></textarea>
                    <span class="error" id="note-error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" maxlength="20">
                    <span class="error" id="city-error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone:</label>
                    <input type="number" class="form-control" id="phone" name="phone" maxlength="20">
                    <span class="error" id="phone-error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="entry_by">Entry By:</label>
                    <input type="number" class="form-control" id="entry_by" name="entry_by">
                    <span class="error" id="entry_by-error"></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
                $(document).ready(function() {
                    $('#addItem').click(function() {
                        $('#itemsContainer').append('<input type="text" class="form-control"  name="items[]"><br>');
                    });
        });
    </script>
   
    <script src="../public/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>


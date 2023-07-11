<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        .card {
            margin: 0 4px;
            margin-top: 50px;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">QR Code Generator</h5>
                        <form method="post" action="" id="qr-form">
                            <div class="form-group">
                                <label for="text">Your Text</label>
                                <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Generate QR Code</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div id="qr-code-result" class=" text-center bg-info">QR code result will appear here</div>
                        <div id="qr-code-image"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Handle form submission
        $('#qr-form').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            // Get the form data
            var formData = $(this).serialize();

            // Send an AJAX request to the server
            $.ajax({
                type: 'POST',
                url: 'generate_qr.php', // Replace with the actual PHP script for generating QR code
                data: formData,
                success: function(response) {
                    // Update the result section with the response
                    $('#qr-code-result').text(response.result);
                    $('#qr-code-image').html(response.qrImage);
                },
                error: function() {
                    // Handle error
                    alert('An error occurred while generating the QR code.');
                }
            });
        });
    });
</script>

    
</body>
</html>

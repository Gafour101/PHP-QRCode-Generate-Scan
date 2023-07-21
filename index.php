<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="header"><h1><b>QR Code Generator</b> </h1></div>
        <div class="form">
            <form method="post" action="" id="qr-form">
                <div class="form-group">
                    <div class="text-content">
                        <label for="text" class=" mt-2">Content</label>
                    </div>
                    <textarea class="form-control " id="text" name="text" cols="" rows="4" required placeholder="Enter your text to generate QR Code"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-1 form-control" disabled>Generate QR Code</button>
            </form>
        </div>

        <!-- SHOWS QR CODE RESULT -->
        <div class=" mt-3 results qr-code">
                <div class="qr-image" id="qr-code-image" class="p-3 qrcode"></div>
        </div>
        <!-- END OF RESULT -->
    </div>
    <!-- END OF WRAPPER -->
    
    <script src="assets/js/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
            // Function to enable or disable the button
            function toggleButton() {
                var inputVal = $('#text').val();
                if (inputVal.trim() === '') {
                    // Input field is empty, disable the button
                    $('#qr-form button').prop('disabled', true);
                } else {
                    // Input field has a value, enable the button
                    $('#qr-form button').prop('disabled', false);
                }
            }

            // Handle input field change event
            $('#text').on('input', function() {
                toggleButton();

                // Check if input is blank and remove the 'active' class from the wrapper
                if ($(this).val().trim() === '') {
                    $('.wrapper').removeClass('active');
                }
            });
  
            // Handle form submission
            $('#qr-form').submit(function(event) {
                event.preventDefault(); // Prevent form submission
                
                // Change button text and disable the button
                var buttonText = $('#qr-form button').text();
                $('#qr-form button').text('Generating QR Code...').prop('disabled', true);

                // Send an AJAX request to the server
                $.ajax({
                    type: 'POST',
                    url: 'generate_qr.php', // Replace with the actual PHP script for generating QR code
                    data: $(this).serialize(),
                    success: function(response) {
                        // Update the QR code image with the response
                        $('#qr-code-image').html(response.qrImage);
                    },
                    error: function() {
                        // Handle error
                        alert('An error occurred while generating the QR code.');
                    },
                    complete: function() {
                        // Restore button text and enable the button
                        $('#qr-form button').text(buttonText).prop('disabled', false);
                    },
                });
            });
        });
    </script>
    
    <script src="assets/js/script.js"></script>
</body>
</html>

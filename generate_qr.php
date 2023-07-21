<?php
    // generate_qr.php

    // Include the necessary QR code library
    require_once 'vendor/autoload.php';

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    // Get the form data
    $text = $_POST['text'];

    // Replace line breaks with a space or a special symbol
    $text = str_replace(PHP_EOL, ' ', $text);

    // Create QR code options object
    $qrOptions = new QROptions([
        'version'      => 5,       // QR code version (size)
        'outputType'   => QRCode::OUTPUT_IMAGE_PNG,  // Output format
        'eccLevel'     => QRCode::ECC_L, // Error correction level (L, M, Q, H)
        'scale'        => 5,      // Adjust the size of the QR code
        'moduleValues' => [
            // Adjust the color of the QR code (RGB values)
            'dark' => [0, 0, 0],
            'light' => [255, 255, 255],
        ],
        'addQuietzone' => false,   // Include quiet zone
        'cachefile'    => __DIR__.'/qr-cache', // Cache file path (optional)
    ]);

    // Create QR code instance
    $qrcode = new QRCode($qrOptions);

    // Set the path and filename for the QR code image
    $path = "qr-code-images/";
    $qrImagePath = $path.$text.".png";

    // Generate the QR code
    $qrcode->render($text, $qrImagePath);

    // Prepare the response
    $response = array(
        'result' => 'QR code generated successfully!',
        'qrImage' => '<img src="'.$qrImagePath.'" alt="QR Code">',
    );

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    
?>

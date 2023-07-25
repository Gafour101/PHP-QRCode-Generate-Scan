<?php
    
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ... rest of the code
    // Include the necessary QR code library
    require_once 'vendor/autoload.php';

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    try {

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

        $qrcode = (new QRCode($qrOptions))->render($_POST['text']);

        $qrcode = '<img src="'.$qrcode.'" />';

        send_response(['qrcode' => $qrcode]);
    } catch (\Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
	    send_response(['error' => $e->getMessage()]);
    }

    /**
     * @param array $response
     */
    function send_response(array $response){
        header('Content-type: application/json;charset=utf-8;');
        echo json_encode($response);
        exit;
    }

?>

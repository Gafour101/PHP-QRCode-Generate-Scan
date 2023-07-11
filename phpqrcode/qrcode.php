<?php
    require_once 'qrlib.php';
    $path = 'images/';
    $qrcode = $path.time().".png";
    QRcode:: png("Gafour",$qrcode,'H',4,4);

    echo "<img src='".$qrcode."'>";
?>
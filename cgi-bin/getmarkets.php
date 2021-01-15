<?php

if ($_GET["auth"] != "fd4cbecc-f3a6-4fba-9853-f8e94bb1e8f7") {
    http_response_code(401);
    echo 'You are not authorised!';
} else {
    try {
        $marketfile = fopen("../marketData.json", "r") or die("Unable to open file!");
        fclose($myfile);
        echo fread($marketfile, filesize("../marketData.json"));
    } catch (Exception $e) {
        http_response_code(500);
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

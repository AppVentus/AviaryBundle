<?php
    $image_data = file_get_contents($_REQUEST['url']);
    $img_url = $_REQUEST['filename'];
    file_put_contents($img_url, $image_data);
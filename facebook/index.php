<?php
header('Content-Type: application/json');

function getInfo($source, $url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://masgimenz.my.id/'.$source.'/?url=' . $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $result;
}

if (isset($_GET['url']) && $_GET['url'] !== '') {
    $t = json_decode(getInfo('tiktok', $_GET['url']));
    if ($t->status_code > 0) {
        $r->status = false;
        $r->msg = $t->status_msg;
        echo json_encode($r);
    } else {
        $r['status'] = true;
        $r['data'] = $t->aweme_details;
        echo json_encode($r);
    }
} else {
    $r->status = false;
    $r->msg = 'Url required!';
    echo json_encode($r);
}
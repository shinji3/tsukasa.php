<?php
$url_scheme = parse_url($_GET["ref"], PHP_URL_SCHEME);
if (is_null($url_scheme)) die;
$url = substr_replace($_GET["ref"], "mmsh", 0, strlen($url_scheme));
$ref = urlencode($url);
$xml_string = shell_exec("ffprobe -loglevel quiet -show_streams -print_format xml -i " . escapeshellarg($url));
$xml = simplexml_load_string($xml_string);
$start_pts = (int)$xml->xpath("//stream/@start_time")[0]->start_time;
if ($start_pts === 0) die;
$start_time = time() - $start_pts - 10;
echo "http://mudai.moe.hm/kagamin/tsukasa.php?start_time=${start_time}&ref=${ref}";

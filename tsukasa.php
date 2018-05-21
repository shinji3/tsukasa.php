<?php
header("Content-Type: video/x-ms-asf");
header("Cache-Control: no-cache");
date_default_timezone_set("UTC");
$start_time = isset($_GET["start_time"]) ? (time() - (int)$_GET["start_time"]) : 0;
?><ASX version="3.0">
<Entry>
<StartTime Value="<?php echo (string)floor($start_time / 3600) . date(":i:s", $start_time); ?>" />
<Ref href="<?php echo isset($_GET["ref"]) ? htmlspecialchars($_GET["ref"], ENT_QUOTES) : ""; ?>" />
</Entry>
</ASX>

<?php
header("Content-Type: video/x-ms-asf");
date_default_timezone_set("UTC");
?><ASX version="3.0">
<Entry>
<StartTime Value="<?php echo date("H:i:s", isset($_GET["start_time"]) ? (time() - (int)$_GET["start_time"]) : 0); ?>" />
<Ref href="<?php echo isset($_GET["ref"]) ? htmlspecialchars($_GET["ref"], ENT_QUOTES) : ""; ?>" />
</Entry>
</ASX>

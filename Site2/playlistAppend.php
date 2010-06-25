<?php
header("Cache-Control: no-cache");
echo "<li id=";
echo $_GET['song_id'];
echo "><label>";
echo $_GET['song_id'];
echo "</label><em>";
echo "<a href='javascript:loadContent(\"";
echo $_GET['song_id'];
echo ".php\")'>i</a></em></li>";
?>

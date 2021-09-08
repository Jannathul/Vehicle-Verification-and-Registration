<?php
$CurrentTime = new DateTime();  
$CurrentTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
$DateTime = $CurrentTime->format("Y-m-d H:i:s");  
echo $DateTime;

echo date("Y-m-d");
?>

<?php
session_start();
session_unset();
session_destroy();
header('location: ../any_one_can_access/index.php');
?>

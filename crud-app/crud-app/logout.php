<?php
session_start();
session_destroy();
header("Location: /crud-app/pages/home.php");
exit();

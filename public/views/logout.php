<?php
session_start();
session_unset(); // unset session to log out then redirect to index
session_destroy();
header("Location: /querymate/index.php"); // redirect to index
exit;
<?php
session_start();
unset($_SESSION['Emp_id']);
unset($_SESSION['UserId']);
session_destroy();
header('Location:EmpLogin.php');
 ?>

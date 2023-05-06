<?php

  include '../config/connection.php';
  
  session_start();
  session_unset();
  session_destroy();
  
  echo '<script type="text/javascript">
          alert("You have successfully logged out!");
          window.location.replace("../");
        </script>';

?>
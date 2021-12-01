<?php
   session_start();

   if(session_destroy()) {

      
return redirect()->to('login')->send();
   }
?>

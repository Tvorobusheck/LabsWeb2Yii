<?php 
  
// Use ls command to shell_exec 
// function 
$output = shell_exec('./vendor/bin/codecept run --steps'); 
  
// Display the list of all file 
// and directory 
file_put_contents('output.txt', $output); 
?>

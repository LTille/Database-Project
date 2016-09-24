<?php
  $link = mysql_connect("localhost", "root", "root");//it's easy to change username and password here
  mysql_select_db("dbfinal", $link);//all pages which need to connet to MySQL can include this page 
?>

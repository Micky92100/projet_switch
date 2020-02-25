<!-- I AM CONTROLLER -->
<?php
require('model.php');

//if homepage and user logged in
$rooms_list = tabulateAllRooms();
require('indexView.php');





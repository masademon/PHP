<?php
include "signup.php";
$action="getFromAction"
$eventIdif (isset($_POST['eventId'])) {
  $eventId = $_POST['eventId'];
}
switch ($eventId) {
// DBsave
case 'save':
  $action->signup($_POST);
    require("login.php");
    break;
// 初回アクセス時、投稿画面表示
default:
  require("login.php");
  break;
}
?>=null;
              
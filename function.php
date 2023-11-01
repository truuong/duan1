<?php 
   $host = "localhost";
   $user = "root";
   $password = "mysql";
   $db = "du-an-mau";
   $conn = null;
   try {
       $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$password);
   } catch (PDOException $e) {
       echo $e->getMessage();
   }
   function action($sql){
    global $conn;
    $conn->exec($sql);
   }
   function selectDb($sql){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
   }
   function total($sql){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
   }
?>
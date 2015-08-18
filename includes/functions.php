<?php
require_once "config.php";
// SET SERVER TIMEZONE
date_default_timezone_set(servertimezone);
//Create Connection
$db=mysqli_connect(server, dbusername, dbpassword, dbname);
if (!$db){
   die ("Connection Failed: " . mysqli_connect_error());
}

$ret="";
function fetchusername($qry){
    global $db;
    global $ret;
    $result=mysqli_query($db, $qry);
    while ($row=mysqli_fetch_assoc($result)){
        $ret=$row["fname"]." ".$row["lname"];
    }
    return $ret;
}

//fetch ques and answers
function getquesanswer($qry){
    global $db;
    $result = mysqli_query($db, $qry);
    $ret=array();
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $ret[$row["ques"]]=$row["ans"];
        }
        return $ret;
    } else {
        return false;
    }

    mysqli_close($db);
}

 // FUNCTION TO LOGIN USER
function getdata($qry){
    global $db;
    $result = mysqli_query($db, $qry);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $ret=array($row["pwd_hash"]=>$row["pwd_salt"]);
        }
        return $ret;
    } else {
        return false;
    }

    mysqli_close($db);
}

//Function to redirect pages. URL should be an absolute URL.
function redirect($url){
    header("location:".$url);
    exit();
}

//function to get Client IP
// function getclientip(){
//     if (!empty($_SERVER['HTTP_CLIENT_IP'])){
//         $ip=$_SERVER['HTTP_CLIENT_IP'];
//     }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
//         $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
//     }else{
//         $ip=$_SERVER['REMOTE_ADDR'];
//     }
//     return $ip;
// }

//Generate random sting
function generaterandom($length=20){
    $allowed_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $i=0;
    $ret="";
    for ($i; $i<$length; $i++){
        $ret.=substr($allowed_characters,rand(0,strlen($allowed_characters)-1) ,1);
    }
    return $ret;
}

//Execute Query
function executequery($query){
    global $db;
    if(mysqli_query($db, $query)){
        return true;
    }else{
        $error[]=(mysqli_error($db));
        return false;
    }
}
// COUNT RESULTSET
function countresults($query){
    global $db;
    $result=mysqli_query($db, $query);
    if ($result){
        return mysqli_num_rows($result);
    }  
}

//Purify String
function purify($text){
    $text=stripcslashes($text);
    $text=htmlspecialchars($text);
    return $text;
}

//Validate String
function validatestring($text){
    if (preg_match("/^[a-zA-Z0-9]*$/",$text)) {
        return true;
    }else{
        return false;
    }
}

//Validate EMail Address
function validateemail($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else{
        return false;
    }
}

//Validate URL Address
function validateurl($website){
    if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
        return true;
    }else{
        return false;
    }
}

//Generates and fills up a HTML select field
function generatetimezonelist(){
	$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
  foreach ($tzlist as $key => $value) {
   if ($value!="Asia/Kolkata"){
      echo "<option value=$value>$value</option>";
  }else{
      echo "<option value=$value selected=selected>$value</option>";
  }
}
}

// VERIFY IF CONTROL HAS ERROR
function controlhaserror($controlid){
    global $errorcontrol;
    if (in_array($controlid, $errorcontrol)) {
        echo "has-error";
    }
}

// PRINT ERROR ARRAY
function print_errors(){
    global $error;
    foreach ($error as $key => $value){
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error! </strong>'.$value.'</div>';
    }
}

// PRINT SUCCESS ARRAY
function print_success(){
    global $success;
    foreach ($success as $key => $value){
        echo '<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success! </strong>'.$value.'</div>';
    }
}

// PRINT SIGN IN CONTROLS
function print_sign($controlid){
    global $errorcontrol;
    if (in_array($controlid, $errorcontrol)) {
        if ($_POST) {
            echo '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
        }        
    }else{
     if ($_POST){
        echo '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';                   
    }

}
}

// FUNCTION TO VALIDATE USERNAMES
function validateusername($username) 
{
    return preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/',$username);
}

?>

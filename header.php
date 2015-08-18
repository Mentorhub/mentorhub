
<?php require_once "includes/functions.php"; ?>
<!-- LOGIC -->


<?php 
if (isset($_SESSION["loggedin"])!==true){
 if (isset($_POST["login"])){
   $qry="select pwd_hash, pwd_salt from tblusers where uname="."'".$_POST["uname"]."'";
   if (!getdata($qry)){
    //echo 'Sorry! the user '.$_POST["uname"].' was not found on our servers.<br>Kindly recheck.';
   }else{
     $data=getdata($qry);
     reset($data);
     $a=key($data);
     $b=current($data);
     $c=$b.$_POST["password"].$b;
     if (md5($c)===$a){
      $qry="select fname, lname from tblusers where uname="."'".$_POST["uname"]."'";
      session_start();
      $_SESSION["userfullname"]=fetchusername($qry);
      $_SESSION["loggedinuser"]=$_POST["uname"];
      $_SESSION["loggedin"]=true;
    }else{
    //echo "password was incorrect";
    }
  }
}else{
 session_start();
}
}
?>


<?php

$uname=$password=$email=$fname=$lname="";
if(isset($_POST['submit']) && $_POST['submit']!=""){
 $uname=purify($_POST['uname']);
 $password=purify($_POST['pwd_hash']);
 $email=purify($_POST['email']);
 $fname=purify($_POST['fname']);
 $lname=purify($_POST['lname']);
 $re=purify($_POST['re_pwd_hash']);
 if (strlen($uname) < 6){
  $error[]="User Name must be 6 characters long.<br>";
}
if (strlen($password) < 8){
  $error[]="Password must be atleast 8 characters long.<br>";
}
if ($password!==$re){
  $error[]="Your both passwords did not match!<br>";
}
if (strlen($email)===0){
  $error[]="Providing EMail Address is mandatory.<br>";
}
if (!validatestring($uname)){
  $error[]="User Name has illegal characters.<br>";
}
if (!validateemail($email)){
  $error[]="Email Address is in invalid form.<br>";
}
if (count($error)!==0){
 print_errors($error);
}else{
  $salt=generaterandom();
  $password=$salt.$password.$salt;
  $password=md5($password);
  $token=generaterandom(12);
  $qry="insert into tblusers (uname, pwd_hash, pwd_salt, email, fname, lname, token, status)
  values ('$uname', '$password', '$salt', '$email', '$fname', '$lname', '$token', 'inactive')";
  $verify=executequery($qry);
  echo "successfully";
  redirect('activateaccount.php');
        /*if ($verify){

          mail($vemail, "Activate Account on Attrix Technologies Website" ,"Congratulations Mr./ Mrs. <strong>$vfirstname $vlastname</strong>. You have successfully registered your account with Attrix Technologies.
                  Kindly <a href='www.attrixtech.com/manish/activateaccount.php/?activatekey='.$token>click here</a> to cativate your account.");
}*/
}
$error_message="";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css" media="screen" charset="utf-8">
  <link rel="stylesheet" href="css/custom.css" media="screen" charset="utf-8">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <title>Mentorhub</title>
</head>
<body>
  <div class="container" style="margin-top:20px;">
   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="images/Picture7.png" alt="MenTorhub" width="160px" height="50px"></a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav">
          <li <?php if($_SERVER['PHP_SELF']==="/phphelp/index.php"){ echo "class=active";} ?>><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
          <li <?php if($_SERVER['PHP_SELF']==="/phphelp/aboutus.php"){ echo "class=active";} ?>><a href="aboutus.php">About Us<span class="sr-only">(current)</span></a></li>
          <li <?php if($_SERVER['PHP_SELF']==="#"){ echo 'class="active"';} ?> class="dropdown">

          </li>
        </ul>
        
        <form class="navbar-form navbar-right" method="post">
          <div class="form-group">
            <?php 
            if (isset($_SESSION["loggedin"])) {
             echo '<input type="text" class="form-control" placeholder="Search"> ';
             echo '<button type="submit" class="btn btn-default">Search</button> ';
             echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.ucwords($_SESSION["userfullname"]).'<span class="caret"></span></a>
             <ul class="dropdown-menu" role="menu">
               <li><a href="logout.php">Logout</a></li>
               <li><a href="#">Profile</a></li>
               <li><a href="#">Messages</a></li>
               <li class="divider"></li>
               <li><a href="#">Separated link</a></li>
               <li class="divider"></li>
               <li><a href="#">One more separated link</a></li>
             </ul>';   
           }else{
            echo '<input type="text" name="uname" placeholder="Username" class="form-control"> ';
            echo '<input type="password" name="password" placeholder="Password" class="form-control"> ';
            echo '<button type="submit" name="login" class="btn btn-default">Log in</button> ';
            echo '<a type="submit" name="signup" class="btn btn-default" href="signup.php">Sign up</a>';
          }?>

        </form>
      </div>
    </div>
  </nav>

</div>




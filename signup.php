<?php require_once "header.php" ?>


<div class="container">
<div class="col-md-6 col-md-offset-3 myform">
<h3>Register Form</h3>
  <form method="post">
    <div class="content">
      <p>All * fields are mandatory.</p>
    </div>
    <div class="form-group">
      <label for="Username">Username*</label>
      <input type="text" name="uname" class="form-control" placeholder="username" value="<?php if (isset($_POST["uname"])){echo $_POST["uname"];}?>" >
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password*</label>
      <input type="password" name="pwd_hash" class="form-control" id="exampleInputPassword1" placeholder="password" >
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Re-Password*</label>
      <input type="password" name="re_pwd_hash" class="form-control" id="exampleInputPassword1" placeholder="re-password">
    </div>
    <div class="form-group">
      <label for="Firstname">Firstname</label>
      <input type="text" name="fname" class="form-control" placeholder="firstname" value=<?php echo $fname; ?>>
    </div>
    <div class="form-group">
      <label for="Lastname">Lastname</label>
      <input type="text" name="lname" class="form-control" placeholder="lastname" value=<?php echo $lname; ?>>
    </div>


    <div class="form-group">
      <label for="exampleInputEmail1">Email address*</label>
      <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="email" 
      value=<?php echo $email; ?>>
    </div>
    <div class="g-recaptcha" data-sitekey="6LcxRwkTAAAAAAhr1CmSgi304JPTWvvkCJNCqk2U"></div>
    <br/>
    <div class="checkbox">
      <label><input type="checkbox" value="">I agree to terms and conditions of CopyCat Pvt. Ltd.</label>
    </div>

    <div class="checkbox">
      <label><input type="checkbox" value="1" checked>I like to subscribe to Email Newsletter of CopyCat.</label>
    </div>
    <button type="submit" name="submit" value="a" class="btn btn-default">Submit</button>
  </form></div></div>





  <?php require_once "footer.php" ?>
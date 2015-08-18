<?php require "header.php";?>


<?php
if (isset($_GET["submit"])){
	$activateid=$_GET['activateid'];
	$emailid=$_GET['emailid'];
	if (isset($_GET['emailid']) AND strlen($emailid)<10){
		echo "emailid not provided";
	}
	$newstatus="active";
	$q="select email from tblusers where email='$emailid' and status='active'";
	// echo countresults($q);
	if(countresults($q)>0){
		echo "account is already activated.";
	}else{
		$r="select email from tblusers where email='$emailid' AND token='$activateid' AND status='inactive'";
		// echo $r;
		echo "valid:".countresults($r);
		if (countresults($r)>0){
		$qry="update tblusers set status='$newstatus' where email='$emailid'";
		// echo $qry;
		echo "users updated";
		if (executequery($qry)){
			echo "account verified successfully";
			header("refresh:3;url:index.php");
		}else{
			echo "unable to save status";
		}
	}else{
		echo "invalid activation id detected";
	}
}
}
?>

<p>Activate Account</p>
<div class="form">
	<form method="GET">
		<p>Please enter activation code:</p><br>
		<input type="text" name="activateid" <?php if(isset($_GET["activateid"])){echo "value=$_GET[activateid]";} ?>>
		<input type="submit" name="submit" value="Submit">
		<input type="hidden" name="emailid" <?php if(isset($_GET["emailid"])){echo "value=$_GET[emailid]";} ?>>
	</form>
</div>




<?php require "footer.php";?>
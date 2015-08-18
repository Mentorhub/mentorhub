<?php require_once "includes/functions.php" ?>
<?php require_once "header.php" ?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/page.css">
	<link rel="stylesheet" href="css/bootstrap.css" media="screen" charset="utf-8">
</script> 
</head>
<body>
	<?php
	$qry="select ques, ans from ques_ans order by ques";
	$abc=getquesanswer($qry);
	if (isset($_GET["page"])){
		$p=$_GET["page"];
	}else{
		$p=1;
	}
	vijay($p);
	pagination(count($abc));

	function pagination($n){
		global $p;
		$nop=($n/10)+1;
		$l=1;
		echo "<div class=container><nav><ul class=pagination><li class=disabled><a href=# aria-label=Previous>Previous</a></li>";
		for ($l; $l<$nop; $l++){
			echo "<li ><a href=pages.php?page=$l>$l</a></li>";
		}
		echo "<li><a href=# aria-label=Next>Next</a></li></ul></nav></div>";
	}
	function vijay($p){
		$last=($p*10)-1;
		$first=($p*10)-10;
		$x=1;
		global $abc;
		foreach ($abc as $key => $value) {
			if ($x>=$first AND $x <=$last){
				if (isset($_SESSION["loggedin"])) {
					echo "<div class=sec_container><div class=mybox><div class=question><h4>".ucfirst($key)."</h4></div>
					<div id=DIV_1>
						<h4 id=H2_2>
							Manish Saraswat
						</h4>
						<div id=DIV_3>
							<samp>".ucfirst($value)."</samp>
						</div><br id=BR_14 />
						<form method=POST>
							<input type=button name=like value=Like id=$x class=A_15>
							<input type=button name=comment value=Comment class=A_15>  
							<input type=button name=delete value=Delete class=A_15></form>
						</div></div></div>";
					}else{
						echo "<div class=sec_container><div class=mybox><div class=question><h4>".ucfirst($key)."</h4></div>
						<div id=DIV_1>
							<h4 id=H2_2>
								Manish Saraswat
							</h4>
							<div id=DIV_3>
								<samp>".ucfirst($value)."</samp>
							</div><br id=BR_14 />
							if (isset($_POST[comment])) {
								echo <form><textarea row=10 col=80></textarea>
								<input type=submit name=submit value=submit></form>;
							}
							<form method=POST>
							<input type=button name=like value=Like class=A_15>
							<input type=button name=comment value=Comment class=A_15></form>
						</div></div></div>";
					}
				}
				$x++;
			}	
		}
		?>

		<?php require_once "footer.php" ?>
	</body>
	</html>

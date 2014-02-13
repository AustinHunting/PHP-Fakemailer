<!doctype html>
<html lang="de">
<header>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
</header>
<body>
<form action="" method="post">
<table border="0">
<tbody>
<tr>
<td>Empfänger (Mail) :</td>
<td><input name="to" type="text" size="90" value="<?php echo htmlspecialchars($_POST['to']); ?>"/></td>
</tr>
<tr>
<td>Von (Mail) :</td>
<td><input name="from" type="text" size="90" value="<?php echo htmlspecialchars($_POST['from']); ?>"/></td>
</tr>
<tr>
<td>Von (Name) :</td>
<td><input name="name" type="text" size="90" value="<?php echo htmlspecialchars($_POST['name']); ?>"/></td>
</tr>
<tr>
<td>Betreff :</td>
<td><input name="subject" type="text" size="90" value="<?php echo htmlspecialchars($_POST['subject']); ?>"/></td>
</tr>
<tr>
<td>Nachricht :</td>
<td><textarea cols="70" rows="10" name="message"><?php echo htmlspecialchars($_POST['message']); ?></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Send" /></td>
</tr>
</tbody></table>
</body>
</form>
<?php
if ($_POST['message'] != "") {
	$to = $_POST['to'];
	$from = $_POST['from'];
	$name = $_POST['name'];
	$absender = $name.' <'.$from.'>';
	$headers .= 'From:' . $absender . "\n";
	$headers .= 'Reply-To:' . $from . "\n";
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	 
	$ret=mail($to, stripslashes($subject), stripslashes($message), $headers);

	$handle = fopen("mails.log", a);
	fwrite($handle,date('c').", to:".htmlspecialchars($to).", from:".htmlspecialchars($from).", subject:".htmlspecialchars($subject).".\n");
	fclose ($handle);
}

if ($ret==true) {
	echo "<br /> Mail sent Successfully";
	} else {
	echo "<br /> Unable to Send mail";
}
?>
</html>

<!DOCTYPE html>

<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Federation Status</title>

<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>

<link href="assets/css/stylesheet.css" rel="stylesheet" type="text/css" />

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript" src="federation.js"></script>
</head>
<body>
	<div style="padding-left: 8px">
		<h3 style="text-align: center">Federation Status</h3>
		<p></p>
		<center><table id="teams">
			<tr>
				<th style="padding: 1%">Long Name</th>
                <th style="padding: 1%">Short Name</th>
				<th style="padding: 1%">Status</th>
			</tr>
		</table></center>
		<p>
			<center>Status of Master List AJAX call: <span id="masterStatus"> ... </span></center>
		</p>
	</div>
</body>
</html>

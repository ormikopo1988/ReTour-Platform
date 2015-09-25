<html lang="el" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<title>Καλώς ήρθατε στο ReTour!</title>
	<link media="all" type="text/css" href="http://www.inf.uth.gr/cced/wp-admin/css/wp-admin.min.css?ver=3.5.1" id="wp-admin-css" rel="stylesheet">
	<link media="all" type="text/css" href="http://www.inf.uth.gr/cced/wp-includes/css/buttons.min.css?ver=3.5.1" id="buttons-css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<style>	
		#login {
			background: none repeat scroll 0 0 #FFFFFF;
			border: 2px solid #E5E5E5;
			box-shadow: 1px 4px 10px -1px rgba(200, 200, 200, 0.7);
			font-weight: normal;
			margin-top: 130px;
			padding: 29px 24px 46px;
		}
		
		#login,
		#login label {
			color:#454545;
		}
		
		html {
			background: grey url(images/bg_blue.jpg) center center fixed no-repeat;
			background-size: 100% 100%;
		}
		
		body.login {
			background:transparent !important;
		}
		
		.login #login a {
			color:black !important;
		}

		.login #login a:hover {
			color:#3333CC !important;
		}


		#login #nav,
		#login #backtoblog {
			text-shadow:0 1px 4px #000;
		}
		
		.login #nav a, .login #backtoblog a {
			color: black !important;
		}
	</style>
	<meta content="noindex,nofollow" name="robots">
	<script>
		function Members(username,password) {

			var errors = '';

			var username = $("#loginform [name='username']").val();
			if (username == "") {
				errors += '- Παρακαλώ εισάγετε το όνομα χρήστη σας\n';
			}

			var password = $("#loginform [name='password']").val();
			if (password == "") {
				errors += '- Παρακαλώ εισάγετε το συνθηματικό σας\n';
			}

			if (errors) {
				errors = 'Διαπιστώθηκαν τα παρακάτω σφάλματα: \n' + errors;
				alert(errors);
				return false;
			}
			
			/*else {
				var url = "Members.php?username=" +username;

				$.ajax({
					url: url,
					type: "POST",
					dataType: 'json',
					success: function(){}
				});
			}*/	
		}
	</script>
</head>
<body class="login login-action-login wp-core-ui">
	<div id="login" align='center'><br><br>
	<form method="post" action="members.php" id="loginform" name="loginform">
		<p>
			<label for="user_login">Όνομα χρήστη<br>
			<input type="text" size="20" value="" class="input" id="user_login" name="username" autocomplete="on"/></label>
		</p>
		<p>
			<label for="user_pass">Email<br>
			<input type="text" size="20" value="" class="input" id="user_pass" name="password" autocomplete="on"/></label>
		</p>
		<p class="submit">
		<center><input type="submit" onclick="Members(username.value,password.value)" value="Σύνδεση" class="button button-primary button-large" id="wp-submit" name="wp-submit"></input></center>
		</p>
	</form>

	</div>

<p align='center' id="nav" style="font-size:13pt">
<a href="http://83.212.107.26/wp-login.php?action=register">Εγγραφή</a>
</p>
</body>
</html>
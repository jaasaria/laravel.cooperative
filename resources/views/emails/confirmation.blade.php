<!DOCTYPE html>
<html>
<head>
	<title>Iloilo Finest</title>
</head>
<body>

	<h2>Hey <strong>{{ ucwords($user->name) }}</strong>,</h2>
	<h3>Thanks for signing up :)</h3>

	<br>
	<p>We look forward to having you in the system, but there's one last thing I'll need from you... I'll need you to prove that you are a real person by confirming your email address.</p>
	<p>Please click the link below to confirm your email.</p>
	<br>
	<h4><center><a href="{{ url('register/token/' . $user->token ) }}">Please Click link to <b>Confirm</b> your Email.</a></h4><center>
	<br>
	<h6>You are receiving this email because you registered at the IloiloFinest</h6>

</body>
</html>
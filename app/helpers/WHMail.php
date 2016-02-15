<?php

class WHMail{
	
	static function emailVerfication($to,$name,$verification_code){
		
		$from='From: <noreply@whutzcookin.com>';
		$subject='Email Verification For WHUTZCOOKIN Cook';
		$message= '<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head><body>
		<p>
		<center>
			<img src="'.Request::server("HTTP_HOST").'/views/images/logo2.png" style="width:200px">
		</center>
		</p>
		<p>Dear '.$name.'<br />
			</p>
			<p>Thank you for registering at The Whutz Cookin</p>			
			<p>This email is to verify that you are indeed a human! If you are, simply follow the link below which will complete the registration process.</p>
			<a href="'.Request::server("HTTP_HOST").'/verification/email/'.$verification_code.'">Click on the link to activate your account.</a>
			<p>Best wishes <br/>
			The Whutz Cookin Registry Team.
			</p>
		</body>
		</html>';
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= 'From: <noreply@whutzcookin.com>' . "\r\n";
		//return mail($to,$subject,$message,$headers);
	}
	
	
	
}
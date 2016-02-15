<?php

class Helpers{
	
	static function time_ago($date)
	{
		if( empty( $date ) )
		{
			return "No date provided";
		}
	
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	
		$lengths = array("60","60","24","7","4.35","12","10");
	
		$now = time();
	
		$unix_date = strtotime( $date );
	
		// check validity of date
	
		if( empty( $unix_date ) )
		{
			return "Bad date";
		}
	
		// is it future date or past date
	
		if( $now > $unix_date )
		{
			$difference = $now - $unix_date;
			$tense = "ago";
		}
		else
		{
			$difference = $unix_date - $now;
			$tense = "from now";
		}
	
		for( $j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++ )
		{
			$difference /= $lengths[$j];
		}
	
		$difference = round( $difference );
	
		if( $difference != 1 )
		{
			$periods[$j].= "s";
		}
	
		return "$difference $periods[$j] {$tense}";
	
	}
	
	
	static function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);
		
		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
		  	return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}
	
	static function emailVerfication($to,$name,$verification_code){
		
		$from='From: <noreply@whutzcookin.com>';
		$subject='Email Verification For WHUTZCOOKIN Cook';
		$message= '<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head><body>
		<p>
		<center>
			<img src="'.Request::server("HTTP_HOST").'/views/images/logo2.png" style="width:200px">
		</center>
		</p><br>
		<p>Dear '.$name.'<br />
			</p>
			<p>Thank you for registering at The Whutz Cookin</p>			
			<p>This email is to verify that you are indeed a human! If you are, simply follow the link below which will complete the registration process.</p>
			<a href="'.Request::server("HTTP_HOST").'/#/login/true?email_verified='.$verification_code.'">Click on the link to activate your account.</a>
			<p>if you are not able to clicking '.Request::server("HTTP_HOST").'/#/login/true?email_verified='.$verification_code.' </p>
			<p>Best wishes <br/>
			The Whutz Cookin Registry Team.
			</p>
		</body>
		</html>';
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= 'From: <noreply@whutzcookin.com>' . "\r\n";
		
		try{
			return mail($to,$subject,$message,$headers);
		}
		catch(Exception $ex){
			return false;
		}
	}
	
	static function emailReservation($email,$phone,$fname,$lname,$book_date,$party_size){
		
		$to="vivekjoshi15@gmail.com";
		$from='From: <noreply@whutzcookin.com>';
		$subject='New Reservation At Whutz Cookin';
		$message= '<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head><body>
		<p>
		<center>
			<img src="'.Request::server("HTTP_HOST").'/views/images/logo2.png" style="width:200px">
		</center>
		</p><br>
		<p>Dear Admin,</p><br /><br/>
		<p>New Reservation is submitted.Below are the details of reservation.</p>
			<p>Name: '.$fname.' '.$lname.'</p>			
			<p>Email: '.$email.'</p>				
			<p>Phone: '.$phone.'</p>		
			<p>Booking Date: '.$book_date.'</p>			
			<p>Party Size: '.$party_size.'</p><br/><br/>				
			<p>Best wishes <br/>
			The Whutz Cookin Registry Team.
			</p>
		</body>
		</html>';
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= 'From: <noreply@whutzcookin.com>' . "\r\n";
		
		try{
			return mail($to,$subject,$message,$headers);
		}
		catch(Exception $ex){
			return false;
		}
	}

	static function emailContact($email,$phone,$fname,$lname,$message){
		
		$to="vivekjoshi15@gmail.com";
		$from='From: <noreply@whutzcookin.com>';
		$subject='New Reservation At Whutz Cookin';
		$message= '<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head><body>
		<p>
		<center>
			<img src="'.Request::server("HTTP_HOST").'/views/images/logo2.png" style="width:200px">
		</center>
		</p><br>
		<p>Dear Admin,</p><br /><br/>
		<p>New Reservation is submitted. Below are the details of request.</p>
			<p>Name: '.$fname.' '.$lname.'</p>			
			<p>Email: '.$email.'</p>				
			<p>Phone: '.$phone.'</p>		
			<p>Message: '.$message.'</p><br/><br/>	
			<p>Best wishes <br/>
			The Whutz Cookin Registry Team.
			</p>
		</body>
		</html>';
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= 'From: <noreply@whutzcookin.com>' . "\r\n";
		
		try{
			return mail($to,$subject,$message,$headers);
		}
		catch(Exception $ex){
			return false;
		}
	}
	
	static function forgotPassword($email,$links){
		
		$to=$email;
		$from='From: <noreply@whutzcookin.com>';
		$subject='Forgot Password For WHUTZCOOKIN Account';
		$message= '<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head><body>
		<p>
		<center>
			<img src="'.Request::server("HTTP_HOST").'/views/images/logo2.png" style="width:200px">
		</center>
		</p><br>
		<p>Hello</p><br /><br/>
		<p>Reset your password</p>
			<p><a href="'.Request::server("HTTP_HOST").'/#/home?reset='.$links.'#reset">click here  </a>
			</p>
			<p>if You are not able to clicking links then '.Request::server("HTTP_HOST").'/#/home?reset='.$links.'#reset </p>
		</body>
		</html>';
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= 'From: <noreply@whutzcookin.com>' . "\r\n";
		echo $message;
		try{
			return mail($to,$subject,$message,$headers);
		}
		catch(Exception $ex){
			return false;
		}
	}
	
	static function sendMailForDishPrepare($cook,$cart,$user){
		
			$from='From: <noreply@whutzcookin.com>';
			$subject='You have new order For WHUTZCOOKIN Cook';
			$message= '<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head><body>
			<p>
			<center>
				<img src="'.Request::server("HTTP_HOST").'/views/images/logo2.png" style="width:200px">
			</center>
			</p><br>
			<p>Dear '.$cook->name.',</p><br /><br/>
			<p>New Order is submitted. Below are the details of dish.</p>
				<p>User Name: '.$user->name.'</p>			
				<p>Mobile: '.$user->mobile.'</p>				
				<p>Phone: '.$user->phone.'</p>
				<p>Dish Name: '.$cart["dish"]["name"].'</p>	
				<p>Quantity: '.$cart["quantity"].'</p><br/><br/>
				<p><a href="'.Request::server("HTTP_HOST").'"> Click here to check more details </a>
					if you are not able to click '.Request::server("HTTP_HOST").'
				</p>	
				<p>Best wishes <br/>
				The Whutz Cookin Order Team.
				</p>		
				</body>
			</html>';
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <noreply@whutzcookin.com>' . "\r\n";
			
			try{
				return mail($cook->email,$subject,$message,$headers);
			}
			catch(Exception $ex){
				return false;
			}	
	}
	static function sendMailDishInfoForUser($cook,$cart,$user,$order_id){
		
			$from='From: <noreply@whutzcookin.com>';
			$subject='You have new order For WHUTZCOOKIN Cook';
			$message= '<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head><body>
			<p>
			<center>
				<img src="'.Request::server("HTTP_HOST").'/views/images/logo2.png" style="width:200px">
			</center>
			</p><br>
			<p>Dear '.$user->name.',</p><br /><br/>
			<p>Your Order is submitted. Below are the details of dish.</p>
				<p>Cook Name: '.$cook->name.'</p>			
				<p>Dish Name: '.$cart["dish"]["name"].'</p>	
				<p>Quantity: '.$cart["quantity"].'</p><br/><br/>
				<p><a href="'.Request::server("HTTP_HOST").'/order/status#?order='.$order_id.'"> Click here to check more details </a>
					if you are not able to click '.Request::server("HTTP_HOST").'/order/status#?order='.$order_id.'
				</p>	
				<p>Best wishes <br/>
				The Whutz Cookin Order Team.
				</p>		
				</body>
			</html>';
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <noreply@whutzcookin.com>' . "\r\n";
			
			try{
				return mail($user->email,$subject,$message,$headers);
			}
			catch(Exception $ex){
				return false;
			}	
	}
}
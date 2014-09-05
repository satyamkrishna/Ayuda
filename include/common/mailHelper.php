<?php
require_once "/home/ayudango/php/Mail.php";
require_once "/home/ayudango/php/Mail/mime.php";

class sendMail {
	// Mail Variables

	private $host = "mail.ayuda-ngo.org";
	private $username = "noreply@ayuda-ngo.org";
	private $password = "satyamkrishna1";

	// Constructor
	public function __construct() {

	}

	public function sendMail($from, $to, $subject, $body, $attachment = false, $files_assoc = NULL) {
		$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject);

		if ($attachment == true) {
			$crlf = "\n";
			$mime = new Mail_mime(array('eol' => $crlf));
			$mime -> setTXTBody($body);
			$mime -> setHTMLBody('<html><body>' . $body . '</html></body>');
			if (sizeof($files_assoc) == 0) {
				die("Sorry No attachment in Attachment Mode");
			} else {
				foreach ($files_assoc as $file => $filetype) {
					$mime -> addAttachment($file, $filetype);
				}

			}

			//do not ever try to call these lines in reverse order
			$body = $mime -> get();
			$headers = $mime -> headers($headers);
		}

		//Authenticate
		$smtp = Mail::factory('smtp', array('host' => $host, 'auth' => true, 'username' => $this->username, 'password' => $this->password));
		$mail = $smtp -> send($to, $headers, $body);

		if (PEAR::isError($mail)) {
			die("<p>" . $mail -> getMessage() . "</p>");
		} else {
			echo("<p>Message successfully sent!</p>");
		}
	}



}
?>
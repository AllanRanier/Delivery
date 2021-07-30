<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function email()
	{
		$email = \Config\Services::email();

		$email->setFrom('your@example.com', 'Your Name');
		$email->setTo('pimomip972@obxstorm.com');
		// $email->setCC('another@another-example.com');
		// $email->setBCC('them@their-example.com');

		$email->setSubject('Email Test');
		$email->setMessage('Testing the email class.');

		if ($email->send()) {
			echo 'email enviado';
		}else {
			echo $email->printDebugger();
		}
	}
}

<?php
namespace MailboxValidatorCakePHP\Controller;

use Cake\Core\Configure;

class MailboxValidatorController{

	public function single ($email) {
		$api_key = Configure::read('MBV_API_KEY');
		if (trim($email) != '') {
			$results = file_get_contents('https://api.mailboxvalidator.com/v1/validation/single?key=' . $api_key . '&email=' .$email);
			// Decode the return json results and return the data as an array.
			$data = json_decode($results,true);
			if (trim ($data['error_code']) == '' ) {
				$this->custom_log ($results);
				if ( $data['status'] == 'False' ) {
					return false;
				} else {
					return true;
				}
			}else {
				$this->mbv_error_log ($data);
				return false;
			}
		 }
	}

	public function disposable ($email) {
		$api_key = Configure::read('MBV_API_KEY');
		if (trim($email) != '') {
			$results = file_get_contents('https://api.mailboxvalidator.com/v1/email/disposable?key=' . $api_key . '&email=' .$email);
			// Decode the return json results and return the data as an array.
			$data = json_decode($results,true);
			if (trim ($data['error_code']) == '' ) {
				$this->custom_log ($results);
				if ( $data['is_disposable'] == 'True' ) {
					return false;
				} else {
					return true;
				}
			}else {
				$this->mbv_error_log ($data);
				return false;
			}
		 }
	}

	public function free($email){
		$api_key = Configure::read('MBV_API_KEY');
		if (trim($email) != '') {
			$results = file_get_contents('https://api.mailboxvalidator.com/v1/email/free?key=' . $api_key . '&email=' .$email);
			// Decode the return json results and return the data as an array.
			$data = json_decode($results,true);
			if (trim ($data['error_code']) == '' ) {
				$this->custom_log ($results);
				if ( $data['is_free'] == 'True' ) {
					return false;
				} else {
					return true;
				}
			}else {
				$this->mbv_error_log ($data);
				return false;
			}
		}
	}

	public function custom_log ($result) {
		file_put_contents( '../logs/mbv_log.log', date('d M, Y h:i:s A') . PHP_EOL, FILE_APPEND);
		file_put_contents( '../logs/mbv_log.log', $result . PHP_EOL, FILE_APPEND);
	}

	public function mbv_error_log ($data) {
		file_put_contents( '../logs/mbv_error_log.log', date('d M, Y h:i:s A') . PHP_EOL, FILE_APPEND);
		file_put_contents( '../logs/mbv_error_log.log', 'Error Code: ' . $data['error_code'] . PHP_EOL, FILE_APPEND);
		file_put_contents( '../logs/mbv_error_log.log', 'Error Message: ' . $data['error_message'] . PHP_EOL, FILE_APPEND);
	}

}
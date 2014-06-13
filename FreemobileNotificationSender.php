<?php

class FreemobileNotificationSender {
	const api_url = 'https://smsapi.free-mobile.fr/sendmsg';

	protected $_user_id;
	protected $_api_key;

	public function __construct($user_id,$api_key) {
		$this->_user_id = $user_id;
		$this->_api_key = $api_key;

		return $this;
	}

	public function sendMessage($message) {
		if (strlen($message) > 160) {
			throw new InvalidArgumentException('Message too long');
		}

		$query = http_build_query(array(
			'user' => $this->_user_id,
			'pass' => $this->_api_key,
			'msg' => $message
		));
		$url = self::api_url.'?'.$query;

		$curl_handler = curl_init();
		curl_setopt($curl_handler,CURLOPT_URL,$url);
		curl_setopt($curl_handler,CURLOPT_POST,false);
		curl_setopt($curl_handler,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl_handler,CURLOPT_HEADER,true);
		curl_setopt($curl_handler,CURLOPT_NOBODY,true);
		curl_setopt($curl_handler,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl_handler,CURLOPT_SSL_VERIFYPEER,true);
		curl_setopt($curl_handler,CURLOPT_SSL_VERIFYHOST,2);
		curl_setopt($curl_handler,CURLOPT_CAINFO,__DIR__."/freemobile.crt");
		
		if (curl_exec($curl_handler) === false) {
			throw new Exception('Curl error : '.curl_error($curl_handler));
		}
		
		$status = curl_getinfo($curl_handler,CURLINFO_HTTP_CODE);
		curl_close($curl_handler);

		switch ($status) {
		case 200:
			return true;
			break;

		case 400:
			throw new Exception('Badly formed request');
			return false;
			break;

		case 402:
			throw new OverflowException('Too much SMS sent in a short period of time');
			return false;
			break;

		case 403:
			throw new UnexpectedValueException('SMS notification service not activated or wrong credentials');
			return false;
			break;

		case 500:
			throw new RuntimeException('Server error, try later');
			return false;
			break;
			
		default:
			return false;
			break;
		}
	}
}

?>
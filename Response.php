<?php
namespace	Pennline\Http;

use Pennline\Php\Exception;

class Response implements ResponseInterface {

	/**
	 * @var array
	 */
	protected $http_info;

	/**
	 * @var string
	 */
	protected $message_body;


	/**
	 * @param string $message_body
	 * @param array $http_info
	 */
	public function __construct( $message_body = '', $http_info = array() ) {
		$this->init();
		$this->populate( $message_body, $http_info );
		$this->http_info = $http_info;
		$this->message_body = $message_body;
	}

	/**
	 * @return array
	 */
	public function getHttpInfo() {
		return $this->http_info;
	}

	/**
	 * @return string
	 */
	public function getMessageBody() {
		return $this->message_body;
	}

	protected function init() {
		$this->http_info = array();
		$this->message_body = '';
	}

	/**
	 * @param string $message_body
	 * @param array $http_info
	 */
	public function populate( $message_body = '', $http_info = array() ) {
		if ( !is_array( $http_info ) ) {
			error_log( __METHOD__ . '() $http_info provided is not an array' );
			throw new Exception( 'parameter type error', 1 );
		}

		if ( isset( $message_body ) && is_string( $message_body ) ) {
			$this->message_body = $message_body;
		}

		if ( !empty( $http_info ) ) {
			$this->http_info = $http_info;
		}
	}

}
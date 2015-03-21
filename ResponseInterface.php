<?php
namespace	Pennline\Http;

interface ResponseInterface {

	/**
	 * @param string $message_body
	 * @param array $http_info
	 */
	public function __construct( $message_body = '', $http_info = array() );

}
<?php
namespace	Pennline\Http;

use Pennline\Http\RequestInterface;
use Pennline\Http\Response;
use Pennline\Php\Exception;

abstract class Request implements RequestInterface {

	/**
	 * @var RequestInterface
	 */
	protected $RequestService;


	/**
	 * @param array $properties
	 */
	public function __construct( $properties = array() ) {
		$this->init();
		$this->populate( $properties );
	}

	/**
	 * @param string $url
	 * the uri to get
	 *
	 * @param object|array|string $data
	 * data to send in the get
	 *
	 * @returns bool|Response
	 **/
	public function get( $url, $data = array() ) {
		return new Response(
			$this->RequestService->get( $url, $data ),
			$this->RequestService->getRequestInfo()
		);
	}

	protected function init() {
		$this->RequestService = null;
	}

	/**
	 * @param array $properties
	 * @throws Exception
	 */
	protected function populate( $properties = array() ) {
		if ( !is_array( $properties ) ) {
			error_log( __METHOD__ . '() $properties provided are not an array' );
			throw new Exception( 'parameter type error', 1 );
		}

		if ( isset( $properties['RequestService'] ) && $properties['RequestService'] instanceof RequestInterface ) {
			$this->RequestService = $properties['RequestService'];
		}
	}

	/**
	 * @param string $url
	 * the uri to get
	 *
	 * @param {object|array|string} $data
	 * data to send in the get
	 *
	 * @returns bool|Response
	 **/
	public function post( $url = '', $data = array() ) {
		return new Response(
			$this->RequestService->post( $url, $data ),
			$this->RequestService->getRequestInfo()
		);
	}

	/**
	 * @throws Exception
	 */
	public function validate() {
		if ( !( $this->RequestService instanceof RequestInterface ) ) {
			error_log( __METHOD__ . '() $this->RequestService !instanceof RequestInterface' );
			throw new Exception( 'missing required property', 2 );
		}
	}
}

<?php
App::import('GeoIp.Lib', 'GeoIP');
App::uses('GeoIpLocation', 'GeoIp.Model');

class GeoIpLocationTestCase extends CakeTestCase {

	public function setUp() {
		parent::setUp();
		$this->GeoIpLocation = new GeoIpLocation();
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->GeoIpLocation);
	}

	public function testFind() {
		$mock = $this->getMockForModel
	}
}
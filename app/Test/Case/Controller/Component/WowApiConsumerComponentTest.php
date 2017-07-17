<?php
App::uses('ComponentCollection', 'Controller');
App::uses('Component', 'Controller');
App::uses('WowApiConsumerComponent', 'Controller/Component');

/**
 * WowApiConsumerComponent Test Case
 *
 */
class WowApiConsumerComponentTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$Collection = new ComponentCollection();
		$this->WowApiConsumer = new WowApiConsumerComponent($Collection);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WowApiConsumer);

		parent::tearDown();
	}

/**
 * testGet method
 *
 * @return void
 */
	public function testGet() {
		$this->markTestIncomplete('testGet not implemented.');
	}

/**
 * testGetRealms method
 *
 * @return void
 */
	public function testGetRealms() {
		$this->markTestIncomplete('testGetRealms not implemented.');
	}

/**
 * testMakeRequest method
 *
 * @return void
 */
	public function testMakeRequest() {
		$this->markTestIncomplete('testMakeRequest not implemented.');
	}

/**
 * testBuildQuery method
 *
 * @return void
 */
	public function testBuildQuery() {
		$this->markTestIncomplete('testBuildQuery not implemented.');
	}

	/**
	 * testExtProfileLink method
	 *
	 * Verify the generated external profile link.
	 *
	 * @return void
	 */
		public function testExtProfileLink() {
			$expects = 'https://us.battle.net/wow/en/character/emerald-dream/carilliya/simple';
			$result = $this->WowApiConsumer->buildExtLink('Carilliya', 'emerald-dream');

			$this->assertNotNull($result);
			$this->assertEquals($expects, $result);
		}

/**
 * testParseSettings method
 *
 * @return void
 */
	public function testParseSettings() {
		$this->markTestIncomplete('testParseSettings not implemented.');
	}

}

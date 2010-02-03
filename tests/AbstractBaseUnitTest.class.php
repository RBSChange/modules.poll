<?php
abstract class poll_tests_AbstractBaseUnitTest extends poll_tests_AbstractBaseTest
{
	/**
	 * @return void
	 */
	public function prepareTestCase()
	{
		$this->resetDatabase();
	}
}
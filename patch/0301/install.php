<?php
class poll_patch_0301 extends patch_BasePatch
{
 
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		$this->execChangeCommand("update-autoload", array("modules/poll"));
		$this->execChangeCommand("compile-roles");
		$this->execChangeCommand("compile-locales", array("poll"));
	}

	/**
	 * Returns the name of the module the patch belongs to.
	 *
	 * @return String
	 */
	protected final function getModuleName()
	{
		return 'poll';
	}

	/**
	 * Returns the number of the current patch.
	 * @return String
	 */
	protected final function getNumber()
	{
		return '0301';
	}
}

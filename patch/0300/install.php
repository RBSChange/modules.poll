<?php
/**
 * poll_patch_0300
 * @package modules.poll
 */
class poll_patch_0300 extends patch_BasePatch
{
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		f_util_System::execChangeCommand('compile-roles');
		f_util_System::execChangeCommand('compile-permissions');
	}

	/**
	 * @return String
	 */
	protected final function getModuleName()
	{
		return 'poll';
	}

	/**
	 * @return String
	 */
	protected final function getNumber()
	{
		return '0300';
	}
}
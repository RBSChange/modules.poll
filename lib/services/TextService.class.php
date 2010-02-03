<?php
class poll_TextService extends poll_ResponseService
{
	/**
	 * @var poll_TextService
	 */
	private static $instance;

	/**
	 * @return poll_TextService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = self::getServiceClassInstance(get_class());
		}
		return self::$instance;
	}

	/**
	 * @return poll_persistentdocument_text
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_poll/text');
	}

	/**
	 * Create a query based on 'modules_poll/text' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_poll/text');
	}
}
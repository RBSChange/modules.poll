<?php
class poll_TextanswerService extends f_persistentdocument_DocumentService
{
	/**
	 * @var poll_TextanswerService
	 */
	private static $instance;

	/**
	 * @return poll_TextanswerService
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
	 * @return poll_persistentdocument_textanswer
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_poll/textanswer');
	}

	/**
	 * Create a query based on 'modules_poll/textanswer' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_poll/textanswer');
	}

	/**
	 * @param poll_persistentdocument_text $text
	 * @param String $value
	 */
	public function addAnswerForText($text, $value)
	{
		$doc = $this->getNewDocumentInstance();
		$doc->setLabel($value);
		$doc->setText($text);
		$doc->save();
	}

	/**
	 * @param poll_persistentdocument_text $text
	 * @return Array<poll_persistentdocument_textanswer>
	 */
	public function getAnswersForText($text)
	{
		return $this->createQuery()->add(Restrictions::eq('text.id', $text->getId()))->addOrder(Order::desc('document_creationdate'))->find();
	}
}
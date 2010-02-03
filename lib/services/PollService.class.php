<?php
class poll_PollService extends f_persistentdocument_DocumentService
{
	/**
	 * @var poll_PollService
	 */
	private static $instance;

	/**
	 * @return poll_PollService
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
	 * @return poll_persistentdocument_poll
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_poll/poll');
	}

	/**
	 * Create a query based on 'modules_poll/poll' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_poll/poll');
	}

	/**
	 * This method add one vote for the poll $poll and the response $response
	 *
	 * @param poll_persistentdocument_poll $poll
	 * @param poll_persistentdocument_response $response
	 * @param Boolean $updatePoll
	 */
	public function addVoteForValue($poll, $response, $updatePoll = true)
	{
		try
		{
			$tm = $this->getTransactionManager();
			$tm->beginTransaction();

			if($updatePoll == true)
			{
				$pollVotes = $poll->getVotes() == null ? 0 : $poll->getVotes();
				$poll->setVotes($pollVotes + 1);
				$this->pp->updateDocument($poll);
			}

			$responseVotes = $response->getVotes() == null ? 0 : $response->getVotes();
			$response->setVotes($responseVotes + 1);
			$this->pp->updateDocument($response);

			$tm->commit();
		}
		catch (Exception $e)
		{
			$tm->rollBack($e);
		}
	}

	/**
	 * This method return the poll that must be displayed in contextual mode
	 *
	 * @param website_persistentdocument_topic $topic
	 * @return poll_persistentdocument_poll
	 */
	public function getContextualPoll($topic)
	{
		$poll = $this->createQuery()
			->add(Restrictions::childOf($topic->getId()))
			->add(Restrictions::published())
			->addOrder(Order::desc('document_creationdate'))
			->findUnique();

		return $poll;
	}

	/**
	 * @param poll_persistentdocument_poll $document
	 * @return boolean true if the document is publishable, false if it is not.
	 */
	public function isPublishable($document)
	{
		if (parent::isPublishable($document))
		{
			$query = poll_ResponseService::getInstance()->createQuery()
				->add(Restrictions::published())
				->add(Restrictions::childOf($document->getId()))
				->setProjection(Projections::rowCount('count'));
			$result = $query->find();
			if ($result[0]['count'] > 1)
			{
				return true;
			}
		}
		return false;
	}

}
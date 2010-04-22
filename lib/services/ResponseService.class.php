<?php
class poll_ResponseService extends f_persistentdocument_DocumentService
{
	/**
	 * @var poll_ResponseService
	 */
	private static $instance;

	/**
	 * @return poll_ResponseService
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
	 * @return poll_persistentdocument_response
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_poll/response');
	}

	/**
	 * Create a query based on 'modules_poll/response' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_poll/response');
	}

	/**
	 * @param poll_persistentdocument_response $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
	protected function preInsert($document, $parentNodeId = null)
	{
		$parent = DocumentHelper::getDocumentInstance($parentNodeId);

		if ($parent->getVotes() !== 0 )
		{
			throw new IllegalOperationException('Impossible to insert a new response after the first vote');
		}
	}

	/**
	 * @param poll_persistentdocument_response $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
	protected function preUpdate($document, $parentNodeId = null)
	{
		$parent = $this->getParentOf($document);

		if (!is_null($parent->getVotes()) )
		{
			if (!f_permission_PermissionService::getInstance()->hasPermission(users_UserService::getInstance()->getCurrentBackEndUser(), "modules_poll.UpdateResponse", $parent->getId()) )
			{
				throw new IllegalOperationException('Impossible to update this response without compromize the data of votes');
			}
		}
	}

	/**
	 * @param poll_persistentdocument_response $document
	 * @return void
	 */
	protected function preDelete($document)
	{
		$parent = $this->getParentOf($document);
		if ( $parent->getVotes()!== 0 )
		{
			throw new IllegalOperationException('Impossible to delete this response without compromize the data of votes');
		}

		$texts = poll_TextanswerService::getInstance()->createQuery()->add(Restrictions::eq('text.id', $document->getId()))->find();
		foreach ($texts as $text)
		{
			$text->delete();
		}
	}


	/**
	 * Methode à surcharger pour effectuer des post traitement apres le changement de status du document
	 * utiliser $document->getPublicationstatus() pour retrouver le nouveau status du document.
	 * @param poll_persistentdocument_response $document
	 * @param String $oldPublicationStatus
	 * @param array<"cause" => String, "modifiedPropertyNames" => array, "oldPropertyValues" => array> $params
	 * @return void
	 */
	protected function publicationStatusChanged($document, $oldPublicationStatus, $params)
	{
		if ($oldPublicationStatus == 'PUBLICATED' || $document->isPublished())
		{
			$parent = $this->getParentOf($document);
			$parent->getDocumentService()->publishIfPossible($parent->getId());
		}
	}

    /**
     * @see f_persistentdocument_DocumentService::getResume()
     *
     * @param poll_persistentdocument_response $document
     * @param string $forModuleName
     * @param unknown_type $allowedSections
     * @return array
     */
    public function getResume ($document, $forModuleName, $allowedSections = null)
    {
       $data = parent::getResume($document, $forModuleName, $allowedSections);
       $data['properties']['numberofvotes'] = $document->getVotes();
       return $data;
    }	
}
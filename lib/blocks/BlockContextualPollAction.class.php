<?php
class poll_BlockContextualPollAction extends block_BlockAction
{
	/**
	 * @param block_BlockContext $context
	 * @param block_BlockRequest $request
	 * @return String view name
	 */
	public function execute($context, $request)
	{
		// Search the poll to display
		$page = $context->getPageDocument();
		$topic = $page->getDocumentService()->getParentOf($page);
			
		$poll = poll_PollService::getInstance()->getContextualPoll($topic);
			
		$subBlock = $this->getNewBlockInstance()
		->setPackageName('modules_poll')
		->setType('Poll')
		->setDocumentParameter($poll);
		return $this->forward($subBlock);
	}
}
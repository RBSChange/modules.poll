<?php
class poll_BlockTagguedPollAction extends block_BlockAction
{
	/**
	 * @param block_BlockContext $context
	 * @param block_BlockRequest $request
	 * @return String view name
	 */
	public function execute($context, $request)
	{
		// Search the poll tagged
		try 
		{
			$poll = TagService::getInstance()->getDocumentByContextualTag('contextual_website_website_modules_poll_tagged-poll', website_WebsiteModuleService::getInstance()->getCurrentWebsite());
			$subBlock = $this->getNewBlockInstance()
				->setPackageName('modules_poll')
				->setType('Poll')
				->setDocumentParameter($poll);
			return $this->forward($subBlock);
		}
		catch (Exception $e)
		{
			if ($context->inBackofficeMode())
			{
				return block_BlockView::ERROR;
			}
			else 
			{
				return block_BlockView::NONE;
			}
		}
	}
	
}

<?php
class poll_BlockPollAction extends block_BlockAction
{
	/**
	 * @param block_BlockContext $context
	 * @param block_BlockRequest $request
	 * @return String view name
	 */
	public function execute($context, $request)
	{
		$poll = $this->getDocumentParameter();

		if ($poll !== null && $poll->isPublished() )
		{
			$this->setParameter('item', $poll);
			// If cookies exist or poll closing passed return success view
			$pollClosingPassed = date_GregorianCalendar::getInstance($poll->getPollclosing())->isBefore(date_GregorianCalendar::getInstance(date('Y-m-d')));
			$cookieSetted = $this->checkCookie($poll);

			if ($pollClosingPassed)
			{
				$this->setParameter('closeComment', $poll->getCloseCommentWithReplacedValue());
			}

			if ($cookieSetted)
			{
				$this->setParameter('AlreadyParticipated', true);
			}

			if ( $cookieSetted || $pollClosingPassed )
			{
				return block_BlockView::SUCCESS;
			}

			// If form submitted save value
			if ( $request->hasParameter('submit') && $request->getParameter('currentPoll') == $poll->getId())
			{
				if (!$request->hasNonEmptyParameter('response') && !$request->hasNonEmptyParameter('text'))
				{
					$this->setParameter("errorText", f_Locale::translate("&modules.poll.frontoffice.MissingResponseError;"));
					return block_BlockView::INPUT;
				}

				$ps = poll_PollService::getInstance();
				$updatePoll = true;
				
				if($request->hasNonEmptyParameter('response'))
				{
					$response = $request->getParameter('response');
					if(is_array($response))
					{
						foreach ($response as $rep)
						{
							$ps->addVoteForValue($poll, DocumentHelper::getDocumentInstance($rep), $updatePoll);
							$updatePoll = false;
						}
					}
					else
					{
						$ps->addVoteForValue($poll, DocumentHelper::getDocumentInstance($response));
					}
				}
				
				if($request->hasNonEmptyParameter('text'))
				{
					$taService = poll_TextanswerService::getInstance();
					$text = $request->getParameter('text');
					foreach ($text as $id => $value)
					{
						if(!f_util_StringUtils::isEmpty($value))
						{
							$resp = DocumentHelper::getDocumentInstance($id);
							$ps->addVoteForValue($poll, $resp, $updatePoll);
							$updatePoll = false;
							$taService->addAnswerForText($resp, $value);
						}
					}
				}

				$this->setCookie($poll);

				$this->setParameter('partComment', $poll->getPartcommentAsHtml());
				
				return block_BlockView::SUCCESS;
			}

			return block_BlockView::INPUT;
		}

		return block_BlockView::NONE;
	}

	/**
	 * @param poll_persistentdocument_poll $poll
	 */
	private function setCookie($poll)
	{
		$date = date_GregorianCalendar::getInstance($poll->getPollclosing());
		$id = $poll->getId();
		setcookie('rbschange'.$id, $id, $date->getTimestamp());
	}
	/**
	 * @param poll_persistentdocument_poll $poll
	 *
	 * @return Boolean
	 */
	private function checkCookie($poll)
	{
		if( isset($_COOKIE['rbschange' . $poll->getId()]) && $_COOKIE['rbschange' . $poll->getId()] == $poll->getId() )
		{
			return true;
		}
		return false;
	}
}
<?php
class poll_ResetPollAction extends f_action_BaseJSONAction 
{
	/**
	 * Please use this method for the action body instead of execute() (without
	 * the underscore): it is called by execute and directly receives Context
	 * and Request objects.
	 *
	 * @param Context $context
	 * @param Request $request
	 */
	protected function _execute($context, $request)
	{
		$pollId = $this->getDocumentIdFromRequest($request);
		$poll = DocumentHelper::getDocumentInstance($pollId, "modules_poll/poll");
		poll_PollService::getInstance()->resetVotes($poll);
		return $this->sendJSON(array("message" => f_Locale::translateUI("&modules.poll.bo.actions.ResetPoll-Success;")));
	}
}
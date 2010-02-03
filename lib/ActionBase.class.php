<?php
class poll_ActionBase extends f_action_BaseAction
{
	
	/**
	 * Returns the poll_PollService to handle documents of type "modules_poll/poll".
	 *
	 * @return poll_PollService
	 */
	public function getPollService()
	{
		return poll_PollService::getInstance();
	}
	
	/**
	 * Returns the poll_ResponseService to handle documents of type "modules_poll/response".
	 *
	 * @return poll_ResponseService
	 */
	public function getResponseService()
	{
		return poll_ResponseService::getInstance();
	}
	
	/**
	 * Returns the poll_TextService to handle documents of type "modules_poll/text".
	 *
	 * @return poll_TextService
	 */
	public function getTextService()
	{
		return poll_TextService::getInstance();
	}
	
	/**
	 * Returns the poll_TextanswerService to handle documents of type "modules_poll/textanswer".
	 *
	 * @return poll_TextanswerService
	 */
	public function getTextanswerService()
	{
		return poll_TextanswerService::getInstance();
	}
	
}
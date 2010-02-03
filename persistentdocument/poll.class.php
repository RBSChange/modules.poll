<?php
class poll_persistentdocument_poll extends poll_persistentdocument_pollbase 
{
	
	/**
	 * This method return the close comment but try to insert the votes number
	 *
	 * @return String
	 */
	public function getCloseCommentWithReplacedValue()
	{
		return str_replace('{votes}', $this->getVotes(), $this->getClosecommentAsHtml());
	}
	
}
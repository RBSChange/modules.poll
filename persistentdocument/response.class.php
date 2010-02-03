<?php
/**
 * poll_persistentdocument_response
 * @package poll
 */
class poll_persistentdocument_response extends poll_persistentdocument_responsebase
{
	function getHtmlId()
	{
		return "poll-response-".$this->getId();
	}
	/**
	 * This method return the poucent of response
	 *
	 * @return float
	 */
	public function getPourcentValue()
	{
		$poll = $this->getDocumentService()->getParentOf($this);
		$pourcent = round(( $this->getVotes() / $poll->getVotes() ) * 100, 2);
		return $pourcent;
	}
	
	/**
	 * @return Integer
	 */
	function getVotesAsNumber()
	{
		return intval(parent::getVotes());
	}
	
	/**
	 * @return String
	 */
	function getVotesAsLocalizedString()
	{
		$votes = $this->getVotesAsNumber();
		if ($votes > 1)
		{
			$key = "&modules.poll.frontoffice.votesNumber;";
		}
		else
		{
			$key = "&modules.poll.frontoffice.voteNumber;";
		}
		return f_Locale::translate($key, array("votes" => $votes));
	}

	public function isText()
	{
		return false;
	}
}

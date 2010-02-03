<?php
class poll_SeeStatsAction extends poll_Action
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$id = $request->getParameter(K::COMPONENT_ID_ACCESSOR );
		try
		{
			$doc = DocumentHelper::getDocumentInstance($id);
			if($doc instanceof poll_persistentdocument_poll)
			{
				$request->setParameter('item', $doc);
				return View::SUCCESS ;
			}
		}
		catch (Exception $e)
		{//nothing to do
		}
		return View::NONE ;
	}
}
<?php
class poll_SeeAnswerAction extends poll_Action
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
			if($doc instanceof poll_persistentdocument_text)
			{
				$request->setParameter('text', $doc);
				$request->setParameter('answers', poll_TextanswerService::getInstance()->getAnswersForText($doc));
				return View::SUCCESS ;
			}
		}
		catch (Exception $e)
		{//nothing to do
		}
		return View::NONE ;
	}
}
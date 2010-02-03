<?php
class poll_SeeAnswerSuccessView extends f_view_BaseView
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$this->setTemplateName('SeeAnswer', K::HTML);
		$this->setAttributes($request->getParameters());
	}
}
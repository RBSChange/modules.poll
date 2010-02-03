<?php
class poll_SeeStatsSuccessView extends f_view_BaseView
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$this->setTemplateName('SeeStats', K::HTML);
		$this->getStyleService()->registerStyle('modules.poll.frontoffice');
    $this->setAttribute('style', $this->getStyleService()->execute());
		$this->setAttributes($request->getParameters());
	}
}
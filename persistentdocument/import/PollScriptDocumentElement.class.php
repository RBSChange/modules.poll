<?php
class poll_PollScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return poll_persistentdocument_poll
     */
    protected function initPersistentDocument()
    {
    	return poll_PollService::getInstance()->getNewDocumentInstance();
    }
}
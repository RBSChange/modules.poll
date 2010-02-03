<?php
class poll_ResponseScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return poll_persistentdocument_response
     */
    protected function initPersistentDocument()
    {
    	return poll_ResponseService::getInstance()->getNewDocumentInstance();
    }
}
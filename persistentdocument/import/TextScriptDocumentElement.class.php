<?php
/**
 * poll_TextScriptDocumentElement
 * @package modules.poll.persistentdocument.import
 */
class poll_TextScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return poll_persistentdocument_text
     */
    protected function initPersistentDocument()
    {
    	return poll_TextService::getInstance()->getNewDocumentInstance();
    }
}
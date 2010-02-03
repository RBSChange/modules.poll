<?php
/**
 * poll_TextanswerScriptDocumentElement
 * @package modules.poll.persistentdocument.import
 */
class poll_TextanswerScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return poll_persistentdocument_textanswer
     */
    protected function initPersistentDocument()
    {
    	return poll_TextanswerService::getInstance()->getNewDocumentInstance();
    }
}
<?php

/**
 * @property Controller $owner
 */
class JqueryControllerExtension extends Extension
{

    public function onBeforeInit()
    {

        $isCMS  = (bool) is_subclass_of($this->owner, "LeftAndMain");
        $isAjax = Director::is_ajax();
        if (!$isCMS && !$isAjax) {
            SilverStripeJquery::requireJquery();
        }
    }
}
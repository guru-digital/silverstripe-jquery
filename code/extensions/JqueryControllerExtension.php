<?php

/**
 *
 */
class JqueryControllerExtension extends Extension
{

    public function onBeforeInit()
    {
        if (!is_subclass_of(Controller::curr(), "LeftAndMain")) {
            SilverStripeJquery::requireJquery();
        }
    }
}
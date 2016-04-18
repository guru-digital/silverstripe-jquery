<?php

/**
 * @property Controller $owner
 */
class JqueryControllerExtension extends Extension {

    public function onBeforeInit() {
        if (
                !$this->isCMS() || $this->isAuthentication()
        ) {
            SilverStripeJquery::requireJquery();
        }
    }

    public function isCMS() {
        return is_subclass_of($this->owner, "LeftAndMain");
    }

    public function isAuthentication() {
        return $this->owner->getRequest()->param("Controller") == "Security" &&
                in_array($this->owner->getRequest()->param("Action"), array("login", "logout"));
    }

}

<?php

/**
 *
 */
class JqueryControllerExtension extends Extension {

    /**
     *
     * @var  ReflectionProperty
     */
    private $requirementsJSProp;

    /**
     *
     * @var Requirements
     */
    protected $backend;

    public function onBeforeInit() {
        if (!is_subclass_of(Controller::curr(), "LeftAndMain")) {
            $this->backend = Requirements::backend();
            $jsMin         = (Director::isDev()) ? "" : ".min";
            $toBlock       = array(FRAMEWORK_DIR . "/thirdparty/jquery/jquery.js");
            $toPrepend     = array("silverstripe-jquery/thirdparty/jquery/jquery" . $jsMin . ".js", "silverstripe-jquery/thirdparty/jquery-migrate/jquery-migrate" . $jsMin . ".js");
            $this->mungeRequirementsJs($toBlock, $toPrepend);
        }
    }

    protected function mungeRequirementsJs($toBlock, $toPrepend) {
        foreach ($toBlock as $block) {
            Requirements::block($block);
        }
        $prependJs = array();
        foreach ($toPrepend as $prepend) {
            $prependJs[$prepend] = true;
        }
        $this->setRequirementsJS(array_merge($prependJs, $this->getRequirementsJS()));
    }

    /**
     *
     * @return ReflectionProperty
     */
    protected function getRequirementsJSProp() {
        if (!$this->requirementsJSProp) {
            $class                    = new ReflectionClass($this->backend);
            $this->requirementsJSProp = $class->getProperty("javascript");
            $this->requirementsJSProp->setAccessible(true);
        }
        return $this->requirementsJSProp;
    }

    /**
     *
     * @return ReflectionProperty
     */
    protected function getRequirementsJS() {
        return $this->getRequirementsJSProp()->getValue($this->backend);
    }

    /**
     *
     * @return ReflectionProperty
     */
    protected function setRequirementsJS($requirementsJs) {
        return $this->getRequirementsJSProp()->setValue($this->backend, $requirementsJs);
    }

}

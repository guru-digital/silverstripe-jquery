<?php

class SilverStripeJquery
{
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

	public static function create()
	{
		return new static();
	}

	public function __construct()
	{
		$this->backend = Requirements::backend();
	}

	public static function requireJquery()
	{
		return static::create()->mungeRequirementsJs(static::getFrameworkJqueryFiles(), static::getRequirementFiles());
	}

	protected function mungeRequirementsJs($toBlock, $toPrepend)
	{
		foreach ($toBlock as $block) {
			Requirements::block($block);
		}
		$prependJs = array();
		foreach ($toPrepend as $prepend) {
			$prependJs[$prepend] = true;
		}
		$this->setRequirementsJS(array_merge($prependJs, $this->getRequirementsJS()));
		return $this;
	}

	/**
	 *
	 * @return ReflectionProperty
	 */
	protected function getRequirementsJSProp()
	{
		if (!$this->requirementsJSProp) {
			$class						 = new ReflectionClass($this->backend);
			$this->requirementsJSProp	 = $class->getProperty("javascript");
			$this->requirementsJSProp->setAccessible(true);
		}
		return $this->requirementsJSProp;
	}

	/**
	 *
	 * @return ReflectionProperty
	 */
	protected function getRequirementsJS()
	{
		return $this->getRequirementsJSProp()->getValue($this->backend);
	}

	/**
	 *
	 * @return ReflectionProperty
	 */
	protected function setRequirementsJS($requirementsJs)
	{
		return $this->getRequirementsJSProp()->setValue($this->backend, $requirementsJs);
	}

	public static function getRequirementFiles()
	{
		$jsMin = (Director::isDev()) ? "" : ".min";
		return array(
			SS_JQUERY_DIR."/thirdparty/jquery/jquery".$jsMin.".js",
		);
	}

	public static function getFrameworkJqueryFiles()
	{
		return array(
			FRAMEWORK_DIR."/thirdparty/jquery/jquery.js",
			FRAMEWORK_DIR."/thirdparty/jquery/jquery.min.js"
		);
	}
}
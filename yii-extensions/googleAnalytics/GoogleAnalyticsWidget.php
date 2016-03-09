<?php

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'api/googleApi.php');

class GoogleAnalyticsWidget extends CWidget
{
    const TYPE_SETTINGSFORM = 'settingsform';
    const TYPE_REPORT = 'report';
    private $gapi;
    public $type;
    public $model;
    public $modelSettings;
    public $ga_query;

    /*protected $_constr = 'Chart';
    protected $_baseScript = 'highcharts';
    public $options = array();
    public $htmlOptions = array();
    public $setupOptions = array();
    public $scripts = array();
    public $callback = false;
    public $scriptPosition = null;*/

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->gapi = new googleApi;
        $this->gapi->setModel(
            $this->model,
            $this->modelSettings
        );
        switch ( strtolower($this->type) ) {
            case self::TYPE_SETTINGSFORM:
                print $this->gapi->getSettingsForm();
                break;
            case self::TYPE_REPORT:
                return $this->gapi->getReportData($this->ga_query['from'], $this->ga_query['to'], $this->ga_query['metrics'], $this->ga_query['options']);
                break;
            default:

                break;
        }
        /*if (isset($this->htmlOptions['id'])) {
            $this->id = $this->htmlOptions['id'];
        } else {
            $this->htmlOptions['id'] = $this->getId();
        }

        echo CHtml::openTag('div', $this->htmlOptions);
        echo CHtml::closeTag('div');

        // check if options parameter is a json string
        if (is_string($this->options)) {
            if (!$this->options = CJSON::decode($this->options)) {
                throw new CException('The options parameter is not valid JSON.');
            }
        }

        // merge options with default values
        $defaultOptions = array('chart' => array('renderTo' => $this->id));
        $this->options = CMap::mergeArray($defaultOptions, $this->options);
        array_unshift($this->scripts, $this->_baseScript);*/

        $this->registerAssets();
    }

    /**
     * Publishes and registers the necessary script files.
     */
    protected function registerAssets()
    {
        /*$basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;
        $baseUrl = Yii::app()->getAssetManager()->publish($basePath, false, 1, YII_DEBUG);

        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');

        // register additional scripts
        $extension = YII_DEBUG ? '.js' : '.js';
        foreach ($this->scripts as $script) {
            $cs->registerScriptFile("{$baseUrl}/{$script}{$extension}", $this->scriptPosition);
        }

        // highcharts and highstock can't live on the same page
        if ($this->_baseScript === 'highstock') {
            $cs->scriptMap["highcharts{$extension}"] = "{$baseUrl}/highstock{$extension}";
        }

        // prepare and register JavaScript code block
        $jsOptions = CJavaScript::encode($this->options);
        $setupOptions = CJavaScript::encode($this->setupOptions);
        $js = "Highcharts.setOptions($setupOptions); var chart = new Highcharts.{$this->_constr}($jsOptions);";
        $key = __CLASS__ . '#' . $this->id;
        if (is_string($this->callback)) {
            $callbackScript = "function {$this->callback}(data) {{$js}}";
            $cs->registerScript($key, $callbackScript, CClientScript::POS_END);
        } else {
            $cs->registerScript($key, $js, CClientScript::POS_LOAD);
        }*/
    }
}

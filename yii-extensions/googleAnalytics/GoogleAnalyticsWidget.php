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

        $this->registerAssets();
    }

    public function isActivated()
    {
        return $this->gapi->isActivated();
    }

    /**
     * Publishes and registers the necessary script files.
     */
    protected function registerAssets()
    {

    }
}

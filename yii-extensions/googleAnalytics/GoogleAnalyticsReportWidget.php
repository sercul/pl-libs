<?php

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GoogleAnalyticsWidget.php');

class GoogleAnalyticsReportWidget extends GoogleAnalyticsWidget
{
    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->type = self::TYPE_REPORT;
        return parent::run();
    }

    protected function registerAssets()
    {

    }
}

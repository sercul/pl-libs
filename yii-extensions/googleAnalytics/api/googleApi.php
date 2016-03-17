<?php

class googleApi
{
    /*OAuth client
Here is your client ID
54900137081-4tbi1304tfaug0i7mopfdg2o68pjttp6.apps.googleusercontent.com
Here is your client secret
5CBk1CjjeChUuuwQVFOJT4Xa*/

    private $errors;
    private $options;
    public $client;
    private $access = array( '54900137081-e4kig7g7mj6dtnrvois0obi9v6ig0qgo.apps.googleusercontent.com', 'wJ7R3lg_HYVwjoqDePRnVYIT' );

    ///*TODO EMULATED release.pp.ua*/private $access_token = '{"access_token":"ya29.mAIw2x2r_mGJwWejHIheL4E_nchSPaGWPFMS40Yz-LH1C88IIF5MrZOzhaYVVqwgFQ","token_type":"Bearer","expires_in":3600,"refresh_token":"1\/wP0mnNNmlewtPwrQ4wem3EAxXQY8Gd3ETdmQ-lnyZKY","created":1456849418}';
    ///*TODO EMULATED plexisoft*/private $access_token = '{"access_token":"ya29.mALfJikTAeWainCMxJNc1MQQxPoc8wue2VY4521ZOWKP9tU9eHJMu8hkk6rq6IH-lg","token_type":"Bearer","expires_in":3600,"refresh_token":"1\/U_4dljIPY0WRJHhoc9rrhqjKF3UD7cNvkxUZAcnMCn8MEudVrK5jSpoR30zcRFq6","created":1456843862}';
    ///*TODO EMULATED*/private $profile_id = 115357560;
    /*TODO EMULATED unauthorized*/private $access_token = null;
    /*TODO EMULATED unauthorized*/private $profile_id = null;//115357560;
//print_r(array($this->service->data_ga->get( 'ga:'.$_primaryProfile->id, '30daysAgo', 'yesterday', 'ga:sessions,ga:users,ga:pageviews,ga:BounceRate,ga:organicSearches,ga:pageviewsPerSession', array() )));
    private $model;
    private $modelSettings;

    public function __construct()
    {
        spl_autoload_unregister(array('YiiBase','autoload'));
        include_once( __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php' );
        spl_autoload_register(array('YiiBase','autoload'));

        $config = new Google_Config();
        $config->setCacheClass( 'Google_Cache_Null' );
        if ( function_exists( 'curl_version' ) ) {
            $curlversion = curl_version();
            if ( isset( $curlversion['version'] ) && ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) && version_compare( $curlversion['version'], '7.10.8' ) >= 0 && defined( 'GADWP_IP_VERSION' ) && GADWP_IP_VERSION ) {
                $config->setClassConfig( 'Google_IO_Curl', array( 'options' => array( CURLOPT_IPRESOLVE => GADWP_IP_VERSION ) ) ); // Force CURL_IPRESOLVE_V4 or CURL_IPRESOLVE_V6
            }
        }

        $this->client = new Google_Client( $config );
        $this->client->setScopes( 'https://www.googleapis.com/auth/analytics.readonly' );
        $this->client->setAccessType( 'offline' );
        $this->client->setApplicationName( 'Google Dashboard for Yii' );
        $this->client->setRedirectUri( 'urn:ietf:wg:oauth:2.0:oob' );
        $this->client->setClientId( $this->access[0] );
        $this->client->setClientSecret( $this->access[1] );
    }

    public function setModel($model, $settings)
    {
        $this->model = $model;
        $this->modelSettings = $settings;

        $this->loadFromModel();
        if ( !empty($this->access_token) ) {
            $this->client->setAccessToken($this->access_token);
            $this->service = new Google_Service_Analytics($this->client);
        }
    }

    private function loadFromModel()
    {
        if ( !empty($this->model) ) {
            foreach ($this->modelSettings as $field => $modelField) {
                $this->{$field} = $this->model->{$modelField};
            }
        }
    }

    private function updateModel()
    {
        foreach ($this->modelSettings as $field => $modelField) {
            $this->model->{$modelField} = $this->{$field};
        }
        $this->model->save(false);
    }

    public function isActivated()
    {
        if ( !empty($this->client->getAccessToken()) ) {
            if ( $this->client->isAccessTokenExpired() ) {
                /*$_refreshToken = json_decode($this->client->getAccessToken())->refresh_token;
                $this->client->refreshToken($_refreshToken);
                $_token = $this->client->getAccessToken();*/
                //TODO token reinit
            }
            return true;
        }
        return false;
    }

    private function getAccountsProperties()
    {
        $accountsProperties = array();
        if ( $this->isActivated() ) {
            try{
                $_accounts = $this->service->management_accounts->listManagementAccounts();
                foreach ($_accounts->items as $_account) {
                    if ( in_array('READ_AND_ANALYZE', $_account->permissions->effective) ) {
                        $_properties = $this->service->management_webproperties->listManagementWebproperties($_account->id);
                        foreach ($_properties->items as $_property) {
                            $_profiles = $this->service->management_profiles->listManagementProfiles($_property->accountId, $_property->id);
                            $_primaryProfile = $_profiles->items[0];
                            if ( !empty($_primaryProfile) ) {
                                $accountsProperties[] = array(
                                    'selectedProfileId' => $this->profile_id,
                                    'accountId' => $_property->accountId,
                                    'id' => $_property->id,
                                    'internalWebPropertyId' => $_property->internalWebPropertyId,
                                    'websiteUrl' => $_property->websiteUrl,
                                    'name' => $_property->name,
                                    'profileId' => $_primaryProfile->id
                                );
                            }
                        }
                    }
                }
            }catch (Exception $e) {
                $this->errors[] = $e->getMessage();
                return $accountsProperties;
            }
        }

        return $accountsProperties;
    }

    public function getSettingsForm()
    {
        if ( !$this->isActivated() ) {
            if ( isset($_POST['ga']['auth_code']) ) {
                try {
                    $this->client->authenticate($_POST['ga']['auth_code']);
                    if ( !empty($this->client->getAccessToken()) ) {
                        $this->access_token = $this->client->getAccessToken();

                        $this->client->setAccessToken($this->access_token);
                        $this->service = new Google_Service_Analytics($this->client);

                        $this->updateModel();
                    }
                } catch(Exception $e) {
                    $this->errors[] = $e->getMessage();
                }
            } else {
                return $this->activatePlugin();
            }
        } elseif ($this->isActivated()) {
            if ( isset($_POST['ga']['profile_id']) ) {
                $this->profile_id = $_POST['ga']['profile_id'];
                $this->updateModel();
            }
            return $this->generalSettings();
        }
        return (!$this->isActivated()) ? $this->activatePlugin() : $this->generalSettings();
    }

    private function activatePlugin() {
        $authUrl = $this->client->createAuthUrl();
        $form = '';
        if ( !empty($this->errors) ) {
            $form .='<table>';
            foreach ($this->errors as $_error) {
                $form .='<tr>
                            <td>Error: </td>
                            <td>' . $_error . '</td>
                        </tr>';
            }
            $form .='</table>';
        }
        $form .= '<form name="input" action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="col-sm-12">
                <div class="col-sm-8">
                    <div class="form-group">
                        Use this link to get your access code: <a href="' . $authUrl . '" id="gapi-access-code" target="_blank">Get Access Code</a>.
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="ga_dash_code" class="required">Access Code:<span class="required">*</span></label>
                        <input class="form-control" type="text" id="ga_auth_code" name="ga[auth_code]" value="" size="61" required="required" title="Use the red link to get your access code!">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <hr>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <input class="btn btn-info pull-left" type="submit" name="ga[authorize]" value="Save Access Code">
                    </div>
                </div>
            </div>
        </form>';
        return $form;
    }

    private function generalSettings()
    {
        $dataProvider=new CArrayDataProvider($this->getAccountsProperties());

        $gridClass = new GridView;
        $grid = $gridClass->widget('GridView', array(
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                array(
                    'name'=>'Selected Resource',
                    'type'=>'raw',
                    'value'=>'CHtml::radioButtonList(\'ga[profile_id]\',$data[\'selectedProfileId\'] ,array($data[\'profileId\'] => $data[\'name\']),array(
                        \'labelOptions\'=>array(\'style\'=>\'display:inline\'),
                        \'onclick\'=>\'$(this).closest("form").submit($data)\',
                    ))'
                ),
                'websiteUrl' => array(
                    'name' => t('Default URL'),
                    'value' => '$data["websiteUrl"]'
                ),
                'profileId' => array(
                    'name' => t('Account ID'),
                    'value' => '$data["profileId"]'
                ),
                'id' => array(
                    'name' => t('Tracking ID'),
                    'value' => '$data["id"]'
                ),
                'edit' => array(
                    'name' => t('Actions'),
                    "type" => "raw",
                    'value' => '
                    l("<i class=\"menu-icon glyphicon glyphicon-edit\"></i>", array ("' . Yii::app()->controller->id . '/edit"), array("class" => "btn btn-default"))'
                ),


            ),
        ), true);

        $form = '
        <form name="input" action="' . $_SERVER['REQUEST_URI'] . '" method="post">';

        $profileProperties = $this->getAccountsProperties();
        if ( !empty($this->errors) ) {
            $form .='<table>';
            foreach ($this->errors as $_error) {
                $form .='<tr>
                            <td>Error: </td>
                            <td>' . $_error . '</td>
                        </tr>';
            }
            $form .='</table>';
        } else {
            $form .='<div class="col-sm-12">';
            $form .= $grid;
            $form .= '<div class="btn-group-box"><a href="' . app()->controller->createUrl(Yii::app()->controller->id . '/reset').'" class="btn btn-info">'.t("Reset Analytics Connection").'</a>';
            $form .= CHtml::submitButton ("Save", array('class' => 'btn btn-info pull-left'));
            $form .='</div></div>';
        }

        $form .= '</form>';

        return $form;
    }

    public function getReportData($_fromDate, $_toDate, $_metrics, $_options = array())
    {
        $data = array();
        if ( $this->isActivated() ) {
            $_ga = 'ga:'.$this->profile_id;
            /*$_fromDate = '30daysAgo';
            $_toDate = 'yesterday';
            $_metrics = 'ga:sessions,ga:users,ga:pageviews,ga:BounceRate,ga:organicSearches,ga:pageviewsPerSession';*/
            $data = $this->service->data_ga->get( $_ga, $_fromDate, $_toDate, $_metrics, $_options);

            return $data;
        }
        return $data;
    }
}
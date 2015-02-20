<?php

require_once(PATH_SDK_ROOT . 'Core/CoreConstants.php');

/**
 * This file is unique to the PHP SDK, it is designed to
 * handle configuration requests that are handled in a more
 * native manner in the .NET version of the SDK
 */
class ConfigurationManager
{
	/**
	 * App specific settings
	 * @param string targetSetting
	 */
	public static function AppSettings($targetSetting)
	{
		// todo fix load_xml_file issue
		/*
		 * libxml_disable_entity_loader(false);
		$alias = 'common.plugins.integration.quickbooks';
		$path = Yii::getPathOfAlias($alias);
		$fileName = $path . CoreConstants::SLASH_CHAR . "config" . CoreConstants::SLASH_CHAR."App.Config";
		$xmlObj = simplexml_load_file($fileName);*/
		$xmlstring = '<?xml version="1.0" encoding="utf-8"?>
						<configuration>
						  <intuit>
							<ipp>
							  <!--Json serialization not supported in PHP SDK v1.0.0 -->
							  <message>
								<request serializationFormat="Xml" compressionFormat="None"/>
								<response serializationFormat="Xml" compressionFormat="None"/>
							  </message>
							  <service>
								<baseUrl qbd="https://sandbox-quickbooks.api.intuit.com/" qbo="https://sandbox-quickbooks.api.intuit.com/" />
							  </service>
							</ipp>
						  </intuit>
						  <appSettings>
							<!--These samples use a hard-coded realm ID and OAuth tokens.  Enter the values below. -->
							<add key="AccessToken" value="qyprdb6yhuZciBLSt7ApYOIG8XYQ6Xe3Qaddopm3jwrVHo4a" />
							<add key="AccessTokenSecret" value="6sJzm5jIJ7cqoAXTmxUD4RhmQTN6o8kc41ompDo7" />
							<add key="ConsumerKey" value="qyprdSoBkdpPkrQNVikxxHYTH1MmDn" />
							<add key="ConsumerSecret" value="figQIznrE9orJZAqexUWhxoXn2Wvm8vp5hkms7Bw" />
							<add key="RealmID" value="1315125545" />
						  </appSettings>
						</configuration>';
		$xmlObj = simplexml_load_string($xmlstring);
		$oneXPathTest = '//appSettings/add[@key="'.$targetSetting.'"]';
		$result = $xmlObj->xpath($oneXPathTest);

		$returnVal = NULL;
		if ($result && $result[0])
		{
			foreach($result[0]->attributes() as $attrName => $attrVal)
			{
				if ('value'==$attrName)
				{
					$returnVal = (string)$attrVal;
					break;
				}
			}
		}
		
		return $returnVal;
	}
}

?>

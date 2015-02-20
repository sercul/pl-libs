<?php
/**
 * Copyright 2014 David T. Sadler
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Include the SDK by using the autoloader from Composer.
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * Include the configuration values.
 *
 * Ensure that you have edited the configuration.php file
 * to include your application keys.
 *
 * For more information about getting your application keys, see:
 * http://devbay.net/sdk/guides/application-keys/
 */
$config = require __DIR__.'/../configuration.php';

/**
 * The namespaces provided by the SDK.
 */
use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Trading\Services;
use \DTS\eBaySDK\Trading\Types;
use \DTS\eBaySDK\Trading\Enums;

/**
 * Specify the numerical site id that we want the listing to appear on.
 *
 * This determines the validation rules that eBay will apply to the request.
 * For example, it will determine what categories can be specified, the values
 * allowed as shipping services, the visibility of the item in some searches and other
 * information.
 *
 * Note that due to the risk of listing fees been raised this example will list the item
 * to the sandbox site.
 *
 * It is important to note that you do not list to the US site. The categories that support
 * parts compatibility are only available on the eBay Motors site which has a different site Id
 * to the regular US site.
 */
$siteId = Constants\SiteIds::MOTORS;

/**
 * Create the service object.
 *
 * For more information about creating a service object, see:
 * http://devbay.net/sdk/guides/getting-started/#service-object
 */
$service = new Services\TradingService(array(
    'apiVersion' => $config['tradingApiVersion'],
    'sandbox' => true,
    'siteId' => $siteId
));

/**
 * Create the request object.
 *
 * For more information about creating a request object, see:
 * http://devbay.net/sdk/guides/getting-started/#request-object
 */
$request = new Types\AddItemRequestType();

/**
 * An user token is required when using the Trading service.
 *
 * For more information about getting your user tokens, see:
 * http://devbay.net/sdk/guides/application-keys/
 */
$request->RequesterCredentials = new Types\CustomSecurityHeaderType();
$request->RequesterCredentials->eBayAuthToken = $config['sandbox']['userToken'];

/**
 * Begin creating the item.
 */
$item = new Types\ItemType();

$item->Title = 'Brake Pads';
$item->Description = 'Brake pads for your car';

/**
 * List in the eBay Motors > Parts & Accessories > Car & Truck Parts > Brakes > Pads & Shoes (33567) category.
 */
$item->PrimaryCategory = new Types\CategoryType();
$item->PrimaryCategory->CategoryID = '33567';

/**
 * For this example we want a listing that will be compatible with the following vehicles.
 *
 * | Year | Make       | Model              | Trim                  | Engine                                     |
 * |-------------------------------------------------------------------------------------------------------------|
 * | 2015 | BMW        | 320i               | All Trims             | All Engines                                |
 * | 2011 | Nissan     | Leaf               | SV Hatchback 4-Door   | ELECTRIC                                   |
 * | 2015 | Land Rover | Range Rover Evoque | Autobiography Dynamic | 2.0L 1999CC 122Cu. In. l4 GAS Turbocharged |
 * | 2014 | Ford       | Fiesta             | All Trims             | All Engines                                |
 *
 * Note that where we state All Trims and All Engines, we are telling eBay that the listing is compatible with
 * all the vehicles for the specified Year, Make and Model. When the item is listed eBay will automatically expand
 * the list to include all those vehicles.
 */
$item->ItemCompatibilityList = new Types\ItemCompatibilityListType();

/**
 * Begin with our first vehicle
 * Year   - 2015
 * Make   - BMW
 * Model  - 320i
 * Trim   - All Trims
 * Engine - All Engines
 */
$compatibility = new Types\ItemCompatibilityType();
$compatibility->CompatibilityNotes = 'An example compatibility';

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Year';
$nameValue->Value = array('2015');
$compatibility->NameValueList[] = $nameValue;

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Make';
$nameValue->Value = array('BMW');
$compatibility->NameValueList[] = $nameValue;

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Model';
$nameValue->Value = array('320i');
$compatibility->NameValueList[] = $nameValue;

/**
 * Note that we do not have to specify Trim and Engine, we can leave them out of the request
 * and eBay will assume that we mean all trims and engines.
 */
$item->ItemCompatibilityList->Compatibility[] = $compatibility;

/**
 * Year   - 2011
 * Make   - Nissan
 * Model  - Leaf
 * Trim   - SV Hatchback 4-Door
 * Engine - ELECTRIC
 */
$compatibility = new Types\ItemCompatibilityType();
$compatibility->CompatibilityNotes = 'An example compatibility';

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Year';
$nameValue->Value = array('2011');
$compatibility->NameValueList[] = $nameValue;

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Make';
$nameValue->Value = array('Nissan');
$compatibility->NameValueList[] = $nameValue;

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Model';
$nameValue->Value = array('Leaf');
$compatibility->NameValueList[] = $nameValue;

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Trim';
$nameValue->Value = array('SV Hatchback 4-Door');
$compatibility->NameValueList[] = $nameValue;

$nameValue = new Types\NameValueListType();
$nameValue->Name = 'Engine';
$nameValue->Value = array('ELECTRIC');
$compatibility->NameValueList[] = $nameValue;

$item->ItemCompatibilityList->Compatibility[] = $compatibility;

/**
 * Year   - 2015
 * Make   - Land Rover
 * Model  - Range Rover Evoque
 * Trim   - Autobiography Dynamic
 * Engine - 2.0L 1999CC 122Cu. In. l4 GAS Turbocharged
 *
 * The SDK allows properties to be specified when constructing new objects.
 * By taking advantage of this feature we can add a compatibility as follows.
 */
$item->ItemCompatibilityList->Compatibility[] = new Types\ItemCompatibilityType(array(
    'CompatibilityNotes' => 'An example compatibility',
    'NameValueList' => array(
        new Types\NameValueListType(array('Name' => 'Year', 'Value' => array('2015'))),
        new Types\NameValueListType(array('Name' => 'Make', 'Value' => array('Land Rover'))),
        new Types\NameValueListType(array('Name' => 'Model', 'Value' => array('Range Rover Evoque'))),
        new Types\NameValueListType(array('Name' => 'Trim', 'Value' => array('Autobiography Dynamic'))),
        new Types\NameValueListType(array('Name' => 'Engine', 'Value' => array('2.0L 1999CC 122Cu. In. l4 GAS Turbocharged')))
    )
));

/**
 * Year   - 2014
 * Make   - Ford
 * Model  - Fiesta
 * Trim   - All Trims
 * Engine - All Engines
 */
$item->ItemCompatibilityList->Compatibility[] = new Types\ItemCompatibilityType(array(
    'CompatibilityNotes' => 'An example compatibility',
    'NameValueList' => array(
        new Types\NameValueListType(array('Name' => 'Year', 'Value' => array('2014'))),
        new Types\NameValueListType(array('Name' => 'Make', 'Value' => array('Ford'))),
        new Types\NameValueListType(array('Name' => 'Model', 'Value' => array('Fiesta')))
    )
));

/**
 * Provide enough information so that the item is listed.
 * It is beyond the scope of this example to go into any detail.
 */
$item->ListingType = Enums\ListingTypeCodeType::C_FIXED_PRICE_ITEM;
$item->Quantity = 99;
$item->ListingDuration = Enums\ListingDurationCodeType::C_GTC;
$item->StartPrice = new Types\AmountType(array('value' => 19.99));
$item->Country = 'US';
$item->Location = 'Beverly Hills';
$item->Currency = 'USD';
$item->ConditionID = 1000;
$item->PaymentMethods[] = 'PayPal';
$item->PayPalEmailAddress = 'example@example.com';
$item->DispatchTimeMax = 1;
$item->ShipToLocations[] = 'None';
$item->ReturnPolicy = new Types\ReturnPolicyType();
$item->ReturnPolicy->ReturnsAcceptedOption = 'ReturnsNotAccepted';

/**
 * Finish the request object.
 */
$request->Item = $item;

/**
 * Send the request to the AddItem service operation.
 *
 * For more information about calling a service operation, see:
 * http://devbay.net/sdk/guides/getting-started/#service-operation
 */
$response = $service->addItem($request);

/**
 * Output the result of calling the service operation.
 *
 * For more information about working with the service response object, see:
 * http://devbay.net/sdk/guides/getting-started/#response-object
 */
if (isset($response->Errors)) {
    foreach ($response->Errors as $error) {
        printf("%s: %s\n%s\n\n",
            $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
            $error->ShortMessage,
            $error->LongMessage
        );
    }
}

if ($response->Ack !== 'Failure') {
    printf("The item was listed to the eBay Sandbox with the Item number %s\n",
        $response->ItemID
    );
}

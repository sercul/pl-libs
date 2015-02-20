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
 * Configuration settings used by all of the examples.
 * 
 * Specify your eBay application keys in the appropriate places.
 *
 * Be careful not to commit this file into an SCM repository.
 * You risk exposing your eBay application keys to more people than intended.
 *
 * For more information about the configuration, see:
 * http://devbay.net/sdk/guides/sample_project.html#configuration
 */
return array(
    'sandbox' => array(
        'devId' => '2a31c075-c2ba-4d52-a25c-68a90cbe104f',
        'appId' => 'Plexisof-e142-4f80-958a-323118b2d810',
        'certId' => '2dcc163b-ef0b-4ba0-b40c-eff4468d9361',
        'userToken' => 'AgAAAA**AQAAAA**aAAAAA**t77TVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDZKLoQydj6x9nY+seQ**YUQDAA**AAMAAA**MLI5jjiFgss45FvV8+n8xm53UWxi6ghGfveYiH3mU/fbTtz8ATPlM2dizet7ltQoXhNfRLK6quYnbXQDbtMmysus/v9jO9HSvrD8UQ0Ltz6RSIUSvumRa2YIf6Z5i1Y65wB/sDzHliuJkSdwMgGgSNfhhhb6NRJkx+4FULfzf2DxxdpwpHxnBbgK3K+DzENqxm5pHIyzGvpORBaOjkqVyo+1o3Xh2zFdBXXedg3CGDgWYApt6rcPa9YjvLcwQda35HdV14Bh5r5NPZ6hyABmvEjZpBAZiVP9WUYy/qDWViWfGdeyo+mccntC3FEvuFfd2QvkzhfTR7f6nOPlHAzOrh+xvRe/i031ZEmY7Ughaigf8Y/qsE2uhHM09q8dVaWdoOh8NTMojQ589OJR+GwJD/pdoc3RPXWizQ+B8CpfjezEyrF2sdKqS8rik6RUnmljpETon0nVaKBLAF2M9ww0ZwgZeBwvShW/PB2PpQd4e2p2TJoxbRiaGmtzSAaip6GJUXRFZyq/AxZN5nmH92E2jRgbUu7DzpOJHI1WoTD5SNA07sw9d90wi9GxtORGlse9+RynBQ/lMZw9KZfCEQ9DWlRBwCJrieAx1t1VyRxJT01vMmsK4rgy42AkiCuRS9NddxEeAVg3ImRAXC+INwqYkoZjUbIWmAIkL7p3ymYu5eaSYDY1zwczYNeEhpLWddH98M9qC3nDxD+1b3QzGCwlpI3O5sv9UJOakxxBlmEstudj2UZjoncR9bxRawTr9Cgl'
    ),
    'production' => array(
        'devId' => 'YOUR_PRODUCTION_DEVID_APPLICATION_KEY',
        'appId' => 'YOUR_PRODUCTION_APPID_APPLICATION_KEY',
        'certId' => 'YOUR_PRODUCTION_CERTID_APPLICATION_KEY',
        'userToken' => 'YOUR_PRODUCTION_USER_TOKEN_APPLICATION_KEY'
    ),
    'findingApiVersion' => '1.12.0',
    'tradingApiVersion' => '871',
    'shoppingApiVersion' => '871',
    'halfFindingApiVersion' => '1.2.0'
);

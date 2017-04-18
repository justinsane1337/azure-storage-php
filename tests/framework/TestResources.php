<?php

/**
 * LICENSE: The MIT License (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * https://github.com/azure/azure-storage-php/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP version 5
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Tests\Framework
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */

namespace MicrosoftAzure\Storage\Tests\framework;

use MicrosoftAzure\Storage\Table\Models\EdmType;
use MicrosoftAzure\Storage\Table\Models\Entity;
use MicrosoftAzure\Storage\Common\Internal\Utilities;
use MicrosoftAzure\Storage\Common\Internal\Resources;
use MicrosoftAzure\Storage\Common\Internal\Http\HttpCallContext;
use MicrosoftAzure\Storage\Table\Models\BatchOperation;
use MicrosoftAzure\Storage\Table\Models\BatchOperationType;
use MicrosoftAzure\Storage\Table\Models\UpdateEntityResult;
use GuzzleHttp\Psr7\Response;

/**
 * Resources for testing framework.
 *
 * @package    MicrosoftAzure\Storage\Tests\Framework
 * @author     Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright  2016 Microsoft Corporation
 * @license    https://github.com/azure/azure-storage-php/LICENSE
 * @link       https://github.com/azure/azure-storage-php
 */
class TestResources
{
    const QUEUE1_NAME   = 'Queue1';
    const QUEUE2_NAME   = 'Queue2';
    const QUEUE3_NAME   = 'Queue3';
    const KEY1          = 'key1';
    const KEY2          = 'key2';
    const KEY3          = 'key3';
    const KEY4          = 'AhlzsbLRkjfwObuqff3xrhB2yWJNh1EMptmcmxFJ6fvPTVX3PZXwrG2YtYWf5DPMVgNsteKStM5iBLlknYFVoA=='; //Faked although looks real.
    const VALUE1        = 'value1';
    const VALUE2        = 'value2';
    const VALUE3        = 'value3';
    const ACCOUNT_NAME  = 'myaccount';
    const SAS_TOKEN     = 'st=2016-12-01T19%3A43%3A00Z&se=2016-12-02T19%3A43%3A00Z&sp=rwdl&sv=2015-12-11&sr=c&sig=aGVsbG8gd29ybGQ%3D';
    const QUEUE_URI     = '.queue.core.windows.net';
    const URI1          = "http://myaccount.queue.core.windows.net/myqueue";
    const URI2          = "http://myaccount.queue.core.windows.net/?comp=list";
    const DATE1         = 'Sat, 18 Feb 2012 16:25:21 GMT';
    const DATE2         = 'Mon, 20 Feb 2012 17:12:31 GMT';
    const REQUEST_ID1   = 'f16b5298-0003-011e-0e70-83666b000000';
    const REQUEST_ID2   = 'c17dcd76-0003-0046-1c70-832445000000';
    const RESPONSE_BODY = "<?xml version=\"1.0\" encoding=\"utf-8\"?><Error><Code>InvalidResourceName</Code><Message>The specifed resource name contains invalid characters.\nRequestId:f16b5298-0003-011e-0e70-83666b000000\nTime:2017-02-10T07:36:04.8329883Z</Message></Error>";
    const ERROR_MESSAGE = "The specifed resource name contains invalid characters.\nRequestId:f16b5298-0003-011e-0e70-83666b000000\nTime:2017-02-10T07:36:04.8329883Z";
    const VALID_URL     = 'http://www.example.com';
    const HEADER1       = 'testheader1';
    const HEADER2       = 'testheader2';
    const HEADER1_VALUE = 'HeaderValue1';
    const HEADER2_VALUE = 'HeaderValue2';

    // Media services
    const MEDIA_SERVICES_ASSET_NAME             = 'TestAsset';
    const MEDIA_SERVICES_OUTPUT_ASSET_NAME      = 'TestOutputAsset';
    const MEDIA_SERVICES_ACCESS_POLICY_NAME     = 'TestAccessPolicy';
    const MEDIA_SERVICES_LOCATOR_NAME           = 'TestLocator';
    const MEDIA_SERVICES_JOB_NAME               = 'TestJob';
    const MEDIA_SERVICES_JOB_ID_PREFIX          = 'nb:jid:UUID:';
    const MEDIA_SERVICES_JOB_TEMPLATE_NAME      = 'TestJobTemplate';
    const MEDIA_SERVICES_JOB_TEMPLATE_ID_PREFIX = 'nb:jtid:UUID:';
    const MEDIA_SERVICES_TASK_COFIGURATION      = 'H.264 HD 720p VBR';
    const MEDIA_SERVICES_PROCESSOR_NAME         = 'Windows Azure Media Encoder';
    const MEDIA_SERVICES_DECODE_PROCESSOR_NAME  = 'Storage Decryption';
    const MEDIA_SERVICES_PROCESSOR_ID_PREFIX    = 'nb:mpid:UUID:';
    const MEDIA_SERVICES_DUMMY_FILE_NAME        = 'simple.avi';
    const MEDIA_SERVICES_DUMMY_FILE_CONTENT     = 'test file content';
    const MEDIA_SERVICES_DUMMY_FILE_NAME_1      = 'other.avi';
    const MEDIA_SERVICES_DUMMY_FILE_CONTENT_1   = 'other file content';
    const MEDIA_SERVICES_ISM_FILE_NAME          = 'small.ism';
    const MEDIA_SERVICES_ISMC_FILE_NAME         = 'small.ismc';
    const MEDIA_SERVICES_STREAM_APPEND          = 'Manifest';
    const MEDIA_SERVICES_INGEST_MANIFEST        = 'TestIngestManifest';
    const MEDIA_SERVICES_INGEST_MANIFEST_ASSET  = 'TestIngestManifestAsset';
    const MEDIA_SERVICES_CONTENT_KEY_AUTHORIZATION_POLICY_NAME     = 'TestContentKeyAuthorizationPolicy';
    const MEDIA_SERVICES_CONTENT_KEY_AUTHORIZATION_OPTIONS_NAME    = 'TestContentKeyAuthorizationPolicyOption';
    const MEDIA_SERVICES_CONTENT_KEY_AUTHORIZATION_POLICY_RESTRICTION_NAME = 'TestContentKeyAuthorizationPolicyRestriction';
    const MEDIA_SERVICES_ASSET_DELIVERY_POLICY_NAME = 'AssetDeliveryPolicyName';

    // See https://tools.ietf.org/html/rfc2616
    const STATUS_NOT_MODIFIED          = 304;
    const STATUS_BAD_REQUEST           = 400;
    const STATUS_UNAUTHORIZED          = 401;
    const STATUS_FORBIDDEN             = 403;
    const STATUS_NOT_FOUND             = 404;
    const STATUS_CONFLICT              = 409;
    const STATUS_PRECONDITION_FAILED   = 412;
    const STATUS_INTERNAL_SERVER_ERROR = 500;

    public static function getInterestingName($prefix)
    {
        $rint = mt_rand(0, 1000000);
        return $prefix . $rint . 'ft';
    }

    public static function getSASInterestingUTCases()
    {
        $testCases = array();

        // The SAS token is all generated with fake key.
        $testCases[] = [
            "2016-05-31", // signedVersion
            "rwdlacup", // signedPermission
            "bfqt", // signedService
            "sco", // signedResourceType
            "2017-03-24T21:14:01Z", // signedExpiracy
            "2017-03-17T13:14:01Z", // signedStart
            "", // signedIP
            "https", // signedProtocol
            "sv%3D2016-05-31%26ss%3Dbqtf%26srt%3Dsco%26sp%3Drwdlacup%26se%3D2017-03-24T21%3A14%3A01Z%26st%3D2017-03-17T13%3A14%3A01Z%26spr%3Dhttps%26sig%3DiApmwEEGPc6EqjvBCekfEons2NRs7aGC1frKyWEO8g8%253D" // expectedSignature
        ];

        $testCases[] = [
            "2016-05-31", // signedVersion
            "rwdlacup", // signedPermission
            "bfqt", // signedService
            "sco", // signedResourceType
            "2017-03-24T21:14:01Z", // signedExpiracy
            "2017-03-17T13:14:01Z", // signedStart
            "168.1.5.65", // signedIP
            "https,http", // signedProtocol
            "sv%3D2016-05-31%26ss%3Dbqtf%26srt%3Dsco%26sp%3Drwdlacup%26se%3D2017-03-24T21%3A14%3A01Z%26st%3D2017-03-17T13%3A14%3A01Z%26sip%3D168.1.5.65%26spr%3Dhttps%2Chttp%26sig%3D2FT%252FEl0rqE1uwVODaKzBNQKHJeJM3vUsGbr%252FQtwLVcs%253D" // expectedSignature
        ];

        $testCases[] = [
            "2016-05-31", // signedVersion
            "rw", // signedPermission
            "bf", // signedService
            "s", // signedResourceType
            "2017-03-24T00:00:00Z", // signedExpiracy
            "2017-03-17T00:00:00Z", // signedStart
            "", // signedIP
            "https", // signedProtocol
            "sv%3D2016-05-31%26ss%3Dbf%26srt%3Ds%26sp%3Drw%26se%3D2017-03-24T00%3A00%3A00Z%26st%3D2017-03-17T00%3A00%3A00Z%26spr%3Dhttps%26sig%3DoSxrFQuddGNRUJYab3jU7nhcoSgJaceA%252FFH9EY5istY%253D" // expectedSignature
        ];

        $testCases[] = [
            "2016-05-31", // signedVersion
            "up", // signedPermission
            "q", // signedService
            "o", // signedResourceType
            "2017-03-24T00:00:00Z", // signedExpiracy
            "2017-03-17T00:00:00Z", // signedStart
            "", // signedIP
            "https", // signedProtocol
            "sv%3D2016-05-31%26ss%3Dq%26srt%3Do%26sp%3Dup%26se%3D2017-03-24T00%3A00%3A00Z%26st%3D2017-03-17T00%3A00%3A00Z%26spr%3Dhttps%26sig%3D4fMFk%252BFE%252BE90wTPMCGY%252FF%252FplPrDM%252BO8veJi1GmY5wWA%253D" // expectedSignature
        ];

        return $testCases;
    }

    public static function getValidAccessPermission()
    {
        $result = array();
        $result['Blob'][]      = ['dwcar', 'racwd'];
        $result['Blob'][]      = ['waradadawadaca', 'racwd'];
        $result['Container'][] = ['ldwcar', 'racwdl'];
        $result['Container'][] = ['rcal', 'racl'];
        $result['Table'][]     = ['dar', 'rad'];
        $result['Table'][]     = ['duardduar', 'raud'];
        $result['Queue'][]     = ['puar', 'raup'];
        $result['Queue'][]     = ['ppap', 'ap'];

        return $result;
    }

    public static function getInvalidAccessPermission()
    {
        $result = array();
        $result['Blob'][]      = 'dwcarl';
        $result['Blob'][]      = 'waradadawadacap';
        $result['Container'][] = 'ldwcarsdf';
        $result['Container'][] = 'rcalfds';
        $result['Table'][]     = 'darwer';
        $result['Table'][]     = 'duardduaras';
        $result['Queue'][]     = 'puarzxcv';
        $result['Queue'][]     = '!ppap!';

        return $result;
    }

    public static function getWindowsAzureStorageServicesConnectionString()
    {
        $connectionString = getenv('AZURE_STORAGE_CONNECTION_STRING');

        if (empty($connectionString)) {
            throw new \Exception('AZURE_STORAGE_CONNECTION_STRING envionment variable is missing');
        }

        return $connectionString;
    }

    public static function getEmulatorStorageServicesConnectionString()
    {
        $developmentStorageConnectionString = 'UseDevelopmentStorage=true';

        return $developmentStorageConnectionString;
    }

    public static function getFailedResponse($statusCode, $reason)
    {
        return new Response(
            $statusCode,
            array(
                Resources::DATE => self::DATE1,
                Resources::X_MS_REQUEST_ID => self::REQUEST_ID1
            ),
            self::RESPONSE_BODY,
            '1.1',
            $reason
        );
    }

    public static function getServiceManagementConnectionString()
    {
        $connectionString = getenv('AZURE_SERVICE_MANAGEMENT_CONNECTION_STRING');

        if (empty($connectionString)) {
            throw new \Exception('AZURE_SERVICE_MANAGEMENT_CONNECTION_STRING envionment variable is missing');
        }

        return $connectionString;
    }

    public static function getServiceBusConnectionString()
    {
        $connectionString = getenv('AZURE_SERVICE_BUS_CONNECTION_STRING');

        if (empty($connectionString)) {
            throw new \Exception('AZURE_SERVICE_BUS_CONNECTION_STRING enviroment variable is missing.');
        }

        return $connectionString;
    }

    public static function simplePackageUrl()
    {
        $name = getenv('SERVICE_MANAGEMENT_SIMPLE_PACKAGE_URL');

        if (empty($name)) {
            throw new \Exception('SERVICE_MANAGEMENT_SIMPLE_PACKAGE_URL envionment variable is missing');
        }

        return $name;
    }

    public static function simplePackageConfiguration()
    {
        $name = getenv('SERVICE_MANAGEMENT_SIMPLE_PACKAGE_CONFIGURATION');

        if (empty($name)) {
            throw new \Exception('SERVICE_MANAGEMENT_SIMPLE_PACKAGE_CONFIGURATION envionment variable is missing');
        }

        return $name;
    }

    public static function complexPackageUrl()
    {
        $name = getenv('SERVICE_MANAGEMENT_COMPLEX_PACKAGE_URL');

        if (empty($name)) {
            throw new \Exception('SERVICE_MANAGEMENT_COMPLEX_PACKAGE_URL envionment variable is missing');
        }

        return $name;
    }

    public static function complexPackageConfiguration()
    {
        $name = getenv('SERVICE_MANAGEMENT_COMPLEX_PACKAGE_CONFIGURATION');

        if (empty($name)) {
            throw new \Exception('SERVICE_MANAGEMENT_COMPLEX_PACKAGE_CONFIGURATION envionment variable is missing');
        }

        return $name;
    }

    public static function getMediaServicesConnectionParameters()
    {
        return array(
            'accountName'       => self::getEnvironmentVariable('AZURE_MEDIA_SERVICES_ACCOUNT_NAME'),
            'accessKey'         => self::getEnvironmentVariable('AZURE_MEDIA_SERVICES_ACCESS_KEY'),
            'endpointUri'       => self::getEnvironmentVariable('AZURE_MEDIA_SERVICES_ENDPOINT_URI', false),
            'oauthEndopointUri' => self::getEnvironmentVariable('AZURE_MEDIA_SERVICES_OAUTH_ENDPOINT_URI', false),
        );
    }

    private static function getEnvironmentVariable($name, $required = true)
    {
        $value = getenv($name);

        if (empty($value) && $required) {
            throw new \Exception("{$name} enviroment variable is missing.");
        }

        return $value;
    }

    public static function getCORSSingle()
    {
        $sample = array();
        $sample['AllowedOrigins'] =
            'http://www.microsoft.com,http://www.bing.com';
        $sample['AllowedMethods'] = 'GET,PUT';
        $sample['MaxAgeInSeconds'] = '500';
        $sample['ExposedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-data0*';
        $sample['AllowedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-target0*';
        
        return $sample;
    }

    public static function getServicePropertiesSample()
    {
        $sample = array();
        $sample['Logging']['Version'] = '1.0';
        $sample['Logging']['Delete'] = 'true';
        $sample['Logging']['Read'] = 'false';
        $sample['Logging']['Write'] = 'true';
        $sample['Logging']['RetentionPolicy']['Enabled'] = 'true';
        $sample['Logging']['RetentionPolicy']['Days'] = '20';
        $sample['HourMetrics']['Version'] = '1.0';
        $sample['HourMetrics']['Enabled'] = 'true';
        $sample['HourMetrics']['IncludeAPIs'] = 'false';
        $sample['HourMetrics']['RetentionPolicy']['Enabled'] = 'true';
        $sample['HourMetrics']['RetentionPolicy']['Days'] = '20';
        $sample['MinuteMetrics']['Version'] = '1.0';
        $sample['MinuteMetrics']['Enabled'] = 'true';
        $sample['MinuteMetrics']['IncludeAPIs'] = 'false';
        $sample['MinuteMetrics']['RetentionPolicy']['Enabled'] = 'true';
        $sample['MinuteMetrics']['RetentionPolicy']['Days'] = '20';
        //1st cors
        $sample['Cors']['CorsRule'][0]['AllowedOrigins'] =
            'http://www.microsoft.com,http://www.bing.com';
        $sample['Cors']['CorsRule'][0]['AllowedMethods'] = 'GET,PUT';
        $sample['Cors']['CorsRule'][0]['MaxAgeInSeconds'] = '500';
        $sample['Cors']['CorsRule'][0]['ExposedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-data0*';
        $sample['Cors']['CorsRule'][0]['AllowedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-target0*';
        //2nd cors
        $sample['Cors']['CorsRule'][1]['AllowedOrigins'] =
            'http://www.azure.com,http://www.office.com';
        $sample['Cors']['CorsRule'][1]['AllowedMethods'] = 'POST,HEAD';
        $sample['Cors']['CorsRule'][1]['MaxAgeInSeconds'] = '350';
        $sample['Cors']['CorsRule'][1]['ExposedHeaders'] =
            'x-ms-meta-customheader1,x-ms-meta-data1*';
        $sample['Cors']['CorsRule'][1]['AllowedHeaders'] =
            'x-ms-meta-customheader1,x-ms-meta-target1*';

        return $sample;
    }

    public static function setServicePropertiesSample()
    {
        $sample = array();
        $sample['Logging']['Version'] = '1.0';
        $sample['Logging']['Delete'] = 'true';
        $sample['Logging']['Read'] = 'false';
        $sample['Logging']['Write'] = 'true';
        $sample['Logging']['RetentionPolicy']['Enabled'] = 'true';
        $sample['Logging']['RetentionPolicy']['Days'] = '10';
        $sample['HourMetrics']['Version'] = '1.0';
        $sample['HourMetrics']['Enabled'] = 'true';
        $sample['HourMetrics']['IncludeAPIs'] = 'false';
        $sample['HourMetrics']['RetentionPolicy']['Enabled'] = 'true';
        $sample['HourMetrics']['RetentionPolicy']['Days'] = '10';
        $sample['MinuteMetrics']['Version'] = '1.0';
        $sample['MinuteMetrics']['Enabled'] = 'true';
        $sample['MinuteMetrics']['IncludeAPIs'] = 'false';
        $sample['MinuteMetrics']['RetentionPolicy']['Enabled'] = 'true';
        $sample['MinuteMetrics']['RetentionPolicy']['Days'] = '10';
        //1st cors
        $sample['Cors']['CorsRule'][0]['AllowedOrigins'] =
            'http://www.microsoft.com,http://www.bing.com';
        $sample['Cors']['CorsRule'][0]['AllowedMethods'] = 'GET,PUT';
        $sample['Cors']['CorsRule'][0]['MaxAgeInSeconds'] = '500';
        $sample['Cors']['CorsRule'][0]['ExposedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-data0*';
        $sample['Cors']['CorsRule'][0]['AllowedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-target0*';
        //2nd cors
        $sample['Cors']['CorsRule'][1]['AllowedOrigins'] =
            'http://www.azure.com,http://www.office.com';
        $sample['Cors']['CorsRule'][1]['AllowedMethods'] = 'POST,HEAD';
        $sample['Cors']['CorsRule'][1]['MaxAgeInSeconds'] = '350';
        $sample['Cors']['CorsRule'][1]['ExposedHeaders'] =
            'x-ms-meta-customheader1,x-ms-meta-data1*';
        $sample['Cors']['CorsRule'][1]['AllowedHeaders'] =
            'x-ms-meta-customheader1,x-ms-meta-target1*';

        return $sample;
    }

    public static function setBlobServicePropertiesSample()
    {
        $sample = array();
        $sample['Logging']['Version'] = '1.0';
        $sample['Logging']['Delete'] = 'true';
        $sample['Logging']['Read'] = 'false';
        $sample['Logging']['Write'] = 'true';
        $sample['Logging']['RetentionPolicy']['Enabled'] = 'true';
        $sample['Logging']['RetentionPolicy']['Days'] = '10';
        $sample['HourMetrics']['Version'] = '1.0';
        $sample['HourMetrics']['Enabled'] = 'true';
        $sample['HourMetrics']['IncludeAPIs'] = 'false';
        $sample['HourMetrics']['RetentionPolicy']['Enabled'] = 'true';
        $sample['HourMetrics']['RetentionPolicy']['Days'] = '10';
        $sample['MinuteMetrics']['Version'] = '1.0';
        $sample['MinuteMetrics']['Enabled'] = 'true';
        $sample['MinuteMetrics']['IncludeAPIs'] = 'false';
        $sample['MinuteMetrics']['RetentionPolicy']['Enabled'] = 'true';
        $sample['MinuteMetrics']['RetentionPolicy']['Days'] = '10';
        //1st cors
        $sample['Cors']['CorsRule'][0]['AllowedOrigins'] =
            'http://www.microsoft.com,http://www.bing.com';
        $sample['Cors']['CorsRule'][0]['AllowedMethods'] = 'GET,PUT';
        $sample['Cors']['CorsRule'][0]['MaxAgeInSeconds'] = '500';
        $sample['Cors']['CorsRule'][0]['ExposedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-data0*';
        $sample['Cors']['CorsRule'][0]['AllowedHeaders'] =
            'x-ms-meta-customheader0,x-ms-meta-target0*';
        //2nd cors
        $sample['Cors']['CorsRule'][1]['AllowedOrigins'] =
            'http://www.azure.com,http://www.office.com';
        $sample['Cors']['CorsRule'][1]['AllowedMethods'] = 'POST,HEAD';
        $sample['Cors']['CorsRule'][1]['MaxAgeInSeconds'] = '350';
        $sample['Cors']['CorsRule'][1]['ExposedHeaders'] =
            'x-ms-meta-customheader1,x-ms-meta-data1*';
        $sample['Cors']['CorsRule'][1]['AllowedHeaders'] =
            'x-ms-meta-customheader1,x-ms-meta-target1*';
        $sample['DefaultServiceVersion'] = '2015-04-05';

        return $sample;
    }

    public static function listMessagesSample()
    {
        $sample = array();
        $sample['QueueMessage']['MessageId']       = '5974b586-0df3-4e2d-ad0c-18e3892bfca2';
        $sample['QueueMessage']['InsertionTime']   = 'Fri, 09 Oct 2009 21:04:30 GMT';
        $sample['QueueMessage']['ExpirationTime']  = 'Fri, 16 Oct 2009 21:04:30 GMT';
        $sample['QueueMessage']['PopReceipt']      = 'YzQ4Yzg1MDItYTc0Ny00OWNjLTkxYTUtZGM0MDFiZDAwYzEw';
        $sample['QueueMessage']['TimeNextVisible'] = 'Fri, 09 Oct 2009 23:29:20 GMT';
        $sample['QueueMessage']['DequeueCount']    = '1';
        $sample['QueueMessage']['MessageText']     = 'PHRlc3Q+dGhpcyBpcyBhIHRlc3QgbWVzc2FnZTwvdGVzdD4=';

        return $sample;
    }

    public static function listMessagesMultipleMessagesSample()
    {
        $sample = array();
        $sample['QueueMessage'][0]['MessageId']       = '5974b586-0df3-4e2d-ad0c-18e3892bfca2';
        $sample['QueueMessage'][0]['InsertionTime']   = 'Fri, 09 Oct 2009 21:04:30 GMT';
        $sample['QueueMessage'][0]['ExpirationTime']  = 'Fri, 16 Oct 2009 21:04:30 GMT';
        $sample['QueueMessage'][0]['PopReceipt']      = 'YzQ4Yzg1MDItYTc0Ny00OWNjLTkxYTUtZGM0MDFiZDAwYzEw';
        $sample['QueueMessage'][0]['TimeNextVisible'] = 'Fri, 09 Oct 2009 23:29:20 GMT';
        $sample['QueueMessage'][0]['DequeueCount']    = '1';
        $sample['QueueMessage'][0]['MessageText']     = 'PHRlc3Q+dGhpcyBpcyBhIHRlc3QgbWVzc2FnZTwvdGVzdD4=';

        $sample['QueueMessage'][1]['MessageId']       = '1234c20-0df3-4e2d-ad0c-18e3892bfca2';
        $sample['QueueMessage'][1]['InsertionTime']   = 'Sat, 10 Feb 2010 21:04:30 GMT';
        $sample['QueueMessage'][1]['ExpirationTime']  = 'Sat, 05 Jun 2010 21:04:30 GMT';
        $sample['QueueMessage'][1]['PopReceipt']      = 'QzW4Szf1MDItYTc0Ny00OWNjLTkxYTUtZGM0MDFiZDAwYzEw';
        $sample['QueueMessage'][1]['TimeNextVisible'] = 'Sun, 09 Oct 2009 23:29:20 GMT';
        $sample['QueueMessage'][1]['DequeueCount']    = '4';
        $sample['QueueMessage'][1]['MessageText']     = 'QWEFGlsc3Q+dGhpcyBpcyBhIHRlc3QgbWVzc2FnZTwvdGVzdD4=';

        return $sample;
    }

    public static function listQueuesEmpty()
    {
        $sample = array();
        $sample['Queues'] = '';
        $sample['NextMarker'] = '';

        return $sample;
    }

    public static function listQueuesOneEntry()
    {
        $sample = array();
        $sample['@attributes']['ServiceEndpoint'] = 'http://myaccount.blob.core.windows.net/';
        $sample['Marker'] = '/account/listqueueswithnextmarker3';
        $sample['MaxResults'] = '2';
        $sample['Queues'] = array('Queue' => array('Name' => 'myqueue'));
        $sample['NextMarker'] = '';

        return $sample;
    }

    public static function listQueuesMultipleEntries()
    {
        $sample = array();
        $sample['@attributes']['ServiceEndpoint'] = 'http://myaccount.blob.core.windows.net/';
        $sample['MaxResults'] = '2';
        $sample['Prefix'] = 'myprefix';
        $sample['Account'] = 'myaccount';
        $sample['Queues'] = array('Queue' => array(
          0 => array('Name' => 'myqueue1'),
          1 => array('Name' => 'myqueue2')
        ));
        $sample['NextMarker'] = '/account/myqueue3';

        return $sample;
    }

    public static function listContainersEmpty()
    {
        $sample = array();
        $sample['Containers'] = '';
        $sample['NextMarker'] = '';

        return $sample;
    }

    public static function listContainersOneEntry()
    {
        $sample = array();
        $sample['@attributes']['ServiceEndpoint'] = 'http://myaccount.blob.core.windows.net/';
        $sample['Marker'] = '/account/listqueueswithnextmarker3';
        $sample['MaxResults'] = '2';
        $sample['Containers'] = array('Container' => array(
            'Name' => 'audio',
            'Properties' => array(
                'Last-Modified' => 'Wed, 12 Aug 2009 20:39:39 GMT',
                'Etag' => '0x8CACB9BD7C6B1B2'
            )
            ));
        $sample['NextMarker'] = '';

        return $sample;
    }

    public static function listContainersMultipleEntries()
    {
        $sample = array();
        $sample['@attributes']['ServiceEndpoint'] = 'http://myaccount.blob.core.windows.net/';
        $sample['MaxResults'] = '3';
        $sample['account'] = 'myaccount';
        $sample['Prefix'] = 'myprefix';
        $sample['Containers'] = array('Container' => array(
          0 => array(
            'Name' => 'audio',
            'Properties' => array(
                'Last-Modified' => 'Wed, 12 Aug 2009 20:39:39 GMT',
                'Etag' => '0x8CACB9BD7C6B1B2'
            )
            ),
          1 => array(
            'Name' => 'images',
            'Properties' => array(
                'Last-Modified' => 'Wed, 12 Aug 2009 20:39:39 GMT',
                'Etag' => '0x8CACB9BD7C1EEEC'
            )
            )
        ));
        $sample['NextMarker'] = 'video';

        return $sample;
    }

    public static function getContainerAclOneEntrySample()
    {
        $sample = array();
        $sample['SignedIdentifiers'] = array('SignedIdentifier' => array(
            'Id' => 'MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'rwd')
            ));

        return $sample;
    }

    public static function getContainerAclMultipleEntriesSample()
    {
        $sample = array();
        $sample['SignedIdentifiers'] = array( 'SignedIdentifier' => array(
            0 => array('Id' => 'HYQzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'wd')),
            1 => array('Id' => 'MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'rwd'))
            ));

        return $sample;
    }

    public static function getQueueACLOneEntrySample()
    {
        $sample = array();
        $sample['SignedIdentifiers'] = array('SignedIdentifier' => array(
            'Id' => 'MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'ap')
            ));

        return $sample;
    }

    public static function getQueueACLMultipleEntriesSample()
    {
        $sample = array();
        $sample['SignedIdentifiers'] = array( 'SignedIdentifier' => array(
            0 => array('Id' => 'HYQzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'raup')),
            1 => array('Id' => 'MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'ru'))
            ));

        return $sample;
    }

    public static function getQueueACLMultipleUnencodedEntriesSample()
    {
        $sample = array();
        $sample['SignedIdentifiers'] = array( 'SignedIdentifier' => array(
            0 => array('Id' => 'HYQzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'raup')),
            1 => array('Id' => 'MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'ru'))
            ));

        return $sample;
    }

    public static function getQueueACLMultipleArraySample()
    {
        $sample = array();
        $sample[] = [
            'Id' => 'a',
            'AccessPolicy' => array(
                'Start' => self::getRandomEarlierTime(),
                'Expiry' => self::getRandomLaterTime(),
                'Permission' => 'raup')
        ];
        $sample[] = [
            'Id' => 'b',
            'AccessPolicy' => array(
                'Start' => self::getRandomEarlierTime(),
                'Expiry' => self::getRandomLaterTime(),
                'Permission' => 'raup')
        ];
        $sample[] = [
            'Id' => 'c',
            'AccessPolicy' => array(
                'Start' => self::getRandomEarlierTime(),
                'Expiry' => self::getRandomLaterTime(),
                'Permission' => 'raup')
        ];
        $sample[] = [
            'Id' => 'd',
            'AccessPolicy' => array(
                'Start' => self::getRandomEarlierTime(),
                'Expiry' => self::getRandomLaterTime(),
                'Permission' => 'raup')
        ];
        $sample[] = [
            'Id' => 'e',
            'AccessPolicy' => array(
                'Start' => self::getRandomEarlierTime(),
                'Expiry' => self::getRandomLaterTime(),
                'Permission' => 'raup')
        ];
        $sample[] = [
            'Id' => 'f',
            'AccessPolicy' => array(
                'Start' => self::getRandomEarlierTime(),
                'Expiry' => self::getRandomLaterTime(),
                'Permission' => 'raup')
        ];

        return $sample;
    }

    public static function getTableACLOneEntrySample()
    {
        $sample = array();
        $sample['SignedIdentifiers'] = array('SignedIdentifier' => array(
            'Id' => 'MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'ad')
            ));

        return $sample;
    }

    public static function getTableACLMultipleEntriesSample()
    {
        $sample = array();
        $sample['SignedIdentifiers'] = array( 'SignedIdentifier' => array(
            0 => array('Id' => 'HYQzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'raud')),
            1 => array('Id' => 'MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=',
            'AccessPolicy' => array(
                'Start' => Utilities::convertToEdmDateTime(self::getRandomEarlierTime()),
                'Expiry' => Utilities::convertToEdmDateTime(self::getRandomLaterTime()),
                'Permission' => 'ru'))
            ));

        return $sample;
    }

    public static function getRandomLaterTime()
    {
        $interval = mt_rand(10000, 65535);
        $now = new \DateTime();
        return $now->add(\DateInterval::createFromDateString($interval . ' seconds'));
    }

    public static function getRandomEarlierTime()
    {
        $interval = mt_rand(10000, 65535);
        $now = new \DateTime();
        return $now->sub(\DateInterval::createFromDateString($interval . ' seconds'));
    }

    public static function listBlobsEmpty()
    {
        $sample = array();
        $sample['Blobs'] = '';
        $sample['NextMarker'] = '';

        return $sample;
    }

    public static function listBlobsOneEntry()
    {
        $sample = array();
        $sample['@attributes']['ServiceEndpoint'] = 'http://myaccount.blob.core.windows.net/';
        $sample['@attributes']['ContainerName'] = 'mycontainer';
        $sample['Marker'] = '/account/listblobswithnextmarker3';
        $sample['MaxResults'] = '2';
        $sample['Delimiter'] = 'mydelimiter';
        $sample['Prefix'] = 'myprefix';
        $sample['Blobs'] = array(
            'BlobPrefix' => array('Name' => 'myblobprefix'),
            'Blob' => array(
                'Name' => 'myblob',
                'Snapshot' => '10-12-2011',
                'Metadata' => array('Name1' => 'Value1', 'Name2' => 'Value2'),
                'Properties' => array(
                    'Last-Modified' => 'Sat, 04 Sep 2011 12:43:08 GMT',
                    'Etag' => '0x8CAFB82EFF70C46',
                    'Content-Length' => '10',
                    'Content-Type' => 'type',
                    'Content-Encoding' => 'encoding',
                    'Content-Language' => 'language',
                    'Content-MD5' => 'md5',
                    'Cache-Control' => 'cachecontrol',
                    'x-ms-blob-sequence-number' => '0',
                    'x-ms-blob-type' => 'BlockBlob',
                    'x-ms-lease-status' => 'locked'
                )
            )
        );

        $sample['NextMarker'] = '';

        return $sample;
    }

    public static function listBlobsMultipleEntries()
    {
        $sample = array();
        $sample['@attributes']['ServiceEndpoint'] = 'http://myaccount.blob.core.windows.net/';
        $sample['@attributes']['ContainerName'] = 'mycontainer';
        $sample['Marker'] = '/account/listblobswithnextmarker3';
        $sample['MaxResults'] = '2';
        $sample['Blobs'] = array(
            'BlobPrefix' => array(
                0 => array('Name' => 'myblobprefix'),
                1 => array('Name' => 'myblobprefix2')),
            'Blob' => array( 0 => array(
                'Name' => 'myblob',
                'Snapshot' => '10-12-2011',
                'Metadata' => array('Name1' => 'Value1', 'Name2' => 'Value2'),
                'Properties' => array(
                    'Last-Modified' => 'Sat, 04 Sep 2011 12:43:08 GMT',
                    'Etag' => '0x8CAFB82EFF70C46',
                    'Content-Length' => '10',
                    'Content-Type' => 'type',
                    'Content-Encoding' => 'encoding',
                    'Content-Language' => 'language',
                    'Content-MD5' => 'md5',
                    'Cache-Control' => 'cachecontrol',
                    'x-ms-blob-sequence-number' => '0',
                    'BlobType' => 'BlockBlob',
                    'LeaseStatus' => 'locked'
                )
            ),

            1 => array(
                'Name' => 'myblob2',
                'Snapshot' => '10-12-2011',
                'Metadata' => array('Name1' => 'Value1', 'Name2' => 'Value2'),
                'Properties' => array(
                    'Last-Modified' => 'Sun, 26 Feb 2010 12:43:08 GMT',
                    'Etag' => '0x7CQWER2EFF70C46',
                    'Content-Length' => '20',
                    'Content-Type' => 'type2',
                    'Content-Encoding' => 'encoding2',
                    'Content-Language' => 'language2',
                    'Content-MD5' => 'md52',
                    'Cache-Control' => 'cachecontrol2',
                    'x-ms-blob-sequence-number' => '1',
                    'BlobType' => 'PageBlob',
                    'LeaseStatus' => 'unlocked'
                )
            )));

        $sample['NextMarker'] = 'value';

        return $sample;
    }

    public static function listBlocksMultipleEntriesHeaders()
    {
        $sample = array(
            'Last-Modified' => 'Sat, 04 Sep 2011 12:43:08 GMT',
            'Etag' => '0x8CAFB82EFF70C46',
            'x-ms-blob-content-length' => '13606912',
            'Content-Type' => 'type',
            'Content-Encoding' => 'encoding',
            'Content-Language' => 'language',
            'Content-MD5' => 'md5',
            'Cache-Control' => 'cachecontrol',
            'x-ms-blob-sequence-number' => '0',
            'BlobType' => 'BlockBlob',
            'LeaseStatus' => 'locked'
        );

        return $sample;
    }

    public static function listBlocksMultipleEntriesBody()
    {
        $sample = array();
        $sample['CommittedBlocks'] = array('Block' => array(
            0 => array('Name' => 'BlockId001', 'Size' => '4194304'),
            1 => array('Name' => 'BlockId002', 'Size' => '4194304')
        ));

        $sample['UncommittedBlocks'] = array('Block' => array(
            0 => array('Name' => 'BlockId003', 'Size' => '4194304'),
            1 => array('Name' => 'BlockId004', 'Size' => '1024000')
        ));

        return $sample;
    }

    public static function listPageRangeHeaders()
    {
        $sample = array(
            'Last-Modified' => 'Sat, 04 Sep 2011 12:43:08 GMT',
            'Etag' => '0x8CAFB82EFF70C46',
            'x-ms-blob-content-length' => '13606912',
        );

        return $sample;
    }

    public static function listPageRangeBodyInArray()
    {
        return array('PageRange' => array(
            0 => array('Start' => '0',        'End' => '4194303'),
            1 => array('Start' => '4194304',  'End' => '8388607'),
            2 => array('Start' => '8388608',  'End' => '12582911'),
            3 => array('Start' => '12582911', 'End' => '13606911'),
        ));
    }

    public static function getUpdateMessageResultSampleHeaders()
    {
        return array(
            Resources::X_MS_POPRECEIPT =>
                'YzQ4Yzg1MDItYTc0Ny00OWNjLTkxYTUtZGM0MDFiZDAwYzEw',
            Resources::X_MS_TIME_NEXT_VISIBLE =>
                'Fri, 09 Oct 2009 23:29:20 GMT'
        );
    }

    public static function getTestEntity($partitionKey, $rowKey)
    {
        $entity = new Entity();
        $entity->setETag('');
        $entity->setPartitionKey($partitionKey);
        $entity->setRowKey($rowKey);
        $entity->addProperty('CustomerId', EdmType::INT32, 890);
        $entity->addProperty('CustomerName', null, 'John');
        $entity->addProperty('IsNew', EdmType::BOOLEAN, true);
        $entity->addProperty('JoinDate', EdmType::DATETIME, Utilities::convertToDateTime('2012-01-26T18:26:19.0000470Z'));

        return $entity;
    }
    
    public static function getExpectedTestEntity($partitionKey, $rowKey)
    {
        $entity = new Entity();
        $entity->setETag('');
        $entity->addProperty('PartitionKey', EdmType::STRING, $partitionKey);
        $entity->addProperty('RowKey', EdmType::STRING, $rowKey);
        $entity->addProperty('CustomerId', EdmType::INT32, 890);
        $entity->addProperty('CustomerName', EdmType::STRING, 'John');
        $entity->addProperty('IsNew', EdmType::BOOLEAN, true);
        $entity->addProperty('JoinDate', EdmType::DATETIME, Utilities::convertToDateTime('2012-01-26T18:26:19.0000470Z'));
    
        return $entity;
    }

    public static function getSimpleJson()
    {
        $data['dataArray'] = array('test1','test2','test3');
        $data['jsonArray'] = '["test1","test2","test3"]';

        $data['dataObject'] = array('k1' => 'test1', 'k2' => 'test2', 'k3' => 'test3');
        $data['jsonObject'] = '{"k1":"test1","k2":"test2","k3":"test3"}';

        return $data;
    }

    public static function getBatchResponseHeaders()
    {
        return array(
            'Cache-Control'          => array('no-cache'),
            'Transfer-Encoding'      => array('chunked'),
            'Content_Type'           => array('multipart/mixed; boundary=batchresponse_e899556e-c637-4b2d-8cd1-63edb03dd6fe'),
            'Server'                 => array('Windows-Azure-Table/1.0 Microsoft-HTTPAPI/2.0'),
            'x-ms-request-id'        => array('b3818f44-0002-001d-01fe-872339000000'),
            'x-ms-version'           => array('2015-04-05'),
            'X-Content-Type-Options' => array('nosniff'),
            'Date'                   => array('Thu, 16 Feb 2017 02:46:47 GMT')
        );
    }

    public static function getBatchContexts()
    {
        $contexts = array();
        for ($i = 0; $i < 6; ++$i) {
            $context = new HttpCallContext();
            $context->setStatusCodes([204]);
            $contexts[] = $context;
        }
        return $contexts;
    }

    public static function getBatchOperations()
    {
        $operations = array();
        $operation1 = new BatchOperation();
        $operation2 = new BatchOperation();
        $operation3 = new BatchOperation();
        $operation4 = new BatchOperation();
        $operation5 = new BatchOperation();
        $operation6 = new BatchOperation();
        $operation1->setType(BatchOperationType::DELETE_ENTITY_OPERATION);
        $operation2->setType(BatchOperationType::MERGE_ENTITY_OPERATION);
        $operation3->setType(BatchOperationType::INSERT_MERGE_ENTITY_OPERATION);
        $operation4->setType(BatchOperationType::INSERT_MERGE_ENTITY_OPERATION);
        $operation5->setType(BatchOperationType::DELETE_ENTITY_OPERATION);
        $operation6->setType(BatchOperationType::DELETE_ENTITY_OPERATION);
        $operations[] = $operation1;
        $operations[] = $operation2;
        $operations[] = $operation3;
        $operations[] = $operation4;
        $operations[] = $operation5;
        $operations[] = $operation6;

        return $operations;
    }

    public static function getInterestingAccountSASTestCase(
        $signedPermissions,
        $signedService,
        $signedResourceType,
        $signedExpiracy = "",
        $signedStart = "",
        $signedIP = ""
    ) {
        if ($signedExpiracy == "") {
            $signedExpiracy = (self::getRandomLaterTime()->format('Y-m-d\TH:i:s\Z'));
        }

        if ($signedStart == "") {
            $signedStart = (self::getRandomEarlierTime()->format('Y-m-d\TH:i:s\Z'));
        }

        if ($signedIP == "") {
            $signedIP = "0.0.0.0-255.255.255.255";
        }

        $result = array();
        $result['signedVersion']      = Resources::STORAGE_API_LATEST_VERSION;
        $result['signedPermissions']  = $signedPermissions;
        $result['signedService']      = $signedService;
        $result['signedResourceType'] = $signedResourceType;
        $result['signedExpiracy']     = $signedExpiracy;
        $result['signedStart']        = $signedStart;
        $result['signedIP']           = $signedIP;
        $result['signedProtocol']     = 'https,http';

        return $result;
    }

    public static function getExpectedBatchResultEntries()
    {
        $entityResult1 = UpdateEntityResult::create(
            array(Resources::ETAG => 'W/"datetime\'2017-02-16T02%3A46%3A47.89766Z\'"')
        );
        $entityResult2 = UpdateEntityResult::create(
            array(Resources::ETAG => 'W/"datetime\'2017-02-16T02%3A46%3A47.89766Z\'"')
        );
        $entityResult3 = UpdateEntityResult::create(
            array(Resources::ETAG => 'W/"datetime\'2017-02-16T02%3A46%3A47.89766Z\'"')
        );
        return [
            'The entity was deleted successfully.',
            $entityResult1,
            $entityResult2,
            $entityResult3,
            'The entity was deleted successfully.',
            'The entity was deleted successfully.',
        ];
    }

    public static function getBatchResponseBody()
    {
        return '--batchresponse_e899556e-c637-4b2d-8cd1-63edb03dd6fe
Content-Type: multipart/mixed; boundary=changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9

--changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9
Content-Type: application/http
Content-Transfer-Encoding: binary

HTTP/1.1 204 No Content
Content-ID: 1
X-Content-Type-Options: nosniff
Cache-Control: no-cache
DataServiceVersion: 1.0;


--changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9
Content-Type: application/http
Content-Transfer-Encoding: binary

HTTP/1.1 204 No Content
Content-ID: 2
X-Content-Type-Options: nosniff
Cache-Control: no-cache
DataServiceVersion: 1.0;
ETag: W/"datetime\'2017-02-16T02%3A46%3A47.89766Z\'"


--changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9
Content-Type: application/http
Content-Transfer-Encoding: binary

HTTP/1.1 204 No Content
Content-ID: 3
X-Content-Type-Options: nosniff
Cache-Control: no-cache
DataServiceVersion: 1.0;
ETag: W/"datetime\'2017-02-16T02%3A46%3A47.89766Z\'"


--changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9
Content-Type: application/http
Content-Transfer-Encoding: binary

HTTP/1.1 204 No Content
Content-ID: 4
X-Content-Type-Options: nosniff
Cache-Control: no-cache
DataServiceVersion: 1.0;
ETag: W/"datetime\'2017-02-16T02%3A46%3A47.89766Z\'"


--changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9
Content-Type: application/http
Content-Transfer-Encoding: binary

HTTP/1.1 204 No Content
Content-ID: 5
X-Content-Type-Options: nosniff
Cache-Control: no-cache
DataServiceVersion: 1.0;


--changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9
Content-Type: application/http
Content-Transfer-Encoding: binary

HTTP/1.1 204 No Content
Content-ID: 6
X-Content-Type-Options: nosniff
Cache-Control: no-cache
DataServiceVersion: 1.0;


--changesetresponse_2918827d-ca4b-4da7-8ff2-5e205df53ac9--
--batchresponse_e899556e-c637-4b2d-8cd1-63edb03dd6fe--';
    }

    public static function getEntitySampleBody()
    {
        return '<?xml version="1.0" encoding="utf-8"?><entry xml:base="https://phput.table.core.windows.net/" xmlns="http://www.w3.org/2005/Atom" xmlns:d="http://schemas.microsoft.com/ado/2007/08/dataservices" xmlns:m="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata" m:etag="W/&quot;datetime\'2017-02-16T03%3A39%3A51.7780193Z\'&quot;"><id>https://phput.table.core.windows.net/getentity(PartitionKey=\'123\',RowKey=\'456\')</id><category term="phput.getentity" scheme="http://schemas.microsoft.com/ado/2007/08/dataservices/scheme" /><link rel="edit" title="getentity" href="getentity(PartitionKey=\'123\',RowKey=\'456\')" /><title /><updated>2017-02-16T03:39:52Z</updated><author><name /></author><content type="application/xml"><m:properties><d:PartitionKey>123</d:PartitionKey><d:RowKey>456</d:RowKey><d:Timestamp m:type="Edm.DateTime">2017-02-16T03:39:51.7780193Z</d:Timestamp><d:CustomerId m:type="Edm.Int32">890</d:CustomerId><d:CustomerName>John</d:CustomerName><d:IsNew m:type="Edm.Boolean">true</d:IsNew><d:JoinDate m:type="Edm.DateTime">2012-01-26T18:26:19.000047Z</d:JoinDate></m:properties></content></entry>';
    }

    public static function getTableSampleBody()
    {
        return '<?xml version="1.0" encoding="utf-8"?><entry xml:base="https://phput.table.core.windows.net/" xmlns="http://www.w3.org/2005/Atom" xmlns:d="http://schemas.microsoft.com/ado/2007/08/dataservices" xmlns:m="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata"><id>https://phput.table.core.windows.net/Tables(\'gettable\')</id><category term="phput.Tables" scheme="http://schemas.microsoft.com/ado/2007/08/dataservices/scheme" /><link rel="edit" title="Tables" href="Tables(\'gettable\')" /><title /><updated>2017-02-16T03:48:16Z</updated><author><name /></author><content type="application/xml"><m:properties><d:TableName>gettable</d:TableName></m:properties></content></entry>';
    }

    public static function getInsertEntitySampleBody()
    {
        return '<?xml version="1.0" encoding="utf-8"?><entry xml:base="https://phput.table.core.windows.net/" xmlns="http://www.w3.org/2005/Atom" xmlns:d="http://schemas.microsoft.com/ado/2007/08/dataservices" xmlns:m="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata" m:etag="W/&quot;datetime\'2017-02-16T06%3A47%3A05.1541526Z\'&quot;"><id>https://phput.table.core.windows.net/insertentity(PartitionKey=\'123\',RowKey=\'456\')</id><category term="phput.insertentity" scheme="http://schemas.microsoft.com/ado/2007/08/dataservices/scheme" /><link rel="edit" title="insertentity" href="insertentity(PartitionKey=\'123\',RowKey=\'456\')" /><title /><updated>2017-02-16T06:47:05Z</updated><author><name /></author><content type="application/xml"><m:properties><d:PartitionKey>123</d:PartitionKey><d:RowKey>456</d:RowKey><d:Timestamp m:type="Edm.DateTime">2017-02-16T06:47:05.1541526Z</d:Timestamp><d:CustomerId m:type="Edm.Int32">890</d:CustomerId><d:CustomerName>John</d:CustomerName><d:IsNew m:type="Edm.Boolean">true</d:IsNew><d:JoinDate m:type="Edm.DateTime">2012-01-26T18:26:19.000047Z</d:JoinDate></m:properties></content></entry>';
    }

    public static function getInsertEntitySampleHeaders()
    {
        return array(
            'cache-control' => 'no-cache',
            'transfer-encoding' => 'chunked',
            'content-type' => 'application/atom+xml;type=entry;charset=utf-8',
            'etag' => 'W/"datetime\'2017-02-16T06%3A47%3A05.1541526Z\'"',
            'location' => 'https://phput.table.core.windows.net/insertentity(PartitionKey=\'123\',RowKey=\'456\')',
            'server' => 'Windows-Azure-Table/1.0 Microsoft-HTTPAPI/2.0',
            'x-ms-request-id' => '28adeb0c-0002-00b6-5320-88f42b000000',
            'x-ms-version' => '2015-04-05',
            'x-content-type-options' => 'nosniff',
            'date' => 'Thu, 16 Feb 2017 06:47:04 GMT'
        );
    }
}

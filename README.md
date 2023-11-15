# SMS Service

## Composer

    composer require alkaris/sms-service

## SMS Service using InfoBip API

Usage: 

```php
$smsService = new SMSService($apiKeyPrefix, $apiKey, $urlBasePath);
$smsService->setSender("InfoSMS");

$smsService->setContent("Message I wanna send ..");
$smsService->setNumber(38762225883);

$smsService->sendSMS();
```

First, initialize SMS service 

```php
$smsService = new SMSService($apiKeyPrefix, $apiKey, $urlBasePath);
```

Constructor accepts three parameters, which has to be unique. Best practice is to read it from DOTENV (.env) file using Laravel.


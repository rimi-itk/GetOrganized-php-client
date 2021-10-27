# GetOrganized API PHP Client

Installation

```sh
composer require itk-dev/get-organized-api-php-client
```

Usage

```sh
<?php

require_once 'vendor/autoload.php';

use ItkDev\GetOrganizedApi\Client;
use ItkDev\GetOrganizedApi\Service;

$client = (new Client())
    ->setBaseUrl('https://…')
    ->setUsername('…')
    ->setPassword('…');

$service = new Service\Cases($client);
$result = $service->findCases([
    'CaseIdFilter' => '*',
    'IncludeRegularCases' => true,
    'IncludeOrphanedCases' => false,
    'StartItemIndex' => 0,
    'ItemCount' => 30,
    'CustomProperties' => ''
]);

foreach ($result->Case as $case) {
    var_export([
        'id' => (string)$case->attributes()->CaseID,
        'name' => (string)$case->attributes()->Name,
    ]);
}
```

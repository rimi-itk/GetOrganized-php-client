<?php

namespace ItkDev\GetOrganizedApi\Service;

use ItkDev\GetOrganizedApi\Service;
use SimpleXMLElement;

class Cases extends Service
{
    public function findCases(array $query)
    {
        $result = $this->post('Cases/FindCases/', [
            'json' => $query,
        ]);

        return isset($result['ResultsXml']) ? new SimpleXMLElement($result['ResultsXml']) : null;
    }
}

<?php

namespace ItkDev\GetOrganizedApi\Service;

use ItkDev\GetOrganizedApi\Service;

/**
 * @see https://aarhuskommune.sharepoint.com/:b:/s/ITKDesign/EZTRj3J4wfJGr1lV6BH8bDgBPlqsIPR59s2n5HdbHMTNFA?e=jgGuyP
 */
class Cases extends Service
{
    public function FindCases(array $query): array
    {
        $result = $this->post('Cases/FindCases/', [
            'json' => $query,
        ]);

        return isset($result['ResultsXml']) ? $this->xml2array($result['ResultsXml']) : null;
    }
}

<?php

namespace App;

use League\Csv\Reader;
use App\Person;
use League\Csv\Statement;

class Registry
{
    private string $personFileName;
    private array $searchedPerson = [];

    public function __construct(string $personFileName)
    {
        $this->personFileName = $personFileName;
    }

    public function search(string $id): array
    {
        $csv = array_map('str_getcsv', file($this->personFileName));

        foreach ($csv as $line) {
            if ($id === $line[2]) {
                $this->searchedPerson = $line;
            }
        }
        return $this->searchedPerson;
    }

    public function delete(): void
    {
        $csv = array_map('str_getcsv', file($this->personFileName));

        foreach ($csv as $line) {
            if ($line === $this->searchedPerson) {
                $key = array_search($line, $csv);
                array_splice($csv, $key, 1);
            }
        }

        $fp = fopen($this->personFileName, 'w');
        foreach ($csv as $line) {
            fputcsv($fp, $line);
        }
        fclose($fp);
    }
}

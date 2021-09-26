<?php

namespace App;

use League\Csv\Writer;

class Person
{
    private string $name;
    private string $surname;
    private string $id;
    private string $description;
    private string $personFilePath;

    public function __construct(string $name, string $surname, string $id, string $description, string $personFilePath)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
        $this->description = $description;
        $this->personFilePath = $personFilePath;
        $writer = Writer::createFromPath($this->personFilePath, 'a+');
        $writer->insertOne([$this->name, $this->surname, $this->id, $this->description]);
    }
}

<?php

namespace LesoWarehouseSystem\Repository;

abstract class AbstractRepository
{
    protected function getContent(string $jsonFile): array
    {
        $json = file_get_contents($jsonFile);
        return json_decode($json, true);
    }

    protected function saveJsonFile(
        string $jsonFile,
        array $content
    ): void {
        file_put_contents($jsonFile, json_encode($content, JSON_PRETTY_PRINT));
    }
}
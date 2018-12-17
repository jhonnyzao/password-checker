<?php

namespace Erasys\Services;

use Symfony\Component\Yaml\Yaml;

/**
 * Provides static methods to parse yaml files
 */
class YamlParser
{
    /**
     * Parses a yaml file to a PHP array
     * @param string $filename the name of the yaml file
     *
     * @return array with the yaml content
     */
    public static function parseRulesFile($filename): array
    {
        try {
            $value = Yaml::parseFile($filename);
        } catch (\Exception $e) {
            fwrite(STDERR, $e);
            die(1);
        }

        return $value['rules'];
    }
}

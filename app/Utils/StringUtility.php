<?php

declare(strict_types=1);

namespace App\Utilities;

class StringUtility
{
    public static function parseFilter(string $filterString, array $arrowedFields = []): array
    {
        $result = [];
        $queries = [];
        foreach (explode(' ', $filterString) as $filter) {
            $elements = explode(':', $filter);
            if (1 === \count($elements)) {
                $queries[] = $filter;
            } else {
                $field = strtolower($elements[0]);
                if (\in_array($field, $arrowedFields, true)) {
                    $result[strtolower($field)] = $elements[1];
                } else {
                    $queries[] = $filter;
                }
            }
        }
        if (\count($queries) > 0) {
            $result['query'] = $queries;
        }

        return $result;
    }

    public static function parseOrder(?string $orderString = ''): array
    {
        $result = [];
        if (null === $orderString || '' === $orderString) {
            $result['order'] = 'id';
            $result['direction'] = 'asc';
        } else {
            $elements = explode(' ', $orderString);
            if (1 === \count($elements)) {
                $result['order'] = $orderString;
                $result['direction'] = 'asc';
            } else {
                $result['order'] = $elements[0];
                $result['direction'] = 'desc' === strtolower($elements[0]) ? 'desc' : 'asc';
            }
        }

        return $result;
    }

    public static function normalizeStringArray(array|string|null $strings): array
    {
        if (null === $strings) {
            return [];
        }
        if (!\is_array($strings)) {
            $strings = [$strings];
        }
        $result = array_unique(array_map(function ($string) {
            return strtolower($string);
        }, $strings));

        return array_unique($result);
    }

    public static function normalizeIntArray(array|int|string|null $integers): array
    {
        if (empty($integers)) {
            return [];
        }
        if (!\is_array($integers)) {
            $integers = [$integers];
        }
        $result = array_unique(array_map(function ($integer) {
            return (int) $integer;
        }, $integers));

        return array_unique($result);
    }

    public static function filterSearchQuery(array|string $strings): array
    {
        if (\is_string($strings)) {
            $strings = explode(' ', $strings);
        }
        $result = array_unique(array_filter($strings, function ($string) {
            return !empty($string);
        }));

        return array_unique($result);
    }
}

<?php

namespace EasyTK;

function array_only(array $array, $columns): array
{
    if (is_array($columns)) {
        $data = [];
        foreach ($columns as $column) {
            $data[$column] = $array[$column] ?: null;
        }
    } else {
        $data[$columns] = $array[$columns] ?: null;
    }
    return $data;
}

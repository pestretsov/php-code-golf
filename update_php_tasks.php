<?php

$positionMarker = '/*caret*/';
$positionMarkerPattern = '/\/\*caret\*\//';

$fileName = 'phpTasks';
$json = json_decode(file_get_contents(__DIR__ . '/' . $fileName . '.json'));

foreach ($json->tasks as &$task) {
    ['filename' => $filename, 'extension' => $extension] = pathinfo($task->source);

    $initialFilename = $task->source;
    $targetFilename = substr($initialFilename, 0, strlen($initialFilename) - strlen($filename . "." . $extension)) .
        sprintf("%s_.%s", $filename, $extension);

    $tasksDir = __DIR__ . '/tasks_php_new/';
    $initialCode = trim(file_get_contents($tasksDir . $initialFilename));
    $targetCode = trim(file_get_contents($tasksDir . $targetFilename));

    $initialOffset = strpos($initialCode, $positionMarker);
    $initialCode = preg_replace($positionMarkerPattern, '', $initialCode, 1);

    $task->initialCode = $initialCode;
    $task->targetCode = $targetCode;
    $task->initialOffset = $initialOffset;
    unset($task->source);
}

file_put_contents(__DIR__ . '/' . $fileName . '_.json', json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

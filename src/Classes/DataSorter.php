<?php

namespace App\Classes;

use App\Interfaces\ISorter;

class DataSorter implements ISorter
{

    public string $path;

    public string $ramSize;

    public string $time;

    public int $iterationCount = 0;

    public array $sortedData = [];

    public function __construct($filePath, $ramSize)
    {
        $this->path = $filePath;

        $this->ramSize = $ramSize;
    }

    public function getUnsortedArray(): array
    {
        $data = [];

        if (file_exists($this->path)) {
            $data = explode(' ', rtrim(file_get_contents($this->path)));
        }

        return $data;
    }

    public function memoryUsage()
    {
        $mem_usage = memory_get_usage(true);

        echo round($mem_usage / 1048576) . "MB";
    }

    public function executionTime($seconds_input): string
    {
        $hours = (int)($minutes = (int)($seconds = (int)($milliseconds = (int)($seconds_input * 1000)) / 1000) / 60) / 60;

        return "Время выполнения: " . $hours . ':' . ($minutes % 60) . ':' . ($seconds % 60) . (($milliseconds === 0) ? '' : '.' . rtrim($milliseconds % 1000, '0'));
    }

    public function quicksort($array): array
    {
        set_time_limit(3600);
        ini_set('memory_limit', $this->ramSize . "M");
//        ini_set('memory_limit', "-1");

        $leftArr = $rightArr = [];

        $pivotKey = key($array);
        $pivot = array_shift($array);

        foreach ($array as $val) {
            $this->iterationCount++;
            if ($val <= $pivot) {
                $leftArr[] = $val;
            } else {
                $rightArr[] = $val;
            }
        }
        return array_merge($this->quicksort($leftArr), [$pivotKey => $pivot], $this->quicksort($rightArr));
    }

    public function quicksortRun()
    {
        $timeStart = microtime(true);
        $this->sortedData = $this->quicksort($this->getUnsortedArray());
        $timeEnd = microtime(true);

        $this->time = "Время: " . $this->executionTime(($timeEnd - $timeStart));

    }

    public function mergesort($array): array
    {
        set_time_limit(3600);
        ini_set('memory_limit', $this->ramSize . "M");
//        ini_set('memory_limit','-1');

        $mid = count($array) / 2;
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);

        $left = $this->mergesort($left);
        $right = $this->mergesort($right);

        return $this->merge($left, $right);
    }

    private function merge($left, $right): array
    {
        $leftArrayCount = 0;
        $rightArrayCount = 0;

        $result = [];
        $leftIndex = 0;
        $rightIndex = 0;

        while ($leftIndex < count($left) && $rightIndex < count($right)) {

            if ($left[$leftIndex] > $right[$rightIndex]) {
                $result[] = $right[$rightIndex];
                $rightIndex++;
                $rightArrayCount++;
            } else {
                $result[] = $left[$leftIndex];
                $leftIndex++;
                $leftArrayCount++;
            }
        }
        while ($leftIndex < count($left)) {
            $result[] = $left[$leftIndex];
            $leftIndex++;
            $leftArrayCount++;
        }

        while ($rightIndex < count($right)) {
            $result[] = $right[$rightIndex];
            $rightIndex++;
            $rightArrayCount++;
        }
        $this->iterationCount = $leftArrayCount + $rightArrayCount;
        return $result;
    }

    public function mergesortRun()
    {
//        $this->memoryUsage();
        $timeStart = microtime(true);
        $this->sortedData = $this->mergesort($this->getUnsortedArray());
        $timeEnd = microtime(true);
        $this->memoryUsage();

        $this->time = "Время: " . $this->executionTime(($timeEnd - $timeStart));


    }

    public function writeSortedData()
    {
        file_put_contents($this->path, implode(', ', $this->sortedData));
    }
}
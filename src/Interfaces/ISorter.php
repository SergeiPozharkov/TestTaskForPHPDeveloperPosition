<?php

namespace App\Interfaces;

interface ISorter
{
    public function getUnsortedArray(): array;
    public function memoryUsage(): string;
    public function executionTime($seconds_input): string;

    public function mergesort($array): array;
    public function mergesortRun();

    public function quicksort($array): array;
    public function quicksortRun();

    public function writeSortedData();

}
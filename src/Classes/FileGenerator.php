<?php


namespace App\Classes;

use App\Interfaces\IGenerator;
use FilesystemIterator;

class FileGenerator implements IGenerator
{

    public string $filePath;

    public function generateFileWithData($fileSize)
    {
        set_time_limit(3600);

        $fi = new FilesystemIterator($_SERVER['DOCUMENT_ROOT'] . "\\files\\");

        if (iterator_count($fi) == 0) {
            $fileNumber = 1;

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt") == false) {
                fopen($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt", 'a');
            }

            $currentFileSize = filesize($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt");

            while ($currentFileSize < $this->convertToBytes($fileSize)) {

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt")) {
                    fwrite(fopen($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt", 'a'),
                        mt_rand() . ' ', $this->convertToBytes($fileSize));
                    $currentFileSize = filesize($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt");
                    clearstatcache();
                }
            }

            fclose(fopen($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt", 'a'));

        } else {

            $fileNumber = iterator_count($fi) + 1;

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt") == false) {
                fopen($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt", 'a');
            }

            $currentFileSize = filesize($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt");

            while ($currentFileSize < $this->convertToBytes($fileSize)) {

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt")) {
                    fwrite(fopen($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt", 'a'),
                        mt_rand() . ' ', $this->convertToBytes($fileSize));
                    $currentFileSize = filesize($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt");
                    clearstatcache();
                }
            }

            fclose(fopen($_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt", 'a'));
        }

        $this->filePath = $_SERVER['DOCUMENT_ROOT'] . "\\files\\file" . $fileNumber . ".txt";
    }

    private function convertToBytes($size): float|int
    {
        return $size * 1048576;
    }
}
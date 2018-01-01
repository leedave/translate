<?php

namespace Leedch\Translate;

/**
 * Description of Translation
 *
 * @author leed
 */
class Translate
{
    private $translations = [];
    private static $instance;
    
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function loadTranslations(array $arrFiles)
    {
        $rows = [];
        foreach ($arrFiles as $file) {
            $filePath = $file;
            if (!file_exists($filePath)) {
                continue;
            }
            $file = fopen($filePath, "r");
            while (!feof($file)) {
                $fRow = fgetcsv($file, 0, ",");
                if (count($fRow) < 2) {
                    continue;
                }
                $rows[$fRow[0]] = $fRow[1];
            }
        }
        $this->translations = $rows;
    }
    
    public function getTranslations() : array
    {
        return $this->translations;
    }
    
    /**
     * Get the current Translation
     * 
     * @param string $code
     * @return string
     */
    public static function __(string $code) : string
    {
        $t = self::getInstance();
        if (!isset($t->translations[$code])) {
            return $code;
        }
        return $t->translations[$code];
    }
}

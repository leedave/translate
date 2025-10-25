<?php

namespace Leedch\Translate;

/**
 * Description of Translation
 *
 * @author leed
 */
class Translate
{
    private array $translations = [];
    private static $instance = null;

    public static function getInstance(): static
    {
        if(!static::$instance){
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function loadTranslations(array $arrFiles): void
    {
        $rows = [];
        foreach ($arrFiles as $filePath) {
            if (!file_exists($filePath)) {
                continue;
            }
            $file = fopen($filePath, "r");
            while (($fRow = fgetcsv($file, 0, ',', '"', '\\')) !== false) {
                if (count($fRow) < 2) {
                    continue;
                }
                $rows[$fRow[0]] = $fRow[1];
            }
            fclose($file);
        }
        $this->translations = $rows;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * Get the current Translation
     *
     * @param string $code
     * @return string
     */
    public static function __(string $code): string
    {
        $t = self::getInstance();
        return $t->translations[$code] ?? $code;
    }

    public static function jsonReturnAll(): string
    {
        return json_encode(static::getInstance()->translations, JSON_UNESCAPED_UNICODE) ?: '[]';
    }
}

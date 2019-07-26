<?php namespace Hebinet\SvgIcons;

use Exception;

class Icon
{
    private $iconString;

    /**
     * Icon constructor.
     *
     * @param $iconString
     */
    public function __construct($iconString)
    {
        $this->iconString = preg_replace('/\s+/', ' ', trim($iconString));
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function render()
    {
        $filepath = $this->getFilePath();
        if (!is_file($filepath)) {
            throw new Exception('File ' . $filepath . ' does not exist.');
        }

        $icon = file_get_contents($filepath);
        if ($icon) {
            return $icon;
        }

        return '';
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getFilePath()
    {
        return str_replace(
            '/',
            DIRECTORY_SEPARATOR,
            config('icons.path_to_fontawesome') . "/" . $this->getDir() . "/" . $this->getFilename() . ".svg"
        );
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getDir()
    {
        switch ($this->getVariant()) {
            case 'far':
                return 'regular';
            case 'fal':
                return 'light';
            case 'fab':
                return 'brands';
        }

        return 'solid';
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getFilename()
    {
        $parts = $this->getParts();

        return str_replace('fa-', '', $parts[1]);
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getVariant()
    {
        $parts = $this->getParts();

        return $parts[0];
    }

    /**
     * @return array
     * @throws Exception
     */
    private function getParts()
    {
        $parts = explode(' ', $this->iconString);
        if (count($parts) < 2) {
            throw new Exception('Wrong formatted Icon string: ' . $this->iconString);
        }

        return $parts;
    }
}
<?php namespace Hebinet\SvgIcons;

use DOMDocument;
use Exception;

class Icon
{
    /**
     * @var string
     */
    private $iconString;

    /**
     * @var array
     */
    private $config;

    /**
     * @var string The optional title of the SVG icon
     */
    private $title = '';

    /**
     * Icon constructor.
     *
     * @param string $iconString
     */
    public function __construct($iconString)
    {
        $this->iconString = preg_replace('/\s+/', ' ', trim($iconString));

        $this->config = config('icons');
    }

    /**
     * Renders the given icon to html
     *
     * @return false|string
     * @throws Exception
     */
    public function render()
    {
        $filepath = $this->getFilePath();
        if (!is_file($filepath)) {
            throw new Exception('File ' . $filepath . ' does not exist.');
        }

        $dom = new DOMDocument();
        $dom->load($filepath);

        $addClasses = $this->getAdditionalClasses();

        foreach ($dom->getElementsByTagName('svg') as $item) {
            $item->setAttribute('class', 'svg-inline--fa' . $addClasses);
            $item->setAttribute('role', 'img');

            if ($this->getTitle()) {
                $title = $dom->createElement("title");
                $title->nodeValue = $this->getTitle();

                $item->appendChild($title);
            } else {
                $item->setAttribute('aria-hidden', 'true');
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Returns the complete path to the svg file
     *
     * @return string
     * @throws Exception
     */
    public function getFilePath()
    {
        return str_replace(
            '/',
            DIRECTORY_SEPARATOR,
            $this->config['path_to_fontawesome'] . "/" . $this->getDir() . "/" . $this->getFilename() . ".svg"
        );
    }

    /**
     * Returns the directory name based on the style class
     *
     * @return string
     * @throws Exception
     */
    public function getDir()
    {
        switch ($this->getStyle()) {
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
     * Returns the filename of the icon
     *
     * @return string
     * @throws Exception
     */
    public function getFilename()
    {
        $parts = $this->getParts();

        return str_replace('fa-', '', $parts[1]);
    }

    /**
     * Returns the title for the icon
     *
     * @return string
     * @throws Exception
     */
    public function getTitle()
    {
        $this->getParts();

        return $this->title;
    }

    /**
     * Returns the style for the icon font
     * e.g. fas, far, fal, ...
     *
     * @return string
     * @throws Exception
     */
    public function getStyle()
    {
        $parts = $this->getParts();

        return $parts[0];
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getAdditionalClasses(): string
    {
        $parts = $this->getParts();
        $addClasses = '';
        if (count($parts) > 2) {
            for ($i = 2; $i < count($parts); $i++) {
                $addClasses .= ' ' . $parts[$i];
            }
        }

        return $addClasses;
    }

    /**
     * Returns the separate css classes for the icon like style, icon and additional classes
     *
     * @return array
     * @throws Exception
     */
    private function getParts()
    {
        $parts = $this->iconString;
        if (strpos($this->iconString, ',') !== false) {
            // Description has a title like 'fas fa-download,title'
            list($parts, $title) = explode(',', $this->iconString, 2);
            $this->title = $title;
        }

        $parts = explode(' ', $parts);
        if (count($parts) < 2) {
            throw new Exception('Wrong formatted Icon string: ' . $this->iconString);
        }

        return $parts;
    }
}
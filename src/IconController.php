<?php namespace Hebinet\SvgIcons;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IconController
{
    /**
     * @param Request $request
     * @param $style
     * @param $icon
     *
     * @return false|string
     */
    public function show(Request $request, $style, $icon)
    {
        $style = $this->sanitizeInput($style);
        $icon = $this->sanitizeInput($icon);

        $iconString = "{$style} {$icon}";

        $title = $request->get('title', null);
        if (!is_null($title)) {
            $iconString .= ",{$title}";
        }

        try {
            return (new Icon($iconString))->render();
        } catch (\Exception $e) {
            throw new NotFoundHttpException('SVG Icon not found');
        }
    }

    /**
     * @param $input
     *
     * @return string
     */
    private function sanitizeInput($input)
    {
        $input = str_replace(['..\\', '.\\', '\\', '../', './', '/'], '', $input);

        return $input;
    }
}
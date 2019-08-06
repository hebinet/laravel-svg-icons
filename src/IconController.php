<?php namespace Hebinet\SvgIcons;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IconController
{
    /**
     * @param Request $request
     * @param $style
     * @param $icon
     *
     * @return Response
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
            return (new Response((new Icon($iconString))->render(), 200))
                ->header('Content-Type', 'image/svg+xml');
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
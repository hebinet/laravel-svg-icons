<?php

namespace Hebinet\SvgIcons {

    function config($key)
    {
        return require(__DIR__ . '/../../config/icons.php');
    }
}

namespace {

    function base_path($path)
    {
        return __DIR__ . '/../../' . $path;
    }

    use PHPUnit\Framework\TestCase;

    class IconTest extends TestCase
    {
        public function testNormalIcon()
        {
            $icon = new \Hebinet\SvgIcons\Icon('fas fa-download');

            $this->assertEquals($icon->getStyle(), 'fas');
            $this->assertEquals($icon->getFilename(), 'download');
            $this->assertEquals($icon->getDir(), 'solid');
            $this->assertEquals($icon->getTitle(), '');
            $this->assertEquals($icon->getAdditionalClasses(), '');
            $this->assertStringEndsWith($icon->getDir() . "/" . $icon->getFilename() . ".svg", $icon->getFilePath());
            $this->assertIsString($icon->render());
        }

        public function testIconWithAddClass()
        {
            $icon = new \Hebinet\SvgIcons\Icon('fas fa-download fa-2x');

            $this->assertEquals($icon->getStyle(), 'fas');
            $this->assertEquals($icon->getFilename(), 'download');
            $this->assertEquals($icon->getDir(), 'solid');
            $this->assertEquals($icon->getTitle(), '');
            $this->assertEquals($icon->getAdditionalClasses(), ' fa-2x');
            $this->assertStringEndsWith($icon->getDir() . "/" . $icon->getFilename() . ".svg", $icon->getFilePath());
            $this->assertIsString($icon->render());
        }

        public function testIconWithSeveralAddClass()
        {
            $icon = new \Hebinet\SvgIcons\Icon('fas fa-download fa-2x fa-fw text-bold');

            $this->assertEquals($icon->getStyle(), 'fas');
            $this->assertEquals($icon->getFilename(), 'download');
            $this->assertEquals($icon->getDir(), 'solid');
            $this->assertEquals($icon->getTitle(), '');
            $this->assertEquals($icon->getAdditionalClasses(), ' fa-2x fa-fw text-bold');
            $this->assertStringEndsWith($icon->getDir() . "/" . $icon->getFilename() . ".svg", $icon->getFilePath());
            $this->assertIsString($icon->render());
        }

        public function testNormalIconWithTitle()
        {
            $icon = new \Hebinet\SvgIcons\Icon('fas fa-download,Title');

            $this->assertEquals($icon->getStyle(), 'fas');
            $this->assertEquals($icon->getFilename(), 'download');
            $this->assertEquals($icon->getDir(), 'solid');
            $this->assertEquals($icon->getTitle(), 'Title');
            $this->assertEquals($icon->getAdditionalClasses(), '');
            $this->assertStringEndsWith($icon->getDir() . "/" . $icon->getFilename() . ".svg", $icon->getFilePath());
            $this->assertIsString($icon->render());
        }

        public function testIconWithAddClassWithTitle()
        {
            $icon = new \Hebinet\SvgIcons\Icon('fas fa-download fa-2x,Title');

            $this->assertEquals($icon->getStyle(), 'fas');
            $this->assertEquals($icon->getFilename(), 'download');
            $this->assertEquals($icon->getDir(), 'solid');
            $this->assertEquals($icon->getTitle(), 'Title');
            $this->assertEquals($icon->getAdditionalClasses(), ' fa-2x');
            $this->assertStringEndsWith($icon->getDir() . "/" . $icon->getFilename() . ".svg", $icon->getFilePath());
            $this->assertIsString($icon->render());
        }

        public function testIconWithoutIconStringInConstructor()
        {
            $icon = new \Hebinet\SvgIcons\Icon();

            try {
                $svg = $icon->render();
                $this->fail('Exception not thrown.');
            } catch (Exception $e) {
                $this->assertContains('No Icon definition provided', $e->getMessage());
            }

            $this->assertIsString($icon->render('fas fa-download'));
        }
    }
}
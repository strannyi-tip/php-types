<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Enumeration\OrientationEnum;
use StrannyiTip\PhpTypes\Primitive\MutableRectangle;


class MutableRectangleTest extends Unit
{
    public function testCreate()
    {
        $rect = new MutableRectangle(0, 0, 10, 20);
        $this->assertEquals(0, $rect->x, 'Test for x sets correctly');
        $this->assertEquals(0, $rect->y, 'Test for y sets correctly');
        $this->assertEquals(10, $rect->width, 'Test for width sets correctly');
        $this->assertEquals(20, $rect->height, 'Test for height sets correctly');
    }

    public function testSquare()
    {
        $rect = new MutableRectangle(0, 0, 10, 20);
        $this->assertEquals(200, $rect->square()->value, 'Test for calculated square');
    }

    public function testOrientation()
    {
        $rect_landscape = new MutableRectangle(0, 0, 20, 10);
        $rect_portrait = new MutableRectangle(0, 0, 10, 20);
        $rect_square = new MutableRectangle(0, 0, 10, 10);
        $this->assertEquals(OrientationEnum::Landscape, $rect_landscape->orientation(), 'Test for get Landscape orientation');
        $this->assertEquals(OrientationEnum::Portrait, $rect_portrait->orientation(), 'Test for get Portrait orientation');
        $this->assertEquals(OrientationEnum::Square, $rect_square->orientation(), 'Test for get Square orientation');
    }

    public function testZoom()
    {
        $rect = new MutableRectangle(0, 0, 100, 200);
        $rect->zoom(0.5);
        $this->assertEquals(50, $rect->width, 'Test for zoomed width');
        $this->assertEquals(100, $rect->height, 'Test for zoomed height');
        $rect2 = new MutableRectangle(0, 0, 100, 200);
        $rect2->zoom(2.0);
        $this->assertEquals(200, $rect2->width, 'Test for zoomed width');
        $this->assertEquals(400, $rect2->height, 'Test for zoomed height');
    }

    public function testContains()
    {
        $main_rect = new MutableRectangle(0, 0, 100, 100);
        $small_rect = new MutableRectangle(10, 10, 50, 50);
        $big_rect = new MutableRectangle(10, 10, 500, 500);
        $moved_rect = new MutableRectangle(120, 120, 50, 50);

        $this->assertTrue($main_rect->contains($small_rect), 'Test for check contains true small rect');
        $this->assertFalse($main_rect->contains($big_rect), 'Test for check contains false biggest rect');
        $this->assertFalse($main_rect->contains($moved_rect), 'Test for check contains false moved rect');
    }

    public function testHasCollision()
    {
        $main_rect = new MutableRectangle(100, 100, 100, 100);
        $collis_rect = new MutableRectangle(110, 110, 50, 50);
        $left_rect = new MutableRectangle(0, 100, 50, 50);
        $right_rect = new MutableRectangle(1000, 10, 50, 50);
        $top_rect = new MutableRectangle(50, 0, 10, 10);
        $bottom_rect = new MutableRectangle(120, 1200, 50, 10);

        $this->assertTrue($main_rect->hasCollision($collis_rect), 'Test for collision detected');
        $this->assertFalse($main_rect->hasCollision($left_rect), 'Test for not collision with left rect');
        $this->assertFalse($main_rect->hasCollision($right_rect), 'Test for not collision with right rect');
        $this->assertFalse($main_rect->hasCollision($top_rect), 'Test for not collision with top rect');
        $this->assertFalse($main_rect->hasCollision($bottom_rect), 'Test for not collision with bottom rect');
    }
}

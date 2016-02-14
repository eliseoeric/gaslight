<?php

use App\Tag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp() {
        parent::setUp();
        Artisan::call('migrate');
    }

    /** @test */
    public function a_tag_has_a_name()
    {
        $tag = new Tag(['name' => 'Web Design']);

        $this->assertEquals('Web Design', $tag->name);
    }


}

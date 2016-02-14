<?php

use App\Card;
use App\Tag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CardTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp() {
        parent::setUp();
        Artisan::call('migrate');
    }
    /** @test */
    public function a_card_has_a_title()
    {
        $card = new Card(['title' => 'Web Design']);

        $this->assertEquals('Web Design', $card->title);
    }

    /** @test */
    public function a_card_can_add_tag() {
        $card = factory(Card::class)->create();

        $tag = factory(Tag::class)->create();
        $tagTwo = factory(Tag::class)->create();

        $card->tag($tag);
        $card->tag($tagTwo);

        $this->assertEquals(2, $card->countTags());
    }
}

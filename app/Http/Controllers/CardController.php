<?php

namespace App\Http\Controllers;

use App\Card;
use App\Repositories\CardRepository;
use App\Tag;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;

class CardController extends Controller
{

	/**
	 * The card repository instance.
	 *
	 * @var CardRepository
	 */
	protected $cards;

	/**
	 *Create a new controller instance
	 *
	 * @param CardRepository $cards
	 */
	public function __construct( CardRepository $cards )
    {
	    $this->middleware( 'auth' );

	    $this->cards = $cards;
    }


	/**
	 * Display a list of all of the user's cards
	 * @param Request $request
	 * @return Response
	 */
	public function index( Request $request )
	{
		//Below is code before using CardRepo
//		$cards = Card::where( 'user_id', $request->user()->id )->get();
//
//		return veiw('cards.index', [
//			'cards' => $cards,
//		]);
//		dd( $this->cards->forUser( $request->user() ) );
		return view( 'cards.index', [
			'cards' => $this->cards->forUser( $request->user() ),
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$card = Card::find($id);

		return $card;
	}


	/**
	 * Create a new card
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store( Request $request )
	{
		$this->validate( $request, [
			'title' => 'required|max:255',
			'url'   => 'required|url',
			'desc' => 'max:255'
		]);

		$tags = $request->tags;

		foreach( $tags as $tag )
		{
			if( is_numeric( $tag ) )
			{
				$tagArr[] = $tag;
			}
			else
			{
				$newTag = Tag::create(['name'=>$tag]);
				$tagArr[] = $newTag->id;
			}
		}

		$client = new Client();
		$httpReq = $client->get( $request->url );

		$res = $httpReq->getBody();

		$crawler = new Crawler($res->getContents());
		$og_img_tag = $crawler->filter('meta[property="og:image"]');
		$og_img = $og_img_tag->attr('content');

		$card = $request->user()->cards()->create([
			'title' => $request->title,
			'url' => $request->url,
			'desc' => $request->desc,
			'og_image' => $og_img,
		]);

		$card->tags()->sync($tagArr);

		return redirect('/cards');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$card = Card::findOrFail($id);

		return view( 'cards.edit', [
			'card' => $card
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$card = Card::findOrFail($id);

		$this->validate( $request, [
			'title' => 'required|max:255',
			'url'   => 'required|url',
			'desc' => 'max:255'
		]);

		$tags = $request->tags;

		if($tags)
		{
			foreach( $tags as $tag )
			{
				if( is_numeric( $tag ) )
				{
					$tagArr[] = $tag;
				}
				else
				{
					$newTag = Tag::create(['name'=>$tag]);
					$tagArr[] = $newTag->id;
				}
			}
		}


		$client = new Client();
		$httpReq = $client->get( $request->url );

		$res = $httpReq->getBody();

		$crawler = new Crawler($res->getContents());
		$og_img_tag = $crawler->filter('meta[property="og:image"]');
		$og_img = $og_img_tag->attr('content');


		$card->fill([
			'title' => $request->title,
			'url' => $request->url,
			'desc' => $request->desc,
			'og_image' => $og_img,
		])->save();

		$card->tags()->sync($tagArr);

		return redirect('/cards');

	}

	public function destory( Request $request, Card $card )
	{
		$this->authorize( 'destroy', $card );

		$card->delete();

		return redirect('/cards');
	}

}

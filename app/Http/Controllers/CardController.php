<?php

namespace App\Http\Controllers;

use App\Repositories\CardRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
		]);

		$request->user()->cards()->create([
			'title' => $request->title,
			'url' => $request->url,
		]);

		return redirect('/cards');
	}

	public function destory( Request $request, Card $card )
	{
		$this->authorize( 'destroy', $card );

		$card->delete();

		return redirect('/cards');
	}

}

@extends( 'layouts.app' )

@section( 'content' )
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Card Form -->
        <form action="/card" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Card Title-->
            <div class="form-group">
                <label for="card-title" class="col-sm-3 control-label">Card</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="card-title" class="form-control"/>
                </div>
            </div>

            <!-- Card Name-->
            <div class="form-group">
                <label for="card-url" class="col-sm-3 control-label">Card Url</label>

                <div class="col-sm-6">
                    <input type="text" name="url" id="card-url" class="form-control"/>
                </div>
            </div>

            <!-- Add Card Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i>Add Card
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if( count( $cards ) )
    <div class="panel panel-default">
        <div class="panel-heading">
            Latest Cards
        </div>

        <div class="panel-body">
            <table class="table table-striped card-table">
                <thead>
                    <th>Card</th>
                    <th>Url</th>
                    <th>&nbsp;</th>
                </thead>

                <tbody>
                    @foreach ( $cards as $card )
                        <tr>
                            <td class="table-text">
                                <div>{{ $card->title  }}</div>
                            </td>
                            <td class="table-text">
                                <div><a href="{{ $card->url  }}">Go To Site</a></div>
                            </td>
                            <td>
                                <form action="/card/{{ $card->id}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field( 'DELETE' ) }}

                                    <button class="btn btn-default">Delete Card</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection
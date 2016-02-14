@extends( 'layouts.app' )

@section( 'content' )
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Card Form -->
        <form action="/cards" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Card Title-->
            <div class="form-group">
                <label for="card-title" class="col-sm-3 control-label">Card</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="card-title" class="form-control"/>
                </div>
            </div>

            <!-- Card URL-->
            <div class="form-group">
                <label for="card-url" class="col-sm-3 control-label">Card Url</label>

                <div class="col-sm-6">
                    <input type="text" name="url" id="card-url" class="form-control"/>
                </div>
            </div>

            <!-- Card Name-->
            <div class="form-group">
                <label for="card-desc" class="col-sm-3 control-label">Card Description</label>

                <div class="col-sm-6">
                    <input type="text" name="desc" id="card-desc" class="form-control"/>
                </div>
            </div>
            <!-- Tag Name-->
            <div class="form-group">
                <label for="tag-name" class="col-sm-3 control-label">Tag Name</label>

                <div class="col-sm-6">
                    <select name="tags[]" id="tag-name" class="form-control tag-select multipe">

                    </select>
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
    <div class="container-fluid">
        <div class="row">
            @foreach( $cards as $card )
                <div class="col-sm-12 col-md-3 col-lg-2">
                    <div class="panel panel-default thumbnail" style="padding: 0;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-8">
                                    {{ $card->title }}
                                </div>
                                <div class="col-sm-4">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Menu
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="/cards/{{$card->id}}/edit">Edit Card</a></li>
                                            <li><a href="{{ $card->url  }}" target="_blank">Go to site</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li>
                                                <form action="/cards/{{ $card->id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field( 'DELETE' ) }}

                                                    <button class="btn btn-default btn-xs">Delete Card</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="">
                            <a href="{{ $card->url }}" title="{{ $card->title }}" target="_blank">
                                <img class="" src="{{ $card->og_image }}" alt=""/>
                            </a>

                        </div>
                        <div class="panel-body">
                            <p>{{ $card->desc }}</p>
                        </div>
                        <div class="panel-footer">
                            @foreach($card->tags as $tag)
                                <span class="label label-info">{{$tag->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
@endsection
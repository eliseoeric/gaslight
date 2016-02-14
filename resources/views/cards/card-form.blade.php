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
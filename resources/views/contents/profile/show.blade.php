<div class="tab-pane active mt-4" id="home">
    <div class="form-group">

        <div class="col-xs-6">
            <label for="first_name"><h4>Name: {{auth()->user()->name}}</h4></label>
        </div>
    </div>


    <div class="form-group">

        <div class="col-xs-6">
            <label for="email"><h4>Email: {{auth()->user()->email}}</h4></label>

        </div>
    </div>
    <div class="form-group">

        <div class="col-xs-6">
            <label for="email"><h4>Phone: {{auth()->user()->phone}}</h4></label>

        </div>
    </div>
    <div class="form-group">

        <div class="col-xs-6">
            <label for="email"><h4>Address: {{auth()->user()->address}}</h4></label>

        </div>
    </div>

<hr>

</div><!--/tab-pane-->

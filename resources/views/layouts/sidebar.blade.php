<div class="col-md-3">
    <div class="card">
        <div class="card-header">{{ __('Menu') }}</div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                  <a href="{{route("dashboard")}}" class="list-group-item list-group-item-action">{{ __('Dashboard') }}</a>
                  <a href="{{route("operation")}}" class="list-group-item list-group-item-action">{{ __('Caisse') }}</a>
                  <a href="#" class="list-group-item list-group-item-action">{{ __('Type d\'opération') }}</a>
            </ul>
        </div>
    </div>
</div>

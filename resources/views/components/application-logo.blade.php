@hasanyrole('admin|user')
<h1>@if(auth()->user()->company_name != null){{auth()->user()->company_name}}
    @else {{ env("APP_NAME") }} @endif</h1>
@endhasanyrole

@hasanyrole('subuser')
<h1>@if(auth()->user()->owner->company_name != null){{auth()->user()->owner->company_name}}
    @else {{ env("APP_NAME") }} @endif</h1>
@endhasanyrole

@guest
<h1>{{ env("APP_NAME") }}</h1>
@endguest
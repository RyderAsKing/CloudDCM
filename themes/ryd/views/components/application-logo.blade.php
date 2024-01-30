@hasanyrole('admin|user')
<h1
    class="inline-flex items-center justify-center px-3 py-2 text-lg font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-800 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
    @if(auth()->user()->company_name != null){{auth()->user()->company_name}}
    @else {{ env("APP_NAME") }} @endif</h1>
@endhasanyrole

@hasanyrole('subuser')
<h1
    class="inline-flex items-center justify-center px-3 py-2 text-lg font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-800 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
    @if(auth()->user()->owner->company_name != null){{auth()->user()->owner->company_name}}
    @else {{ env("APP_NAME") }} @endif</h1>
@endhasanyrole

@guest
@if(file_exists(public_path('image/' . env('APP_LOGO'))) && env('APP_LOGO') != null)

<img src="{{ asset('image/' . env('APP_LOGO')) }}" alt="{{ env(" APP_NAME") }}"
    class="inline-flex items-center justify-center px-3 py-2 text-lg font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-800 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
    width="256">
@else
<h1
    class="inline-flex items-center justify-center px-3 py-2 text-lg font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-800 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
    {{ env("APP_NAME") }}</h1>
@endif
@endguest
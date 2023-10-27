@hasanyrole('admin|user')
<h1
    class="inline-flex items-center justify-center px-4 py-2 text-md font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-900 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
    @if(auth()->user()->company_name != null){{auth()->user()->company_name}}
    @else {{ env("APP_NAME") }} @endif</h1>
@endhasanyrole

@hasanyrole('subuser')
<h1
    class="inline-flex items-center justify-center px-4 py-2 text-md font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-900 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
    >@if(auth()->user()->owner->company_name != null){{auth()->user()->owner->company_name}}
    @else {{ env("APP_NAME") }} @endif</h1>
@endhasanyrole

@guest
<h1
    class="inline-flex items-center justify-center px-4 py-2 text-md font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-900 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
    >{{ env("APP_NAME") }}</h1>
@endguest
@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )

@if (config('adminlte.use_route_url', false))
@php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
@php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<li class="nav-item">
    <a class="nav-link">
        {{auth()->user()->name}}
    </a>
</li>

<li class="nav-item">
    <a class="nav-link text-center" href="{{route('change-user')}}">
        <i class="fa fa-fw fa-user text-dark"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link text-center" href="{{route('change-password')}}">
        <!--  {{ __('adminlte::adminlte.log_out') }} -->
        <i class="fa fa-fw fa-key text-success"></i>

    </a>
</li>

<li class="nav-item">
    <a class="nav-link text-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <!--  {{ __('adminlte::adminlte.log_out') }} -->
        <i class="fa fa-fw fa-power-off text-red"></i>

    </a>
    <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
        @if(config('adminlte.logout_method'))
        {{ method_field(config('adminlte.logout_method')) }}
        @endif
        {{ csrf_field() }}
    </form>
</li>
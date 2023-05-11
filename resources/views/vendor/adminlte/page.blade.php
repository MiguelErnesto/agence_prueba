@extends('adminlte::master')
@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')

<div class="wrapper">
    {{-- Top Navbar --}}
    @if($layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.navbar.navbar-layout-topnav')
    @else
    @include('adminlte::partials.navbar.navbar')
    @endif
    {{-- Left Main Sidebar --}}
    <!--  @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif
 -->

    <aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">
        {{-- Sidebar brand logo --}}
        @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
        @else
        @include('adminlte::partials.common.brand-logo-xs')
        @endif

        {{-- Sidebar menu --}}

        <div class="sidebar text-start">
            <nav class="pt-2">
                <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}" data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') !=300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                    {{-- Configured sidebar links --}}
                    <!-- @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') -->
                    <!-- <li class="nav-header">
                <div class="container text-center border-light my-3">                    
                <h6>OPCIONES DE AJUSTES</h6>
                </div>
            </li> -->

                    <!-- PRINCIPAL -->
                    <li class="nav-item mt-2">
                        <a class="nav-link" href="{{route('main.edit', ['main' => 1])}}" <p><i class="fa fa-home fa-lg"></i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{config('app.nombre_principal')}} </p>
                        </a>
                    </li>

                    <!-- MENU SUPERIOR -->
                    <li class="nav-item mt-3">
                        <a class="nav-link" href="{{route('navbar.edit', ['navbar' => 1])}}" <p><i class="fa fa-window-maximize fa-lg"></i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MENU SUPERIOR </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="{{route('section1.edit', ['section1' => 1])}}" <p><i class="fa fa-arrow-right"></i>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{config('app.nav_section1')}} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="{{route('section2.edit', ['section2' => 1])}}" <p><i class="fa fa-arrow-right"></i>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{config('app.nav_section2')}} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="{{route('section3.edit', ['section3' => 1])}}" <p><i class="fa fa-arrow-right"></i>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{config('app.nav_section3')}} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="{{route('section4.edit', ['section4' => 1])}}" <p><i class="fa fa-arrow-right"></i>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{config('app.nav_section4')}} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="{{route('section5.edit', ['section5' => 1])}}" <p><i class="fa fa-arrow-right"></i>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{config('app.nav_section5')}} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="{{route('section6.edit', ['section6' => 1])}}" <p><i class="fa fa-arrow-right"></i>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{config('app.nav_section6')}} </p>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <a class="nav-link" href="{{route('social_network.index', ['social_network' => 1])}}" <p><i class="fa fa-users    fa-lg"></i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Redes Sociales </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('footer.edit', ['footer' => 1])}}" <p>&nbsp;<i class="fa fa-angle-double-down fa-lg"></i>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;Pie de página </p>
                        </a>
                    </li>


                </ul>
            </nav>
        </div>




    </aside>


    {{-- Content Wrapper --}}

    @empty($iFrameEnabled)
    @include('adminlte::partials.cwrapper.cwrapper-default')
    @else
    @include('adminlte::partials.cwrapper.cwrapper-iframe')
    @endempty

    {{-- Footer --}}
    @hasSection('footer')
    @include('adminlte::partials.footer.footer')
    @endif

    {{-- Right Control Sidebar --}}
    @if(config('adminlte.right_sidebar'))
    @include('adminlte::partials.sidebar.right-sidebar')
    @endif

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
@stop
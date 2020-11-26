@extends('layouts.base')

@section('body')
<div class="flex flex-col w-full min-h-screen text-white bg-gray-200">
    <header class="w-full py-3 bg-primary-600">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="flex items-center justify-between px-5">
            <div class="left">
                <h1 class="text-3xl font-bold"><a href="/">J7 POS SYSTEM</a></h1>
            </div>
            <div class="flex items-center right">
                <a href="/"><h1 class="flex items-center mr-5 font-semibold"><span class="flex items-center p-1 mr-1 rounded-full bg-primary-500"><i class="material-icons">dashboard</i></span>DASHBOARD</h1></a>
                <a href="/pos"><h1 class="flex items-center mr-5 font-semibold"><span class="flex items-center p-1 mr-1 rounded-full bg-primary-500"><i class="material-icons">point_of_sale</i></span>POS</h1></a>
                <a href="#"><h1 class="flex items-center mr-5 font-semibold"><span class="flex items-center p-1 mr-1 rounded-full bg-primary-500"><i class="material-icons">person</i></span>{{ auth()->user()->username }}</h1></a>
                <a href="#" data-turbolinks="false" onclick="document.querySelector('#logout-form').submit()"><h1 class="flex items-center font-semibold"><span class="flex items-center p-1 mr-1 rounded-full bg-primary-500"><i class="material-icons">logout</i></span>LOGOUT</h1></a>
            </div>
        </div>
    </header>
    @yield('content')
</div>
@endsection
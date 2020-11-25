@extends('layouts.base')

@section('body')
<div class="flex flex-col w-full h-screen text-white bg-gray-200">
    <header class="w-full py-3 bg-primary-600">
        <div class="container flex items-center justify-between px-5 mx-auto">
            <div class="left">
                <h1 class="text-3xl font-bold"><a href="#">POS</a></h1>
            </div>
            <div class="flex items-center right">
                <a href="/"><h1 class="flex items-center mr-5 font-semibold"><i class="mr-1 material-icons">dashboard</i>Dashboard</h1></a>
                <a href="#"><h1 class="flex items-center font-semibold"><span class="flex items-center p-1 mr-1 rounded-full bg-primary-500"><i class="material-icons">person</i></span>Administrator</h1></a>
            </div>
        </div>
    </header>
    @yield('content')
</div>
@endsection
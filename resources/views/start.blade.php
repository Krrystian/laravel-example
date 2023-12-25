@extends('layouts.app')

@section('content')
<div class="w-full h-screen grid grid-flow-row grid-cols-2 justify-center items-center">
    <!-- Left -->
    <div
        class="fixed z-10 w-[300px] top-[50px] min-h-screen flex bg-buff overflow-hidden justify-center items-center p-4">
        <div class="w-full">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold w-full text-center border-b-2 pb-2 border-vanilla cursor-default">
                    Categories</h1>
            </div>
            <div class="mt-4">
                <ul class="space-y-2">
                    @foreach($categorySanitized as $id => $name)
                    <li class="flex justify-between items-center">
                        <a
                            class="text-xl text-black cursor-pointer text-center w-full hover:bg-vanilla rounded-xl duration-300 p-1 transition-all">
                            {{$name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Right -->
</div>

@endsection
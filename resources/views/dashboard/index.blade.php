@extends('layouts.app')

@section('content')

<div
    class="w-full h-screen grid grid-cols-1 gap-y-10 lg:gap-0 lg:grid-cols-2 py-[7vh] items-center overflow-x-hidden lg:overflow-y-hidden">
    <!-- LEFT -->
    <div class="flex flex-col w-full items-center px-8">
        <h2 class="text-2xl font-bold border-b-2 border-sage py-2 w-full text-center">Categories</h2>
        <form action="{{ route('category.store') }}" method="POST" class="flex justify-center gap-4 py-2 w-full">
            @csrf
            @method('POST')
            <input type="text" placeholder="New Category" id="name" name="name"
                class="border bg-beige placeholder:text-black/70 border-sage px-2 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-sage focus:border-transparent">
            <button type="submit"
                class="bg-vanilla px-2 py-2 rounded h-full hover:bg-oldrose duraiton-300 transition-all text-black hover:text-vanilla">Add</button>
        </form>
        <div class="grid grid-cols-2 gap-y-2 py-4 w-full px-4 max-h-[200px] overflow-hidden overflow-y-scroll">
            @foreach ($categorySanitized as $id => $name)
            <p class="text-lg border-b border-sage">{{ $name }}</p>
            <div class="border-sage border-b flex justify-end gap-4 h-full items-center">
                <a href="{{ route('category.edit', ['category_id' => $id]) }}"
                    class="bg-vanilla px-2 rounded hover:bg-oldrose duraiton-300 transition-all text-black hover:text-vanilla">Edit</a>
                <button type="button"
                    onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this category?')) { document.getElementById('delete-form-{{ $id }}').submit(); }"
                    class="bg-vanilla px-2 rounded hover:bg-oldrose duraiton-300 transition-all text-red hover:text-vanilla">Delete</button>
                <form id="delete-form-{{ $id }}" action="{{ route('category.destroy') }}" method="POST">
                    <input type="hidden" name="category_id" id="category_id" value="{{ $id }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            @endforeach
        </div>
        <h2 class="text-2xl font-bold border-b-2 border-sage pt-24 w-full text-center">Users</h2>
        <form action="{{ route('admin.userSelect') }}" method="GET" class="flex justify-center gap-4 py-2 w-full">
            @csrf
            @method('GET')
            <button type="button" onclick="window.location.href = '{{ route('admin') }}'"
                class="bg-vanilla px-2 py-2 rounded h-full hover:bg-oldrose duraiton-300 transition-all text-black hover:text-vanilla">Reset</button>
            <input type="text" placeholder="Search User By Email" id="email" name="email"
                class="border bg-beige placeholder:text-black/70 border-sage px-2 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-sage focus:border-transparent">
            <button type="submit"
                class="bg-vanilla px-2 py-2 rounded h-full hover:bg-oldrose duraiton-300 transition-all text-black hover:text-vanilla">Search</button>

        </form>

        <div class="grid grid-cols-3 gap-y-2 py-4 w-full px-4 max-h-[200px] overflow-hidden overflow-y-scroll">
            @foreach ($users as $user)
            <p class="text-lg border-b border-sage font-semibold">{{ $user['name'] }}</p>
            <p class="text-lg border-b border-sage break-all lg:break-normal">{{ $user['email'] }}</p>
            <div class="border-sage border-b flex justify-end gap-4 h-full items-center">
                <form action="{{ route('user.suspend') }}" method="POST" class="inline"
                    onsubmit="return confirm('Are you sure you want to suspend this user? PERMANENT');">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="{{ $user['id'] }}">
                    <button type="submit" {{ $user['suspended'] ? 'disabled' : '' }}
                        class="bg-vanilla px-2 rounded disabled:hover:bg-black disabled:hover:text-red disabled:bg-black hover:bg-oldrose duraiton-300 transition-all text-red hover:text-vanilla">{{
                        $user['suspended'] ? 'Suspended' : 'Suspend' }}</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
    <!-- RIGHT -->
    <div class="flex flex-col w-full items-cente px-8">
        <h2 class="text-2xl font-bold border-b-2 border-sage py-2 w-full text-center">Reports</h2>
        <div
            class="w-full grid grid-cols-5 gap-y-2 py-4 px-8 lg:px-8 max-h-[614px] h-full overflow-hidden overflow-y-scroll">
            @foreach ($reports as $report)
            <div class="col-span-5 md:col-span-3 flex flex-col">
                <p class="text-lg h-full flex items-center font-semibold">{{
                    $report['user']['email']
                    }}</p>
                <p class="text-base md:border-b col-span-2 border-sage italic text-black/60 break-all">{{
                    $report['comment'] }}</p>
            </div>
            <div
                class="col-span-5 md:col-span-2 border-sage border-b pb-4 md:pb-2 flex justify-end gap-4 h-full items-center">
                <div class="w-full flex md:flex-col gap-2 justify-center items-center">
                    <form action="{{route ('user.suspend')}}" method="POST" class="inline w-full"
                        onsubmit="return confirm('Are you sure you want to suspend user? PERMANENT');">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id" value="{{ $report['user_id'] }}">
                        <button type="submit" {{$report['user']['suspended'] ? 'disabled' : 'null' }}
                            class="bg-vanilla w-full px-2 rounded disabled:hover:bg-black disabled:hover:text-red disabled:bg-black hover:bg-oldrose duraiton-300 transition-all text-red hover:text-vanilla">
                            {{$report['user']['suspended'] ? 'Suspended' : 'Suspend' }}</button>
                    </form>
                    <form action="{{route('comment.destroy')}}" method="POST" class="inline w-full"
                        onsubmit="return confirm('Are you sure you want to remove this comment? PERMANENT');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="id" value="{{$report['id']}}">
                        <input type="hidden" name="user_id" id="user_id" value="{{$report['user_id']}}">
                        <button type="submit"
                            class="bg-vanilla w-full px-2 rounded disabled:hover:bg-vanilla disabled:hover:text-red disabled:bg-black hover:bg-oldrose duraiton-300 transition-all text-red hover:text-vanilla">
                            Remove comment</button>
                    </form>
                </div>
                <form action="{{route('comment.verify')}}" method="POST" class="inline h-full"
                    onsubmit="return confirm('Are you sure you want to verify this comment?');">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="{{$report['id']}}">
                    <button type="submit"
                        class="bg-sage h-full px-2 rounded text-beige hover:text-black hover:bg-vanilla duration-300 transition-all">
                        Verify</button>
                </form>
            </div>
            @endforeach
        </div>

        @endsection
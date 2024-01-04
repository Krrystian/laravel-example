@extends('layouts.app')

@section('content')
<div class="pt-[50px] min-h-screen w-full flex flex-col md:grid grid-cols-2 items-center">
    <h1 class="text-5xl text-black/50 font-bold tracking-wider text-center col-span-2 cursor-default py-8 md:py-0">
        {{$recipe['title']}}</h1>
    <!-- Left side -->
    <div class="flex flex-col items-center h-full">
        <div class="md:w-[400px] h-[400px] w-[300px] rounded-xl">
            <img src="{{ URL('storage/' . $recipe['image']) }}" alt="" class="w-full h-full object-cover rounded-xl">
        </div>
        <p>Created at {{ substr($recipe['created_at'], 0, 10) }} </p>
    </div>
    <!-- Right side -->
    <div class="h-full w-full xl:pr-24 md:pr-8 mt-8 md:mt-0">
        <div class="grid grid-cols-2 gap-4 mb-8 px-8">
            <p class="text-xl font-bold text-center">Preparation: <span
                    class="font-normal">{{$recipe['prep_time']}}</span></p>
            <p class="text-xl font-bold text-center">Cooking: <span class="font-normal">{{$recipe['cook_time']}}</span>
            </p>
            <p class="text-xl font-bold text-center">Servings: <span class="font-normal">{{$recipe['servings']}}</span>
            </p>
            <p class="text-xl font-bold text-center">Category: <span
                    class="font-normal">{{$recipe['category']['name']}}</span></p>
        </div>
        <p class="text-3xl text-center md:text-start font-bold col-span-2 pb-4">Ingredients: </p>
        <p class="text-xl font-normal pb-4 text-left px-8 md:pl-0"">{!!$recipe['ingredients']!!}</p>
        <p class=" text-3xl text-center md:text-start font-bold col-span-2 pb-4">Instructions: </p>
        <p class="text-xl font-normal pb-4 px-8 md:pl-0">{!! $recipe['instructions'] !!}</p>
    </div>
</div>
<!-- Comment Section -->
<div class="mt-8 flex flex-col items-center">
    <h2 class="text-3xl font-bold text-center pb-4">Comments</h2>
    @auth
    <!-- Add new comment form -->
    <form action="{{ route('comment.store') }}" method="POST" class="w-full px-8 md:w-[50%] pb-10">
        @csrf
        @method('POST')
        <input type="hidden" name="recipe_id" value="{{$recipe['id']}}">
        <div class="flex flex-col md:flex-row gap-4 w-full">
            <label for="comment" class=" self-center text-xl text-nowrap font-bold mb-2 h-full">Add
                comment:</label>
            <textarea name="comment" id="comment" class="border-4 bg-beige border-sage resize-none text-xl p-2 w-full"
                required> </textarea>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white text-nowrap bg-oldrose hover:bg-vanilla duration-300 transition-all text-xl font-bold py-2 px-4 rounded">
                Add
            </button>
        </div>
    </form>
    @else
    <p class="text-xl font-bold text-center">You must be logged in to comment</p>
    @endauth
    <div class="w-full flex mb-24 justify-center">
        <div class="flex-col flex w-full mx-8 md:w-[60%]">
            @foreach($comments as $comment)
            <div class="grid grid-cols-4 md:grid-cols-5 mb-4 pb-4 border-b-2 border-b-vanilla">
                <p class="font-bold text-xl text-black flex items-center">{{$comment['username']}}:</p>
                <p class="text-md text-black/60 italic text-wrap col-span-2 break-words self-center h-full">
                    {{$comment['comment']}}
                </p>
                <p class="hidden md:flex self-center justify-center">{{ substr($comment['updated_at'], 0, 10) }}
                </p>
                @if( Auth::id() == $comment['user_id'])
                <div class="flex justify-center items-center">
                    <button>
                        <a href="{{ route('comment.edit', $comment['id']) }}" class="">
                            <x-feathericon-edit />
                        </a>
                    </button>
                </div>
                @else
                <a></a>
                @endif

            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
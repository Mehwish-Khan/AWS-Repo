@extends('layouts.app')

@section('content')

<div class="m-auto w-4/5 py-24">
    <div class="text-center">
        <h1 class="text-5xl uppercase bold">
            Cars
        </h1>
    </div>

    @if (Auth::user())
        <div class="pt-10">
            <a
                class="border-b-2 p-2 border-dotted italic bg-teal-400"
                href="cars/create">
                Add a new Car &rarr;
            </a>
        </div>
    @else
        <p>Please login first to add a new Car!</p>
    @endif


    <div class="w-5/6 py-10">
        @foreach ($cars as $car)
        <div class="m-auto">
            {{-- @if (isset(Auth::user()->id) && Auth::user()->id == $car->user_id) --}}
                <div class="float-right">
                    <a
                        class="border-b-2 p-2 border-dotted italic text-green-500"
                        href="cars/{{ $car->id }}/edit">
                        Edit &rarr;
                    </a>

                    <form action="/cars/{{ $car->id }}" method="POST" class="pt-3">
                        @csrf
                        @method('delete')
                        <button
                            type="submit"
                            class="border-b-2 p-2 border-dotted italic text-red-500">

                            Delete &rarr;
                        </button>
                    </form>
                </div>
            {{-- @endif --}}


            <img
            src="{{asset('images/' . $car->image_path)}}"
            class="w-40 mb-8 shadow-xl text-center"
            alt="">
            <span class="uppercase text-blue-500 font-bold text-s italic">
                Founded: {{$car->founded}}
            </span>

            <h2 class="text-gray-700 text-5xl hover:text-gray-500">
                <a href="/cars/{{ $car->id }}">
                    {{$car->name}}
                </a>
            </h2>

            <p class="text-lg text-gray-700 py-6">
                {{$car->description}}
            </p>

            <hr class="mt-4 mb-8">
        </div>

        @endforeach
    </div>



</div>


@endsection

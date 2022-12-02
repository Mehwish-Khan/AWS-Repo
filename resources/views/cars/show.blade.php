@extends('layouts.app')

@section('content')

<div class="m-auto w-4/5 pt-24 pb-10">
    <div class="text-center">
        <img
            src="{{asset('images/' . $car->image_path)}}"
            class="w-6/12 mb-8 shadow-xl text-center"
            alt="">
        <h1 class="text-5xl uppercase bold">
            {{$car->name}}
        </h1>
        {{-- <p class="text-xl text-gray-700 py-6">
            {{ $car->headquarter->headquarters }}, {{ $car->headquarter->country }}
        </p> --}}
    </div>
</div>

<div class="px-20 ">
    <div class="m-auto text-center">
        <span class="uppercase text-blue-500 font-bold text-s italic">
            Founded: {{$car->founded}}
        </span>

        <p class="text-lg text-gray-700 py-6">
            {{$car->description}}
        </p>
    </div>
        <table class="table-auto">
            <tr class="bg-blue-100">
                <th class="w-1/4 border-4 border-gray-500">
                    Model
                </th>
                <th class="w-1/4 border-4 border-gray-500">
                    Engines
                </th>
                <th class="w-1/4 border-4 border-gray-500">
                    Production Date
                </th>
            </tr>

            @forelse ($car->carModel as $model)
                <tr>
                    <td class="border-4 border-gray-500">
                        {{ $model->model_name}}
                    </td>
                    <td class="border-4 border-gray-500">
                        @forelse ($car->engines as $engine)
                            @if ($model->id == $engine->model_id)
                                {{ $engine->engine_name }}
                            @endif
                        @empty

                        @endforelse
                    </td>
                    <td class="border-4 border-gray-500">
                        {{ date('d-m-y', strtotime($car->productionDate->created_at)) }}
                    </td>
                </tr>
            @empty
                <h4>No Car's model found!</h4>
            @endforelse
        </table>

        <p class="text-left">
            <b>Products types:</b>
            @forelse ($car->products as $product)
                {{$product->name}}
            @empty
                No Car Product found!
            @endforelse

        </p>

        <hr class="mt-4 mb-8">
</div>



@endsection

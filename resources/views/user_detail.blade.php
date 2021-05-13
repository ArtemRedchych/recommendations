@extends('layouts.app')

@section('content')

<main style="margin-top: 30px;" class="flex-shrink-0">
        <div class="container">
                <div class="row">
                        <div class="col-12">
                                <h1 class="mt-5">User {{$user_id}} details</h1>
                        </div>
                        <div class="col-12">
                                <h4 class="mt-3">Urdered products:</h1>
                        </div>

                </div>
                <div>
                        <div class="col-12">
                                <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">ProductID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Categories</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($products as $product)
                                                        <tr>
                                                                <th scope="row">{{$product['id']}}</th>
                                                                <th>{{$product['title']}}</th>
                                                                <th>{{$product['author']}}</th>
                                                                <th>
                                                                        @foreach ($product['categories'] as $category)
                                                                                {{ $loop->first ? '' : ', ' }}
                                                                                {{$category}}
                                                                        @endforeach
                                                                </th>
                                                      </tr> 
                                                @endforeach
                                         
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
</main>
@endsection
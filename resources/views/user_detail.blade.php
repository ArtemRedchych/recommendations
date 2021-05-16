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
                <div class="row">
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
                                                                                {{$all_categories[$category]}}
                                                                        @endforeach
                                                                </th>
                                                      </tr> 
                                                @endforeach
                                         
                                        </tbody>
                                </table>
                        </div>
                </div>

                <div class="row">
                        <div class="col-12">
                                <h3 class="mt-3">Recommended products:</h1>
                        </div>
                </div>
                <div class="row">
                        <div class="col-12">
                                <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">ProductID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Categories</th>
                                            <th scope="col">Score</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($recomm_prods as $product)
                                                        <tr>
                                                                <th scope="row">{{$product['id']}}</th>
                                                                <th>{{$product['title']}}</th>
                                                                <th>{{$product['author']}}</th>
                                                                <th>
                                                                        @foreach ($product['categories'] as $category)
                                                                                {{ $loop->first ? '' : ', ' }}
                                                                                {{$all_categories[$category]}}
                                                                        @endforeach
                                                                </th>
                                                                <th>{{$product['score']}}</th>
                                                      </tr> 
                                                @endforeach
                                         
                                        </tbody>
                                </table>
                        </div>
                </div>

        </div>
</main>
@endsection
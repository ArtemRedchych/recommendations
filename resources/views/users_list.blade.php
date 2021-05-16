@extends('layouts.app')

@section('content')
<script>
        $(document).ready(function() {
                 $('#users_table').DataTable({
                        "order": [[ 3, "desc" ]]
                 });
        } );
</script>
<main style="padding-top: 30px;" class="flex-shrink-0">
        <div class="container">
                <div class="row">
                        <div class="col-12">
                                <h1 class="mt-5">Users list</h1>
                        </div>
                        <div class="col-12">
                                <h4 class="mt-5">Výpočet po zmáčknutí tlačítka "Detail" trvá cca 30 vteřin</h1>
                        </div>
                        <div class="col-12">
                                <table id="users_table" class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Orders</th>
                                            <th scope="col">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($users as $user)
                                                        <tr>
                                                                <th scope="row">{{$user->custommer_id}}</th>
                                                                <td>User_{{$user->custommer_id}}</td>
                                                                <td>{{$user->order}}</td>
                                                                <td>
                                                                        <a href="{{route('users.show', $user->custommer_id)}}" class="btn btn-primary">Detail</a>
                                                                </td>
                                                      </tr> 
                                                @endforeach
                                         
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
</main>
@endsection
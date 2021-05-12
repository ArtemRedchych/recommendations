@extends('layouts.app')
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

</script>
@section('content')
<main style="padding-top: 30px;" class="flex-shrink-0">
        <div class="container">
                <div class="row">
                        <div class="col-12">
                                <h1 class="mt-5">Users list</h1>
                        </div>
                        <div class="col-12">
                                <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">3</th>
                                            <td colspan="2">Larry the Bird</td>
                                            <td>@twitter</td>
                                          </tr>
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
</main>
@endsection
@extends('layouts.app')

@section('content')
<script>
    $(document).ready(function() {
             $('#users_table').DataTable();
    } );
</script>
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Content-based recommendation system</h1>
        <p class="lead">Vyhledávání na webu a v multimediálních databázích.</p>
        <p class="lead">Pro pokračování zmačkněte prosím tlačítko "Users" v menu.</p>
    </div>
</main>
@endsection
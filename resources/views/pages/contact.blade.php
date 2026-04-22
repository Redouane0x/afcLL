@extends('layouts.app')

@section('content')

    <h1 class="text-vert mb-4">Contact </h1>

    <form>

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea class="form-control"></textarea>
        </div>

        <button class="btn btn-vert">Envoyer</button>

    </form>

@endsection

@extends('layouts.app')

@section('content')

    <div class="p-5 text-center text-white bg-vert rounded">
        <h1>AFC Liébaüt</h1>
        <p>Club de football - Passion & Performance </p>

        <a href="/agenda" class="btn btn-light mt-3">Voir les matchs</a>
    </div>

    <div class="row mt-5">

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="text-vert">Agenda</h5>
                <p>Découvrez les prochains matchs</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="text-vert">Boutique</h5>
                <p>Maillots et équipements</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="text-vert">Club</h5>
                <p>Découvrez notre histoire</p>
            </div>
        </div>

    </div>

@endsection

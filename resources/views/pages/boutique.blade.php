@extends('layouts.app')

@section('content')

    <h1 class="text-vert mb-4">Boutique du club </h1>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="https://via.placeholder.com/300" class="card-img-top">
                <div class="card-body">
                    <h5>Maillot AFC LL</h5>
                    <p>Prix : 35€</p>
                    <button class="btn btn-vert">Voir</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="https://via.placeholder.com/300" class="card-img-top">
                <div class="card-body">
                    <h5>Crampons</h5>
                    <p>Prix : 60€</p>
                    <button class="btn btn-vert">Voir</button>
                </div>
            </div>
        </div>

    </div>

@endsection

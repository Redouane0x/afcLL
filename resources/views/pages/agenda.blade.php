@extends('layouts.app')

@section('content')

    <h1 class="text-vert mb-4">Agenda des matchs </h1>

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-3">
                <h5>AFCLL vs Paris FC</h5>
                <p><strong>Date :</strong> 25 Avril 2026</p>
                <p><strong>Lieu :</strong> Stade Municipal</p>
                <span class="badge bg-success">À venir</span>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-3">
                <h5>AFCLL vs Lyon</h5>
                <p><strong>Date :</strong> 18 Avril 2026</p>
                <p><strong>Score :</strong> 2 - 1</p>
                <span class="badge bg-secondary">Terminé</span>
            </div>
        </div>

    </div>

@endsection

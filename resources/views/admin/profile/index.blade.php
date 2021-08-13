@extends('adminlte::page')
@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Meu Perfil</h1>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <h3 class="profile-username text-center">{{ $user['name'] }}</h3>
            <p class="text-muted text-center">
                @if ($user['isAdmin'] == 1)
                    Administrador
                @else
                    Membro
                @endif
            </p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>E-mail:</b> {{ $user['email'] }}
                </li>
                <li class="list-group-item">
                    <b>Desde:</b> {{ date('d/m/Y', strtotime($user['created_at'])) }}
                </li>
            </ul>
        </div>
    </div>
    @include('flash-message')
@endsection

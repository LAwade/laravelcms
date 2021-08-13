@extends('adminlte::page')
@section('title', 'Usuários')

@section('content_header')
    <h1>Todos Usuários
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-success float-right">
            <i class="fas fa-plus"></i> Novo Usuário
        </a>
    </h1>
@endsection

@section('content')
    <div class="row py-3">
        <div class="col-12">
            <div class="card">
                <table class="table table-hover text-nowrap">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Registrado</th>
                            <th colspan='2'></th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    @if ($user->id != $loggedid)
                                        <form class="d-inline" method="POST"
                                            action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                            onsubmit="return confirm('Deseja excluir esse usuário?')">

                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Excluir
                                            </button>
                                        </form>
                                    @else
                                    <button class="btn btn-sm btn-danger" disabled
                                    >
                                        <i class="fas fa-trash"></i> Excluir
                                    </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @include('flash-message')
    {{ $users->links('pagination::bootstrap-4') }}
@endsection

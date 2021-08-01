@extends('adminlte::page')
@section('title', 'Usuários')

@section('content_header')
    <h1>Todos Usuários</h1>
@endsection

@section('content')
    <div class="row">
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
                                    <a href="{{ route('users.edit'), ['user' => $user->id] }}" class="btn btn-flat btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('users.destroy'), ['user' => $user->id] }}" class="btn btn-flat btn-danger">
                                        <i class="fas fa-trash"></i> 
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('adminlte::page')
@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Usuário</h1>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Alterar Usuário</h3>
        </div>
        <form action="{{ route('users.update', [$user->id]) }}" method="POST" class="form-horizontal">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $user->name }}" id="inputName" placeholder="Nome Completo">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ $user->email }}" id="inputEmail" placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSenha" class="col-sm-2 col-form-label">Nova senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="inputSenha" placeholder="Senha">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputConfSenha" class="col-sm-2 col-form-label">Confirmar Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror" id="inputConfSenha"
                            placeholder="Confirme Senha">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="submit" class="btn btn-success" value="Salvar">
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    @include('flash-message')
@endsection

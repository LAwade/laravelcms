@extends('adminlte::page')
@section('title', 'Novo Usuário')

@section('content_header')
    <h1>Novo Usuário</h1>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Usuário</h3>
        </div>
        <form action="{{ route('users.store') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="inputName" placeholder="Nome Completo">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="inputEmail" placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSenha" class="col-sm-2 col-form-label">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputSenha" placeholder="Senha">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputConfSenha" class="col-sm-2 col-form-label">Confirmar Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputConfSenha"
                            placeholder="Confirme Senha">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="submit" class="btn btn-success" value="Cadastrar">
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    @include('flash-message')
@endsection

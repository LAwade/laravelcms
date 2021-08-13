@extends('adminlte::page')
@section('title', 'Novo Usuário')

@section('content_header')
    <h1>Nova Página</h1>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Cadastrar página</h3>
        </div>
        <form action="{{ route('pages.store') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" id="inputTitle" placeholder="Título">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputBody" class="col-sm-2 col-form-label">Body</label>
                    <div class="col-sm-10">
                        <textarea name="body" class="bodyfield @error('body') is-invalid @enderror" value="{{old('body')}}" id="inputBody"></textarea>
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
    @include('tinymce')
@endsection

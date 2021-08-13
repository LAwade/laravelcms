@extends('adminlte::page')
@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Página</h1>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Alterar Página</h3>
        </div>
        <form action="{{ route('pages.update', [$page->id]) }}" method="POST" class="form-horizontal">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputTitle" class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ $page->title }}" id="inputTitle" placeholder="Título">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Body</label>
                    <div class="col-sm-10">
                        <textarea name="body" class="bodyfield form-control @error('body') is-invalid @enderror"
                            id="inputBody">{{ $page->body }}</textarea>
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
    @include('tinymce')
@endsection

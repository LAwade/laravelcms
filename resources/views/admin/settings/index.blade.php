@extends('adminlte::page')
@section('title', 'Painel')

@section('content_header')
    <h1>Configurações</h1>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Edições do site</h3>
        </div>
        <form action="{{ route('settings.save')}}" method="POST">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="inputTitle">Title</label>
                    <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Informe o titulo do site" value="{{$settings['title']}}">
                </div>
                <div class="form-group">
                    <label for="inputSubTitle">Sub-Title</label>
                    <input type="text" class="form-control" name="subtitle" id="inputSubTitle" placeholder="Informe o sub-titulo do site" value="{{$settings['subtitle']}}">
                </div>
                <div class="form-group">
                    <label for="inputEmail">E-mail de contato</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Informe o e-mail do contato" value="{{$settings['email']}}">
                </div>
                <div class="form-group">
                    <label for="inputbackgroud">Backgroud</label>
                    <input type="color" class="form-control" name="bgcolor" id="inputbackgroud"  value="{{$settings['bgcolor']}}">
                </div>
                <div class="form-group">
                    <label for="inputtextcolor">Text Color</label>
                    <input type="color" class="form-control" name="textcolor" id="inputtextcolor" value="{{$settings['textcolor']}}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    @include('flash-message')
@endsection

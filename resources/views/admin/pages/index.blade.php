@extends('adminlte::page')
@section('title', 'Usuários')

@section('content_header')
    <h1>Minhas Páginas
        <a href="{{ route('pages.create') }}" class="btn btn-sm btn-success float-right">
            <i class="fas fa-plus"></i> Nova Página
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
                            <th>Titulo</th>
                            <th colspan='2'></th>
                        </tr>
                        @foreach ($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->title }}</td>
                                <td>
                                    <a href="{{ route('pages.edit', ['page' => $page->id]) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('pages.edit', ['page' => $page->id]) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form class="d-inline" method="POST"
                                        action="{{ route('pages.destroy', ['page' => $page->id]) }}"
                                        onsubmit="return confirm('Deseja excluir essa página?')">

                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @include('flash-message')
    {{ $pages->links('pagination::bootstrap-4') }}
@endsection

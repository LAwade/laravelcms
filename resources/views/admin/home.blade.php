@extends('adminlte::page')
@section('plugins.Chartjs', true)
@section('title', 'Painel')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashbord</h1>
            </div>
            <div class="col-sm-6">
                <form action="{{ route('admin') }}" method="GET" id="formFilter">
                    <div class="col-4 float-sm-right">
                        <div class="form-group">
                            <select class="form-control" name="filter" onchange="this.form.submit()">
                                @foreach ($daysfilter as $days)
                                    <option value="{{ $days }}" {{ ($filter == $days) ? "selected='selected'" : ''}} >Últimos {{ $days }} Dias</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $visitsCount }}</h3>
                <p>Visitas</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-eye"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $onlineCount }}</h3>
                <p>Usuários Online</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-heart"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pageCount }}</h3>
                <p>Páginas</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-sticky-note"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $userCount }}</h3>
                <p>Usuários</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-user"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
            </div>
            <div class="card-body">
                <canvas id="pagePie"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Different Height</h3>
            </div>
            <div class="card-body">
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                <br>
                <input class="form-control" type="text" placeholder="Default input">
                <br>
                <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        let ctx = document.getElementById('pagePie').getContext('2d')
        window.pagePie = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: {{ $pageValues }},
                    backgroundColor: '#000FFF'
                }],
                labels: {!! $pageLabels !!}
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                }
            }
        })
    }
</script>
@endsection

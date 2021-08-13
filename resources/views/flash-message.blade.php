@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="fas fa-check"></i> <b>TUDO CERTO!</b></h5>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="icon fas fa-ban"></i> <b>OPSS.. DEU ALGO DE ERRADO!</b></h5>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="fas fa-exclamation-triangle"></i> <b>É MELHOR AJUSTAR ALGUMAS COISAS!</b></h5>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="fas fa-exclamation-circle"></i> <b>APENAS UMA INFORMAÇÃO!</b></h5>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="icon fas fa-ban"></i> <b>OPSS.. ALGO DEU ERRADO!</b></h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        Por favor, verifique os todos campos preenchidos!
    </div>
@endif

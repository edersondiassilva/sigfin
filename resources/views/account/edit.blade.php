@extends('template.app')
@section('content')
<div class="col-xs-12 col-md-12">
    <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dados da Conta</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/accounts/update" method="post" role="form">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
              <input type="hidden" name="id" value="{{ $a->id }}" />
              <input type="hidden" name="user_id" value="{{ $a->user_id }}" />
              <div class="box-body">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group col-xs-4 col-md-4">
                  <label for="bank">Banco<span class="required">* </span></label>
                  <input type="text" class="form-control" name="bank" id="bank" value="{{ $a->bank }}" maxlength="100">
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="agency">Agência<span class="required">* </span></label>
                  <input type="text" class="form-control" name="agency" id="agency" value="{{ $a->agency }}" maxlength="5">
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="number">Conta<span class="required">* </span></label>
                  <input type="text" class="form-control" name="number" id="number" value="{{ $a->number }}" maxlength="13">
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="city">Cidade</label>
                  <input type="text" class="form-control" name="city" id="city" value="{{ $a->city }}" maxlength="100">
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="state">Estado</label>
                  <input type="text" class="form-control" name="state" id="state" value="{{ $a->state }}" maxlength="2">
                </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</div>
@endsection
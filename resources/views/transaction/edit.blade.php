@extends('template.app')
@section('content')
<div class="col-xs-12 col-md-12">
    <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dados da Transação</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/transactions/update" method="post" role="form">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
              <input type="hidden" name="id" value="{{ $t->id }}" />
              <input type="hidden" name="user_id" value="{{ $t->user_id }}" />
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
                  <label for="type">Conta<span class="required">* </span></label>
                  <select class="form-control" name="account_id" id="account_id" required="required">
                  <option value="">&nbsp;</option>
                  @foreach($accounts as $id => $number)
                      <option value="{{ $id }}" {{ $t->account_id == $id ? "selected":"" }}> {{ $number }} </option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="type">Tipo<span class="required">* </span></label>
                  <select class="form-control" name="type" id="type" required="required">
                  <option value="">&nbsp;</option>
                  @foreach($types as $id => $description)
                      <option value="{{ $id }}"  {{ $t->type == $id ? "selected":"" }}> {{ $description }} </option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="status">Status<span class="required">* </span></label>
                  <select class="form-control" name="status" id="status" required="required">
                  <option value="">&nbsp;</option>
                  @foreach($status as $id => $description)
                      <option value="{{ $id }}"  {{ $t->status == $id ? "selected":"" }}> {{ $description }} </option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="operation">Operação<span class="required">* </span></label>
                  <select class="form-control" name="operation" id="operation" required="required">
                  <option value="">&nbsp;</option>
                  @foreach($operations as $id => $description)
                      <option value="{{ $id }}"  {{ $t->operation == $id ? "selected":"" }}> {{ $description }} </option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="value">Valor</label>
                  <input type="text" class="form-control money" name="value" id="value" value="{{ $t->value }}" maxlength="100">
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="prevision_date">Data prevista</label>
                  <input type="text" class="form-control date" name="prevision_date" id="prevision_date"
											value="{{ (old("prevision_date") ? old("prevision_date") : date('d/m/Y')) }}">
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="realization_date">Data realizada</label>
                  <input type="text" class="form-control date" name="realization_date" id="realization_date"
											value="{{ (old("realization_date") ? old("realization_date") : date('d/m/Y')) }}">
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
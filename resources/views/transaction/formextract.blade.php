@extends('template.app')
@section('content')
<div class="col-xs-12 col-md-12">
    <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Extrato Financeiro</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/transactions/getextract" method="post" role="form">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
              <input type="hidden" name="id" value="{{ old('id') }}" />
              <input type="hidden" name="user_id" />
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
                      <option value="{{ $id }}"{{ (old("account_id") == $id ? "selected":"") }}> {{ $number }} </option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="prevision_date">Data inicial</label>
                  <input type="text" class="form-control date" name="initial_date" id="initial_date"
											value="{{ (old("initial_date") ? old("initial_date") : date('d/m/Y')) }}" required>
                </div>
                <div class="form-group col-xs-4 col-md-4">
                  <label for="realization_date">Data final</label>
                  <input type="text" class="form-control date" name="final_date" id="final_date"
											value="{{ (old("final_date") ? old("final_date") : date('d/m/Y')) }}" required>
                </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Gerar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</div>
@endsection
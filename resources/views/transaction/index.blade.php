@extends('template.app')
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lista de Transações</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      @if(empty($transactions))
      <div class="alert alert-danger">
          Você não tem nenhuma transação cadastrada.
      </div>
      @else
        <table id="table-transactions" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>#</th>
            <th>Tipo</th>
            <th>Operação</th>
            <th>Valor</th>
            <th>Data prevista</th>
            <th>Data realizada</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($transactions as $t)
          <tr>
            <td>
                <a class="fa fa-pencil nav-link" href="/transactions/edit/{{ $t->id }}" target="_parent">&nbsp;</a>
            </td>
            <td>{{ $t->id }}</td>
            <td>{{ $t->type }}</td>
            <td>{{ $t->operation }}</td>
            <td>{{ $t->value }}</td>
            <td>{{ $t->prevision_date }}</td>
            <td>{{ $t->realization_date }}</td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>#</th>
            <th>#</th>
            <th>Tipo</th>
            <th>Operação</th>
            <th>Valor</th>
            <th>Data prevista</th>
            <th>Data realizada</th>
          </tr>
          </tfoot>
        </table>
        @endif
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="/transactions/create" class="btn btn-sm btn-info btn-flat pull-left">Inserir</a> 
      </div>
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
      
<script>
  $(function () {
    $('#table-transactions').DataTable({
      'searching'   : false
    });
  })
</script>
@endsection
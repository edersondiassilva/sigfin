@extends('template.app')
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lista de Contas</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      @if(empty($accounts))
      <div class="alert alert-danger">
          Você não tem nenhuma conta cadastrada.
      </div>
      @else
        <table id="table-accounts" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>#</th>
            <th>Banco</th>
            <th>Agência</th>
            <th>Conta</th>
            <th>Cidade</th>
            <th>UF</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($accounts as $a)
          <tr>
            <td>
                <a class="fa fa-pencil nav-link" href="/accounts/edit/{{ $a->id }}" target="_parent">&nbsp;</a>
            </td>
            <td>{{ $a->id }}</td>
            <td>{{ $a->bank }}</td>
            <td>{{ $a->agency }}</td>
            <td>{{ $a->number }}</td>
            <td>{{ $a->city }}</td>
            <td>{{ $a->state }}</td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>#</th>
            <th>#</th>
            <th>Banco</th>
            <th>Agência</th>
            <th>Conta</th>
            <th>Cidade</th>
            <th>UF</th>
          </tr>
          </tfoot>
        </table>
        @endif
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="/accounts/create" class="btn btn-sm btn-info btn-flat pull-left">Inserir</a> 
      </div>
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
      
<script>
  $(function () {
    $('#table-accounts').DataTable({
      'searching'   : false
    });
  })
</script>
@endsection
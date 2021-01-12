@extends('app.layout')
@section('content')
    <div class="container"   >
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
    <br><br>
    <div class="row justify-content-center">
  <div class="col-md-10 col-md-offset-1">
    <div class="card border-primary mb-3  text-white" >
      <div class="card-heading bg-success  " style="text-align:center;"><h2 class="card-title"> Cargar el padron de afiliados titulares activos en el sistema SGAP</h2></div>
        <div class="card-body">
          <form method="POST" action="xls" accept-charset="UTF-8" enctype="multipart/form-data">
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <label class="col-md-4 control-label">Suba el archivo en formato .xlsx</label>
              <div class="col-md-6">
              <label class="btn btn-lg bg-primary text-white"for="fileinput">Buscar archivo </label>
                <input id="fileinput" type="file" class="form-control" style='display: none;'name="filexls" >
              </div>
            </div>
 
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success ">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
 @endsection   

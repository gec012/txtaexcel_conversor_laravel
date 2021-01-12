@extends('app.layout')
@section('content')
    <div class="container "  >
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
    <br><br>
    <div class="row justify-content-center">
  <div class="col-md-10 col-md-offset-1">
    <div class="card border-primary mb-3  text-white" >
      <div class="card-heading bg-success  " style="text-align:center;"> <h2 class="card-title">Cargar el archivo de aportes UNSa</h2></div>
        <div class="card-body border-primary" >
          <form method="POST" action="storage/create" accept-charset="UTF-8" enctype="multipart/form-data">
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <label class="col-md-4 control-label ">Subir archivo en formato .txt
              </label>
              <div class="col-md-6">
              
              <label class="btn btn-lg bg-primary text-white"for="fileinput">Buscar archivo</label>
                    <input id="fileinput" type="file" class="form-control "style='display: none;' name="file" >
                
              
              </div>
            </div>
 
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success">Enviar</button>
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

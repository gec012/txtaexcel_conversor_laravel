@extends('app.layout')
@section('content')
<div class="container">
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="card  card-default text-white">

<div class="card-heading bg-success  " style="text-align:center;">
 <h2>Informes afiliados activos  sin aportes en el sistema SGAP</h2>
</div>
<div class="card-body">
<table id="myTable" class="table table-hover table-active table-bordered table-responsive table-condesed">
    <tr>
        <th class="bg-primary   text-white" >Fecha de creacion</th>
        <th class="bg-primary   text-white">Ver</th>
        <th class="bg-primary   text-white">Nombre</th>
        <th class="bg-primary   text-white">Descripcion</th>
      

        
        <th class="bg-primary   text-white" >Eliminar</th>
    </tr>
 
 
   
    @foreach ($archivos as $arch)
        <tr class="text-white">
            <td>{{ $arch->created_at}}</td>
           
                <td><a href="{{$arch->url}}" target='_blank'>Ver Archivo Excel</a></td>
          
             <td>{{ $arch->nombre}}</td>
            <td>{{ $arch->descripcion}}</td>
            
          

            <td> {!! Form::open(['method' => 'DELETE','route' => ['sgap_todos.destroy',$arch->id],'style'=>'display:inline']) !!}
        {!! Form::submit('Borrar', ['class' => 'btn btn-warning btn-md']) !!}
            {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    
</table>
</div>
</div>
</div>
@endsection

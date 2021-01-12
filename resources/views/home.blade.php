@extends('app.layout')
@section('content')
    <div class="container col-md-10">

       <h1 class="text-white" align="center"> ARCHIVOS OSUNSa</h1>  
      @if ($message = Session::get('success'))
         <div class="alert alert-success">
            <p>{{ $message }}</p>
         </div>
      @endif
       <br><br>
       
       <a href=""><img src="app/portada.png" hight="768" width="768"></a>
    
</div>
       
   @endsection
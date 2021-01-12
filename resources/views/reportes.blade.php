@extends('app.layout')
@section('content')
  
        <div class="container " >
            <div class="row justify-content-center">
                <div class="card card-default text-white">
                <div class="card-heading bg-success  " style="text-align:center;"><h1 class="card-title"> Informes</h1></div>
                        <div class="card-body ">
                        <table class="table table-striped table-bordered table-hover table-dark table-condesed">
                                <thead>
                                    <tr>
                                    
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Detalles</th>
                                    <th scope="col">Descargas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                    
                                    <td>Personas sin registrar </td>
                                    <td>Personas sin registrar a las cuales se le realizan aportes</td>
                                    <td>
                            <a class="btn btn-info" href="{{ route('reportecasinregistro','1') }}" target="_blank">Word</a>
                            <a class="btn text-white" style="background-color:green; " href="{{ route('reportecasinregistro','0') }}" target="_blank">Excel</a>
                            

                                    </td>
                                    </tr>
                                    <tr>
                                    
                                    <td>Afiliados inactivos a verificar</td>
                                    <td>Afiliados a los que se les realizan aportes y figuran como inactivos</td>
                                    <td>
                            <a class="btn btn-info" href="{{ route('reportecainactivos','1') }}" target="_blank">Word</a>
                            <a class="btn text-white" style="background-color:green; " href="{{ route('reportecainactivos','0') }}" target="_blank">Excel</a>
                              
                                    </td>
                                     </tr>
                                     <tr>
                                    <td>Afiliados activos a verificar</td>
                                    <td>Afiliados activos a los que no se le realizaron aportes</td>
                                    <td>
                            <a class="btn btn-info" href="{{ route('reporteactivossa','1') }}" target="_blank">Word</a>
                            <a class="btn text-white" style="background-color:green; " href="{{ route('reporteactivossa','0') }}" target="_blank">Excel</a>
                              
                            
                                    </td>
                                    </tr>
                                    <tr>
                                    
                                    <td>Afiliados a los que no se le realizaron aportes el ultimo mes</td>
                                    <td>Afiliados que no tienen aportes el ultimo mes pero si en el anterior</td>
                                    <td>
                            <a class="btn btn-info" href="{{ route('reportsaestemes','1') }}" target="_blank">Word</a>
                            <a class="btn text-white" style="background-color:green; " href="{{ route('reportsaestemes','0') }}" target="_blank">Excel</a>
                            

                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                                                  
                        
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\PadronSag;
use App\PersonasSag;
use App\PersonasUnsa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use JasperPHP\JasperPHP as JasperPHP;

class ReporteController extends Controller
{
    public function CAsinRegistro($extend)
    {
        $jasper = new JasperPHP; // instancio objeto
        $carpeta = (string) Carbon::today();
        $carpeta = \substr($carpeta, 0, 10);
        Storage::makeDirectory($carpeta);

        $guardar = 'app/' . $carpeta . '/ReportesPersonasConAporteSinRegistro';

        $band = true;
        $archivos = Archivo::all();
        foreach ($archivos as $arch) {
            if ($arch->url == $guardar . '.xlsx') {
                $band = false;
                $archivo = $arch;

                break;
            }
        }

        if ($band) {

            $personas = PersonasUnsa::orderby('año_mes', 'desc');
            $auxfecha = (string) $personas->first()->año_mes;

            $MES_UNSA = (double) substr($auxfecha, 5, 6);
            $ANIO_UNSA = (double) substr($auxfecha, 0, 5);

         
            $personas = PadronSag::orderby('created_at', 'desc');
            $auxfecha = (string) $personas->first()->created_at;

            $MES_SGAP = (double) substr($auxfecha, 5, 6);
            $ANIO_SGAP = (double) substr($auxfecha, 0, 5);


            $jasper->compile(base_path() . '/vendor/cossou/jasperphp/examples/ReportesPersonasConAporteSinRegistro.jrxml')->execute();
            $jasper->process(
                base_path() . '/vendor/cossou/jasperphp/examples/ReportesPersonasConAporteSinRegistro.jasper',
                public_path() .'/'. $guardar,
                array('xlsx', 'docx'),
                array(
                    'MES_UNSA' => $MES_UNSA,
                    'ANIO_UNSA' => $ANIO_UNSA,
                    'MES_SGAP' => $MES_SGAP,
                    'ANIO_SGAP' => $ANIO_SGAP,

                ),
                array(
                    'driver' =>'postgres',
                    'username' => 'postgres',
                    'password' => 'BsAsN367..',
                    'host' => '127.0.0.1',
                    'database' => 'conversordb',
                    'port' => '5432'
                    )

            )->execute();

            $archivo = new Archivo();
            $archivo->url = $guardar . '.docx';
            $archivo->nombre = 'ReportesPersonasConAporteSinRegistro';
            $archivo->extension = 'docx';
            $archivo->descripcion = 'Informe de personas con aportes de UNSa y sin registro en el sistema SGAP';
            $archivo->categoria = 'CAsinRegistro';
            $archivo->save();

            $archivo = new Archivo();
            $archivo->url = $guardar . '.xlsx';
            $archivo->nombre = 'ReportesPersonasConAporteSinRegistro';
            $archivo->extension = 'xlsx';
            $archivo->descripcion = 'Informe de personas con aportes de UNSa y sin registro en el sistema SGAP';
            $archivo->categoria = 'CAsinRegistro';
            $archivo->save();
        }

        if ($extend == '1') {
            $url = \explode(".", $archivo->url);

            return redirect($url[0] . '.docx');
        } else {
            return redirect($archivo->url);
        }

    }

    public function CAInactivos($extend)
    {
        $jasper = new JasperPHP; // instancio objeto
        $carpeta = (string) Carbon::today();
        $carpeta = \substr($carpeta, 0, 10);
        Storage::makeDirectory($carpeta);

        $guardar = 'app/' . $carpeta . '/ReportePersonasConAportesInactivo';

        $band = true;
        $archivos = Archivo::all();
        foreach ($archivos as $arch) {
            if ($arch->url == $guardar . '.xlsx') {
                $band = false;
                $archivo = $arch;

                break;
            }
        }

        if ($band) {
            $personas = PersonasUnsa::orderby('año_mes', 'desc');
            $auxfecha = (string) $personas->first()->año_mes;

            $MES_UNSA = (double) substr($auxfecha, 5, 6);
            $ANIO_UNSA = (double) substr($auxfecha, 0, 5);

            $personas = PersonasSag::orderby('created_at', 'desc');
            $auxfecha = (string) $personas->first()->created_at;

            $MES_ACTIVOS = (double) substr($auxfecha, 5, 6);
            $ANIO_ACTIVOS = (double) substr($auxfecha, 0, 5);

            $personas = PadronSag::orderby('created_at', 'desc');
            $auxfecha = (string) $personas->first()->created_at;

            $MES_SGAP = (double) substr($auxfecha, 5, 6);
            $ANIO_SGAP = (double) substr($auxfecha, 0, 5);

            
            $jasper->compile(base_path() . '/vendor/cossou/jasperphp/examples/ReportePersonasConAportesInactivo.jrxml')->execute();
            $jasper->process(
                base_path() . '/vendor/cossou/jasperphp/examples/ReportePersonasConAportesInactivo.jasper',
                public_path() .'/'. $guardar,
                array('xlsx', 'docx'),
                array(
                    'MES_UNSA' => $MES_UNSA,
                    'ANIO_UNSA' => $ANIO_UNSA,
                    'MES_ACTIVOS' => $MES_ACTIVOS,
                    'ANIO_ACTIVOS' => $ANIO_ACTIVOS,
                    'MES_SGAP' => $MES_SGAP,
                    'ANIO_SGAP' => $ANIO_SGAP,
                ),
                array(
                    'driver' =>'postgres',
                    'username' => 'postgres',
                    'password' => 'BsAsN367..',
                    'host' => '127.0.0.1',
                    'database' => 'conversordb',
                    'port' => '5432'
                    )

            )->execute();
            $archivo = new Archivo();
            $archivo->url = $guardar . '.docx';
            $archivo->nombre = 'ReportePersonasConAportesInactivo';
            $archivo->extension = 'docx';
            $archivo->descripcion = 'Informe de personas con aportes de UNSa que aparecen como inactivos en el sistema SGAP';
            $archivo->categoria = 'CAInactivos';
            $archivo->save();

            $archivo = new Archivo();
            $archivo->url = $guardar . '.xlsx';
            $archivo->nombre = 'ReportePersonasConAportesInactivo';
            $archivo->extension = 'xlsx';
            $archivo->descripcion = 'Informe de personas con aportes de UNSa que aparecen como inactivos en el sistema SGAP';
            $archivo->categoria = 'CAInactivos';
            $archivo->save();
        }
        if ($extend == '1') {
            $url = \explode(".", $archivo->url);

            return redirect($url[0] . '.docx');
        } else {
            return redirect($archivo->url);
        }

    }

    public function ActivosSA($extend)
    {
        $jasper = new JasperPHP; // instancio objeto
        $carpeta = (string) Carbon::today();
        $carpeta = \substr($carpeta, 0, 10);
        Storage::makeDirectory($carpeta);

        $guardar = 'app/' . $carpeta . '/ReporteActivosSinAportes';

        $band = true;
        $archivos = Archivo::all();
        foreach ($archivos as $arch) {
            if ($arch->url == $guardar . '.xlsx') {
                $band = false;
                $archivo = $arch;

                break;
            }
        }

        if ($band) {

            $personas = PersonasUnsa::orderby('año_mes', 'desc');
            $auxfecha = (string) $personas->first()->año_mes;

            $MES_UNSA = (double) substr($auxfecha, 5, 6);
            $ANIO_UNSA = (double) substr($auxfecha, 0, 5);

            $personas = PersonasSag::orderby('created_at', 'desc');
            $auxfecha = (string) $personas->first()->created_at;

            $MES_ACTIVOS = (double) substr($auxfecha, 5, 6);
            $ANIO_ACTIVOS = (double) substr($auxfecha, 0, 5);

            $jasper->compile(base_path() . '/vendor/cossou/jasperphp/examples/ReporteActivosSinAportes.jrxml')->execute();

            $jasper->process(
                base_path() . '/vendor/cossou/jasperphp/examples/ReporteActivosSinAportes.jasper',
                public_path() .'/'. $guardar,
                array('xlsx', 'docx'),

                array(

                    'MES_UNSA' => $MES_UNSA,
                    'ANIO_UNSA' => $ANIO_UNSA,
                    ' MES_ACTIVOS' => $MES_ACTIVOS,
                    'ANIO_ACTIVOS' => $ANIO_ACTIVOS,

                ),
                array(
                    'driver' =>'postgres',
                    'username' => 'postgres',
                    'password' => 'BsAsN367..',
                    'host' => '127.0.0.1',
                    'database' => 'conversordb',
                    'port' => '5432'
                    )

            )->execute();
            $archivo = new Archivo();
            $archivo->url = $guardar . '.docx';
            $archivo->nombre = 'ReporteActivosSinAportes';
            $archivo->extension = 'docx';
            $archivo->descripcion = 'Informe de personas sin aportes de UNSa que aparecen como activos en el sistema SGAP';
            $archivo->categoria = 'ActivosSA';
            $archivo->save();

            $archivo = new Archivo();
            $archivo->url = $guardar . '.xlsx';
            $archivo->nombre = 'ReporteActivosSinAportes';
            $archivo->extension = 'xlsx';
            $archivo->descripcion = 'Informe de personas sin aportes de UNSa que aparecen como activos en el sistema SGAP';
            $archivo->categoria = 'ActivosSA';
            $archivo->save();
        }
        if ($extend == '1') {
            $url = \explode(".", $archivo->url);

            return redirect($url[0] . '.docx');
        } else {
            return redirect($archivo->url);
        }

    }

    public function SAEsteMes($extend)
    {
        $jasper = new JasperPHP; // instancio objeto
        $carpeta = (string) Carbon::today();
        $carpeta = \substr($carpeta, 0, 10);
        Storage::makeDirectory($carpeta);

        $guardar = 'app/' . $carpeta . '/SinAportesEsteMes';

        $band = true;
        $archivos = Archivo::all();
        foreach ($archivos as $arch) {
            if ($arch->url == $guardar . '.xlsx') {
                $band = false;
                $archivo = $arch;

                break;
            }
        }

        if ($band) {

            $personas = PersonasUnsa::orderby('año_mes', 'desc');
            $auxfecha = (string) $personas->first()->año_mes;

            $MES_DOS = (double) substr($auxfecha, 5, 6);
            $ANIO_DOS = (double) substr($auxfecha, 0, 5);

            $auxfecha = Carbon::create($auxfecha)->subMonth()->toDateString();
            $MES_UNO = (double) substr($auxfecha, 5, 6);
            $ANIO_UNO = (double) substr($auxfecha, 0, 5);
         
            $jasper->compile(base_path() . '/vendor/cossou/jasperphp/examples/SinAportesEsteMes.jrxml')->execute();
            $jasper->process(
                base_path() . '/vendor/cossou/jasperphp/examples/SinAportesEsteMes.jasper',
                public_path() .'/'. $guardar,
                array('xlsx', 'docx'),

                array(

                    'MES_UNO' => $MES_UNO,
                    'ANIO_UNO' => $ANIO_UNO,
                    'MES_DOS' => $MES_DOS,
                    'ANIO_DOS' => $ANIO_DOS,
                ),
                array(
                    'driver' =>'postgres',
                    'username' => 'postgres',
                    'password' => 'BsAsN367..',
                    'host' => '127.0.0.1',
                    'database' => 'conversordb',
                    'port' => '5432'
                    )

            )->execute();
            $archivo = new Archivo();
            $archivo->url = $guardar . '.docx';
            $archivo->nombre = 'Informe_de_afiliados_sin_aportes_este_mes';
            $archivo->extension = 'docx';
            $archivo->descripcion = 'Informe de afiliadps activos a los que nos se le realizaron aportes el ultimo mes';
            $archivo->categoria = 'SAEsteMes';
            $archivo->save();

            $archivo = new Archivo();
            $archivo->url = $guardar . '.xlsx';
            $archivo->nombre = 'Informe_de_afiliados_sin_aportes_este_mes';
            $archivo->extension = 'xlsx';
            $archivo->descripcion = 'Informe de afiliadps activos a los que nos se le realizaron aportes el ultimo mes';
            $archivo->categoria = 'SAEsteMes';
            $archivo->save();
        }


        if ($extend == '1') {
            $url = \explode(".", $archivo->url);

            return redirect($url[0] . '.docx');
        } else {
            return redirect($archivo->url);
        }

    }
}

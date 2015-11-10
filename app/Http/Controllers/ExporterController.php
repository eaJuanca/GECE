<?php

namespace App\Http\Controllers;

use App\model\Factura;
use Illuminate\Http\Request;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class ExporterController extends Controller
{

    public function ExportFacturas(Request $request){


        $s = $request->input('search');

        $data = null;

        if($s != 1){

            $data = Factura::take(1000)->get(['created_at','serie','numero','base','iva','total','nombre_facturado','dni_facturado']);

        }else if($s == 1){

            $titular = $request->input('titular');
            $difunto = $request->input('difunto');
            $dni = $request->input('dni');
            $calle = $request->input('calle');
            $desde = $request->input('desde');
            $hasta = $request->input('hasta');

            $data = Factura::orderBy('id','DESC')->where(function($facturas) use ($titular, $difunto, $dni, $calle, $desde, $hasta){

                if($titular != "") $facturas->where('nombre_titular','like',"%$titular%");
                if($difunto != "") $facturas->where('nom_difunto','like',"%$difunto%");
                if($dni != "") $facturas->where('dni_titular','like',"%$dni%");
                if($calle != "") $facturas->where('calle','like',"%$calle%");

                if($desde != "" && $hasta != ""){

                    $facturas->whereBetween('inicio', array($desde, $hasta));

                }else if($desde != ""){

                    $facturas->where('inicio','>=',$desde);
                } else if($hasta != ""){
                    $facturas->where('inicio','<=', $hasta);
                }

            })->get(['created_at','serie','numero','base','iva','total','nombre_facturado','dni_facturado']);

        }


        Excel::create('Filename', function($excel) use($data) {


            $excel->setTitle('Facturas');

            $excel->sheet('Facturas', function($sheet) use($data) {

                $sheet->fromModel($data,null,'A1',false,true);

                $sheet->row(1, function($row) {
                    // call cell manipulation methods
                    $row->setFontWeight('bold');
                });
            });

        })->download('xls');

    }

}

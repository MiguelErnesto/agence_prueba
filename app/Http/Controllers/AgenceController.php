<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\permissaoSistema;
use App\Models\caoUsuario;
use App\Models\caoFatura;
use App\Models\caoSalario;
use Carbon\Carbon;

class AgenceController extends Controller
{
    //PUBLIC FUNCTIONS
    public function conDesempenho()
    {
        $consultores = $this->consultores();
        $result = null;
        return view('agence.con_desempenho', compact('consultores', 'result'));
    }

    public function relatorio(Request $request)
    {
        $result = [];
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $consultores = $request->consultoresSelected;

        foreach ($consultores as $consultor) {
            $relatorioConsultor = $this->relatorioConsultor(
                $consultor,
                $fechaInicio,
                $fechaFin
            );
            $result[] = $relatorioConsultor;
        }

        $consultores = $this->consultores();

        $this->generarXmlGraficoData($result, $fechaInicio, $fechaFin);

        return response()->json([
            'result' => $result,
            'consultores' => $consultores[0],
        ]);
    }

    //PRIVATE FUNCTIONS
    private function consultores($co_usuario = null)
    {
        $query = DB::table('cao_usuario as cu')
            ->join(
                'permissao_sistema as ps',
                'ps.co_usuario',
                '=',
                'cu.co_usuario'
            )
            ->where('ps.co_sistema', '=', 1)
            ->where('ps.in_ativo', '=', 'S')
            ->whereIn('ps.co_tipo_usuario', [0, 1, 2]);

        if ($co_usuario !== null) {
            $query->where('cu.co_usuario', '=', $co_usuario);
        }

        $query->orderBy('cu.no_usuario', 'asc');

        return $query->get();
    }

    private function relatorioConsultor($consultor, $fechaInicio, $fechaFin)
    {
        //nombre usuario
        $nombreUsuario = caoUsuario::select('no_usuario')
            ->where('co_usuario', '=', $consultor)
            ->first();

        //receita_liquida
        $query = DB::table('cao_fatura as cf')
            ->join('cao_os as co', 'co.co_os', '=', 'cf.co_os')
            ->join('cao_usuario as cu', 'cu.co_usuario', '=', 'co.co_usuario')
            ->selectRaw(
                'SUM(cf.total_imp_inc) as total_imp_inc, SUM(cf.valor) as valor, cf.data_emissao'
            )
            ->where('cu.co_usuario', '=', $consultor)
            ->whereBetween('cf.data_emissao', [$fechaInicio, $fechaFin])
            ->groupBy('cf.data_emissao')
            ->get();

        $grouped = $query->groupBy(function ($item) {
            return Carbon::parse($item->data_emissao)->format('Y-m'); // agrupa por año-mes tipo "2025-09"
        });

        //custo_fixo
        $query = DB::table('cao_salario as cs')
            ->select('cs.brut_salario')
            ->where('cs.co_usuario', '=', $consultor)
            ->get();

        $custo_fixo = count($query) > 0 ? $query[0]->brut_salario : 0;

        //comissao
        $start = Carbon::parse($fechaInicio)->startOfDay(); // 2023-09-01 00:00:00
        $end = Carbon::parse($fechaFin)->endOfDay(); // 2023-09-30 23:59:59

        $query = DB::table('cao_fatura as cf')
            ->select('cf.comissao_cn', 'cu.no_usuario')
            ->join('cao_os as co', 'co.co_os', '=', 'cf.co_os')
            ->join('cao_usuario as cu', 'cu.co_usuario', '=', 'co.co_usuario')
            ->where('cu.co_usuario', '=', $consultor)
            ->whereBetween('cf.data_emissao', [$start, $end])
            ->get();
        $comissao_cn = count($query) > 0 ? $query[0]->comissao_cn : 0;
        $dataExist = count($query) > 0 ? true : false;

        return [
            'dataExist' => $dataExist,
            'data' => $grouped,
            'co_usuario' => $consultor,
            'no_usuario' => $nombreUsuario->no_usuario,
            'custo_fixo' => $custo_fixo,
            'comissao_cn' => $comissao_cn,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ];
    }

    private function obtenerMesesEntreFechas(
        array $datos,
        string $fechaInicio,
        string $fechaFin
    ): array {
        $inicio = Carbon::parse($fechaInicio)->firstOfMonth();
        $mesActual = Carbon::parse($fechaInicio)->firstOfMonth();
        $fin = Carbon::parse($fechaFin)->firstOfMonth();
        $meses = [];

        while ($inicio <= $fin) {
            $mesActual = $inicio->format('Y-m');
            $found = false;
            foreach ($datos as $index => $dato) {
                if ($dato['dataExist']) {
                    if (isset($dato['data'][$mesActual])) {
                        $found = true;
                    }
                }
            }
            if ($found) {
                $meses[] = $mesActual;
            }
            $inicio->addMonth();
            $found = false;
            /* $meses[] = $inicio->format('Y-m');
             $inicio->addMonth(); */
        }

        return $meses;
    }

    private function coloresParaConsultores(int $cantidad): array
    {
        $colores = [];
        for ($i = 0; $i < $cantidad; $i++) {
            // Generar un color HSL girando el matiz (hue) entre 0 y 360 grados
            $hue = intval(($i * 360) / $cantidad);
            $colores[] = "hsl($hue, 70%, 50%)"; // saturación 70%, luminosidad 50%
        }

        return $colores;
    }

    private function formatoAnoMesPt(string $fechaYm): string
    {
        $mesesPt = [
            '01' => 'Jan',
            '02' => 'Fev',
            '03' => 'Mar',
            '04' => 'Abr',
            '05' => 'Mai',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ago',
            '09' => 'Set',
            '10' => 'Out',
            '11' => 'Nov',
            '12' => 'Dez',
        ];
        [$ano, $mes] = explode('-', $fechaYm);
        $abreviaturaMes = $mesesPt[$mes] ?? '???';

        return $abreviaturaMes . $ano;
    }

    private function generarXmlGraficoData(
        array $datos,
        string $fechaInicio,
        string $fechaFin
    ) {
        $xmlBody = '';

        $colores = $this->coloresParaConsultores(count($datos));
        $meses = $this->obtenerMesesEntreFechas(
            $datos,
            $fechaInicio,
            $fechaFin
        );

        $xmlMeses = '';

        foreach ($datos as $index => $dato) {
            if ($dato['dataExist']) {
                //Datos por Consultores para cada mes involucrado en el periodo
                $xmlBody .=
                    '    <dataset seriesName="' .
                    htmlspecialchars($dato['no_usuario']) .
                    '" color="' .
                    $colores[$index] .
                    '" numberPrefix="R$ ">' .
                    "\n";

                $xmlMeses = '<categories>' . "\n";
                foreach ($meses as $mes) {
                    $annoMesPT = $this->formatoAnoMesPt($mes);
                    $xmlMeses .=
                        '<category name="' .
                        $annoMesPT .
                        '" hoverText="' .
                        $annoMesPT .
                        '" /> ' .
                        "\n";

                    if (isset($dato['data'][$mes])) {
                        $valor = 0;
                        $total_imp_inc = 0;
                        $receita_liquida = 0;

                        foreach ($dato['data'][$mes] as $ind => $d) {
                            $valor += $d->valor;
                            $total_imp_inc += $d->total_imp_inc;
                        }
                        $receita_liquida = $valor - $total_imp_inc;

                        $xmlBody .=
                            '    <set value="' .
                            $receita_liquida .
                            '" /> ' .
                            "\n";
                    } else {
                        $xmlBody .= '    <set value="0" /> ' . "\n";
                    }
                }

                $xmlMeses .= '<categories>' . "\n";
                $xmlBody .= '  </dataset>' . "\n";
            }
        }

        $xmlHead =
            '<graph bgColor="F1f1f1" caption="Performance Comercial" subCaption="Janeiro de 2007 a Maio de 2007" showValues="0" divLineDecimalPrecision="2" formatNumberScale="2" limitsDecimalPrecision="2" PYAxisName="" SYAxisName="" decimalSeparator="," thousandSeparator="." SYAxisMaxValue="32000" PYAxisMaxValue="32000">' .
            "\n";

        $xmlFoot = '</graph>' . "\n";

        $xmlAll = $xmlHead . $xmlMeses . $xmlBody . $xmlFoot;

        // Guardar el XML en un archivo
        $nombreArchivo = 'productos_manual.xml';
        // $rutaArchivo = storage_path('/' . $nombreArchivo);
        $rutaArchivo = public_path('/charts/' . $nombreArchivo);
        file_put_contents($rutaArchivo, $xmlAll);
    }
}

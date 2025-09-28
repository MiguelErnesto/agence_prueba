<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
        $query = DB::table('cao_fatura as cf')
            ->select('cf.comissao_cn', 'cu.no_usuario')
            ->join('cao_os as co', 'co.co_os', '=', 'cf.co_os')
            ->join('cao_usuario as cu', 'cu.co_usuario', '=', 'co.co_usuario')
            ->where('cu.co_usuario', '=', $consultor)
            ->whereBetween('cf.data_emissao', [$fechaInicio, $fechaFin])
            ->get();
        $comissao_cn = count($query) > 0 ? $query[0]->comissao_cn : 0;
        $no_usuario = count($query) > 0 ? $query[0]->no_usuario : 0;

        return [
            'data' => $grouped,
            'co_usuario' => $consultor,
            'no_usuario' => $nombreUsuario->no_usuario,
            'custo_fixo' => $custo_fixo,
            'comissao_cn' => $comissao_cn,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ];
    }
}

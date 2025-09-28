//import Utils from "../services/utils.js";
import Request from "./request.js";

export default class Consultores {
  constructor() {
    this.btnRelatorio = document.getElementById("btnRelatorio");
    this.list2 = document.getElementById("list2");
    this.divResultadosRelatorio = document.getElementById(
      "divResultadosRelatorio"
    );
    this.tableResultadosRelatorio = document.getElementById(
      "tableResultadosRelatorio"
    );

    this.inpFechaInicio = document.getElementById("inpFechaInicio");
    this.inpFechaFin = document.getElementById("inpFechaFin");
    this.listeners();
    this.establecerFechasHoy();
  }

  listeners = () => {
    this.btnRelatorio.addEventListener("click", (evt) => {
      evt.stopPropagation();
      evt.preventDefault();
      this.tableResultadosRelatorio.innerHTML = "";
      this.onRelatorio();
    });
  };

  establecerFechasHoy = () => {
    const hoy = new Date();

    const yyyy = hoy.getFullYear();
    const mm = String(hoy.getMonth() + 1).padStart(2, "0");
    const dd = String(hoy.getDate()).padStart(2, "0");

    this.inpFechaInicio.value = `${yyyy}-${mm}-${dd}`;
    this.inpFechaFin.value = `${yyyy}-${mm}-${dd}`;
  };

  onRelatorio = async () => {
    this.divResultadosRelatorio.classList.add("d-none");
    let res = await this.relatorio();
    this.render(res["result"]);
    this.divResultadosRelatorio.classList.remove("d-none");
  };

  obtenerMesesEntreFechas = (fechaInicial, fechaFinal) => {
    const inicio = new Date(fechaInicial);
    const fin = new Date(fechaFinal);
    const meses = [];

    let fechaActual = new Date(inicio.getFullYear(), inicio.getMonth(), 1);

    while (fechaActual <= new Date(fin.getFullYear(), fin.getMonth(), 1)) {
      const año = fechaActual.getFullYear();
      const mes = String(fechaActual.getMonth() + 1).padStart(2, "0");
      meses.push(`${año}-${mes}`);

      fechaActual.setMonth(fechaActual.getMonth() + 1);
    }

    return meses;
  };

  formatoMesAnoPT = (fecha) => {
    const meses = [
      "Janeiro",
      "Fevereiro",
      "Março",
      "Abril",
      "Maio",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ];

    const [ano, mes] = fecha.split("-");
    const mesNome = meses[parseInt(mes, 10) - 1];

    return `${mesNome} de ${ano}`;
  };

  number_format = (num) => {
    let newNum = num < 0 ? -1 * num : num;
    let numberFormated = new Intl.NumberFormat("es-ES", {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    }).format(newNum);

    let simbol = num < 0 ? "- R$ " : "R$ ";
    return simbol + numberFormated;
  };

  render = (res) => {
    res.forEach((itemRes) => {
      if (itemRes["dataExits"]) {
        var tableHeader = `
            <table class="tabla-profesional">
            <thead>
            <tr>
            <th colspan=5 class='th1'>${itemRes["no_usuario"]}</th>    
          </tr>
              <tr>
                <th class='th2'>Per&iacute;odo</th>
                <th class='th2'>Receita L&iacute;quida</th>
                <th class='th2'>Custo Fixo </th>
                <th class='th2'>Comiss&atilde;o</th>
                <th class='th2'>Lucro</th>
              </tr>
            </thead>
            <tbody>
            `;
        var tableRows = "";
        var tableFooter = "";
        var tableEnd = "</tbody></table><br/>";

        //SALDO TOTAL
        var saldo_receita_liquida = 0;
        var saldo_custo_fixo = 0;
        var saldo_comissao = 0;
        var saldo_lucro = 0;

        let meses = this.obtenerMesesEntreFechas(
          itemRes["fechaInicio"],
          itemRes["fechaFin"]
        );
        var valor = 0;
        var total_imp_inc = 0;
        var receita_liquida = 0;
        var custo_fixo = itemRes["custo_fixo"];
        var comissao_cn = itemRes["comissao_cn"];
        var comissao = 0;
        var lucro = 0;
        meses.forEach((item) => {
          if (typeof itemRes["data"][item] !== "undefined") {
            console.log(itemRes["data"][item]);
            itemRes["data"][item].forEach((itm) => {
              valor += itm.valor;
              total_imp_inc += itm.total_imp_inc;
            });
            receita_liquida = valor - total_imp_inc;
            comissao = (valor - valor * total_imp_inc) * comissao_cn;
            lucro = valor - total_imp_inc - (custo_fixo + comissao);
            tableRows =
              tableRows +
              `<tr bgcolor=#fafafa>
                  <td nowrap class='tdRow text-left'>
                    ${this.formatoMesAnoPT(item)}
                  </td>
                  <td class='tdRow'>
                      ${this.number_format(receita_liquida)}           
                  </td>
                  <td class='tdRow'>
                    ${this.number_format(custo_fixo)} 
                  </td>
                  <td class='tdRow'>
                    ${this.number_format(comissao)}
                  </td>
                  <td class='${lucro < 0 ? "tdRow text-danger" : "tdRow"}'>
                      ${this.number_format(lucro)}
                  </td>
              </tr>`;
          }
          saldo_receita_liquida += receita_liquida;
          saldo_custo_fixo += custo_fixo;
          saldo_comissao += comissao;
          saldo_lucro += lucro;
        });
        tableFooter = `
            <tr bgcolor=#efefef>
            <td nowrap class='tdSaldo text-left'>SALDO</td>
            <td class='tdSaldo'>${this.number_format(
              saldo_receita_liquida
            )}</td>
            <td class='tdSaldo'>${this.number_format(saldo_custo_fixo)}</td>
            <td class='tdSaldo'>${this.number_format(saldo_comissao)}</td>
            <td class='tdSaldo text-primary'>${this.number_format(
              saldo_lucro
            )}</td>
            </tr> `;

        this.tableResultadosRelatorio.innerHTML +=
          tableHeader + tableRows + tableFooter + tableEnd;
      } else {
        let tableSinDatos = `
        <table class="tabla-profesional">
        <thead>
        <tr>
        <th colspan=1 class='th1'>${itemRes["no_usuario"]}</th>    
        <th colspan=4 class='th1 text-left pl-2'> Nenhum dado no período selecionado</th>    
      </tr>
        </thead>
        </table>
        <br/>`;
        this.tableResultadosRelatorio.innerHTML += tableSinDatos;
      }
    });
  };

  relatorio = async (evt) => {
    const selectedValues = Array.from(this.list2.options).map((o) => o.value);
    console.log(selectedValues);
    let fechaInicio = this.inpFechaInicio.value;
    let fechaFin = this.inpFechaFin.value;

    let data = {
      consultoresSelected: selectedValues,
      fechaInicio: fechaInicio,
      fechaFin: fechaFin,
    };
    console.log("DATA", data);

    const res = await Request.postWithToken("/relatorio", data);
    console.log("RESULTADO", res);
    return res;
  };
}
const onConsultores = async () => {
  var listHandler = new Consultores();
};

window.addEventListener("load", onConsultores);

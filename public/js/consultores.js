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
    this.divGraficoBarras = document.getElementById("divGraficoBarras");
    this.divGraficoPizza = document.getElementById("divGraficoPizza");

    this.listeners();
    this.establecerFechasHoy();
  }

  listeners = () => {
    this.btnRelatorio.addEventListener("click", (evt) => {
      evt.stopPropagation();
      evt.preventDefault();
      const selectedValues = Array.from(this.list2.options).map((o) => o.value);
      if (selectedValues.length == 0) {
        alert("Não há consultor selecionado.");
        return false;
      }
      this.divGraficoBarras.classList.add("d-none");
      this.divGraficoPizza.classList.add("d-none");
      this.tableResultadosRelatorio.innerHTML = "";
      this.onRelatorio();
    });
  };

  establecerFechasHoy = () => {
    const hoy = new Date();

    const yyyy = hoy.getFullYear();
    const mm = String(hoy.getMonth() + 1).padStart(2, "0");
    const dd = String(hoy.getDate()).padStart(2, "0");

    this.inpFechaInicio.value = `${yyyy}-${mm}`;
    this.inpFechaFin.value = `${yyyy}-${mm}`;
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
    var saldo_receita_liquida = 0;
    var saldo_custo_fixo = 0;
    var saldo_comissao = 0;
    var saldo_lucro = 0;
    res.forEach((itemRes) => {
      //SALDO TOTAL
      saldo_receita_liquida = 0;
      saldo_custo_fixo = 0;
      saldo_comissao = 0;
      saldo_lucro = 0;

      if (itemRes["dataExist"]) {
        var tableHeader = `
        <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th colspan="5" class="bg-light fs-6">${itemRes["no_usuario"]}</th>
        </tr>
       </thead>
        <tr>
          <td class="fw-bold text-center" style="width: 20%;">Período</td>
          <td class="fw-bold text-center" style="width: 20%;">Receita Líquida</td>
          <td class="fw-bold text-center" style="width: 20%;">Custo Fixo</td>
          <td class="fw-bold text-center" style="width: 20%;">Comissão</td>
          <td class="fw-bold text-center" style="width: 20%;">Lucro</td>
        </tr>
      <tbody>`;
        var tableRows = "";
        var tableFooter = "";
        var tableEnd = "</tbody></table><br/>";

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
              `<tr>
                  <td class="text-start">
                    ${this.formatoMesAnoPT(item)}
                  </td>
                  <td class="text-end">
                      ${this.number_format(receita_liquida)}           
                  </td>
                  <td class="text-end">
                    ${this.number_format(custo_fixo)} 
                  </td>
                  <td class="text-end">
                    ${this.number_format(comissao)}
                  </td>
                  <td class='${
                    lucro < 0 ? "text-end text-danger" : "text-end "
                  }'>
                      ${this.number_format(lucro)}
                  </td>
              </tr>`;

            saldo_receita_liquida += receita_liquida;
            saldo_custo_fixo += custo_fixo;
            saldo_comissao += comissao;
            saldo_lucro += lucro;
          }
        });
        tableFooter = `
            <tr>
            <td class="fw-bold text-left">SALDO</td>
            <td class="fw-bold text-right">${this.number_format(
              saldo_receita_liquida
            )}</td>
            <td class="fw-bold text-right">${this.number_format(
              saldo_custo_fixo
            )}</td>
            <td class="fw-bold text-right">${this.number_format(
              saldo_comissao
            )}</td>
            <td class="fw-bold text-right text-primary">${this.number_format(
              saldo_lucro
            )}</td>
            </tr> `;

        this.tableResultadosRelatorio.innerHTML +=
          tableHeader + tableRows + tableFooter + tableEnd;
      } else {
        let tableSinDatos = `
        <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th colspan="2" style="width: 40%;" class="bg-light fs-6">${itemRes["no_usuario"]}</th>
          <th colspan="3" class="bg-light"> Nenhum dado no período selecionado</th>
        </tr>        
      </thead>
      <tbody>
        <br/>`;
        this.tableResultadosRelatorio.innerHTML += tableSinDatos;
      }
    });
  };

  fechaConUltimoDiaDelMes = (yyyy_mm) => {
    const [year, month] = yyyy_mm.split("-").map(Number);
    // Mes en JS va de 0 (enero) a 11 (diciembre), pero aquí sumamos 1 porque queremos el siguiente mes
    // Día 0 del siguiente mes es el último día del mes actual
    const lastDay = new Date(year, month, 0);
    // Formatear con ceros a la izquierda
    const mm = (lastDay.getMonth() + 1).toString().padStart(2, "0");
    const dd = lastDay.getDate().toString().padStart(2, "0");
    return `${lastDay.getFullYear()}-${mm}-${dd}`;
  };

  relatorio = async (evt) => {
    const selectedValues = Array.from(this.list2.options).map((o) => o.value);
    console.log(selectedValues);

    let fechaInicio = this.inpFechaInicio.value + "-01";
    let fechaFin = this.fechaConUltimoDiaDelMes(this.inpFechaFin.value);

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

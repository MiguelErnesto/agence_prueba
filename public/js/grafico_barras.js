import Request from "./request.js";

export default class graficoBarras {
  constructor() {
    this.btnGraficoBarras = document.getElementById("btnGraficoBarras");
    this.divGraficoBarras = document.getElementById("divGraficoBarras");
    this.myChart = null;

    this.divResultadosRelatorio = document.getElementById(
      "divResultadosRelatorio"
    );
    this.divGraficoPizza = document.getElementById("divGraficoPizza");
    this.listeners();
  }

  listeners = () => {
    this.btnGraficoBarras.addEventListener("click", (evt) => {
      evt.stopPropagation();
      evt.preventDefault();
      this.divResultadosRelatorio.classList.add("d-none");
      this.divGraficoBarras.classList.add("d-none");
      this.divGraficoPizza.classList.add("d-none");
      this.graficoBarras();
      this.divGraficoBarras.classList.remove("d-none");
    });
  };

  graficoBarras = async () => {
    await fetch("xml/data_line_bar.xml")
      .then((response) => response.text())
      .then((xmlString) => {
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlString, "text/xml");

        const categories = Array.from(xmlDoc.querySelectorAll("category")).map(
          (cat) => cat.getAttribute("name")
        );
        const datasets = Array.from(xmlDoc.querySelectorAll("dataset")).map(
          (datasetElement) => {
            return {
              label: datasetElement.getAttribute("seriesName"),
              backgroundColor: datasetElement.getAttribute("color"),
              data: Array.from(datasetElement.querySelectorAll("set")).map(
                (set) => parseInt(set.getAttribute("value"))
              ),
            };
          }
        );

        const ctx = document.getElementById("graficoBarras").getContext("2d");

        if (this.myChart) {
          this.myChart.destroy();
        }

        this.myChart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: categories,
            datasets: datasets,
          },
          options: {
            responsive: true, // para que se ajuste al contenedor
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      })
      .catch((err) => console.error("Error cargando XML:", err));
  };
}

const onGraficoBarras = async () => {
  var listHandler = new graficoBarras();
};

window.addEventListener("load", onGraficoBarras);

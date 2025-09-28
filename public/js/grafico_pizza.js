import Request from "./request.js";

export default class graficoPizza {
  constructor() {
    this.btnGraficoPizza = document.getElementById("btnGraficoPizza");
    this.divGraficoPizza = document.getElementById("divGraficoPizza");
    this.myChartPizza = null;

    this.divGraficoBarras = document.getElementById("divGraficoBarras");
    this.divResultadosRelatorio = document.getElementById(
      "divResultadosRelatorio"
    );

    this.listeners();
  }

  listeners = () => {
    this.btnGraficoPizza.addEventListener("click", (evt) => {
      evt.stopPropagation();
      evt.preventDefault();
      this.divResultadosRelatorio.classList.add("d-none");
      this.divGraficoBarras.classList.add("d-none");
      this.divGraficoPizza.classList.add("d-none");
      this.pizza();
      this.divGraficoPizza.classList.remove("d-none");
    });
  };

  graficoPizza = async () => {
    await fetch("charts/data_pizza.xml")
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

        const ctx = document.getElementById("graficoPizza").getContext("2d");

        if (this.myChartPizza) {
          this.myChartPizza.destroy();
        }

        this.myChartPizza = new Chart(ctx, {
          type: "pie",
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

  pizza = async () => {
    await fetch("charts/data_pizza.xml")
      .then((response) => response.text())
      .then((xmlString) => {
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlString, "text/xml");

        const sets = xmlDoc.getElementsByTagName("set");
        const labels = [];
        const data = [];
        const backgroundColors = [];

        for (let i = 0; i < sets.length; i++) {
          labels.push(sets[i].getAttribute("name"));
          data.push(parseFloat(sets[i].getAttribute("value")));
          // Añadimos # al color y lo ponemos en formato CSS válido
          backgroundColors.push("#" + sets[i].getAttribute("color"));
        }

        const ctx = document.getElementById("graficoPizza").getContext("2d");

        if (this.myChartPizza) {
          this.myChartPizza.destroy();
        }

        this.myChartPizza = new Chart(ctx, {
          type: "pie",
          data: {
            labels: labels,
            datasets: [
              {
                data: data,
                backgroundColor: backgroundColors,
                borderColor: "#fff",
                borderWidth: 2,
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: "right" },
              title: {
                display: true,
                text: xmlDoc.documentElement.getAttribute("caption"),
              },
            },
          },
        });
      })
      .catch((err) => console.error("Error cargando XML:", err));
  };
}

const onGraficoBarras = async () => {
  var listHandler = new graficoPizza();
};

window.addEventListener("load", onGraficoBarras);

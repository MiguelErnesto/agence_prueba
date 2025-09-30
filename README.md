DETALLES DE LA TAREA

Publicado en: https://medevep.gt.tc/

GitHub: https://github.com/MiguelErnesto/agence_prueba.git

Horas de trabajo 20 horas
- análisis
- preparación del ambiente de trabajo
- desarrollo
- pruebas
- dominio y hosting


DESCRIPCION DE LA TAREA

Base de Datos
- Había un error en una sentencia sql que terminaba en coma (,) en lugar de punto y coma (;) lo que interrumpía la importación de datos.
- Vale destacar además que el valor por defecto '0000-00-00 00:00:00' para campos datetime y '0000-00-00' para campos date ya no es válido para versiones más modernas del mysql. En estos casos debe ponerse null, o en caso de que no se permita el null, una fecha fija. Aqui tuve que modificar esto además para la importación en mi servidor mysql.

Tecnología utilizada
Backend: 
- Laravel 
- php 8.4 inicialmente
- hubo que hacer un downgrade a php 8.3 por requerimientos del hosting.
- mySql 8.0.40
- Arquitectura Modelo-Vista-Controlodor, aislando la capa de datos, métodos y datos para mayor seguridad del sistema.
 
Frontend:
- Motor de plantillas Blade
- Bootstrap5
- Material Design
- Responsive
- JavaScript
- Css
- Html
 
De la aplicación
- Relatorio: Se muestran también los consultores que no tienen datos.

De los gráficos
- Se muestran solamente los consultores con datos en el período.
- Los gráficos no están exactamente igual al ejemplo de la tarea pues según el formato de los xml parecen ser generados con una librería bajo licencia y se usó una librería gratis en su lugar.
- Por la razón anterior el Custo Fixo Medio no se muestra como una linea sino como una barra en color negro al final de cada mes.
- Los botones Gráfico y Pizza mostrarán los últimos datos generados hasta que se generen nuevos datos.

Rutas
- Las rutas están definidas en web.php. Ahi hay dos rutas definidas '/', que carga la página principal, y '/relatorio', que se llama al hacer click en Relatorio.

Controlodor
- En el controlador app/Http/Controllers/AgenceController.php están implementados los métodos del sistema

 Métodos
 - conDesempenho: realiza la consulta para obtener los consultores y los devuelve a la vista 
 - relatorio: Realiza el cálculo para la tabla de relatores y llama el método generarXmlData para generar el xml con los datos obtenidos.
 -  Existen además varios métodos privados usados internamente por los métodos públicos para mejor organización y modulación del código (obtenerMesesEntreFechas, coloresParaConsultores, formatoAnoMesPt, generarXmlPizzaData, xmlPromedio, generarXmlData)

 JavaScript
 - public/js/consultores.js Hace la llamada al método AgenceController::relatorio y procesa los datos para mostrar las tablas con los datos de los Consultores.
 - public/js/grafico_barras.js Carga el xml para el gráfico de barras generado con los datos del Relatorio.
 - public/js/grafico_pizza.js  Carga el xml para el gráfico pizza generado con los datos del Relatorio.
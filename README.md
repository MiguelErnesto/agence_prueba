DETALLES DE LA TAREA

Publicado en: https://medevep.gt.tc/

GitHub: https://github.com/MiguelErnesto/agence_prueba.git

Horas de trabajo 20 horas
- análisis
- preparación del ambiente de trabajo
- desarrollo
- pruebas
- hosting


DESCRIPCION DE LA TAREA

Base de Datos
- Había un error en una sentencia sql que terminaba en coma (,) en lugar de punto y coma (;) lo que interrumpía la importación de datos.
- Vale destacar además que el valor por defecto '0000-00-00 00:00:00' para campos datetime y '0000-00-00' para campos date ya no es válido para versiones más modernas del mysql. En estos casos debe ponerse null, o en caso de que no se permita el null, una fecha fija. Aqui tuve que modificar esto además para la importación en mi servidor mysql.

Tecnología utilizada
Backend: 
Laravel con php 8.4 inicialmente, pero hubo que hacer un downgrade a la version 8.3 por requerimientos del hosting.
Arquitectura Modelo-Vista-Controlodor, aislando la capa de datos, métodos y datos para mayor seguridad del sistema.
 
Frontend
Motor de plantillas Blade
Bootstrap5
Material Design
Responsive
JavaScript
Css
Html
 
De la aplicación
Relatorio: Se muestran también los consultores que no tienen datos.

De los gráficos
- Se muestran solamente los consultores con datos en el período.
- Los gráficos no están exactamente igual al ejemplo de la tarea pues según el formato de los xml parecen ser generados con una librería bajo licencia y se usó una librería gratis en su lugar.
- Por la razón anterior el Custo Fixo Medio no se muestra como una linea sino como una barra en color negro al final de cada mes.
- Los botones Gráfico y Pizza mostrarán los últimos datos generados hasta que se generen nuevos datos.

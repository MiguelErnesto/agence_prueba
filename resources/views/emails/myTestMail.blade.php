<!DOCTYPE html>
<html>
<head>
    <title>{{config('app.nombre_principal')}} | Correo electrónico</title>
</head>
<body>
    <h1>{{config('app.nombre_principal')}} </h1>
    <br/>
    <h3>Mensaje enviado por: {{$name}}</h3>
    <h4>Correo electrónico de contacto: {{$email}}</h4>
    <br/>
    <p></p>
    <p>{{$body}}</p>
</body>
</html>
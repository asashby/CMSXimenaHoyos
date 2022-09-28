<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" style="background-color: #e6e6e6;">

<head>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="telephone=no">
  <!-- disable auto telephone linking in iOS -->
  <meta charset="UTF-8">
  <title>Mailling Restablecer Contraseña Enel</title>
</head>

<body>
  <table width="100%">
    @isset($clientData['name'])
      <tr>
        <th>Nombres:</th>
        <td>{{ $clientData['name'] }}</td>
      </tr>
    @endisset
    @isset($clientData['last_name'])
      <tr>
        <th>Apellidos:</th>
        <td>{{ $clientData['last_name'] }}</td>
      </tr>
    @endisset
    @isset($clientData['phone'])
      <tr>
        <th>Teléfono:</th>
        <td>{{ $clientData['phone'] }}</td>
      </tr>
    @endisset
    @isset($clientData['email'])
      <tr>
        <th>Correo:</th>
        <td>
          <a href="mailto:{{ $clientData['email'] }}" target="_blank">
            {{ $clientData['email'] }}
          </a>
        </td>
      </tr>
    @endisset
    @isset($clientData['message'])
      <tr>
        <th>Mensaje:</th>
        <td>{{ $clientData['message'] }}</td>
      </tr>
    @endisset
    @isset($clientData['consultation_date'])
      <tr>
        <th>Fecha Consulta:</th>
        <td>{{ $clientData['consultation_date'] }}</td>
      </tr>
    @endisset
  </table>
</body>

</html>

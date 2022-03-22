@php
    $verificationPage = "https://kyrie.arkanapp.com/verifyAccount/" . $account->verification_token;
@endphp

¡Hola, {{ $account->name }}!<br>
<p>
    Recibiste este correo porque registraste una cuenta en Project Kyrie y es necesario que la confirmes dando clic
    en <a href="{{ $verificationPage }}" target="_blank">ESTE ENLACE</a> para que así puedas iniciar sesión.<br>
    Si no puedes dar clic en el enlace, accede desde tu navegador a este sitio: {{ $verificationPage }}<br>
    <br>
    Si no fuiste tú quien registró la cuenta, haz caso omiso de este correo.<br>
    <i>El equipo de Project Kyrie.</i>
    <br><br>
    <i>Project Kyrie es un servicio creado por Arkan App.</i>
</p>

@php
if (!isset($messageTitle) || !isset($messageDescription)) {
    $messageTitle = "¡Ha ocurrido un error!";
    $messageDescription = "Esta página no existe.";
}
@endphp
<script>
    $(document).ready(function () {
        window.hideLoadingScreen();
    });
</script>
<div class="ui error message">
    <div class="header">
        {{ $messageTitle }}
    </div>
    <p>{{ $messageDescription }}</p>
</div>

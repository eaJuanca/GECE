<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Escritura</title>
</head>
<style>

    .mIzquierda {

        margin-left: 17.8cm;
    }
    .mSuperior{
        margin-top: 7.5cm;
    }

    .mIzquierda1 {

        margin-left: 2.6cm;
    }

    span{
        font-size: 20px;
    }



</style>
<body>

    <!-- parrafo 1-->
    <p style="margin-top: 7.5cm"> <span style="margin-left: 17.8cm">{{$info->numero}}</span><span style="margin-left: 2.6cm;">{{$info->altura}}</span>
    <span style="margin-left: 6.1cm;">{{$info->nombre_calle}}</span></p>

    <!-- parrafo 2-->
    <p style="margin-top: 2.1cm"> <span style="margin-left: 16.8cm">Pedro Azorin Castejón</span></p>

    <!-- parrafo 3-->
    <p style="margin-top: 1.2cm"> <span style="margin-left: 15.8cm">{{$info->nombre_titular}}</span><span style="margin-left: 16cm">{{$info->dni_titular}}</span></p>


</body>
</html>
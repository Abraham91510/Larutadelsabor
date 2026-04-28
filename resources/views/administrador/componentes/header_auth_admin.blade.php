<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('titulopagina', 'Mi página')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset($favicon ?? '') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    @stack('css')

    <style>
    
body {
    font-family: 'Nunito', sans-serif !important;
    background: url('{{ asset('Imagenes/La Ruta Del Sabor_Logo.ico') }}');
    background-repeat: repeat;
    position: relative;

    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    z-index: -1;
}

h1 { 
    font-family: 'Lilita One', cursive !important;
    color: #fff;
    text-shadow: 2px 2px 6px rgba(0,0,0,0.8);
    margin: 0;
}

h5 {
    color: #eaeaea;
    margin-top: 5px;
}

h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif !important;
    font-weight: 700;
}

.contenedor-auth {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 15px 10px;
}

:root{
    --bg-box: rgba(0,0,0,0.75);
}

.titulo-box {
    text-align: center;
    margin: 15px 0;
    background: var(--bg-box);
    padding: 12px 22px;
    border-radius: 10px;
    backdrop-filter: blur(6px);
    border: 1px solid rgba(255,255,255,0.2);
}

.titulo-box h1 {
    font-family: 'Lilita One', cursive;
    font-weight: bold;
    color: #fff;
}

.titulo-box h5 {
    color: #ddd;
}

.card-auth {
    width: 100%;
    max-width: 520px;
    background: rgba(255,255,255,0.96);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0px 6px 20px rgba(0,0,0,0.35);
}

.form-control {
    border-radius: 6px;
    padding: 8px 10px;
    font-size: 14px;
}

.form-control:focus {
    border-color: #2D9F4F;
    box-shadow: 0 0 0 0.15rem rgba(45,159,79,0.2);
}


.mb-3 {
    display: block; 
}

label {
    display: block; 
    margin-bottom: 4px;
    font-size: 14px;
}

.mb-3 {
    margin-bottom: 12px !important;
}

.password-container {
    position: relative;
    display: flex;
    flex-direction: column;
}

.password-container label {
    margin-bottom: 4px;
    font-size: 14px;
}


.password-container .input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.password-container input {
    width: 100%;
    padding-right: 45px;
    box-sizing: border-box;
}

.password-container i {
    position: absolute;
    right: 15px;

    
    top: 50%;
    transform: translateY(-50%);

    cursor: pointer;
    color: #666;
    font-size: 18px;

    display: flex;
    align-items: center;
}

.footer-auth {
    width: 100%;
    padding: 14px;
    background: var(--bg-box); 
    color: white;
    backdrop-filter: blur(6px);
    text-align: center;
    border-top: 1px solid rgba(255,255,255,0.2);
}


.footer-auth .fw-bold {
    font-size: 20px;
    font-family: 'Lilita One', cursive;
    font-weight: bold;
    color: #fff;
    text-shadow: 2px 2px 6px rgba(0,0,0,0.8);
}


.footer-auth .small {
    font-size: 15px;
    color: #ddd;
}


.footer-auth .text-light {
    font-size: 14px;
    color: #ccc !important;
}

    </style>

</head>

<body>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Enfermería - Hospital San Lorenzo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            width: 210mm;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .hospital-name {
            font-size: 18px;
            font-weight: bold;
        }
        .form-section {
            margin: 15px 0;
        }
        .section-title {
            font-weight: bold;
            margin: 10px 0;
            border-bottom: 2px solid #000;
        }
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .form-table td, .form-table th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }
        .input-field {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 100px;
        }
        .input-field-long {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 200px;
            margin: 2px 5px;
        }
        .signature-box {
            margin-top: 30px;
            border-top: 1px solid #000;
            width: 200px;
            padding-top: 5px;
        }
        .options-list {
            list-style: none;
            padding-left: 0;
            margin: 10px 0;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
</head>
<body>
    <div class="header">
        <div class="hospital-name">HOSPITAL MATERNO INFANTIL<br>SAN LORENZO DE LOS MINA</div>
        <div>DIRECCIÓN DE CUIDADOS DE ENFERMERÍA</div>
    </div>

    <div class="form-section">
        <div class="section-title">ADMINISTRACIÓN DE MEDICAMENTOS SEGÚN PRESCRIPCIÓN MÉDICA</div>
        <table class="form-table">
            <thead>
                <tr>
                    <th>MEDICAMENTOS Y SOLUCIONES</th>
                    <th>DOSIS</th>
                    <th>VIA</th>
                    <th>FRECUENCIA</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>FIRMA</th>
                </tr>
            </thead>
            <tbody>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            </tbody>
        </table>
    </div>

    <div class="form-section">
        <div class="section-title">PROCEDIMIENTOS DE ENFERMERÍA</div>
        <table class="form-table">
            <thead>
                <tr>
                    <th>PROCEDIMIENTOS</th>
                    <th>MATERIALES UTILIZADOS</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>FIRMA</th>
                </tr>
            </thead>
            <tbody>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </tbody>
        </table>
    </div>

    <div class="form-section">
        <div class="section-title">NOTAS DE ENFERMERÍA</div>
        <table class="form-table">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>DESCRIPCIÓN DE CUIDADOS DE ENFERMERÍA</th>
                </tr>
            </thead>
            <tbody>
                <tr><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td></tr>
            </tbody>
        </table>
    </div>

    <div class="form-section">
        <div class="section-title">EGRESO DEL PACIENTE</div>
        <div>Fecha: <span class="input-field"></span> Hora: <span class="input-field"></span></div>
        
        <div style="margin-top: 10px;">
            <div>DESTINO DE EGRESO:</div>
            <ul class="options-list">
                <li><label><input type="checkbox"> ADMITIDO</label></li>
                <li><label><input type="checkbox"> HOSPITALIZACIÓN</label></li>
                <li><label><input type="checkbox"> QUIRÓFANO</label></li>
                <li><label><input type="checkbox"> UCI</label></li>
                <li><label><input type="checkbox"> DE ALTA</label></li>
                <li><label><input type="checkbox"> ALTA A PETICIÓN</label></li>
                <li><label><input type="checkbox"> FUGA</label></li>
                <li><label><input type="checkbox"> FALLECIDO</label></li>
            </ul>
        </div>

        <div class="grid-2col" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div >
                <div>TRASLADADO EN:</div>
                <ul class="options-list">
                    <li><label><input type="checkbox"> AMBULANCIA</label></li>
                    <li><label><input type="checkbox"> ACOMPAñANTE</label></li>
                    <li><label><input type="checkbox"> FAMILIARES</label></li>
                    <li><label><input type="checkbox"> EQUIPO DE SALUD</label></li>
                </ul>
            </div>
        </div>

        <div>
            <div>OBJETOS PERSONALES: <span class="input-field" style="width: 70%;" ></span></div>
            <div>ENTREGADOS A: <span class="input-field" style="width: 80%;" ></span></div>
            <div>REFERIDO A: <span class="input-field"  style="width: 80%;" ></span> </div>
        </div>

        <div style="margin-top: 10px;">
            MEDICAMENTOS: <span class="input-field" style="width: 80%;"></span>
        </div>
        <br/>
    </div>

    <div class="form-section">
        <div class="signature-box">FIRMA DE ENFERMERÍA: </div>
    </div>
</body>
</html>
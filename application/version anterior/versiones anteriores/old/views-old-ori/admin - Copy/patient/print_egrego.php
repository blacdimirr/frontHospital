<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Egreso Hospitalario - Hospital San Lorenzo</title>
    <style>
        /* Mantenemos los mismos estilos base */
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
            border: 1px solid #000;
            margin: 10px 0;
            padding: 15px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
        }
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .form-table td, .form-table th {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        .input-field {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 150px;
            margin: 2px 5px;
        }
        .input-field-short {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 50px;
            margin: 2px 5px;
        }
        .input-field-long {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 200px;
            margin: 2px 5px;
        }
        .grid-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .checkbox-group {
            margin: 5px 0;
        }
        .signature-box {
            margin-top: 30px;
            border-top: 1px solid #000;
            width: 200px;
            padding-top: 5px;
        }
        /* Nuevos estilos específicos para egreso */
        .condition-list {
            list-style: none;
            padding-left: 0;
        }
        .condition-list li {
            margin: 5px 0;
        }
        .sub-title-right{
            text-align: right !important;
        }
        .sub-title-left{
            text-align: left !important;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
</head>
<body>
    <div class="header">
        <div class="hospital-name">HOSPITAL MATERNO INFANTIL<br>SAN LORENZO DE LOS MINA</div>
        <div>Hoja de Egreso Hospitalario o Epicrisis<br>DAR-FO-045 Versión: 01</div>
    </div>

    <div class="form-section">
        <div class="section-title">DATOS DEL PACIENTE</div>
        <div class="grid-2col">
            <div>NOMBRES: <span class="input-field"></span></div>
            <div>APELLIDOS: <span class="input-field"></span></div>
            <div>CÉDULA/PASAPORTE: <span class="input-field"></span></div>
            <div>SEXO: <span class="input-field-short"></span> EDAD: <span class="input-field-short"></span>PESO: <span class="input-field-short"></span></div>
            <div>DIRECCIÓN: <span class="input-field"></span></div>
            <div>DEPARTAMENTO O SERVICIO: <span class="input-field"></span></div>        
        </div>
    </div>

    <div class="form-section">
        <div class="section-title">CONDICIÓN DE EGRESO</div>
        <ul class="condition-list">
            <li>
                <label><input type="checkbox"> ALTA POR ORDEN MÉDICA</label>
                &nbsp;
                <label><input type="checkbox"> DEFUNCIÓN</label>
                &nbsp;
                <label><input type="checkbox"> TRASLADO</label>
                &nbsp;
                <label><input type="checkbox"> FUGA</label>
                &nbsp;
                <label><input type="checkbox"> ALTA PETICIÓN</label>
                &nbsp;
            </li>
        </ul>
    </div>

    <div class="form-section">
        <div class="section-title">INFORMACIÓN ADICIONAL</div>
        <ul class="condition-list">
            <li>
                <label>ADMITIDO POR:</label>
                &nbsp;
                <label><input type="checkbox"> CONSULTA EXTERNA</label>
                &nbsp;
                <label><input type="checkbox"> EMERGENCIA</label>
                &nbsp;
            </li>
        </ul>
        <div class="grid-2col">
            <div>FECHA DE INGRESO: <span class="input-field"></span></div>
            <div>FECHA DE EGRESO: <span class="input-field"></span></div>
            <div>DIAS DE PERMANENCIA: <span class="input-field"></span></div>
            <div>HABITACION O SALA: <span class="input-field-short"></span> CAMA: <span class="input-field-short"></span></div>
            <div>CODIGO: <span class="input-field-short"></span></div>
            <div>ORDENADA POR EL DOCTOR: <span class="input-field"></span></div>
        </div>

        <div class="form-section">
            <div class="section-title">
                <span class="sub-title-right">DIAGNÓSTICO DE INGRESO</span>
                <span class="sub-title-left">(CIE-10)</span>
            </div>
            
            <table class="form-table">
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
            </table>
        </div>

        <div class="form-section">
            <div class="section-title">
                <span class="sub-title-right">DIAGNÓSTICO DE EGRESO</span>
                <span class="sub-title-left">(CIE-10)</span>
            </div>
            
            <table class="form-table">
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
            </table>
        </div>

        <div class="form-section">
            <div class="section-title">
                <span class="sub-title-right">PROCEDIMIENTOS CLINICOS Y QUIRURGICOS EFECTUADOS</span>
            </div>
            
            <table class="form-table">
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
            </table>
        </div>

        <!-- <div class="section-title" style="margin-top: 15px;">PROCEDIMIENTOS REALIZADOS</div>
        <table class="form-table">
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table> -->
    </div>

    <div class="form-section">
        <div class="section-title">HALLAZGO</div>
        <div>FISICO:</div>
        <span class="input-field" style="width: 100%;"></span>        
        <div>LABORATORIO:</div>
        <span class="input-field" style="width: 100%;"></span>
        <div>RADIOGRAFIA:</div>
        <span class="input-field" style="width: 100%;"></span>        
        <div >ANATOMIA PATOLOGICA:</div>
        <span class="input-field" style="width: 100%;"></span>
        <div>PROCEDIMIENTO FISICO O QUIRURGICO REALIZADO:</div>
        <span class="input-field" style="width: 100%;"></span>
        &nbsp;     
        <span class="input-field" style="width: 100%;"></span>        
        <div >COMPLICACIONES:</div>
        <span class="input-field" style="width: 100%;"></span>
        &nbsp;
        <br/>
        <span class="input-field" style="width: 100%;"></span>        
        <div>PRONOSTICO:</div>
        <span class="input-field" style="width: 100%;"></span>        
        <div >PLAN:</div>
        <span class="input-field" style="width: 100%;"></span>
    </div>

    <div class="form-section">
        <div class="section-title">
            <span class="sub-title-right">TRATAMIENTO</span>
        </div>
        
        <table class="form-table">
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>
    </div>

    <div class="form-section">
        <div class="section-title">
            <span class="sub-title-right">EN CASO DE FALLECIMIENTO, ANOTAR CAUSAS</span>
        </div>
        
        <table class="form-table">
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>
    </div>

    <div class="form-section">
        <!-- <div class="section-title">SEGUIMIENTO</div> -->
        <div class="section-title">PLAN DE SEGUIMIENTO AMBULATORIO, CITA CONTROL Y TRATAMIENTO AMBULATORIO:</div>
        <span class="input-field" style="width: 100%;"></span>
        &nbsp;
        <br/>
        <span class="input-field" style="width: 100%;"></span> 
        <!-- <div style="margin-top: 15px;">TRATAMIENTO AMBULATORIO:</div> -->
        <!-- <span class="input-field" style="width: 100%;"></span> -->
    </div>

    <div class="form-section">
        <div class="section-title">FIRMAS</div>
        <div class="grid-2col">
            <div>
                <div>PACIENTE O CONTACTO:</div>
                <div class="signature-box"></div>
            </div>
            <div>
                <div>MÉDICO RESPONSABLE:</div>
                <div class="signature-box"></div>
                <!-- <div>CÓDIGO: <span class="input-field"></span></div> -->
            </div>
        </div>
    </div>
</body>
</html>
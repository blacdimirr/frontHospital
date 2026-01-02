<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Médico - Hospital San Lorenzo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            width: 210mm; /* Tamaño A4 */
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
            padding: 10px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            background-color: #0bb7e1 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact; 
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .form-table td, .form-table th {
            border: 1px solid;
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
        .input-field-extra {
            border-bottom: 1px solid #000;
            display: inline-block;
            width: 100%;
            margin: 2px 5px;
        }

        .grid-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .grid-2col-extra {
            display: grid;
            grid-template-columns: 2fr;
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
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
</head>
<body>
    <div class="header">
        <div class="hospital-name">HOSPITAL MATERNO INFANTIL<br>SAN LORENZO DE LOS MINA</div>
        <div>Hoja de Orden Médica<br><?php echo 'DAR-FO'.$result['opd_details_id']; ?> Versión: 01</div>
    </div>

    <div class="form-section">
        <div class="section-title">DATOS DEL PACIENTE</div>
        <div class="grid-2col">
            <div>NO. DE EXPEDIENTE CLINICO: <span class="input-field"><?php echo 'DAR-FO'.$result['opd_details_id']; ?></span></div>
            <div>SALA O HABITACION: <span class="input-field"></span></div>
            <div>NO DE CAMA: <span class="input-field"></span></div>
            <div>FECHA: <span class="input-field"><?php echo date('d-m-Y');?></span></div>
            <div>MEDICO RESPONSABLE: <span class="input-field"> <?php echo $result['name'].' '.$result['surname'] ; ?> </span></div>
            <div>HORA: <span class="input-field"> <?php echo date('h:i A'); ?> </span></div>
        </div>
    </div>
    <div class="form-section">
        <div class="section-title">DATOS DEL PACIENTE</div>
        <div class="grid-2col">
            <div>NOMBRES y APELLIDOS: <span class="input-field"> <?php echo $result['patient_name']; ?> </span></div>
            <div>CÉDULA/PASAPORTE: <span class="input-field"> <?php echo $result['identification_number']; ?></span></div>
            <div>SEXO: <span class="input-field-short"><?php echo $result['gender']; ?></span> EDAD: <span class="input-field-short"><?php echo $result['age']; ?></span>PESO: <span class="input-field-short"><?php echo $result['weight']; ?></span></div>
            <div>DIRECCIÓN: <span class="input-field-long"><?php echo $result['address']; ?></span></div>
            <div>CIE-10: <span class="input-field-short"></span></div>
        </div>
    </div>

    <div class="form-section">
        <div class="section-title">ORDEN MÉDICA</div>
        <table class="form-table">
            <tr>
                <th>MEDICAMENTO</th>
                <th>DOSIS</th>
                <th>FRECUENCIA</th>
                <th>VÍA</th>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="form-section">
        <div class="section-title">OTRAS ORDENES TERAPEUTICAS</div>
        <div class="grid-2col-extra">
            <div>DIETA: <span class="input-field-extra"></span></div>
            <div>CURAS: <span class="input-field-extra"></span></div>
            <div>OXIGENO: <span class="input-field-extra"></span></div>
            <div>IMÁGENES: <span class="input-field-extra"></span></div>
            <div>PROCEDIMIENTOS: <span class="input-field-extra"></span></div>
            <div>SONDAS Y DRENAJES: <span class="input-field-extra"></span></div>
            <div>CONTROLES HABITUALES: <span class="input-field-extra"></span></div>
            <div>CONTROLES ESPECIALES: <span class="input-field-extra"></span></div>
            <div>FISIOTERAPIA RESPIRATORIA: <span class="input-field-extra"></span></div>
            <div>ACTIVDAD FISICA/POSTURA: <span class="input-field-extra"></span></div>
        </div>
    </div>

    <div class="form-section">
        <div class="section-title">FIRMAS</div>
        <div class="grid-2col">
            <div>
                <div>NOMBRE Y FIRMA DEL MÉDICO:</div>
                <div class="signature-box"></div>
            </div>
            <div>
                <div>CÓDIGO:</div>
                <div class="signature-box"></div>
            </div>
        </div>
    </div>
</body>
</html>
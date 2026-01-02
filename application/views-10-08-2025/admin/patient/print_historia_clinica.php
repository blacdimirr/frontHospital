<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historia Clínica de Emergencia - Hospital San Lorenzo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            /* width: 210mm; */
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
            margin: 5px 0;
            padding: 10px;
        }
        .form-section-short {
            border: 1px solid #000;
            /* margin: 5px 0; */
            padding: 10px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
        }
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }
        .form-table td, .form-table th {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: top;
        }
        .input-field {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 100px;
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
        .input-field-table {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 100px;
            /* margin: 2px 5px; */
        }
        .grid-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
        .triple-column {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
        }
        .table-title {
            /* font-size: 15px; */
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
</head>
<body>
    <div class="header">
        <div class="hospital-name">HOSPITAL MATERNO INFANTIL<br>SAN LORENZO DE LOS MINA</div>
        <div>Historia Clínica de Emergencia</div>
    </div>

    <div class="form-section-short">
        <div class="section-title">Identificación</div>
        <div class="grid-2col">
            <div>Fecha: <span class="input-field"><?php echo date('d-m-Y');?></span> Hora: <span class="input-field"><?php echo date('h:i A'); ?></span></div>
            <br/>
            <?php 
            // print_r($field_historial);
            ?>
            <div>Nombres y Apellidos: <span class="input-field"> <?php echo $result['patient_name']; ?> </span></div>
            <div>Género: <span class="input-field"> <?php echo $result['gender']; ?> </span> Edad: <span class="input-field"><?php echo $result['age']; ?></span></div>
            <div>Cédula/Pasaporte: <span class="input-field"><?php echo $result['identification_number']; ?></span></div>
            <div>Fecha de nacimiento: <span class="input-field"><?php echo $result['appointment_date']; ?></span></div>
            <div>Teléfono: <span class="input-field"><?php echo $result['mobileno']; ?></span></div>
            <div>Nacionalidad: <span class="input-field"><?php echo $result['nationality']; ?></span></div>
            <div>NSS: <span class="input-field"><?php echo $result['insurance_id']; ?></span></div>
            <div>Dirección: <span class="input-field"><?php echo $result['address']; ?></span></div>
            <!-- <div>Dirección: <span class="input-field"></span></div> -->
            <div>Nombre del Acompañante: <span class="input-field"></span></div>
        </div>
    </div>

    <div class="form-section">
        <div class="section-title">Medio de Ingreso</div>
        <div class="checkbox-group">
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[34]->field_value == 'Propios Medicos') { echo 'checked';} ?>  > Propios Medicos</label>
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'Ambulancia 911') { echo 'checked';} ?> > Ambulancia 911</label>
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'CRUE') { echo 'checked';} ?> > CRUE</label>
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'Privada') { echo 'checked';} ?> > Privada</label>
        </div>
        <div>Referido: </div>
        <span class="input-field" style="width: 100%;"></span>

        <div class="checkbox-group">
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'Rojo') { echo 'checked';} ?> > Rojo</label>
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'Naranja') { echo 'checked';} ?> > Naranja</label>
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'Amarillo') { echo 'checked';} ?> > Amarillo</label>
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'Verde') { echo 'checked';} ?> > Verde</label>
            <label><input type="checkbox" <?php if (!empty($field_data[3])) if ($field_data[3]->field_value == 'Azul') { echo 'checked';} ?> > Azul</label>
        </div>
        <div class="grid-2col">
            <div>Fecha: <span class="input-field"> <?php echo $result['appointment_date'];?></span></div>
            <div>Hora: <span class="input-field"> <?php echo $result['date'];?> </span></div>
            <div>Peso: <span class="input-field"> <?php echo $result['weight'];?> </span></div>
            <div>Talla: <span class="input-field"> <?php echo $result['height'];?> </span></div>
            <div>Alergias: <span class="input-field"></span></div>
        </div>
    </div>

  

    <div class="form-section">
        <div class="section-title">
            <span class="sub-title-right">Motivo de Ingreso</span>
        </div>
        
        <table class="form-table">
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>
    </div>

    <div class="form-section">
        <div class="section-title">Signos Vitales</div>
        <table class="form-table">
            <tr>
                <th class="table-title">Hora</th>
                <th class="table-title">T.A (mmHg)</th>
                <th class="table-title">FC (L/M)</th>
                <th class="table-title">FR (R/M)</th>
                <th class="table-title">TEMP. C</th>
                <th class="table-title">Sat O2 (%)</th>
                <th class="table-title">GLASGOW(15)</th>
            </tr>
            <!-- <tr>
                <td><span class="input-field-table"></span></td>
                <td><span class="input-field-table"></span></td>
                <td><span class="input-field-table"></span></td>
                <td><span class="input-field-table"></span></td>
                <td><span class="input-field-table"></span></td>
                <td><span class="input-field-table"></span></td>
                <td><span class="input-field-table"></span></td>
            </tr> -->
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>

    <div class="form-section">
        <div class="section-title">Diagnóstico y Exámenes</div>
        <div>Diagnóstico Presuntivo: <span class="input-field" style="width: 70%;"></span></div>
        <div>CIE-10: <span class="input-field"></span></div>
        
        <div class="triple-column" style="margin-top: 15px;">
            <div>
                <div>Laboratorios:</div>
                <label><input type="checkbox"> Hemograma</label><br>
                <label><input type="checkbox"> Examen Orina</label><br>
                <label><input type="checkbox"> Coprológico</label>
            </div>
            <div>
                <div>Imágenes:</div>
                <label><input type="checkbox"> RX Tórax</label><br>
                <label><input type="checkbox"> Sonografía Abdominal</label><br>
                <label><input type="checkbox"> EKG</label>
            </div>
            <div>
                <label><input type="checkbox"> RX Abdomen</label><br>
                <label><input type="checkbox"> Sonografía Pélvica</label><br>
                Otros: <span class="input-field"></span>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="section-title">Procedimientos y Destino</div>
        <div class="grid-2col">
            <div>
                <div>Procedimientos:</div>
                <label><input type="checkbox"> Reanimación</label><br>
                <label><input type="checkbox"> Nebulización</label><br>
                <label><input type="checkbox"> Observación</label>
            </div>
            <div>
                <div>Destino:</div>
                <label><input type="checkbox"> Hospitalización</label><br>
                <label><input type="checkbox"> Alta</label><br>
                <label><input type="checkbox"> Referido</label>
            </div>
        </div>
        <div style="margin-top: 10px;">
            Medicación: <span class="input-field" style="width: 60%;"></span>
        </div>
    </div>

    <div class="form-section">
        <div class="section-title">Firmas</div>
        <div class="grid-2col">
            <div>
                <div>Médico Tratante:</div>
                <div class="signature-box"></div>
                <br/>
                <div>Fecha: <span class="input-field"></span> Hora: <span class="input-field"></span></div>
            </div>
        </div>
    </div>
</body>
</html>
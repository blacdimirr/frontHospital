<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Egreso Hospitalario - Hospital San Lorenzo</title>
    <style>
        /* Mantenemos los mismos estilos base */
        .body-pdf {
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
            margin: 10px 0;
            padding: 15px;
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
        .grid-2col-extra {
            display: grid;
            grid-template-columns: 2fr;
            gap: 10px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
</head>
<body>
    <div class="body-pdf">
        <div class="print-area">
            <div class="header">
                <div class="hospital-name">HOSPITAL MATERNO INFANTIL<br>SAN LORENZO DE LOS MINA</div>
                <div>Hoja de Egreso Hospitalario o Epicrisis<br>DAR-FO-045 Versión: 01</div>
            </div>
        
            <div class="form-section">
                <div class="section-title">DATOS DEL PACIENTE</div>
                <div class="grid-2col">
                    <div>ASEGURADO:  <span class="input-field-short"><?php if (!empty($result_custom_details['Lisatdo de ARS'])) {echo "Si";} else { echo "No";};?></span></div>

                    <div>ARS:  <span class="input-field"><?php echo $result_custom_details['Lisatdo de ARS'];?></span> </div>
                    <div>NSS:  <span class="input-field-short"><?php echo $result_custom_details['insurance_id'];?></span> </div>

                    <div>NOMBRES y APELLIDOS:  <span class="input-field"><?php echo $result['patient_name'];?></span></div>
                    <div>CÉDULA/PASAPORTE: <span class="input-field"><?php echo $result['identification_number'];?></span></div>
                    <div>SEXO: <span class="input-field-short"><?php echo $result['gender'];?></span> EDAD: <span class="input-field-short"><?php echo $result['age'];?></span>PESO: <span class="input-field-short"><?php echo $result['weight'];?></span></div>
                </div>
                <br/>
                <div class="grid-2col-extra">                    
                    <div>DEPARTAMENTO O SERVICIO: <span class="input-field"></span></div>        
                    <div>DIRECCIÓN: <span class="input-field"><?php echo $result['address'];?></span></div>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title">CONDICIÓN DE EGRESO</div>
                <?php 
                    if (!empty($fields)) {
                        foreach ($fields as $fields_key => $fields_value) {
                            $display_field = $result_custom[$fields_value->name];
                            if ($fields_value->visible_is_custom){?>
                            <div>
                                <?php // echo $fields_value->name; ?>: <span class="input-field-extra"><?php // echo $display_field; ?></span>
                            </div>
                <?php }}} ?>
                <ul class="condition-list">
                    <li>
                        <!-- <?php //  echo $custom_fields_value; ?> -->
                        <label><input type="checkbox" <?php if ($result_custom[$field_data[0]->name] == 'ALTA POR ORDEN MÉDICA') { echo 'checked';} ?> > ALTA POR ORDEN MÉDICA  </label>
                        &nbsp;
                        <label><input type="checkbox" <?php if ($result_custom[$field_data[0]->name] == 'DEFUNCIÓN') { echo 'checked';} ?> > DEFUNCIÓN: </label>
                        &nbsp;
                        <label><input type="checkbox" <?php if ($result_custom[$field_data[0]->name] == 'DEFUNCIÓN') { echo 'checked';} ?>  > TRASLADO </label>
                        &nbsp;
                        <label><input type="checkbox" <?php if ($result_custom[$field_data[0]->name] == 'DEFUNCIÓN') { echo 'checked';} ?>  > FUGA </label>
                        &nbsp;
                        <label><input type="checkbox" <?php if ($result_custom[$field_data[0]->name] == 'DEFUNCIÓN') { echo 'checked';} ?>  > ALTA PETICIÓN </label>
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
                        <label><input type="checkbox" <?php if ($result_custom[$field_data[1]->name] == 'COnsulta externa') { echo 'checked';} ?> > CONSULTA EXTERNA</label>
                        &nbsp;
                        <label><input type="checkbox" <?php if ($result_custom[$field_data[1]->name] == 'emergencia') { echo 'checked';} ?> > EMERGENCIA</label>
                        &nbsp;
                    </li>
                </ul>
                <div class="grid-2col">
                    <?php
                    $date1 = $result_custom_details['date'];
                    $date2 = $result_custom_details['discharge_date'];

                    $res = '';
                    // $res = date_diff(date_create(''.$date1),date_create(''.$date2));
                    
                    ?>
                    <div>FECHA DE INGRESO: <span class="input-field"><?php echo $date1;?></span></div>
                    <div>FECHA DE EGRESO: <span class="input-field"><?php echo $date2;?></span></div>
                    <div>DIAS DE PERMANENCIA: <span class="input-field"><?php echo $res;?></span></div>
                    <!-- <div>HABITACION O SALA: <span class="input-field-short"></span> CAMA: <span class="input-field-short"></span></div> -->
                    <!-- <div>CODIGO: <span class="input-field-short"></span></div> -->
                    <!-- <div>ORDENADA POR EL DOCTOR: <span class="input-field"></span></div> -->
                </div>
                <div class="grid-2col">
                    <!-- <div>FECHA DE INGRESO: <span class="input-field"></span></div> -->
                    <!-- <div>FECHA DE EGRESO: <span class="input-field"></span></div> -->
                    <!-- <div>DIAS DE PERMANENCIA: <span class="input-field"></span></div> -->
                    <div>HABITACION O SALA: <span class="input-field"><?php echo $result['bedgroup_name'];?></span> CAMA: <span class="input-field-short"><?php echo $result['floor_name'];?></span></div>
                    <div>CODIGO: <span class="input-field-short"></span></div>
                    <div>ORDENADA POR EL DOCTOR: <span class="input-field"></span></div>
                </div>
        
                <div class="form-section">
                    <div class="section-title">
                        <span class="sub-title-right">DIAGNÓSTICO DE INGRESO</span>
                        <span class="sub-title-left">(CIE-10)</span>
                    </div>                    
                   
                    <div class="form-table">
                        <?php if (!empty($field_data[2])) echo $result_custom[$field_data[2]->name]; ?>
                    </div>

                </div>
        
                <div class="form-section">
                    <div class="section-title">
                        <span class="sub-title-right">DIAGNÓSTICO DE EGRESO</span>
                        <span class="sub-title-left">(CIE-10)</span>
                    </div>
                    
                    <div class="form-table">
                        <?php if (!empty($field_data[3])) echo $result_custom[$field_data[3]->name]; ?>
                    </div>
                </div>
        
                <div class="form-section">
                    <div class="section-title">
                        <span class="sub-title-right">PROCEDIMIENTOS CLINICOS Y QUIRURGICOS EFECTUADOS</span>
                    </div>
                    
                    <div class="form-table">
                        <?php if (!empty($field_data[4])) echo $result_custom[$field_data[4]->name]; ?>
                    </div>
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
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[5])) echo $result_custom[$field_data[5]->name]; ?> </span>        
                <div>LABORATORIO:</div>
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[6])) echo $result_custom[$field_data[6]->name]; ?>  </span>
                <div>RADIOGRAFIA:</div>
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[7])) echo $result_custom[$field_data[7]->name]; ?>  </span>        
                <div >ANATOMIA PATOLOGICA:</div>
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[8])) echo $result_custom[$field_data[8]->name]; ?>  </span>
                <div>PROCEDIMIENTO FISICO O QUIRURGICO REALIZADO:</div>
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[8])) echo $result_custom[$field_data[8]->name]; ?>  </span>
                &nbsp;       
                <div >COMPLICACIONES:</div>
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[9])) echo $result_custom[$field_data[9]->name]; ?>  </span>
                &nbsp;
                <div>PRONOSTICO:</div>
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[10])) echo $result_custom[$field_data[10]->name]; ?>  </span>        
                <div >PLAN:</div>
                <span class="input-field" style="width: 100%;"> <?php  if (!empty($field_data[11])) echo $result_custom[$field_data[11]->name]; ?>  </span>
            </div>
        
            <div class="form-section">
                <div class="section-title">
                    <span class="sub-title-right">TRATAMIENTO</span>
                </div>
                
                <div class="form-table">
                    <?php if (!empty($field_data[12])) echo $result_custom[$field_data[12]->name]; ?>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title">
                    <span class="sub-title-right">EN CASO DE FALLECIMIENTO, ANOTAR CAUSAS</span>
                </div>
                
                <div class="form-table">
                    <?php if (!empty($field_data[13])) echo $result_custom[$field_data[13]->name]; ?>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title">PLAN DE SEGUIMIENTO AMBULATORIO, CITA CONTROL Y TRATAMIENTO AMBULATORIO:</div>
                <!-- <span class="input-field" style="width: 100%;"></span> -->
                <div class="form-table">
                    <?php if (!empty($field_data[14])) echo $result_custom[$field_data[14]->name]; ?>
                </div>
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
        </div>
    </div>
</body>
</html>
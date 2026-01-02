<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Médico - Hospital San Lorenzo</title>
    <style>
        .body-pdf {
            font-family: Arial, sans-serif;
            margin: 10px;
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
</head>
<body>
    <div class="body-pdf">
        <div class="print-area">
            <div class="header">
                <div class="hospital-name">HOSPITAL MATERNO INFANTIL<br>SAN LORENZO DE LOS MINA</div>
                <div>Hoja de Orden Médica<br>DAR-FO-047 Versión: 01</div>
            </div>
        
            <div class="form-section">
                <div class="section-title">DATOS DEL PACIENTE</div>
                <div class="grid-2col">
                    <div>NO. DE EXPEDIENTE CLINICO: <span class="input-field"><?php echo 'OPDN'.$result->opd_detail_id; ?></span></div>
                    <div>SALA O HABITACION: <span class="input-field"></span></div>
                    <div>NO DE CAMA: <span class="input-field"></span></div>
                    <div>FECHA: <span class="input-field"><?php echo date('d-m-Y');?></span></div>
                    <div>MEDICO RESPONSABLE: <span class="input-field"> <?php echo $result->name.' '.$result->surname ; ?> </span></div>
                    <div>HORA: <span class="input-field"> <?php echo date('h:i A'); ?> </span></div>
                </div>
            </div>
            <div class="form-section">
                <div class="section-title">DATOS DEL PACIENTE</div>
                <div class="grid-2col">
                    <div>NOMBRES y APELLIDOS: <span class="input-field"> <?php echo $result->patient_name; ?> </span></div>
                    <div>CÉDULA/PASAPORTE: <span class="input-field"> <?php echo $result->identification_number; ?></span></div>
                    <div>SEXO: <span class="input-field-short"><?php echo $result->gender; ?></span> EDAD: <span class="input-field-short"><?php echo $result->age; ?></span>PESO: <span class="input-field-short"><?php echo $result->weight; ?></span></div>
                    <div>DIRECCIÓN: <span class="input-field-long"><?php echo $result->address; ?></span></div>
                    <div>CIE-10: <span class="input-field-short"></span></div>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title">ORDEN MÉDICA</div>
                <table class="form-table">
                    <tr>
                        <th>MEDICAMENTO</th>
                        <th>DOSIS</th>
                        <!-- <th><?php echo $this->lang->line("dose_interval"); ?></th> -->
                        <th>FRECUENCIA</th>
                        <th>VÍA</th>
                    </tr>
                    <?php $medsl =''; foreach ($result->medicines as $pkey => $pvalue) { $medsl++; ?>
                        <tr>
                            <td class="text text-center"><?php echo $pvalue->medicine_name; ?></td>
                            <td class="text text-center"><?php echo $pvalue->dosage." ".$pvalue->unit; ?></td>
                            <!-- <td class="text text-center"><?php echo $pvalue->dose_interval_name; ?></td> -->
                            <td class="text text-center"><?php echo $pvalue->dose_interval_name; ?></td>
                            <td class="text text-center"><?php echo $pvalue->instruction; ?></td>
                        </tr>  
                    <?php } ?>
                </table>
            </div>
        
            <div class="form-section">
                <?php if(!empty($result->header_note)) {?>
                    <div>
                        <div class="section-title">Nota: </div>
                        <?php echo $result->header_note ?>
                    </div>
                <?php }?>

                <div class="section-title">OTRAS ORDENES TERAPEUTICAS</div>
                <div class="grid-2col-extra">
                <?php 
                    if (!empty($fields)) {
                        foreach ($fields as $fields_key => $fields_value) {
                            $display_field = $result_custom[$fields_value->name];
                            if ($fields_value->visible_is_custom){?>
                            <div><?php echo $fields_value->name; ?>: <span class="input-field-extra"><?php echo $display_field; ?></span></div>
                    <?php }}
                }?>
                                            
                    <!-- <div>DIETA: <span class="input-field-extra"></span></div> -->
                    <!-- <div>CURAS: <span class="input-field-extra"></span></div> -->
                    <!-- <div>OXIGENO: <span class="input-field-extra"></span></div> -->
                    <!-- <div>IMÁGENES: <span class="input-field-extra"></span></div> -->
                    <!-- <div>PROCEDIMIENTOS: <span class="input-field-extra"></span></div> -->
                    <!-- <div>SONDAS Y DRENAJES: <span class="input-field-extra"></span></div> -->
                    <!-- <div>CONTROLES HABITUALES: <span class="input-field-extra"></span></div> -->
                    <!-- <div>CONTROLES ESPECIALES: <span class="input-field-extra"></span></div> -->
                    <!-- <div>FISIOTERAPIA RESPIRATORIA: <span class="input-field-extra"></span></div> -->
                    <!-- <div>ACTIVDAD FISICA/POSTURA: <span class="input-field-extra"></span></div> -->
                </div>
                <?php if(!empty($result->footer_note)) {?>
                    <div>
                        <div class="section-title">Nota: </div>
                        <?php echo $result->footer_note ?>
                    </div>
                <?php }?>
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
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
     $('#edit_deleteprescription').html("<?php if ($this->rbac->hasPrivilege('prescription', 'can_view')) { ?><a href='#'' onclick='printprescription(<?php echo $id;?>)'  data-toggle='tooltip'  data-original-title='<?php echo $this->lang->line('print'); ?>'><i class='fa fa-print'></i></a><?php } ?><?php if ($this->rbac->hasPrivilege('prescription', 'can_edit')) { ?><a href='#'' onclick='edit_prescription(<?php echo $result->prescription_id;?>)' data-target='#edit_prescription' data-toggle='tooltip'  data-original-title='<?php echo $this->lang->line('edit'); ?>'><i class='fa fa-pencil'></i></a><?php } if ($this->rbac->hasPrivilege('prescription', 'can_delete')) { ?><a onclick='delete_prescription(<?php echo $result->prescription_id;?>)'  href='#'  data-toggle='tooltip'  data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a><?php } ?>");
 
    function delete_prescription(prescription_id) {  
      
        var msg = '<?php echo $this->lang->line("are_you_sure"); ?>';
        if (confirm(msg)) {
            $.ajax({
            url: '<?php echo base_url(); ?>admin/prescription/deleteopdPrescription/'+prescription_id,
                success: function (res) {
                    window.location.reload(true);
                },
                error: function () {
                    alert("Fail")
                }
            });
        }
    }    
</script>
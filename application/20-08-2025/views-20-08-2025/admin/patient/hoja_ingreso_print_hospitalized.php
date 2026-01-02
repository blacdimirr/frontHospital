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
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
</head>
<body>
    <div class="body-pdf">
        <div class="print-area">
            <div class="header">
                <div class="hospital-name">HOSPITAL MATERNO INFANTIL<br>SAN LORENZO DE LOS MINA</div>
                <div>Hoja de Orden Médica<br><?php echo 'DAR-FO'.$result->ipd_id; ?> Versión: 01</div>
            </div>
        
            <div class="form-section">
                <div class="section-title">DATOS DEL PACIENTE</div>
                <div class="grid-2col">
                    <div>FECHA DE INGRESO: <span class="input-field"><?php echo date("d/m/Y", strtotime($patient['appointment_date'])); ?></span></div>
                    <div>HORA DE INGRESO: <span class="input-field"><?php echo date("h:i A", strtotime($patient['appointment_date'])); ?></span></div>
                    <div>FECHA DE NACIMIENTO: <span class="input-field"><?php echo date("d/m/Y", strtotime($patient['dob'])); ?></span></div>
                    <div>EDAD: <span class="input-field">
                        <?php
                                $dob = new DateTime($patient['dob']);
                                $now = new DateTime();
                                echo $dob->diff($now)->y . " años";
                        ?>
                            </span></div>
                    <div>NOMBRE COMPLETO: <span class="input-field"> <?php echo ucwords(strtolower($patient['patient_name'])); ?> </span></div>
                    <div>NO. DE EXPEDIENTE: <span class="input-field"> <?php echo 'DAR-FO-'.$patient['ipd_id']; ?> </span></div>
                    <div>PESO: <span class="input-field"> <?php echo $patient['weight']; ?> </span></div>
                    <div>TALLA: <span class="input-field"> <?php echo $patient['height']; ?></span></div>
                    <div>NOMBRE DEL PADRE/TUTOR: <span class="input-field-short"><?php echo $patient['guardian_name']; ?></span> EDAD: <span class="input-field-short"><?php echo $result->age; ?></span>PESO: <span class="input-field-short"><?php echo $patient['weight']; ?></span></div>
                    <div>TELÉFONO: <span class="input-field-long"><?php echo $patient['mobileno']; ?></span></div>
                    <div>DIRECCIÓN/RESIDENCIA: <span class="input-field-short"><?php echo $patient['address']; ?></span></div>
                    <div>ARS: <span class="input-field-short"><?php echo $patientCustom->{'Listado de ARS'}; ?></span></div>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('Admitting Diagnosis'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->admitting_diagnosis; ?>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('antecedentes_personales'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->antecedentes_personales; ?>
                </div>
            </div>
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('antecedentes_familiar'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->antecedentes_familiar; ?>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('esquema_inmunizacion'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->esquema_inmunizacion; ?>
                </div>
            </div>
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('examen_fisico'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->examen_fisico; ?>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('signos_vitales'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->signos_vitales; ?>
                </div>
            </div>
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('resumen_clinico'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->resumen_clinico; ?>
                </div>
            </div>
        
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('diagnostico'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->diagnostico; ?>
                </div>
            </div>
            <div class="form-section">
                <div class="section-title"> <?php echo $this->lang->line('Treatment'); ?></div>
                <div class="grid-2col">
                    <?php echo $result->tratamiento; ?>
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
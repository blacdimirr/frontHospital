
<input type="hidden" name="id" value=" <?php echo $result->id; ?>">
<input type="hidden" name="opd_details_id" value="<?php echo $result->opd_details_id; ?>">
<input type="hidden" name="visit_id" value="<?php echo $result->visit_id; ?>">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="ipd_prescription_basic_id" value="0">
<div class="row">
    <div class="col-sm-12">
        <div class="ptt10">
            <div class="row">

                <style>
                        body {
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            background-color: #f5f5f5;
                            margin: 0;
                            padding: 20px;
                            color: #333;
                        }
                        
                        .patient-card {
                            background-color: white;
                            border-radius: 10px;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            /* max-width: 800px; */
                            margin: 0 auto;
                            padding: 5px;
                        }
                        
                        .patient-header {
                            border-bottom: 2px solid #4a90e2;
                            padding-bottom: 15px;
                            margin-bottom: 20px;
                        }
                        
                        .patient-header h1 {
                            color: #2c3e50;
                            margin: 0;
                            font-size: 24px;
                        }
                        
                        .patient-info {
                            display: grid;
                            grid-template-columns: 1fr 1fr;
                            /* gap: 15px; */
                        }
                        
                        .info-item {
                            margin-bottom: 5px;
                        }
                        
                        .info-label {
                            font-weight: 600;
                            color: #4a90e2;
                            display: block;
                            margin-bottom: 3px;
                            font-size: 10px;
                        }
                        
                        .info-value {
                            padding: 8px 12px;
                            background-color: #f8f9fa;
                            border-radius: 5px;
                            border-left: 3px solid #4a90e2;
                        }
                        
                        @media (max-width: 600px) {
                            .patient-info {
                                grid-template-columns: 1fr;
                            }
                        }
                </style>

                <div class="patient-card">
                    <div class="patient-header">
                        <h1><?php echo $this->lang->line('Patient Data'); ?></h1>
                    </div>
                    
                    <div class="patient-info">
                        <div class="info-item">
                            <span class="info-label">FECHA DE INGRESO</span>
                            <div class="info-value"><?php echo date("d/m/Y", strtotime($patient->appointment_date)); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">HORA DE INGRESO</span>
                            <div class="info-value"><?php echo date("h:i A", strtotime($patient->appointment_date)); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">FECHA DE NACIMIENTO</span>
                            <div class="info-value"><?php echo date("d/m/Y", strtotime($patient->dob)); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">EDAD</span>
                            <div class="info-value">
                                <?php 
                                    $dob = new DateTime($patient->dob);
                                    $now = new DateTime();
                                    echo $dob->diff($now)->y . " años";
                                ?>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">NOMBRE COMPLETO</span>
                            <div class="info-value"><?php echo ucwords(strtolower($patient->patient_name)); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">NO. DE EXPEDIENTE</span>
                            <div class="info-value"><?php echo 'DAR-FO-'.$patient->opd_details_id; ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">PESO</span>
                            <div class="info-value"><?php echo $patient->weight; ?> </div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">TALLA</span>
                            <div class="info-value"><?php echo $patient->height; ?></div>
                        </div>                      
                        
                        <div class="info-item">
                            <span class="info-label">NOMBRE DEL PADRE/TUTOR</span>
                            <div class="info-value"><?php echo $patient->guardian_name; ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">TELÉFONO</span>
                            <div class="info-value"><?php echo $patient->mobileno; ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">DIRECCIÓN/RESIDENCIA</span>
                            <div class="info-value"><?php echo $patient->address; ?></div>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">ARS</span>
                            <div class="info-value"><?php echo $patientCustom->{'Listado de ARS'}; ?>  </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('Admitting Diagnosis'); ?>
                        </h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="admitting_diagnosis" class="form-control" id="compose-textareas">
                                <?php echo $result->admitting_diagnosis; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('antecedentes_personales'); ?>
                        </h4>
                    </div>                    
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="antecedentes_personales" class="form-control" id="compose-textareas">
                                <?php echo $result->antecedentes_personales; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('antecedentes_familiar'); ?>
                        </h4>
                    </div>                
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="antecedentes_familiar" class="form-control" id="compose-textareas">
                                <?php echo $result->antecedentes_familiar; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('esquema_inmunizacion'); ?>
                        </h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="esquema_inmunizacion" class="form-control" id="compose-textareas">
                                <?php echo $result->esquema_inmunizacion; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('examen_fisico'); ?>
                        </h4>
                    </div>                    
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="examen_fisico" class="form-control" id="compose-textareas">
                                <?php echo $result->examen_fisico; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('signos_vitales'); ?>
                        </h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="signos_vitales" class="form-control" id="compose-textareas">
                                <?php echo $result->signos_vitales; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('resumen_clinico'); ?>
                        </h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="resumen_clinico" class="form-control" id="compose-textareas">
                                <?php echo $result->resumen_clinico; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('diagnostico'); ?>
                        </h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="diagnostico" class="form-control" id="compose-textareas">
                                <?php echo $result->diagnostico; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-sm-12"> 
                        <h4 class="text-center">
                            <?php echo $this->lang->line('Treatment'); ?>
                        </h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea style="height:50px" rows="1" name="treatment" class="form-control" id="compose-textareas">
                                <?php echo $result->tratamiento; ?>
                            </textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>   

</div>
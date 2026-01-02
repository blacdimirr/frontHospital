<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
<?php 
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();

?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        }

    .container {
        width: 80%;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
        text-align: center;
        margin-bottom: 20px;
    }

    header h1 {
        font-size: 24px;
        margin: 0;
    }

    header h2 {
        font-size: 20px;
        margin: 5px 0;
    }

    header h3 {
        font-size: 18px;
        margin: 5px 0;
    }

    header h4 {
        font-size: 16px;
        margin: 5px 0;
    }

    section {
        margin-bottom: 20px;
    }

    section h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        /* margin-bottom: 10px; */
    }

    table td {
        padding: 5px;
        /* border: 1px solid #ddd; */
    }

    /* th {
        background-color:rgb(126, 21, 21);
    } */

    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        /* border-radius: 4px; */
    }
    .text-1{
        /* width: 20px !important; */
        /* height: 10px;
        /* padding: 8px; */
        /* margin-bottom: 10px; */
        /* width: 50%;  */
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .text-2{
        /* width: 100px !important; */
        /* height: 30px !important; Establece la altura en 30 píxeles */
        /* padding: 8px; */
        width: 100%;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    /* input[type="text"], textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    } */

    footer {
        /* text-align: center; */
        /* margin-top: 20px; */
        background-color: #333;

        /* color: #fff; */
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    footer p {
        margin: 5px 0;
    }

    .info{
        padding-top:5px;
    }

    .title-info{
        /* background: red; */
        /* border: 0px solid #fff; */
        border:1px solid #921717;
    }
    .afiliado-info{
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
        text-align: center;        
    }
    .residencia-info{
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
        text-align: center;
    }
    .emergencia-info{
        text-align: center;
    }
    .diagnostico-info{
        text-align: center;
    }
    .procedimientos-info{
        text-align: center;
        margin-top: 70px;
        margin-bottom: 10px;
    }
    .admision-info{
        text-align: center;
    }
    .diagnostico-admision{
        text-align: center;
    }
    .subjetivo-objetivo{
        text-align: center;
    }
    .firma{
        text-align: center;
    }
    ._firma{
        padding:5px;
        font-size: 10px;
    }
    
 </style>
 

<div class="print-area">
    <div class="row">
        <div class="container">
                <header>
                    <h1>Registro Individual de Servicios</h1>
                    <h2>HOSP MATERNO INFANTIL SAN LORENZO DE LOS MINA</h2>
                    <h3>SANTO DOMINGO</h3>
                    <h3>SANTO DOMINGO ESTE</h3>
                    <h4>EMERGENCIA</h4>
                    <!-- <p><strong>RIS:</strong> 0160-001120588</p> -->
                    <p><strong>FECHA:</strong> <?php echo date("d-m-Y h:i:s a"); ?> </p>
                    <?php if (!empty($print_details[0]['print_header'])) { ?>
                        <!-- <div class="pprinta4">
                            <img src="<?php
                            if (!empty($print_details[0]['print_header'])) {
                                echo base_url() . $print_details[0]['print_header'].img_time();
                            }
                            ?>" class="img-responsive" style="height:100px; width: 100%;"> -->
                        <!-- </div> -->
                    <?php } ?>
                </header>

                <section class="afiliado-info info">
                    <h2 class="title-info" >AFILIADO QUE RECIBE EL SERVICIO</h2>
                    <table class="noborder_table">
                        <tr>
                            <th>Expediente:</th>
                            <td><?php echo $opd_prefix.$result["opd_details_id"]; ?></td>

                            <th>Nombre y apellidos:</th>
                            <td><?php echo $result["patient_name"] ?></td>
                        </tr>
                        <tr>
                            <th>NSS:</th>
                            <td><?php echo $result["insurance_id"] ?></td>

                            <th>ARS:</th>
                            <td> <?php echo $field_data[0]->field_value; ?>  </td>
                        </tr>
                        <tr>
                            <th>Plan Cobertura:</th>
                            <td> <?php echo $field_data[2]->field_value; ?> </td>

                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Régimen:</th>
                            <td><?php echo $field_data[3]->field_value; ?> </td>

                            <th>Cédula:</th>
                            <td><?php echo $result["identification_number"] ?></td>
                        </tr>
                        <tr>
                            <th>Estado Civil:</th>
                            <td><?php echo $result["marital_status"] ?></td>

                            <th>Sexo:</th>
                            <td><?php echo $result["gender"] ?></td>
                        </tr>
                        <tr>
                            <th>Nacionalidad:</th>
                            <td><?php echo $result["nationality"] ?></td>

                            <th>Fecha Nacimiento:</th>
                            <td><?php echo $result["dob"] ?></td>
                        </tr>
                    </table>
                </section>

                <section class="residencia-info info">
                    <h2 class="title-info" >LUGAR DE RESIDENCIA DEL AFILIADO</h2>
                    <table class="noborder_table">
                        <tr>
                            <th>Provincia:</th>
                            <td>01 DISTRITO NACIONAL</td>

                            <th>Dirección:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Municipio:</th>
                            <td>001 DISTRITO NACIONAL</td>

                            <th>Ciudad:</th>
                            <td>01 SANTO DOMINGO</td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th>
                            <td><?php echo $result["mobileno"] ?></td>

                            <th>Sector:</th>
                            <td>1116 LOS GUANDULES</td>
                        </tr>
                    </table>
                </section>

                <section class="emergencia-info info">
                    <h2 class="title-info" >EN CASO DE EMERGENCIA SE NOTIFICARÁ</h2>
                    <table class="noborder_table">
                        <tr>
                            <th>Nombre:</th>
                            <td></td>

                            <th>Parentesco:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Dirección:</th>
                            <td></td>

                            <th>Teléfonos:</th>
                            <td></td>
                        </tr>
                    </table>
                </section>

                <section class="diagnostico-info info">
                    <h2 class="title-info" >DIAGNOSTICO DE LA ATENCIÓN</h2>
                    <table class="noborder_table">
                        <tr>
                            <th></th>
                            <th>Código:</th>
                            <th>Descripción del Diagnóstico:</th>
                        </tr>
                        <tr>
                            <th>Diagnóstico Principal:</th>
                            <td><input type="text" class="text-1"></td>

                            <td colspan="2"><input type="text" class="text-2"></td>
                            <!-- <td><input type="text"></td> -->
                        </tr>
                        <tr>
                            <th>Diagnóstico Segundo:</th>
                            <td><input type="text" class="text-1"></td>

                            <td colspan="2"><input type="text" class="text-2"></td>
                            <!-- <td><input type="text"></td> -->
                        </tr>
                        <tr>
                            <th>Diagnóstico Tercero:</th>
                            <td><input type="text" class="text-1"></td>

                            <td colspan="2"><input type="text" class="text-2"></td>
                            <!-- <td><input type="text"></td> -->
                        </tr>
                    </table>
                </section>

                <section class="procedimientos-info info">
                    <h2 class="title-info" >PROCEDIMIENTOS REALIZADOS</h2>
                    <table class="noborder_table">
                        <tr>
                            <th></th>
                            <th>Código:</th>
                            <th>Descripción del procedimiento:</th>
                        </tr>
                        <tr>
                            <th>Servicio Principal:</th>
                            <td><input type="text" class="text-1"></td>

                            <td><input type="text" class="text-2"></td>
                            <!-- <td><input type="text" class="text-1"></td> -->
                        </tr>
                        <tr>
                            <th>Servicio Segundo:</th>
                            <td><input type="text" class="text-1"></td>

                            <td><input type="text" class="text-2"></td>
                            <!-- <td><input type="text" class="text-1"></td> -->
                        </tr>
                    </table>
                </section>

                <section class="admision-info info">
                    <h2 class="title-info" >DETALLE DE LA ADMISIÓN</h2>
                    <table class="noborder_table">
                        <tr>
                            <th>Fecha Ingreso:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Hora Ingreso:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Sala:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Cama:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Enviado desde:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Autorización:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Causa del Ingreso:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Ordenado por:</th>
                            <td></td>
                        </tr>
                    </table>
                </section>

                <hr style="height: 10px; clear: both;margin-bottom: 10px; margin-top: 10px" />
                <section class="diagnostico-admision info">
                    <!-- <h2>Diagnóstico de Admisión:</h2> -->
                    <table class="noborder_table">
                        <tr>
                            <td>Médico Principal/Admitido Por:</td>
                            <td>Especialidad:</td>
                            <td>CITA:</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </section>
                <hr style="height: 10px; clear: both;margin-bottom: 10px; margin-top: 10px" />

                <!-- <footer>
                    <p>Firma del Personal que Registra: ___________________________</p>
                    <p>Firma del Paciente o Responsable: ___________________________</p>
                    <p>Firma del Médico: ___________________________</p>
                </footer> -->
                <footer>
                    <section class="firma info">
                        <table class="noborder_table">
                            <tr>
                                <td class="_firma">
                                    <p>
                                        Firma del Personal que Registra: </br> 
                                        </br>
                                        </br>
                                        </br>
                                        </br>
                                        ________________________________
                                    </p>
                                </td>
                                <td class="_firma">
                                    <p>
                                        Firma del Paciente o Responsable: </br> 
                                        </br>
                                        </br>
                                        </br>
                                        </br>
                                        _________________________________
                                    </p>
                                </td>
                                <td class="_firma">
                                    <p>
                                        Firma del Médico: </br>
                                        </br>
                                        </br>
                                        </br>
                                        </br>
                                        ___________________________
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </section>
                </footer>

                <section class="referencias info">
                    <h2 class="title-info" >EL AFILIADO VIENE REFERIDO DE:</h2>
                    <table class="noborder_table">
                        <tr>
                            <td>Entidad que refiere:</td>
                            <td><input type="text" class="text-2"></td>
                        </tr>
                        <tr>
                            <td>Diagnóstico Presuntivo:</td>
                            <td><input type="text" class="text-2"></td>
                        </tr>
                        <tr>
                            <td>Tratamiento Realizado:</td>
                            <td><input type="text" class="text-2"></td>
                        </tr>
                    </table>

                    <h2 class="title-info" >EL AFILIADO ES REFERIDO A:</h2>
                    <table class="noborder_table">
                        <tr>
                            <td>Entidad a la que se refiere:</td>
                            <td><input type="text" class="text-2"></td>
                        </tr>
                        <tr>
                            <td>Diagnóstico Presuntivo:</td>
                            <td><input type="text" class="text-2"></td>
                        </tr>
                        <tr>
                            <td>Tratamiento Realizado:</td>
                            <td><input type="text" class="text-2"></td>
                        </tr>
                    </table>
                </section>

                <section class="subjetivo-objetivo info">
                    <h2 class="title-info" >SUBJETIVO/SÍNTOMAS:</h2>
                    <textarea rows="4" cols="50"></textarea>

                    <h2 class="title-info" >OBJETIVO/SIGNOS:</h2>
                    <textarea rows="4" cols="50"></textarea>

                    <h2 class="title-info" >ANÁLISIS/DIAGNÓSTICO PRESUNTIVO:</h2>
                    <textarea rows="4" cols="50"></textarea>

                    <h2 class="title-info" >PLAN (ANALÍTICA/TRATAMIENTO):</h2>
                    <textarea rows="4" cols="50"></textarea>
                </section>

                <!-- <section class="ultimo-evento info">
                    <h2>DATOS DEL ÚLTIMO EVENTO DE ATENCION:</h2>
                    <p><strong>RIS:</strong> 0160-001116548</p>
                    <p><strong>FECHA:</strong> 03/02/2025</p>
                    <p><strong>MEDICO:</strong> BRIGIDA MORENO 2</p>
                    <p><strong>ESPECIALIDAD:</strong> CONSEJERIA ANTICONCEPTIVA</p>
                </section> -->

                <section class="razones-cuidado info">
                    <h2 class="title-info" >RAZONES DE ESPECIAL CUIDADO:</h2>
                    <textarea rows="4" cols="50"></textarea>

                    <h2 class="title-info" >OTRAS:</h2>
                    <textarea rows="4" cols="50"></textarea>
                </section>
        </div>

        <!-- NO  -->

        <div class="col-md-12" style="display: none;">

            <?php if (!empty($print_details[0]['print_header'])) { ?>
                        <div class="pprinta4">
                            <img src="<?php
                            if (!empty($print_details[0]['print_header'])) {
                                echo base_url() . $print_details[0]['print_header'].img_time();
                            }
                            ?>" class="img-responsive" style="height:100px; width: 100%;">
                        </div>
                    <?php } ?>
            <div class="card">
                <div class="card-body">  
                    <div class="row">
                            <div class="col-md-12" style="padding-top:10px">
                    <table class="noborder_table">

                        <tr>
                                <th><?php echo $this->lang->line("opd_id"); ?></th>
                                <td><?php echo $opd_prefix.$result["opd_details_id"];?></td>
                                <th><?php echo $this->lang->line("checkup_id") ; ?></th>
                                <td><?php echo $checkup_prefix.$result["id"] ?></td>
                                <th><?php echo $this->lang->line("appointment_date") ; ?></th>
                                <td><?php echo $this->customlib->YYYYMMDDHisTodateFormat($result["appointment_date"]); ?></td>
                            </tr>
                            <?php if($result["appointment_no"]!="" || $result["appointment_serial_no"] ) { ?>
                            <tr>
                                <th><?php echo $this->lang->line("appointment_no"); ?></th>
                                <td><?php if($result["appointment_no"]!="") { echo $this->customlib->getSessionPrefixByType('appointment').$result["appointment_no"]; } ?></td>
                                <th><?php echo 'Appointment S.No' ; ?></th>
                                <td><?php echo $result["appointment_serial_no"] ?></td>
                            
                            </tr>
                            <?php } ?>
                        <tr>
                            <th><?php echo $this->lang->line("patient_name"); ?></th>
                            <td><?php echo $result["patient_name"].' ('. $result["patient_id"] .')' ?></td>
                            <th><?php echo $this->lang->line("weight") ; ?></th>
                            <td><?php echo $result["weight"] ?></td>
                            <th><?php echo $this->lang->line("bp") ; ?></th>
                            <td><?php echo $result["bp"] ?></td>
                        </tr>
                        <tr>
                            <th><?php echo $this->lang->line("age"); ?></th>
                            
                            <td>
                                <?php
                    echo $this->customlib->getPatientAge($result['age'],$result['month'],$result['day']);
                                ?>
                            </td>
                            <th><?php echo $this->lang->line("gender"); ?></th>
                            <td><?php echo $result["gender"] ?></td>
                            <th><?php echo $this->lang->line("height") ; ?></th>
                            <td><?php echo $result["height"] ?></td>
                        </tr>


                        <tr>
                            <th><?php echo $this->lang->line("address"); ?></th>
                            <td><?php echo $result["address"] ?></td>
                            <th><?php echo $this->lang->line("blood_group"); ?></th>
                            <td><?php echo $blood_group_name; ?></td>
                        </tr>
                        <tr>

                            <th><?php echo $this->lang->line('consultant_doctor'); ?></th>
                            <td><?php echo $result["name"] . " " . $result["surname"].' ('. $result["employee_id"] .')' ?></td>
                            
                            <th><?php echo $this->lang->line('department'); ?></th>
                        <td  colspan="3"><?php echo $result["department_name"]; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo $this->lang->line('known_allergies');?></th>
                            <td><?php echo $result["known_allergies"]; ?></td>
                            <th><?php echo $this->lang->line('pulse');?></th>
                            <td><?php echo $result["pulse"]; ?></td>
                            <th><?php echo $this->lang->line('temperature');?></th>
                            <td><?php echo $result["temperature"]; ?></td> 
                        </tr>
                    </table>
                </div>
                    </div>
                        <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px" />
                    <h4 class="font-bold" style="display: none;"><?php echo $this->lang->line("payment_details"); ?></h4>
                    <?php 
                        if (!empty($charge)) {
                        ?>

                    <div class="row">
                        <div class="col-md-12" style="display: none;">
                            <table class="print-table">
                            <thead>
                                <tr class="line">
                                <td><strong>#</strong></td>
                                <td class=""><strong><?php echo $this->lang->line('description');?></strong></td>
                                <td class=""><strong><?php echo $this->lang->line('tax').' ('.'%'.')';?></strong></td>
                                
                                <td class="text-right"><strong><?php echo $this->lang->line('amount').' ('.$currency_symbol.')';?></strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>1</td>
                                <td><strong><?php   echo $charge->charge_name ?></strong><br>
                                    <?php echo $charge->note;?>
                                </td>
                                
                                <td class=""><?php 
                                if($charge->tax>0)
                                    { 
                                    $tax=(($charge->apply_charge*$charge->tax)/100);  
                                    }else{ $tax=0; 
                                    } echo amountFormat($tax)." (".$charge->tax."%)";?></td>
                                <td class="text-right"><?php echo $charge->amount;?></td>
                                </tr>
                                <tr>
                                
                                <td colspan="3" class="text-right thick-line"><strong><?php echo $this->lang->line('net_amount');?></strong></td>
                                <td class="text-right thick-line"><strong><?php echo $currency_symbol.$charge->apply_charge; ?></strong></td>
                                </tr>
                                <tr>
                                
                                <td colspan="3" class="text-right no-line"><strong><?php echo $this->lang->line('tax');?></strong></td>
                                <td class="text-right no-line"><strong><?php 
                                if($charge->tax>0){
                                    $tax_amt = ($charge->apply_charge*$charge->tax/100);
                                }else{
                                    $tax_amt = 0;
                                }
                                
                                $total = ($charge->amount);
                                echo $currency_symbol.amountFormat($total+$tax_amt); ?></strong></td>
                                </tr>
                                <tr>  
                                
                                <td colspan="3" class="text-right no-line"><strong><?php echo $this->lang->line('total');?></strong></td>
                                <td class="text-right no-line"><strong><?php 
                                echo $currency_symbol.amountFormat($total); ?></strong></td>
                                </tr>
                                <tr>                                  
                                <td colspan="3" class="text-right no-line">
                                    <strong><?php echo $this->lang->line('paid_amount');?></strong></td>
                                <td class="text-right no-line"><strong><?php 
                                $amount_paid=(!isset($transaction) || empty($transaction)) ? 0:  $transaction->amount;
                                
                                echo $currency_symbol.amountFormat($amount_paid); ?></strong></td>
                                </tr>
                                    <tr>                                  
                                <td colspan="3" class="text-right no-line">
                                    <strong><?php echo $this->lang->line('balance_amount');?></strong></td>
                                <td class="text-right no-line"><strong><?php 
                                $amount_paid=(!isset($transaction) || empty($transaction)) ? 0:  $transaction->amount;
                                
                                echo $currency_symbol.amountFormat(($total+$tax_amt)-$amount_paid); ?></strong></td>
                                </tr>

                            </tbody>
                        </table>
                        </div>
                    </div>

                        <?php
                        }
                    ?>

                
                </div>
            </div>
            
        </div>
    </div>

    <div class="col-md-12">
        <p>
            <?php
            if (!empty($print_details[0]['print_footer'])) {
                echo $print_details[0]['print_footer'];
            }
            ?>
        </p>
    </div>
</div>


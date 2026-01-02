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
    }

    table td {
        padding: 5px;
    }

    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }
    .text-1{
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .text-2{
        width: 100%;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    footer {
        background-color: #333;
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
                        </tr>
                        <tr>
                            <th>Diagnóstico Segundo:</th>
                            <td><input type="text" class="text-1"></td>

                            <td colspan="2"><input type="text" class="text-2"></td>
                        </tr>
                        <tr>
                            <th>Diagnóstico Tercero:</th>
                            <td><input type="text" class="text-1"></td>

                            <td colspan="2"><input type="text" class="text-2"></td>
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
                        </tr>
                        <tr>
                            <th>Servicio Segundo:</th>
                            <td><input type="text" class="text-1"></td>

                            <td><input type="text" class="text-2"></td>
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

                <section class="razones-cuidado info">
                    <h2 class="title-info" >RAZONES DE ESPECIAL CUIDADO:</h2>
                    <textarea rows="4" cols="50"></textarea>

                    <h2 class="title-info" >OTRAS:</h2>
                    <textarea rows="4" cols="50"></textarea>
                </section>
        </div>

        <!-- NO  -->
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


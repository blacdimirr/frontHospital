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

<div class="body-pdf">
    <div class="print-area">    

        <div class="form-section">
            <div class="grid-2col">
                <div class="section-title">DATOS DEL PACIENTE</div>
                    
                    <div> No. Expediente: <span class="input-field"></span></div> 
                    <div> Habitación o Sala: <span class="input-field"><?php echo $result['patient_name'];?></span></div>
                    <div> Cama: <span class="input-field"><?php echo $result['patient_name'];?></span></div>

                    <div> Nombre y Apeliido:  <span class="input-field-short"><?php if (!empty($result_custom_details['Listado de ARS'])) {echo "Si";} else { echo "No";};?></span></div>
                    <div> CÉDULA/PASAPORTE: <span class="input-field"><?php echo $result['identification_number'];?></span></div>

                    <div> ASEGURADO:  <span class="input-field-short"><?php if (!empty($result_custom_details['Listado de ARS'])) {echo "Si";} else { echo "No";};?></span></div>
                    <div> NSS:  <span class="input-field-short"><?php echo $result_custom_details['insurance_id'];?></span> </div>
                    <div> ARS:  <span class="input-field"><?php echo $result_custom_details['Listado de ARS'];?></span> </div>

                    <div>
                        SEXO: <span class="input-field-short"> <?php echo $result['gender'];?> </span> 
                        EDAD: <span class="input-field-short"> <?php echo $result['age'];?> </span>
                        PESO: <span class="input-field-short"> <?php echo $result['weight'];?> </span>
                    </div>

                    <div> Fecha de Ingreso: <span class="input-field"><?php echo $result['patient_name'];?></span></div>
                    <div> Dias de Permanencia: <span class="input-field"><?php echo $result['patient_name'];?></span></div>
                    
                </div>
                <br/>
                <div class="grid-2col-extra">                    
                    <div> DIRECCIÓN: <span class="input-field"><?php echo $result['address'];?></span></div>
                </div>
        </div>

    </div>
</div>

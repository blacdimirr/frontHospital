<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>ArdanCare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }

        .document {
            width: 210mm;
            /* tamaño A4 */
            min-height: 297mm;
            margin: auto;
            background: #fff;
            padding: 20mm;
            box-sizing: border-box;
            position: relative;
        }

        header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        header img {
            height: 100px;
            vertical-align: middle;
        }

        header .hospital-info {
            display: inline-block;
            margin-left: 15px;
            vertical-align: middle;
        }

        header h1 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }

        header small {
            font-size: 12px;
            color: #666;
        }

        .meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .texto {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 80px;
            /* espacio para el footer */
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        table th {
            background: #f0f0f0;
            font-weight: bold;
        }

        footer {
            position: absolute;
            bottom: 20mm;
            left: 20mm;
            right: 20mm;
            font-size: 13px;
            text-align: center;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature-block {
            text-align: center;
            width: 45%;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
        }

        @media print {
            body {
                background: #fff;
            }

            .document {
                margin: 0;
                box-shadow: none;
            }

            footer {
                position: fixed;
                bottom: 20mm;
            }
        }

        .title {
            text-align: center;
            /* width: 45%; */
        }
    </style>
</head>

<body>
    <div class="document">
        <header>
            <!-- <img src="logo.png" alt="Logo">
                <div class="hospital-info">
                    <h1>Smart Hospital & Research Center</h1>
                    <small>Dirección: 25 King Street, CA · Tel: 896542129934 · Email: smarthospitalgc@gmail.com</small>
                </div> -->
            <p class="texto">
                <strong>FECHA DE IMPRESIóN:</strong> <?php echo date("d-m-Y h:i:s a"); ?>
            </p>
            <?php if (!empty($print_details[0]['print_header'])) { ?>
                <div class="pprinta4">
                    <img src="<?php
                                if (!empty($print_details[0]['print_header'])) {
                                    echo base_url() . $print_details[0]['print_header'] . img_time();
                                }
                                ?>" class="">
                </div>
            <?php } ?>
        </header>

        <div class="">
            <div class="title">
                <h1> Recepción de Almacen </h1>
            </div>
        </div>

        <div class="meta">
            <div>
                <p><strong>Suplidor:</strong> <?php echo $suplidor; ?> </p>
                <p><strong>Orden de compra:</strong> <?php echo $compra_orden; ?> </p>
                <p><strong>Recibido por:</strong> <?php echo $responsable; ?> </p>
            </div>
            <div>
                <p><strong>FECHA:</strong> <?php echo $received_date; ?></p>
                <p><strong>Cod. orden:</strong> <?php echo $_id; ?></p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Unidad</th>
                    <th>Cantidad recibida</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $key => $value) { ?>
                    <tr>
                        <td class="_firma">
                            <p>
                                <?php echo $value['item_name']; ?>
                            </p>
                        </td>
                        <td class="_firma">
                            <p>
                                <?php echo $value['unit']; ?>
                            </p>
                        </td>
                        <td class="_firma">
                            <p>
                                <?php echo $value['quantity']; ?>
                            </p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <footer>
            <div class="signatures">
                <!-- <div class="signature-block">
                    <p>Firma del suplidor</p>
                    <div class="signature-line"></div>
                </div> -->
                <div class="signature-block">
                    <p>Firma del empleado</p>
                    <div class="signature-line"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
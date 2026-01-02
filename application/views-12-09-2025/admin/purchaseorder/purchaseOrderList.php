<?php $currency_symbol = $this->customlib->getHospitalCurrencyFormat();  ?>
<div class="content-wrapper">
    <style>
        .background-custom {
            /* background: #77a6ea; */
            text-align: center;
            border-radius: 30px;
        }

        .AMARILLO {
            background: #eaee6a;
        }

        .NARANJA {
            background: #f0bf62;
        }

        .VERDE {
            background: #aff062;
        }

        .AZUL {
            background: #62f0f0;
        }

        .BLANCO {
            background: rgb(155, 180, 216);
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('purchase_order_list'); ?></h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('expense', 'can_add')) { ?>
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm addexpense"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_purchase_order'); ?></a>
                            <?php } ?>
                        </div><!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered dt-list" data-export-title="<?php echo $this->lang->line('purchase_order_list'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('Reference Number'); ?></th>
                                        <th><?php echo $this->lang->line('description'); ?></th>
                                        <th><?php echo $this->lang->line('supplier'); ?></th>
                                        <th><?php echo $this->lang->line('purchase status'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('total expenditure') . " (" . $currency_symbol . ")"; ?></th>
                                        <th><?php echo $this->lang->line('payment date'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_purchase_order'); ?></h4>
            </div>
            <div class="scroll-area">
                <div class="modal-body pt0 pb0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="edit_data">
                            <form class="ptt10" id="addexpense" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="row">
                                    <?php if ($this->session->flashdata('msg')) { ?>
                                        <?php echo $this->session->flashdata('msg');
                                            $this->session->userdata('msg');
                                        ?>
                                    <?php } ?>
                                    <?php
                                        if (isset($error_message)) {
                                            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                        }
                                    ?>
                                    <?php echo $this->customlib->getCSRF(); ?>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label> <small class="req">*</small>
                                            <input id="date" placeholder="" type="text" class="form-control" value="<?php echo set_value('date', date($this->customlib->getHospitalDateFormat())); ?>" disabled />
                                            <input type='hidden' name="exdate" value="<?php echo set_value('date', date($this->customlib->getHospitalDateFormat())); ?>" > 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('Reference Number'); ?></label>
                                            <input id="reference_number" name="reference_number" placeholder="" type="text" class="form-control" value="<?php echo set_value('reference_number'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                            <textarea class="form-control" id="description" name="description" placeholder="" rows="3"><?php echo set_value('description'); ?></textarea>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('products'); ?></label> <small class="req">*</small>
                                            <select autofocus="" id="item_store_id" name="item_store_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($itemStoreList as $item) {
                                                ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php
                                                        if (set_value('item_store_id') == $item['id']) {
                                                            echo "selected =selected";
                                                        }
                                                        ?>><?php echo $item['item_store'] ?></option>

                                                <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>                                           
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('supplier'); ?></label> <small class="req">*</small>
                                            <select autofocus="" id="supplier_id" name="supplier_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($itemSupplierList as $item) {
                                                ?>
                                                    <option value="<?php echo $item['id'] ?>" <?php
                                                        if (set_value('supplier_id') == $item['id']) {
                                                            echo "selected =selected";
                                                        }
                                                        ?>><?php echo $item['item_supplier'] ?></option>

                                                <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                     <div class="col-sm-12">
                                        <a class="btn btn-info add-record addplus-xs" data-added="0"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_product'); ?></a>
                                        <hr>
                                    </div>                                    

                                    <!-- Productos -->
                                    <div class="">
                                        <div class="">
                                            <div class="col-12">
                                                <table class="table table-striped table-bordered table-hover mb0" id="tableID">
                                                  
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Productos -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('total expenditure') . " (" . $currency_symbol . ")"; ?></label> <small class="req">*</small>
                                            <input id="amount" name="amount" placeholder="" type="text" class="form-control" value="<?php echo set_value('amount'); ?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('payment_date'); ?></label> <small class="req">*</small>
                                            <input id="payment_date" name="payment_date" placeholder="" type="text" class="form-control" value="<?php echo set_value('payment_date', date($this->customlib->getHospitalDateFormat())); ?>" readonly="readonly" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                            <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control" value="<?php echo set_value('documents'); ?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="" style="display:none;">
                                         <div class="col-sm-6" style="display:none;">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label> <small class="req">*</small>
                                                <input id="name" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                            </div>
                                        </div>                                        
                                    </div>
                                    <!-- ingresos -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('income'); ?> <small class="req"> *</small></label>
                                            <input id="amount_income" name="amount_income" readonly placeholder="" type="text" class="form-control" value="<?php echo $amount_income; ?>" />
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="submit" data-loading-text="<?php echo $this->lang->line('processing'); ?>" id="addexpensebtn" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('edit_purchase_order'); ?></h4>
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="edit_expensedata">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModaledit_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('edit_expense'); ?></h4>
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="edit_expensedata_status">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('#date').datepicker({
            format: date_format,
            endDate: '+0d',
            autoclose: true
        });
        $('#payment_date').datepicker({
            format: date_format,
            // endDate: '+0d',
            autoclose: true
        });

        $("#btnreset").click(function() {
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(document).ready(function() {        
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function() {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });

    function delete_record(id) {
        if (confirm('<?php echo $this->lang->line('delete_confirm') ?>')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/purchaseorder/delete/' + id,
                success: function(res) {
                    successMsg('<?php echo $this->lang->line('delete_message'); ?>');
                    window.location.reload(true);
                },
                error: function() {
                    alert("Fail")
                }
            });
        }
    }

    $(document).ready(function(e) {
        $("#addexpense").on('submit', (function(e) {
            e.preventDefault();
            $("#addexpensebtn").button('loading');
            $.ajax({
                url: '<?php echo base_url(); ?>admin/purchaseorder/add',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        $('.dt-list').DataTable().ajax.reload();
                        $('#myModal').modal('hide');
                    }
                    $("#addexpensebtn").button('reset');
                },
                error: function() {
                    alert("Fail");
                    $("#addexpensebtn").button('reset');
                },
                complete: function() {
                    $("#addexpensebtn").button('reset');
                }
            });
        }));
    });

    function edit(id) {
        $('#myModaledit').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/purchaseorder/getDataByid/' + id,
            success: function(data) {
                $('#edit_expensedata').html(data);
            }
        });
    }

    function edit_status(id) {
        $('#myModaledit_status').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/purchaseorder/getDataByidForStatus/' + id,
            success: function(data) {
                $('#edit_expensedata_status').html(data);
            }
        });
    }

    $(".addexpense").click(function() {
        $('#addexpense').trigger("reset");
        $(".dropify-clear").trigger("click");
    });

    $(document).ready(function(e) {
        $('#myModal,#myModaledit,#myModaledit_status').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    });

    function initDatatable2(_selector, _url, params = {}, rm_export_btn = [], pageLength = 100, aoColumnDefs = [{
        "bSortable": false,
        "aTargets": [5,6],
        'sClass': 'background-custom',
    }], searching = true, aaSorting = [], dataSrc = "data") {

        if ($.fn.DataTable.isDataTable('.' + _selector)) { // if exist datatable it will destrory first
            $('.' + _selector).DataTable().destroy();
        }
        table = $('.' + _selector)
            .on('preInit.dt', function(e, settings) {
                var api = new $.fn.dataTable.Api(settings);
                $.each(rm_export_btn, function(key, expt_select) {
                   
                    if (expt_select === "btn-all") {
                        api.buttons().remove();

                    } else {
                        api.buttons('.' + expt_select).remove();

                    }
                });
            }).DataTable({
                // "scrollX": true,
                dom: '<"top"f><Bl>r<t>ip',

                lengthMenu: [
                    [100, -1],
                    [100, "All"]
                ],

                buttons: [{
                        extend: 'copy',
                        text: '<i class="fa fa-files-o"></i>',
                        titleAttr: 'Copy',
                        className: "btn-copy",
                        title: $('.' + _selector).data("exportTitle"),
                        exportOptions: {
                            columns: ["thead th:not(.noExport)"]
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        className: "btn-excel",
                        title: $('.' + _selector).data("exportTitle"),
                        exportOptions: {
                            columns: ["thead th:not(.noExport)"]
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        className: "btn-csv",
                        title: $('.' + _selector).data("exportTitle"),
                        exportOptions: {
                            columns: ["thead th:not(.noExport)"]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',
                        className: "btn-pdf",
                        title: $('.' + _selector).data("exportTitle"),
                        exportOptions: {
                            columns: ["thead th:not(.noExport)"]
                        },

                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        className: "btn-print",
                        title: $('.' + _selector).data("exportTitle"),
                        customize: function(win) {

                            $(win.document.body).find('th').addClass('display').css('text-align', 'center');
                            $(win.document.body).find('table').addClass('display').css('font-size', '14px');
                            $(win.document.body).find('td').addClass('display').css('text-align', 'left');
                            $(win.document.body).find('h1').css('text-align', 'center');
                        },
                        exportOptions: {
                            columns: ["thead th:not(.noExport)"]

                        }

                    }
                ],

                // "scrollY":        "320px",

                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> ',
                    sLengthMenu: "_MENU_"
                },
                "pageLength": pageLength,
                "searching": searching,
                "aaSorting": aaSorting, // default sorting [ [0,'asc'], [1,'asc'] ]
                "aoColumnDefs": aoColumnDefs, //disable sorting { "bSortable": false, "aTargets": [ 1,2 ] }
                "processing": true,
                "serverSide": true,

                "ajax": {
                    "url": baseurl + _url,
                    "dataSrc": dataSrc,
                    "type": "POST",
                    'data': params,
                }

            });

            table.on('draw', function() {
                table.column(5).nodes().to$().each(function(index, td) {
                    var data = $(td).text();
                    // .BLANCO {
                    //     background: rgb(155, 180, 216);
                    // }
                    if (data == 'RECIBIDO') { $(td).css('background-color', '#eaee6a'); }
                    if (data == 'PENDIENTE') { $(td).css('background-color', '#f0bf62'); }
                    if (data == 'ENVIADO') { $(td).css('background-color', '#aff062'); }
                    if (data == 'PAGADO') { $(td).css('background-color', '#62f0f0'); }
                    if (data == '') { $(td).css('background-color', 'rgb(217, 225, 235)'); }
                });
            });
    }

    function delete_row(id) {
        var table = document.getElementById("tableID");
        var rowCount = table.rows.length;
        $("#row" + id).html("");

        let values = $("input[name='row_costs[]']").map(function(){return $(this).val();}).get();
        let sum = 0; 

        $.each(values, function(index, value) {
            sum += parseFloat(value || 0);
        });
        $('#amount').val(sum);
    }

    function sumatoria(){
        let total = 0;
        let amount_total = 0;

        var values = $("input[name='row_costs[]']").map(function(){

            return $(this).val();
        }).get();

         $.each(values, function(index, value) {
            total = (parseFloat($('#quantity'+index).val() || 0) * parseFloat($('#cost'+index).val() || 0) );
            console.log(index,'veces',total);
            $('#total'+index).val(total);

            amount_total += total;

            $('#amount').val(amount_total); 
        });
    }

    function sumatoria_edit(){
        let total = 0;
        let amount_total = 0;

        var values = $("input[name='row_costs[]']").map(function(){

            return $(this).val();
        }).get();

        $.each(values, function(index, value) {
            total = (parseFloat($('#quantity'+index).val() || 0) * parseFloat($('#cost'+index).val() || 0) );
            console.log(index,'veces',total);
            $('#total'+index).val(total);

            amount_total += total;

            $('#amount_edit').val(amount_total); 
        });
    }

    function delete_row_edit(id) {
        var table = document.getElementById("tableID_edit");
        var rowCount = table.rows.length;
        $("#row" + id).html("");
        
        sumatoria_edit();
        // let values = $("input[name='row_costs[]']").map(function(){return $(this).val();}).get();
        // let sum = 0; 

        // $.each(values, function(index, value) {
        //     sum += parseFloat(value || 0);
        // });
        // $('#amount_edit').val(sum);
    }
</script>

<!-- //========datatable start===== -->
<script type="text/javascript">
    (function($) {
        'use strict';
        $(document).ready(function() {
            initDatatable2('dt-list', 'admin/purchaseorder/getDatatable', [], [], 100);
            var item = 0;
            var item_edit = 0;

            $(document).on('click','.add-record',function(){
                console.log(784);
                let producto = $('#item_store_id option:selected').text();          
                let producto_id = $('#item_store_id option:selected').val();
                
                if (producto !== 'Seleccione'){
                    var div = "<input type='hidden' name='rows[]' value='"+producto_id+"' autocomplete='off'> <div class='col-md-6'> <div class='form-group'><label><?php echo $this->lang->line("product"); ?></label><input name='product_id_"+item+"' value="+producto+" class='form-control' id='product_id_"+item+"' readonly></div> </div> <div class='col-md-1'> <div class='form-group'><label><?php echo $this->lang->line("quantity"); ?></label> <input id='quantity"+item+"' class='form-control' type='number' name='row_quantitys[]' min='0' step='.01' autocomplete='off'> </div></div> <div class='col-md-2'> <div class='form-group'><label><?php echo $this->lang->line("cost"); ?></label> <input id='cost"+item+"'class='form-control' type='number' min='0' step='.01' name='row_costs[]' autocomplete='off' onchange='sumatoria()'> </div></div> <div class='col-md-2'> <div class='form-group'><label><?php echo $this->lang->line("total"); ?></label> <input id='total"+item+"' class='form-control' type='number' name='row_quantitys_total[]' readonly autocomplete='off'> </div></div> <div class='col-md-1'> <button type='button' onclick='delete_row("+item+")' data-row-id='"+item+"' class='closebtn delete_row crossbtnfa'><i class='fa fa-remove'></i></button></div>";
                    
                    var row = "<tr id='row" + item + "'><td>" + div + "</td> </tr>";

                    $('#tableID').append(row).find('.select2').select2();
                    item++;
                }

            }); 

            $(document).on('click','.add-record-edit',function(){
                let producto = $('#item_store_id_edit option:selected').text();          
                let producto_id = $('#item_store_id_edit').val();

                item_edit += <?php echo count($purchase_order_details);?> + 1;

                // console.log(74);
                
                console.log(785,producto,producto_id,item_edit);
                if (producto !== 'Seleccione'){
                    var div = "<input type='hidden' name='rows[]' value='"+producto_id+"' autocomplete='off'> <div class='col-md-6'> <div class='form-group'><label><?php echo $this->lang->line("product"); ?></label><input name='product_id_"+item_edit+"' value="+producto+" class='form-control' id='product_id_"+item_edit+"' readonly></div> </div> <div class='col-md-1'> <div class='form-group'><label><?php echo $this->lang->line("quantity"); ?></label> <input id='quantity"+item_edit+"' class='form-control' type='number' name='row_quantitys[]' min='0' step='.01' autocomplete='off'> </div></div> <div class='col-md-2'> <div class='form-group'><label><?php echo $this->lang->line("cost"); ?></label> <input id='cost"+item_edit+"'class='form-control' type='number' min='0' step='.01' name='row_costs[]' autocomplete='off' onchange='sumatoria_edit()'> </div></div> <div class='col-md-2'> <div class='form-group'><label><?php echo $this->lang->line("total"); ?></label> <input id='total"+item_edit+"' class='form-control' type='number' name='row_quantitys_total[]' readonly autocomplete='off'> </div></div> <div class='col-md-1'> <button type='button' onclick='delete_row_edit("+item_edit+")' data-row-id='"+item_edit+"' class='closebtn delete_row_edit crossbtnfa'><i class='fa fa-remove'></i></button></div>";
                    
                    var row = "<tr id='row" + item_edit + "'><td>" + div + "</td> </tr>";

                    $('#tableID_edit').append(row).find('.select2').select2();
                    item_edit++;
                }

            });       
        });
    }(jQuery))
</script>
<!-- //========datatable end===== -->
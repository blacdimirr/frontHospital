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
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('expense_list'); ?></h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('expense', 'can_add')) { ?>
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm addexpense"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_expense'); ?></a>
                            <?php } ?>
                        </div><!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered dt-list" data-export-title="<?php echo $this->lang->line('expense_list'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('invoice_number'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('description'); ?></th>
                                        <th><?php echo $this->lang->line('expense_head'); ?></th>
                                        <?php
                                        if (!empty($fields)) {

                                            foreach ($fields as $fields_key => $fields_value) {
                                        ?>
                                                <th><?php echo $fields_value->name; ?></th>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <th class="text-right"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></th>
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
                <h4 class="modal-title"><?php echo $this->lang->line('add_expense'); ?></h4>
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
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('expense_head'); ?></label> <small class="req">*</small>
                                            <select autofocus="" id="exp_head_id" name="exp_head_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($expheadlist as $exphead) {
                                                ?>
                                                    <option value="<?php echo $exphead['id'] ?>" <?php
                                                        if (set_value('exp_head_id') == $exphead['id']) {
                                                            echo "selected =selected";
                                                        }
                                                        ?>><?php echo $exphead['Tipo']. '-'.$exphead['Objecto']. '-'.$exphead['Cuenta']. '-'.$exphead['Sub_Cuenta']. '-'.$exphead['Auxiliar']. '-'.$exphead['exp_category'] ?></option>

                                                <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label> <small class="req">*</small>
                                            <input id="name" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('invoice_number'); ?></label>
                                            <input id="invoice_no" name="invoice_no" placeholder="" type="text" class="form-control" value="<?php echo set_value('invoice_no'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label> <small class="req">*</small>
                                            <input id="date" name="exdate" placeholder="" type="text" class="form-control" value="<?php echo set_value('date', date($this->customlib->getHospitalDateFormat())); ?>" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></label> <small class="req">*</small>
                                            <input id="amount" name="amount" placeholder="" type="text" class="form-control" value="<?php echo set_value('amount'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                            <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control" value="<?php echo set_value('documents'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                            <textarea class="form-control" id="description" name="description" placeholder="" rows="3"><?php echo set_value('description'); ?></textarea>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="">
                                        <?php // echo display_custom_fields('expenses'); 
                                        ?>
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
                <h4 class="modal-title"><?php echo $this->lang->line('edit_expense'); ?></h4>
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
                url: '<?php echo base_url(); ?>admin/expense/delete/' + id,
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
                url: '<?php echo base_url(); ?>admin/expense/add',
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
            url: '<?php echo base_url(); ?>admin/expense/getDataByid/' + id,
            success: function(data) {
                $('#edit_expensedata').html(data);
            }
        });
    }

    function edit_status(id) {
        $('#myModaledit_status').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/expense/getDataByidForStatus/' + id,
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
</script>

<!-- //========datatable start===== -->
<script type="text/javascript">
    (function($) {
        'use strict';
        $(document).ready(function() {
            initDatatable2('dt-list', 'admin/expense/getDatatable', [], [], 100);
        });
    }(jQuery))
</script>
<!-- //========datatable end===== -->
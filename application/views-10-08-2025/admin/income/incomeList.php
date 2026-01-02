<?php $currency_symbol = $this->customlib->getHospitalCurrencyFormat();?>
<div class="content-wrapper">
    <style>
        .background-custom {
            text-align: center;
            border-radius: 30px;
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('income_list'); ?></h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('income', 'can_add')) {?>
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm addincome"><i class="fa fa-plus"></i>  <?php echo $this->lang->line('add_income'); ?></a>
                            <?php }?>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('income_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered ajaxlist" data-export-title="<?php echo $this->lang->line('income_list'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('invoice_number'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('date'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('description'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('income_head'); ?>
                                        </th>
                                         <?php 
                                         if (!empty($fields)) {

                                                foreach ($fields as $fields_key => $fields_value) {
                                                    ?>
                                                    <th><?php echo $fields_value->name; ?></th>
                                                    <?php
                                                } 
                                            }
                                         ?>
                                        <th class="text-right"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?>
                                        </th>
                                        <th ><?php echo $this->lang->line('income_payments') . " (" . $currency_symbol . ")"; ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_income'); ?></h4>
            </div>
            <form id="add_income" class="ptt10" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="scroll-area">
                    <div class="modal-body pt0 pb0">
                            <div class="row">
                                <?php if ($this->session->flashdata('msg')) {?>
                                    <?php echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg'); ?>
                                <?php }?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('income_head'); ?> <small class="req"> *</small></label>
                                        <select autofocus="" id="inc_head_id" name="inc_head_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($incheadlist as $inchead) { ?>
                                            <option value="<?php echo $inchead['id'] ?>"<?php
                                            if (set_value('inc_head_id') == $inchead['id']) {
                                                    echo "selected = selected";
                                                }
                                                ?>><?php echo $inchead['income_category'] ?>
                                                    
                                            </option>
                                            <?php $count++; } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                                        <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('invoice_number'); ?></label>
                                        <input id="invoice_no" name="invoice_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('invoice_no'); ?>" />

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                        <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date', date($this->customlib->getHospitalDateFormat())); ?>" readonly="readonly" />

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?><small class="req"> *</small></label>
                                        <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount'); ?>" />

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control"   value="<?php echo set_value('documents'); ?>" />

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                        <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="">
                                    <?php // echo display_custom_fields('income'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('evidence'); ?></label>
                                        <input id="documents_other" name="documents_other" placeholder="" type="file" class="filestyle form-control" value="<?php echo set_value('documents_other'); ?>" />
                                    </div>
                                </div>
                                <!-- gastos -->
                                <div class="col-sm-6" style="display:none">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('expenses'); ?> <small class="req"> *</small></label>
                                        <select autofocus="" id="expense_id" name="expense_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($expenselist as $expense) { ?>
                                            <option value="<?php echo $expense['id'] ?>"
                                                <?php
                                                    if (set_value('expense_id') == $expense['id']) {
                                                        echo "selected = selected";
                                                    }
                                                ?>>
                                                <?php echo $expense['name'] ?>
                                            </option>
                                            <?php $count++; } ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" id="add_incomebtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
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
                <h4 class="modal-title"><?php echo $this->lang->line('edit_income'); ?></h4>
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="edit_data">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="myModalIncome_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('edit_income'); ?></h4>
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="income_payment_data">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('#date').datepicker({

            format: date_format,
            endDate: '+0d',
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
     function delete_record(id) {
            if (confirm('<?php echo $this->lang->line('delete_confirm') ?>')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/income/delete/' + id,
                    success: function (res) {
                        successMsg('<?php echo $this->lang->line('delete_message'); ?>');
                        window.location.reload(true);
                    },
                    error: function () {
                        alert("Fail")
                    }
                });
        }
    }   
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });

    $(document).ready(function (e) {
        $("#add_income").on('submit', (function (e) {
            $("#add_incomebtn").button('loading');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/income/add',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        $('.ajaxlist').DataTable().ajax.reload();                        
                        $('#myModal').modal('hide');
                        window.location.reload(true);
                    }
                    $("#add_incomebtn").button('reset');
                },
                error: function () {
                    alert("Fail")
                }
            });
        }));
    });

    function edit(id) {
        $('#myModaledit').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/income/getDataByid/' + id,
            success: function (data) {
                $('#edit_data').html(data);
            },
            error: function () {
                alert("Fail")
            }
        });
    }

    function income_payment(id) {
        $('#myModalIncome_payment').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/income/getDataByForIncomePayment/' + id,
            success: function (data) {
                $('#income_payment_data').html(data);
            },
            error: function () {
                alert("Fail")
            }
        });
    }

 $('#myModal').on('hidden.bs.modal', function () {
      $(".filestyle").next(".dropify-clear").trigger("click");
    $('form#add_income').find('input:text, input:password, input:file, textarea').val('');
    $('form#add_income').find('select option:selected').removeAttr('selected');
    $('form#add_income').find('input:checkbox, input:radio').removeAttr('checked');
});

    $(document).ready(function (e) {
        $('#myModal,#myModaledit,#myModalIncome_payment').modal({
        backdrop: 'static',
        keyboard: false,
        show:false
        });
    });
    function initDatatable2(_selector, _url, params = {}, rm_export_btn = [], pageLength = 100, aoColumnDefs = [{
        "bSortable": false,
        "aTargets": [5],
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
                if (data == 'CUENTA POR COBRAR') { $(td).css('background-color', '#eaee6a'); }
                if (data == 'PAGADO PARCIALMENTE') { $(td).css('background-color', '#f0bf62'); }
                // if (data == 'ENVIADO') { $(td).css('background-color', '#aff062'); }
                if (data == 'PAGADO COMPLETO') { $(td).css('background-color', '#62f0f0'); }
                if (data == '') { $(td).css('background-color', 'rgb(217, 225, 235)'); }
            });
        });
    }
</script>

<!-- //========datatable start===== -->
<script type="text/javascript">
( function ( $ ) {
    'use strict';
    $(document).ready(function () {
        initDatatable2('ajaxlist','admin/income/getDatatable',[],[],100);
    });
} ( jQuery ) )
</script>
<!-- //========datatable end===== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('recent_purchasing_process'); ?></h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('issue_item', 'can_add')) { ?>
                                <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm addissueitem"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_issue_item'); ?></a>
                            <?php } ?>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php $logUser = $this->customlib->getLoggedInUserData(); ?>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('issue_item_list'); ?></div>
                            <table class="table table-hover table-striped table-bordered ajaxlist" data-export-title="<?php echo $this->lang->line('issue_item_list'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('suplidores'); ?></th>
                                        <th><?php echo $this->lang->line('received_by'); ?></th>
                                        <th><?php echo $this->lang->line('note_compra'); ?></th>
                                        <!-- <th><?php echo $this->lang->line('status'); ?></th> -->
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (right) -->
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<style>
    .section-title {
        /* font-size: 1.1rem; */
        color: #3498db;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .products-section {
        /* background-color: #fff9f0; */
        padding: 10px;
        /* padding: 20px; */
        border-radius: 8px;
        border-left: 4px solid #f39c12;
        margin-top: 10px;
    }

    .btn-add {
        background-color: #2ecc71;
        border-color: #2ecc71;
        font-weight: 500;
    }
</style>

<div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirm_return'); ?></h4>
            </div>
            <div class="modal-body">
                <form id="form2" action="<?php echo base_url() ?>admin/issueitem/returnItem" name="item_issue_form" method="post" accept-charset="utf-8">
                    <?php echo $this->customlib->getCSRF(); ?>
                    <input type="hidden" id="item_issue_id" name="item_issue_id" value="">
                    <input type="hidden" id="item_issue_quantity" name="item_issue_quantity" value="">
                    <input type="hidden" id="item_issue_sku" name="item_issue_sku" value="">
                    <p><?php echo $this->lang->line('are_you_sure_to_return_this_item'); ?></p>

                    <ul class="list2" style="display: none;">
                        <li><?php echo $this->lang->line('item'); ?>:<span id="modal_item"></span></li>
                        <li><?php echo $this->lang->line('item_category'); ?>:<span id="modal_item_cat"></span></li>
                        <li><?php echo $this->lang->line('quantity'); ?>:<span id="modal_item_quantity"></span></li>
                        <li><?php echo $this->lang->line('item_store'); ?>:<span id="modal_item_store"></span></li>
                    </ul>
                    <style>
                        .item-card {
                            background-color: #fffaf3;
                            border-radius: 10px;
                            border-left: 5px solid #fd7e14;
                            padding: 20px;
                            margin-bottom: 25px;
                            box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.05);
                        }

                        .item-detail {
                            margin-bottom: 8px;
                            display: flex;
                        }

                        .detail-label {
                            font-weight: 600;
                            color: #5a5a5a;
                            min-width: 160px;
                        }

                        .quantity-input {
                            max-width: 120px;
                            border: 1px solid #fd7e14;
                            border-radius: 5px;
                            padding: 5px 10px;
                        }

                        .note-section {
                            background-color: #f8f9fa;
                            border-radius: 8px;
                            padding: 15px;
                            margin-top: 15px;
                            border-left: 3px solid #6c5ce7;
                        }

                        .btn-container {
                            display: flex;
                            justify-content: center;
                            gap: 15px;
                            margin-top: 30px;
                        }

                        .btn-confirm {
                            background: linear-gradient(135deg, #6c5ce7, #8e44ad);
                            border: none;
                            padding: 10px 25px;
                            font-weight: 600;
                        }

                        .section-divider {
                            height: 2px;
                            background: linear-gradient(to right, transparent, #fd7e14, transparent);
                            margin: 25px 0;
                        }
                    </style>

                    <div class="confirmation-body">
                        <div id="div_dinamico">

                        </div>
                        <div class="section-divider"></div>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button> -->
                        <!-- <button type="submit" id="form2btn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('return'); ?></button> -->

                        <div class="btn-container">
                            <button type="button" class="btn btn-default text-white" data-dismiss="modal">
                                <i class="fas fa-times-circle me-2"></i><?php echo $this->lang->line('cancel'); ?>
                            </button>
                            <button type="submit" id="form2btn" class="btn btn-confirm text-white" data-loading-text="<?php echo $this->lang->line('processing'); ?>">
                                <i class="fas fa-check-circle me-2"></i><?php echo $this->lang->line('confirm_return'); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn cfees btn-ok" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('return'); ?>"><?php echo $this->lang->line('return'); ?></a>
            </div> -->

        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirm_return'); ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="item_issue_id" name="item_issue_id" value="">
                <input type="hidden" id="item_issue_quantity" name="item_issue_quantity" value="">
                <input type="hidden" id="item_issue_sku" name="item_issue_sku" value="">
                <p><?php echo $this->lang->line('are_you_sure_to_return_this_item'); ?></p>
                <ul class="list2">
                    <li><?php echo $this->lang->line('item'); ?><span id="modal_item"></span></li>
                    <li><?php echo $this->lang->line('item_category'); ?><span id="modal_item_cat"></span></li>
                    <li><?php echo $this->lang->line('quantity'); ?><span id="modal_item_quantity"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn cfees btn-ok" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('return'); ?>"><?php echo $this->lang->line('return'); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="follow_up">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_purchasing_process'); ?></h4>
            </div>
            <div class="scroll-area">
                <div class="modal-body pt0 pb0">
                    <div class="row ptt10">

                        <form id="form1" action="<?php echo base_url() ?>admin/itempurchasingprocess/add" name="itemstockform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <!-- <input type="hidden" id="sku" name="sku" /> -->
                            <!-- <input type="hidden" id="item_id_id" name="item_id_id" /> -->
                            <!-- <input type="hidden" id="item_name_api" name="item_name_api" /> -->
                            <!-- <input type="hidden" id="sku" name="sku" /> -->
                            <!-- <input type="hidden" id="quantity_product" name="quantity_product" /> -->
                            <div class="form-group">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('suplidores'); ?></label><small class="req"> *</small>
                                    <select name="suplidores" id="suplidores" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($itemSuplidores as $key => $value) {
                                        ?>
                                            <option value='<?php echo json_encode(array("id"=> $value['id'],"name"=>$value['name'])); ?>'><?php echo $value['name'] ?></option>
                                            <!-- <?php echo $value['name']; ?> -->
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('suplidores'); ?></span>
                                </div>
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail2"><?php echo $this->lang->line('purchasing_process'); ?></label><small class="req"> *</small>
                                    <input id="purchasing_process" name="purchasing_process" placeholder="00000000" type="text" class="form-control" value="<?php echo set_value('purchasing_process'); ?>" />
                                    <span class="text-danger"><?php echo form_error('purchasing_process'); ?></span>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <label for="exampleInputEmail3"><?php echo $this->lang->line('note_compra'); ?></label>
                                    <textarea name="note" class="form-control" id="note" ><?php echo set_value('note'); ?></textarea>
                                    <span class="text-danger"><?php echo form_error('note'); ?></span>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="pull-left">
                                        <button type="button" id="button" onclick="get_details_compra()" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                            <?php echo $this->lang->line('search'); ?>
                                        </button>
                                    </div>
                                </div>

                                <!-- <div class="clearfix"></div> -->
                                <!-- <hr> -->

                                <div class="col-md-12">
                                    <div id="div_id" class="">
                                        <h5 class="section-title">Detalles de la orden</h5>
                                    </div>
                                    <br />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right">
                                    <button type="submit" id="form1btn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- -->
<div class="modal fade" id="prescriptionview_medicamentos" role="dialog" aria-labelledby="follow_up">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close sss" data-dismiss="modal">&times;</button>
                <div class="modalicon">
                    <a class="pull-right" href="#" onclick="print_medicamentos_print('3')" data-toggle="tooltip" title="<?php echo $this->lang->line('historial'); ?>">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
                <h4 class="modal-title" id="prescription_title_medicamento"><?php echo $this->lang->line('prescription'); ?>

                </h4>
            </div>
            <div class="modal-body pt0 pb0" id="getdetails_prescription_medicamentos">

            </div>
        </div>
    </div>
</div>
<!-- -->

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
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#confirm-update').on('show.bs.modal', function(e) {
            var item_issue_id = $(e.relatedTarget).data('item');

            var div_data = '';
            $('#div_dinamico').html("");
            $.ajax({
                type: "GET",
                url: base_url + "admin/issueitem/get_item_issue_details",
                data: {
                    'item_issue_id': item_issue_id
                },
                dataType: "json",
                success: function(data) {
                    $.each(data['details'], function(i, obj) {
                        div_data += "<div class='item-card'> <div> <input type='hidden' name='item_issue_id[]' value='" + obj.item_issue_id + "' /> <input type='hidden' name='item_issue_sku[]' value='" + obj.sku + "' /> </div> <div class='item-title'> </i>Artículo #" + (i + 1) + " </div> <div class='item-detail'> <span class='detail-label'><?php echo $this->lang->line('item'); ?>:</span> <span>" + obj.item_name_api + "</span> </div> <div class='item-detail'> <span class='detail-label'><?php echo $this->lang->line('item_category'); ?>:</span> <span>" + obj.item_category_name + "</span> </div> <div class='item-detail'> <span class='detail-label'><?php echo $this->lang->line('quantity'); ?>:</span> <span>" + obj.existencia + "</span> </div> <div class='item-detail'> <span class='detail-label'>Cantidad a devolver:</span> <input name='item_issue_quantity[]' class='quantity-input' type='number' max='" + obj.existencia + "'> </div> <div class='note-section'> <div class='item-detail'> <span class='detail-label'>Nota de la devolución:</span> <textarea name='note_issue[]' class='form-control'> </textarea> </div> </div> </div>";
                    });
                    $("#div_dinamico").append(div_data);
                }
            });
        });

        $("#confirm-update").modal({
            backdrop: false,
            show: false
        });

        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('.date').datepicker({
            format: date_format,
            autoclose: true
        });
    });

    var base_url = '<?php echo base_url() ?>';

    $(document).on('click', '.btn-ok', function() {
        var $this = $('.btn-ok');
        $this.button('loading');
        var item_issue_id = $('#item_issue_id').val();
        var item_issue_quantity = $('#item_issue_quantity').val();
        var item_issue_sku = $('#item_issue_sku').val();

        $.ajax({
            url: "<?php echo site_url('admin/issueitem/returnItem') ?>",
            type: "POST",
            data: {
                'item_issue_id': item_issue_id,
                'quantity': item_issue_quantity,
                'sku': item_issue_sku
            },
            dataType: 'Json',
            success: function(data, textStatus, jqXHR) {
                if (data.status == "fail") {

                    errorMsg(data.message);
                } else {
                    successMsg(data.message);

                    $("#confirm-delete").modal('hide');
                    location.reload();
                }

                $this.button('reset');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $this.button('reset');
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
        var item = 0;

        $('#form1').on('submit', (function(e) {
            $("#form1btn").button('loading');
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
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
                        console.log('error');
                        $("#form1btn").button('reset');
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function() {
                    alert("Fail")
                }
            });
        }));

        $('#form2').on('submit', (function(e) {
            $("#form1btn").button('loading');
            e.preventDefault();
            console.log($(this).attr('action'), 'klk');
            $.ajax({
                url: $(this).attr('action'),
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
                        console.log('error');
                        $("#form2btn").button('reset');
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function() {
                    alert("Fail")
                }
            });
        }));

        // cambio nuevo
        $(document).on('click', '.add-record', function() {
            console.log(784);
            item++;
            var div = "<div class='products-section'><div class='row'><div class='form-group col-md-4'><label for='exampleInputEmail4'"+item+"><?php echo $this->lang->line('item_category'); ?></label><small class='req'> *</small><select id='item_category_id" + item + "' name='item_category_id[]' class='form-control item_category_id'><option value=''><?php echo $this->lang->line('select'); ?></option><?php foreach ($itemcatlist as $item_category) { ?><option value='<?php echo $item_category['id'] ?>' <?php if (set_value('item_category_id') == $item_category['id']) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo 'selected = selected';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>><?php echo $item_category['name'] ?></option><?php } ?></select><span class='text-danger'><?php echo form_error('item_category_id'); ?></span></div><div class='form-group col-md-5'><label for='exampleInputEmail5"+item+"'><?php echo $this->lang->line('item'); ?></label><small class='req'> *</small><select id='item_id" + item + "' name='item_id_[]' class='form-control item-select' data-id='" + item + "'><option value=''><?php echo $this->lang->line('select'); ?></option></select><span class='text-danger'><?php echo form_error('item_id'); ?></span></div><div style='display:none;'class='form-group col-md-3'><label for='exampleInputEmail6"+item+"'><?php echo $this->lang->line('store'); ?></label><small class='req'> *</small><select id='item_store_id' name='item_store_id[]' class='form-control'><option value=''><?php echo $this->lang->line('select'); ?></option><?php foreach ($itemstorelist as $item) { ?><option value='<?php echo $item['id'] ?>' <?php if (set_value('item_store_id') == $item['id']) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo 'selected = selected';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>><?php echo $item['item_store'] ?></option><?php } ?></select><span class='text-danger'><?php echo form_error('item_store_id'); ?></span></div><div class='form-group col-md-3'><label for='exampleInputEmail7"+item+"'><?php echo $this->lang->line('quantity'); ?></label><small class='req'> *</small><input class='form-control' name='quantity[]' /><div id='div_avail" + item + "'><span><?php echo $this->lang->line('available_quantity'); ?> : </span><span id='item_available_quantity" + item + "'>0</span></div></div></div></div>";
            $('#div_id').append(div);
        });
        // 
    });

    var base_url = '<?php echo base_url() ?>';

    function get_details_compra() {
        let vendor_json = $('#suplidores').val();
        let vendor_id = JSON.parse(vendor_json);
        vendor_id = vendor_id.id;
        // console.log(text.id)
        let order_number = $('#purchasing_process').val();

        var div_data = "";
        $.ajax({
            type: "GET",
            url: base_url + "admin/itempurchasingprocess/get_details_compra",
            data: {
                'vendor_id': vendor_id,
                'order_number': order_number
            },
            dataType: "json",
            success: function(data) {
                // let obj_ = JSON.stringify(data);
                let _data = data.data;
                console.log(_data, 'prueba:');
                let item;

                $.each(_data.products, function(i, obj) {
                    console.log(obj.name, 'prueba:');
                    item = i;
                    var div = "<div class='products-section'> <div class='row'> <div class='form-group col-md-6'> <label for='exampleInputEmail"+item+"'><?php echo $this->lang->line('item'); ?></label> <input class='form-control' value='" + obj.name + "' disabled /> </div> <div class='form-group col-md-2'> <label for='exampleInputEmail9"+item+"'><?php echo $this->lang->line('quantity'); ?></label> <input class='form-control' value='" + obj.quantity + "' disabled  /> </div> <div class='form-group col-md-2'> <label for='exampleInputEmail10"+item+"'><?php echo $this->lang->line('unit'); ?></label> <input class='form-control' value='" + obj.unit + "' disabled  /> </div> <div class='form-group col-md-2'> <label for='exampleInputEmail11"+item+"'><?php echo $this->lang->line('received_quantity'); ?></label> <input class='form-control' type='number' min='0' name='received_quantity[]' /> <input type='hidden' name='received_sku[]' value='" + obj.sku + "' /> <input type='hidden' name='received_unit[]' value='" + obj.unit+ "' /> <input type='hidden' name='received_name[]' value='" + obj.name + "' /> </div> </div> </div>";
                    $('#div_id').append(div);
                });
            }
        });
    }

    function popup(data, print = false) {
        var base_url = base_url;
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({
            "position": "absolute",
            "top": "-1000000px"
        });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function() {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
            if (print) {
                window.location.reload(true);
            }
        }, 500);
        return true;
    }

      function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function print_record(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/itempurchasingprocess/get_print/' + id,
            success: function(res) {
                let data = JSON.parse(res);
                popup(data.page);
            },
            error: function() {
                alert("Fail")
            }
        });
    }
    /*

      function print_medicamentos(ipd_id) {
        $('#prescription_title_medicamento').html('');

        $.ajax({
            url: base_url + 'admin/prescription/print_medicamentos',
            dataType: 'JSON',
            data: {
                'ipd_id': ipd_id,
                'id': 1
            },
            type: "GET",
            beforeSend: function() {},
            success: function(res) {
                console.log(7445, res.page);
                holdModal('prescriptionview_medicamentos');
                $("#getdetails_prescription_medicamentos").html(res.page);
            },

            complete: function() {
                $("#compose-textareass,.compose-textareas").wysihtml5({
                    toolbar: {
                        "image": false,
                    }
                });
            },
            error: function(xhr) { // if error occured
                alert("");
            }
        });

    }
    */

    function delete_record(id) {
        if (confirm('<?php echo $this->lang->line('delete_confirm') ?>')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/itempurchasingprocess/delete/' + id,
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

    $(".addissueitem").click(function() {
        $('#form1').trigger("reset");
        $('#issue_to').val("");

        let valor_clase = 0;

        $('#div_avail' + valor_clase).hide();
        $('#item_available_quantity' + valor_clase).html("");

    });

    $(document).ready(function(e) {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    });
</script>
<!-- //========datatable start===== -->
<script type="text/javascript">
    (function($) {
        'use strict';
        $(document).ready(function() {
            initDatatable('ajaxlist', 'admin/itempurchasingprocess/getissueitemdatatable');
        });
    }(jQuery))
</script>
<!-- //========datatable end===== -->
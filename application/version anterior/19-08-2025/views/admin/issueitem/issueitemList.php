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
                        <h3 class="box-title"><?php echo $this->lang->line('issue_item_list'); ?></h3>
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
                                        <!-- <th><?php echo $this->lang->line('item'); ?></th> -->
                                        <th><?php echo $this->lang->line('store'); ?></th>
                                        <!-- <th><?php echo $this->lang->line('item_category'); ?></th> -->
                                        <th><?php echo $this->lang->line('issue_return'); ?></th>
                                        <th><?php echo $this->lang->line('issue_to'); ?></th>
                                        <th><?php echo $this->lang->line('issued_by'); ?></th>
                                        <!-- <th><?php echo $this->lang->line('quantity'); ?></th> -->
                                        <th><?php echo $this->lang->line('status'); ?></th>
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

                    <div id="div_dinamico">

                    </div>
                    <div class="modal-footer">
                        <!-- <div class="pull-right"> -->
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                        <button type="submit" id="form2btn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('return'); ?></button>
                        <!-- </div> -->
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
                <h4 class="modal-title"><?php echo $this->lang->line('add_issue_item'); ?></h4>
            </div>
            <div class="scroll-area">
                <div class="modal-body pt0 pb0">
                    <div class="row ptt10">

                        <form id="form1" action="<?php echo base_url() ?>admin/issueitem/add" name="itemstockform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <!-- <input type="hidden" id="sku" name="sku" /> -->
                            <!-- <input type="hidden" id="item_id_id" name="item_id_id" /> -->
                            <!-- <input type="hidden" id="item_name_api" name="item_name_api" /> -->
                            <!-- <input type="hidden" id="sku" name="sku" /> -->
                            <!-- <input type="hidden" id="quantity_product" name="quantity_product" /> -->
                            <div class="form-group">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('user_type'); ?></label><small class="req"> *</small>
                                    <select name="account_type" onchange="getIssueUser(this.value)" id="" class="form-control ac_type">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($roles as $role_key => $role_value) {
                                        ?>
                                            <option value="<?php echo $role_value['id']; ?>"><?php echo $role_value['name'] ?></option>
                                            <?php echo $role_value['name']; ?>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('Items'); ?></span>
                                </div>
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('issue_to'); ?></label><small class="req"> *</small>
                                    <select id="issue_to" name="issue_to" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('Items'); ?></span>
                                </div>
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('issued_by'); ?></label><small class="req"> *</small>
                                    <input id="issue_by" name="issue_by" placeholder="" type="text" class="form-control" value="<?php echo $logUser['username']; ?>" />
                                    <span class="text-danger"><?php echo form_error('issue_by'); ?></span>
                                </div>
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('issue_date'); ?></label><small class="req"> *</small>
                                    <input id="issue_date" name="issue_date" placeholder="" type="text" class="form-control date" value="<?php echo set_value('issue_date'); ?>" readonly />
                                    <span class="text-danger"><?php echo form_error('issue_date'); ?></span>
                                </div>
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('return_date'); ?></label>
                                    <input id="return_date" name="return_date" placeholder="" type="text" class="form-control date" value="<?php echo set_value('return_date'); ?>" readonly />
                                    <span class="text-danger"><?php echo form_error('return_date'); ?></span>
                                </div>
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
                                    <textarea name="note" class="form-control" id="note" /><?php echo set_value('note'); ?></textarea>
                                    <span class="text-danger"><?php echo form_error('note'); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <hr>

                                <div class="col-md-12">
                                    <div id="div_id" class="row">
                                        <h5 class="section-title">Detalles del producto</h5>

                                        <div class="products-section add_div">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item_category'); ?></label><small class="req"> *</small>

                                                    <select id="item_category_id" name="item_category_id[]" class="form-control item_category_id">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php
                                                        foreach ($itemcatlist as $item_category) {
                                                        ?>
                                                            <option value="<?php echo $item_category['id'] ?>" <?php
                                                                                                                if (set_value('item_category_id') == $item_category['id']) {
                                                                                                                    echo "selected = selected";
                                                                                                                }
                                                                                                                ?>><?php echo $item_category['name'] ?></option>

                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item'); ?></label><small class="req"> *</small>
                                                    <select id="item_id" name="item_id_[]" class="form-control item-select" data-id="0">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('item_id'); ?></span>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('store'); ?></label><small class="req"> *</small>
                                                    <select id="item_store_id" name="item_store_id[]" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php
                                                        foreach ($itemstorelist as $item) {
                                                        ?>
                                                            <option value="<?php echo $item['id'] ?>" <?php
                                                                                                        if (set_value('item_store_id') == $item['id']) {
                                                                                                            echo "selected = selected";
                                                                                                        }
                                                                                                        ?>><?php echo $item['item_store'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('item_store_id'); ?></span>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('quantity'); ?></label><small class="req"> *</small>
                                                    <input class="form-control" type="number" name="quantity[]" />
                                                    <div id="div_avail0" class="div_avail0">
                                                        <span><?php echo $this->lang->line('available_quantity'); ?> : </span>
                                                        <span id="item_available_quantity0" class="item_available_quantity0">0</span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                    <br />
                                    <div class="col-md-12">
                                        <a class="btn btn-primary btn-add add-record addplus-xs" data-added="0"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_product'); ?></a>
                                        <hr>
                                    </div>
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
        // $('#confirm-delete').on('show.bs.modal', function(e) {
        //     $('#item_issue_id').val("");
        //     $('.debug-url').html('');
        //     $('#modal_item_quantity,#modal_item,#modal_item_cat').text("");
        //     var item_issue_id = $(e.relatedTarget).data('item');
        //     var item_category = $(e.relatedTarget).data('category');
        //     var quantity = $(e.relatedTarget).data('quantity');
        //     var item_name = $(e.relatedTarget).data('item_name');
        //     var sku = $(e.relatedTarget).data('sku');
        //     $('#item_issue_id').val(item_issue_id);
        //     $('#item_issue_quantity').val(quantity);
        //     $('#item_issue_sku').val(sku);
        //     $('#modal_item_cat').text(item_category);
        //     $('#modal_item').text(item_name);
        //     $('#modal_item_quantity').text(quantity);
        // });

        $('#confirm-update').on('show.bs.modal', function(e) {
            // $('#item_issue_id').val("");
            // $('.debug-url').html('');
            // $('#modal_item_quantity,#modal_item,#modal_item_cat').text("");
            var item_issue_id = $(e.relatedTarget).data('item');
            // var item_category = $(e.relatedTarget).data('category');
            // var quantity = $(e.relatedTarget).data('quantity');
            // var item_name = $(e.relatedTarget).data('item_name');
            // var sku = $(e.relatedTarget).data('sku');
            // $('#item_issue_id').val(item_issue_id);
            // $('#item_issue_quantity').val(quantity);
            // $('#item_issue_sku').val(sku);
            // $('#modal_item_cat').text(item_category);
            // $('#modal_item').text(item_name);
            // $('#modal_item_quantity').text(quantity);

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
                        console.log(i,data['details']);
                        // var select = "";
                        // if (item_id_post == obj.id) {
                        //     var select = "selected=selected";
                        // }
                        // obj_ = JSON.stringify(obj);
                        // div_data += "<option value='" + obj_ + "'>" + obj.name + "</option>";
                        div_data += "<ul class='list2'> <li> <input type='hidden' name='item_issue_id[]' value='"+obj.item_issue_id+"'/> <input type='hidden' name='item_issue_sku[]' value='"+obj.sku+"'/> </li><li><?php echo $this->lang->line('item'); ?>:<span id='modal_item'>" + obj.item_name_api + "</span></li><li><?php echo $this->lang->line('item_category'); ?>:<span id='modal_item_cat'>" + obj.item_category_name + "</span></li><li><?php echo $this->lang->line('quantity'); ?>:<span id='modal_item_quantity'>" + obj.existencia + "</span></li><li><?php echo $this->lang->line('item_store'); ?>:<span id='modal_item_store'>" + obj.item_store_name + "</span></li><li> <span >Cantidad a devolver:</span> <input name='item_issue_quantity[]' class='form-control' type='number' max='"+obj.existencia+"'  > </li> <li> <span >Nota de la devolver:</span> <textarea name='note_issue[]' class='form-control' > </textarea> </li> </ul> <br/>";
                    });
                    // console.log('quepaso,',div_data);
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
    // $(document).on('change', '#item_category_id', function(e) {

    //     var item_category_id = $(this).val();
    //     populateItem(0, item_category_id);
    // });

    $(document).on('change', '.item_category_id', function(e) {
        var item_category_id = $(this).val();
        var itemSelect = $(this).closest('.row').find('.item-select');
        // console.log(7842,item_category_id,itemSelect[0].id);
        populateItem(0, item_category_id, itemSelect[0].id);
    });


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
            var div = "<div class='products-section'><div class='row'><div class='form-group col-md-4'><label for='exampleInputEmail1'><?php echo $this->lang->line('item_category'); ?></label><small class='req'> *</small><select id='item_category_id" + item + "' name='item_category_id[]' class='form-control item_category_id'><option value=''><?php echo $this->lang->line('select'); ?></option><?php foreach ($itemcatlist as $item_category) { ?><option value='<?php echo $item_category['id'] ?>' <?php if (set_value('item_category_id') == $item_category['id']) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo 'selected = selected';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>><?php echo $item_category['name'] ?></option><?php } ?></select><span class='text-danger'><?php echo form_error('item_category_id'); ?></span></div><div class='form-group col-md-5'><label for='exampleInputEmail1'><?php echo $this->lang->line('item'); ?></label><small class='req'> *</small><select id='item_id" + item + "' name='item_id_[]' class='form-control item-select' data-id='" + item + "'><option value=''><?php echo $this->lang->line('select'); ?></option></select><span class='text-danger'><?php echo form_error('item_id'); ?></span></div><div class='form-group col-md-3'><label for='exampleInputEmail1'><?php echo $this->lang->line('store'); ?></label><small class='req'> *</small><select id='item_store_id' name='item_store_id[]' class='form-control'><option value=''><?php echo $this->lang->line('select'); ?></option><?php foreach ($itemstorelist as $item) { ?><option value='<?php echo $item['id'] ?>' <?php if (set_value('item_store_id') == $item['id']) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo 'selected = selected';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>><?php echo $item['item_store'] ?></option><?php } ?></select><span class='text-danger'><?php echo form_error('item_store_id'); ?></span></div><div class='form-group col-md-4'><label for='exampleInputEmail1'><?php echo $this->lang->line('quantity'); ?></label><small class='req'> *</small><input class='form-control' name='quantity[]' /><div id='div_avail" + item + "'><span><?php echo $this->lang->line('available_quantity'); ?> : </span><span id='item_available_quantity" + item + "'>0</span></div></div></div></div>";

            $('#div_id').append(div);
        });
        // 
    });

    var base_url = '<?php echo base_url() ?>';

    function populateItem(item_id_post, item_category_id_post, id_element) {
        if (item_category_id_post != "") {
            $("#" + id_element).html("");
            // $('#item_id').html("");
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            var obj_ = '';
            $.ajax({
                type: "GET",
                url: base_url + "admin/issueitem/getItemByCategory",
                data: {
                    'item_category_id': item_category_id_post
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        console.log(data);
                        var select = "";
                        if (item_id_post == obj.id) {
                            var select = "selected=selected";
                        }
                        obj_ = JSON.stringify(obj);
                        div_data += "<option value='" + obj_ + "'>" + obj.name + "</option>";
                    });
                    $("#" + id_element).append(div_data);
                }
            });
        }
    }

    $(document).on('change', '.item-select', function(e) {
        var valor_clase = $(this).data('id');

        $('#div_avail' + valor_clase).hide();
        $('#item_available_quantity' + valor_clase).html("");

        // const itemSelect = $(this).closest('.row').find('.item-select');        

        let item = JSON.parse($(this).val());
        console.log(valor_clase);

        // $('#sku').val(item.sku);
        // $('#item_id_id').val(item.id);
        // $('#item_name_api').val(item.name);
        // $('#sku').val(item.sku);
        // $('#quantity_product').val(item.quantity);

        $('#item_available_quantity' + valor_clase).html(item.quantity);

        $('#div_avail' + valor_clase).show();
    });

    function availableQuantity(item_id) {
        if (item_id != "") {
            $('#item_available_quantity').html("");
            var div_data = '';
            $.ajax({
                type: "GET",
                url: base_url + "admin/item/getAvailQuantity",
                data: {
                    'item_id': item_id
                },
                dataType: "json",
                success: function(data) {

                    $('#item_available_quantity').html(data.available);
                    $('#div_avail').show();
                }
            });
        }
    }

    $("input[name=account_type]:radio").change(function() {
        var user = $('input[name=account_type]:checked').val();
        getIssueUser(user);
    });

    function getIssueUser(usertype) {
        $('#issue_to').html("");
        var div_data = "";
        $.ajax({
            type: "POST",
            url: base_url + "admin/issueitem/getUser",
            data: {
                'usertype': usertype
            },
            dataType: "json",
            success: function(data) {

                $.each(data.result, function(i, obj) {
                    if (data.usertype == "admin") {
                        name = obj.username;
                    } else {
                        name = obj.name + " " + obj.surname;
                    }
                    div_data += "<option value=" + obj.id + ">" + name + " (" + obj.employee_id + ")</option>";
                });
                $('#issue_to').append(div_data);
            }
        });
    }

    function delete_record(id) {
        if (confirm('<?php echo $this->lang->line('delete_confirm') ?>')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/issueitem/delete/' + id,
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
            initDatatable('ajaxlist', 'admin/issueitem/getissueitemdatatable');
        });
    }(jQuery))
</script>
<!-- //========datatable end===== -->
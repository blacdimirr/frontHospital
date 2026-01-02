<?php $currency_symbol = $this->customlib->getHospitalCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('item', 'can_view')) {
            ?>

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"> <?php echo $this->lang->line('item_list'); ?></h3>
                            <div class="box-tools pull-right">
                                <?php if ($this->rbac->hasPrivilege('item', 'can_add')) { ?>
                                    <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm additem"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_item'); ?></a>
                                <?php } ?>

                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive mailbox-messages">
                                <div class="download_label"><?php echo $this->lang->line('item_list'); ?></div>
                                <table class="table table-hover table-striped table-bordered ajaxlist" data-export-title="<?php echo $this->lang->line('item_list'); ?>">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('item'); ?></th>
                                            <th><?php echo $this->lang->line('category'); ?>
                                            </th>
                                            <th><?php echo $this->lang->line('unit'); ?>
                                            </th>
                                            <th><?php echo $this->lang->line('available_quantity'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('description'); ?>
                                            </th>
                                            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
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
            <?php
            }
            ?>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="follow_up">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_item') ?></h4>
            </div>
            <div class="scroll-area">
                <div class="modal-body pt0 pb0">
                    <div class="row ptt10">
                        <form id="form1" action="<?php echo base_url() ?>admin/item/add" id="itemstockform" name="itemstockform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <input type="hidden" name="name_select" id="name_select" />
                            <input type="hidden" name="quantity" id="quantity_select" />

                            <!-- Codigo formulario anterior -->
                            <div class="col-md-12" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item_category'); ?></label><small class="req"> *</small>
                                    <select id="item_category_id" name="item_category_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($itemcatlist as $item_category) {
                                        ?>
                                            <option value="<?php echo $item_category['id'] ?>" <?php
                                                                                                if (set_value('item_category_id') == $item_category['id']) {
                                                                                                    echo "selected = selected";
                                                                                                }
                                                                                                ?>><?php echo $item_category['item_category'] ?></option>

                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('unit'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="unit" name="unit" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('unit'); ?></span>
                                </div>
                            </div>

                            <!-- Codigo formulario anterior -->
                            <!-- codigo nuevo -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item'); ?></label><small class="req"> *</small>
                                    <select id="item_id" name="item_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($inventario_productos as $item) {
                                        ?>
                                            <option value='<?php echo json_encode($item); ?>' <?php
                                                                                                if (set_value('item_id') == $item['id']) {
                                                                                                    echo "selected = selected";
                                                                                                }
                                                                                                ?>><?php echo $item['name'] ?></option>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_id'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('categorie'); ?></label>
                                    <input id="categorie_product" name="categorie_product" type="text" class="form-control" value="<?php echo set_value('categorie_product'); ?>" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('unit'); ?></label>
                                    <input id="unit_product" name="unit_product" type="text" class="form-control" value="<?php echo set_value('unit_product'); ?>" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('available_quantity'); ?></label>
                                    <input id="quantity_product" name="quantity_product" type="text" class="form-control" value="<?php echo set_value('unit_product'); ?>" disabled />
                                </div>
                            </div>
                            <!-- codigo nuevo -->

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder=""><?php echo set_value('description'); ?></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer clear">
                <div class="pull-right">
                    <button type="submit" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editmyModal" tabindex="-1" role="dialog" aria-labelledby="follow_up">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('edit_item'); ?></h4>
            </div>
            <div class="scroll-area">
                <div class="modal-body pt0 pb0">
                    <div class="row ptt10">
                        <form id="eform1" action="<?php echo base_url() ?>admin/item/edit" id="itemstockform" name="itemstockform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-md-12" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="ename" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item_category'); ?></label><small class="req"> *</small>
                                    <select id="eitem_category_id" name="item_category_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($itemcatlist as $item_category) {
                                        ?>
                                            <option value="<?php echo $item_category['id'] ?>" <?php
                                                                                                if (set_value('item_category_id') == $item_category['id']) {
                                                                                                    echo "selected = selected";
                                                                                                }
                                                                                                ?>><?php echo $item_category['item_category'] ?></option>

                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('unit'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="eunit" name="unit" placeholder="" type="text" class="form-control" value="<?php echo set_value('unit'); ?>" />
                                    <span class="text-danger"><?php echo form_error('unit'); ?></span>
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item'); ?></label><small class="req"> *</small>
                                    <select id="eitem_id" name="item_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($inventario_productos as $item) {
                                        ?>
                                            <option value='<?php echo json_encode($item); ?>' <?php
                                                if (set_value('item_id') == $item['id']) {
                                                    echo "selected = selected";
                                                }
                                                ?>><?php echo $item['name'] ?></option>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_id'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('categorie'); ?></label>
                                    <input id="ecategorie_product" name="categorie_product" type="text" class="form-control" value="<?php echo set_value('categorie_product'); ?>" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('unit'); ?></label>
                                    <input id="eunit_product" name="unit_product" type="text" class="form-control" value="<?php echo set_value('unit_product'); ?>" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('available_quantity'); ?></label>
                                    <input id="equantity_product" name="quantity_product" type="text" class="form-control" value="<?php echo set_value('unit_product'); ?>" disabled />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="edescription" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                    <span class="text-danger"></span>
                                    <input type="hidden" name="id" id="e_id">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer clear">
                <div class="pull-right">
                    <button type="submit" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function() {
            $("#form1")[0].reset();
        });
    });
</script>
<script>
    // let inventario_productos = <?php echo json_encode($inventario_productos); ?>

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

    $(document).ready(function(e) {
        $('#item_id').on('change', function(e) {
            let text = $('#item_id option:selected').text();
            let item = JSON.parse($('#item_id').val());

            $('#name_select').val(text);
            $('#unit_product').val(item.unit.name);
            $('#categorie_product').val(item.category.name);
            $('#quantity_product').val(item.quantity);
        });

        $('#eitem_id').on('change', function(e) {
            let text = $('#eitem_id option:selected').text();
            let item = JSON.parse($('#eitem_id').val());

            $('#name_select').val(text);
            $('#eunit_product').val(item.unit.name);
            $('#ecategorie_product').val(item.category.name);
            $('#equantity_product').val(item.quantity);
        });

        $('#form1').on('submit', (function(e) {
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
                    } else {
                        // successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function() {}
            });
        }));
    });

    function get_data(id) {

        $.ajax({
            url: "<?php echo base_url() ?>admin/item/get_data/" + id,
            type: "POST",
            dataType: 'json',
            success: function(res) {
                console.log(res,45);
                $('#ename').val(res.name);
                $('#eunit').val(res.unit);
                $('#epurchase_price').val(res.purchase_price);
                $('#e_id').val(res.id);
                $('#eitem_category_id').val(res.item_category_id);
                $('#edescription').val(res.description);

                // 
                if (res.item_id_text){
                    $('#eitem_id').val(res.item_id_text).change();
                } else {
                    $('#eitem_id').val('');
                }
                // $('#equantity_product').val(res.quantity);
                $('#equantity_product').val(res.quantity);
                // 
                $('#editmyModal').modal('show');
            }
        });
    }

    $(document).ready(function(e) {
        $('#eform1').on('submit', (function(e) {
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
                    } else {

                        successMsg(data.message);
                        window.location.reload(true);
                    }

                },
                error: function() {}
            });
        }));
    });

    function delete_record(id) {
        if (confirm('<?php echo $this->lang->line('delete_confirm') ?>')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/item/delete/' + id,
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

    $(".additem").click(function() {
        $('#form1').trigger("reset");
    });

    $(document).ready(function(e) {
        $('#myModal,#editmyModal').modal({
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
            initDatatable('ajaxlist', 'admin/item/getitemdatatable');
        });
    }(jQuery))
</script>
<!-- //========datatable end===== -->
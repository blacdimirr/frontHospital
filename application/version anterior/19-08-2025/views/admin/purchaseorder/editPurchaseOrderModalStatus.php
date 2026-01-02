<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
?>
<form id="editexpense" class="ptt10" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="row">

        <?php if ($this->session->flashdata('msg')) { ?>
            <?php echo $this->session->flashdata('msg') ?>
        <?php } ?>
        <?php
        if (isset($error_message)) {
            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>
        <?php echo $this->customlib->getCSRF(); ?>
        
        <!-- <div class="col-sm-6"> -->
            <!-- <div class="form-group"> -->
                <!-- <label for="exampleInputEmail1"><?php echo $this->lang->line('status'); ?></label><small class="req"> *</small> -->
                <!-- <input id="name" name="name" readonly placeholder="" type="text" class="form-control" value="<?php echo set_value('name', $expense['name']); ?>" /> -->
                <input id="expense_id" type="hidden" class="form-control" value="<?php echo $expense['id']; ?>" />
            <!-- </div> -->
        <!-- </div> -->

        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label><?php echo $this->lang->line('status'); ?></label>
                <select class="form-control" name="search_type">
                    <option value=""><?php echo $this->lang->line('select') ?></option>
                    <option value="1">Pendiente</option>
                    <option value="2">Recibido</option>
                    <option value="3">Pagado</option>
                    <!-- <option value="">Pendiente</option> -->
                </select>
                <!-- <span class="text-danger"><?php echo form_error('search_type'); ?></span> -->
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('evidence'); ?></label>
                <input id="documents_other" name="documents_other" placeholder="" type="file" class="filestyle form-control" value="<?php echo set_value('documents_other'); ?>" />
            </div>
        </div>
    </div><!-- /.box-body -->
    <div class="row">
        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" data-loading-text="<?php echo $this->lang->line('processing'); ?>" id="editexpensebtn" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('.filestyle').dropify();
    });
    $(document).ready(function() {
        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('#editdate').datepicker({

            format: date_format,
            endDate: '+0d',
            autoclose: true
        });
    });
    $(document).ready(function(e) {
        $("#editexpense").on('submit', (function(e) {
            $("#editexpensebtn").button('loading');

            var id = $("#expense_id").val();

            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/purchaseorder/edit_status/' + id,
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
                    $("#editexpensebtn").button('reset');

                },
                error: function() {
                    alert("Fail")
                }
            });
        }));
    });
</script>
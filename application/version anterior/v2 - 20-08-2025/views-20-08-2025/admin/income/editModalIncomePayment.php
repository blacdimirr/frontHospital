
<?php $currency_symbol = $this->customlib->getHospitalCurrencyFormat();?>
<form  id="edit_incomedata" class="ptt10" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="row">
        <?php if ($this->session->flashdata('msg')) {?>
            <?php echo $this->session->flashdata('msg') ?>
        <?php }?>
        <?php
        if (isset($error_message)) {
            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>
        <?php echo $this->customlib->getCSRF(); ?>
        
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                <input id="name" name="name" readonly placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $income['name']); ?>" />
                <input id="income_id"
                       type="hidden" class="form-control"  value="<?php echo $income['id']; ?>" />
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('invoice_number'); ?></label>
                <input id="invoice_no" readonly name="invoice_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('invoice_no', $income['invoice_no']); ?>" />
                <span class="text-danger"><?php echo form_error('invoice_no'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                <input id="editdate" name="date" placeholder="" type="text" class="form-control"  />
                <span class="text-danger"><?php echo form_error('date'); ?></span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?><small class="req"> *</small></label>
                <input id="amount" name="amount" placeholder="" type="text" class="form-control"  />
                <span class="text-danger"><?php echo form_error('amount'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('income_type') ?><small class="req"> *</small></label>
                <!-- <input id="income_type" name="income_type" placeholder="" type="text" class="form-control"  /> -->
                <select autofocus="" id="income_type" name="income_type" class="form-control" >
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <option value="CASH"><?php echo $this->lang->line('CASH'); ?></option>
                    <option value="TRANSFER"><?php echo $this->lang->line('TRANSFER'); ?></option>
                    <option value="CHECK"><?php echo $this->lang->line('CHECK'); ?></option>
                    <option value="CARD"><?php echo $this->lang->line('CARD'); ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('income_type'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                <input id="documentsf" name="documents" placeholder="" type="file" class="filestyle form-control" name='file' size='20' data-height="26" />
                <span class="text-danger"><?php echo form_error('documents'); ?></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?><small class="req"> *</small></label>
                <textarea class="form-control" id="description" name="description" placeholder="" rows="3"></textarea>
                <span class="text-danger"><?php echo form_error('description'); ?></span>
            </div>
        </div><!-- /.box-body -->

    </div>
    <div class="row">
        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" data-loading-text="<?php echo $this->lang->line('processing'); ?>" id="edit_incomedatabtn" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('.filestyle').dropify();
    });
</script>
<script type="text/javascript"> $(document).ready(function (e) {
        $("#edit_incomedata").on('submit', (function (e) {
            $("#edit_incomedatabtn").button('loading');
            var id = $("#income_id").val();
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/income/addIncomePayment/' + id,
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
                        window.location.reload(true);
                    }
                    $("#edit_incomedatabtn").button('reset');
                },
                error: function () {
                    alert("Fail")
                }
            });
        }));
    });
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('#editdate').datepicker({

            format: date_format,
            endDate: '+0d',
            autoclose: true
        });
    });
</script>
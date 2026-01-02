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

         <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label> <small class="req">*</small>
                <input id="editdate" name="exdate" placeholder="" type="text" class="form-control" value="<?php echo set_value('date', date($expense['purchase_order_date'])); ?>" disabled />
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('Reference Number'); ?></label>
                <input id="reference_number" name="reference_number" placeholder="" type="text" class="form-control" value="<?php echo set_value('reference_number', $expense['reference_number']); ?>" />
                <input id="expense_id" type="hidden" class="form-control" value="<?php echo $expense['id']; ?>" />
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                <textarea class="form-control" id="description" name="description" placeholder="" rows="3"><?php echo set_value('purchase_order_description', $expense['purchase_order_description']); ?></textarea>
                <span class="text-danger"></span>
            </div>
        </div>
                                    
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('products'); ?></label> <small class="req">*</small>
                <select autofocus="" id="item_store_id_edit" name="item_store_id" class="form-control">
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php
                    foreach ($itemStoreList as $item) {
                    ?>
                        <option value="<?php echo $item['id'] ?>" <?php
                            // if (set_value('item_store_id') == $item['id']) {
                            //     echo "selected =selected";
                            // }
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
                            if (set_value('supplier_id',$expense['supplier_id']) == $item['id']) {
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
            <a class="btn btn-info add-record-edit addplus-xs" data-added="0"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_product'); ?></a>
            <hr>
        </div>                                    

        <!-- Productos -->
        <div class="">
            <div class="">
                <div class="col-12">
                    <table class="table table-striped table-bordered table-hover mb0" id="tableID_edit">
                        <?php
                            foreach ($purchase_order_details as $key => $item) {
                                //  print_r($item['id']); die();
                                ?>
                                 <tr id="row<?php echo $key;?>">
                                    <td>
                                        <input type="hidden" name="rows[]" value="<?php echo $item["item_store_id"];?>" autocomplete="off">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <?php echo $this->lang->line("product"); ?>
                                                </label>
                                                <input name="product_id_<?php echo $item["item_store_id"];?>" value="<?php echo $item["item_store"];?>" class="form-control" id="product_id_<?php echo $item["item_store_id"];?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>
                                                    <?php echo $this->lang->line("quantity"); ?>
                                                </label>
                                                <input id="quantity<?php echo $key;?>" value="<?php echo $item["amount"];?>" class="form-control" type="number" name="row_quantitys[]" min="0" step=".01" autocomplete="off"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>
                                                    <?php echo $this->lang->line("cost"); ?>
                                                </label>
                                                <input id="cost<?php echo $key;?>"  value="<?php echo $item["cost"];?>" class="form-control" type="number" min="0" step=".01" name="row_costs[]" autocomplete="off" onchange="sumatoria_edit()"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>
                                                    <?php echo $this->lang->line("total"); ?>
                                                </label>
                                                <input id="total<?php echo $key;?>" class="form-control" type="number" name="row_quantitys_total[]" readonly autocomplete="off"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-1"> 
                                            <button type="button" onclick="delete_row_edit(<?php echo $key;?>)" data-row-id="<?php echo $key;?>" class="closebtn delete_row_edit crossbtnfa">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </div>
                                    </td> 
                                </tr>
                            <?php $count++; }?>

                               
                            
                    </table>
                </div>
            </div>
        </div>

        <!-- Productos -->

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></label><small class="req"> *</small>
                <input id="amount_edit" name="amount" placeholder="" type="text" class="form-control" value="<?php echo set_value('total_expenditure', $expense['total_expenditure']); ?>" />

            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('payment_date'); ?></label> <small class="req">*</small>
                <input id="editpayment_date" name="payment_date" placeholder="" type="text" class="form-control" value="<?php echo set_value('payment_date', date($expense['payment_date'])); ?>"  />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control" value="<?php echo set_value('documents'); ?>" />
            </div>
        </div>
        

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('evidence'); ?></label>
                <input id="documents_other" name="documents_other" placeholder="" type="file" class="filestyle form-control" value="<?php echo set_value('documents_other'); ?>" />
            </div>
        </div>

        <!-- Gastos -->
        <div class="col-sm-6" >
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('income'); ?> <small class="req"> *</small></label>
                <input id="amount_income" name="amount_income" readonly placeholder="" type="text" class="form-control" value="<?php echo $amount_income; ?>" />
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
    // $(document).ready(function() {
        
    // });

    // $(document).ready(function() {
       
    // });

    $(document).ready(function(e) {
        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('#editdate').datepicker({
            format: date_format,
            endDate: '+0d',
            autoclose: true
        });

        $('#editpayment_date').datepicker({
            format: date_format,
            endDate: '+0d',
            autoclose: true
        });

        $('.filestyle').dropify();

        $("#editexpense input").on('keypress', (function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                return false;
            }

            $("#editexpensebtn").button('loading');

            var id = $("#expense_id").val();

            e.preventDefault();
            // if (event.keyCode !== 13) {
                console.log(487);
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/purchaseorder/edit/' + id,
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
            // }
        }));
    });
</script>
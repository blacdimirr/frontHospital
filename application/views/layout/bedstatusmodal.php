<?php foreach ($floor_list as $key => $floor) { ?>
<fieldset class="floormain">
    <legend><h4><?php echo $floor["name"] ?></h4></legend>
    <div class="row">
     <?php foreach ($bedgroup_list as $key => $bedgroup) { 
                if ($bedgroup["fid"] == $floor["id"]) { ?>
                <div class="col-md-12">
                    <fieldset style="background-color:<?php echo $bedgroup['color'];?>" ><!-- /class="bedgroups"/ -->
                        <legend class="text-center floorwardbg"><h4><?php echo $bedgroup["name"] ?></h4></legend>
                        <div class="row"> 
                            <?php foreach ($bedlist as $key => $beds) {
                                // print_r($beds['gender']);
                                // die();
                            if ($beds["bedgroupid"] == $bedgroup["id"]) {
                            if ($beds["is_active"] == 'no' && $beds["pid"]) {
                                $name = $beds["patient_name"];
                                $url = '';
                                if (isset($beds["case_reference_id"])) { $url = "admin/patient/profile/" . $beds["pid"]; }
                                else { $url = "admin/patient/ipdprofile/" . $beds["ipd_details_id"]; }
                            ?>
                            <div class="col-md-1 col-xs-6 col-lg-1 col-sm-4">
                                <a data-toggle="popover" class="beddetail_popover" href="<?php echo base_url() . $url; ?>">
                                    <div class="relative">
                                        <div class="<?php if ($beds["is_active"] == "yes") {
                                                echo "bedgreen";
                                            } else {
                                                echo "bedred";
                                            }
                                            ?>">
                                            <i class="fas fa-bed"></i>
                                            <div class="bedtpmiuns6"><?php echo $name ?></div>
                                        </div>
                                    </div>
                                    <div class="bed_detail_popover" style="display: none">
                                        <?php 
                                        echo 
                                        // $this->lang->line('patient_id') . " : " . $beds["patient_unique_id"] . "<br/>" . 
                                        // $this->lang->line('phone') . " : " . $beds["mobileno"] . "<br/>" . $this->lang->line('gender') . " : " . $beds["gender"] . "<br/>" . 
                                        '<b>'.$this->lang->line('bed_no') . "</b> : " . $beds["name"] . "<br/>" . 
                                        '<b>'.$this->lang->line('admission_date') . "</b> : " . date($this->customlib->getHospitalDateFormat(true, true), strtotime($beds['date'])) . "<br/>" . 
                                        '<b>'.$this->lang->line('patient_name') . "</b> : " . $beds["patient_name"] . "<br/>" . 
                                        '<b>'.$this->lang->line('consultant') . "</b> : " . $beds["staff"] . " " . $beds["surname"] . "<br/> <br/>" . 
                                        
                                        '<b>'.$this->lang->line('guardian_name') . "</b> : " . $beds["guardian_name"] . "<br/>" . 
                                        '<b>'.$this->lang->line('gender') . "</b> : " . $beds["gender"] . "<br/>" . 
                                        '<b>'.$this->lang->line('edad') . "</b> : " . $beds['age'].' años ' .$beds['month'].' Meses con '.$beds['day']. "<br/>" . 
                                        '<b>'.$this->lang->line('consultant') . "</b> : " . $beds["staff"] . " " . $beds["surname"]; 
                                        

                                        
                                        ?>

                                    </div>
                                </a>
                            </div><!--./col-md-2-->
                            <?php }
                            if ($beds["is_active"] == 'yes') {
                                $name    = $beds["name"];
                                $dataarr = array($beds["id"], $bedgroup["id"]);
                            ?>
                            <div class="col-md-1 col-xs-6 col-lg-1 col-sm-4">
                                <a href="<?php echo base_url() . "admin/patient/ipdsearch/" . $beds["id"] . "/" . $bedgroup["id"] ?>" >
                                    <div class="relative">  
                                        <div class="<?php if ($beds["is_active"] == "yes") {
                                                echo "bedgreen";
                                            } else {
                                                echo "bedred";
                                            } 
                                            ?>"><i class="fas fa-bed"></i>
                                            <div class="bedtpmiuns6"><?php echo $name ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            }
                             if ($beds["is_active"] == 'unused') {
                                $name    = $beds["name"];
                                $dataarr = array($beds["id"], $bedgroup["id"]);
                            ?>
                            <div class="col-md-1 col-xs-6 col-lg-1 col-sm-4">
                                <a data-toggle="popover" class="beddetail_popover"  href="<?php echo base_url() . "admin/patient/ipdsearch/" . $beds["id"] . "/" . $bedgroup["id"] ?>" >
                                    <div class="relative">  
                                        <div class="<?php if ($beds["is_active"] == "unused") {
                                                echo "bed-unused";
                                            }
                                            ?>"><i class="fas fa-bed"></i>
                                            <div class="bedtpmiuns6"><?php echo $name ?></div>
                                        </div>
                                    </div>
                                      <div class="bed_detail_popover" style="display: none"><?php echo $this->lang->line('unused') ?></div>
                                </a>
                            </div>
                            <?php
                            }
                            }
                            }
                            ?>
                        </div>
                    </fieldset>
                </div>
        <?php } } ?>
    </div>
</fieldset>
<?php }?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.beddetail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {

                return $(this).closest('div').find('.bed_detail_popover').html();
            }
        });
    });
</script>


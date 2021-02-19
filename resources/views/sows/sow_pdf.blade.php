<html>
<head>
    <title>Statement Of Work</title>
    <style>
        .text-center{
           text-align:center;
        }
        table 
        {
            width:100%;
            border-collapse: collapse;
            /* border:1px Solid grey; */
        }
        td
        {
            border:1px Solid;
            height: auto;
            width:80%;
            padding: 10px 10px;
        }
        .header
        {
            width:30%;
            font: bold; 
        }
        .checks
        {
            position: absolute;
            margin-top: .3rem;
            margin-left: -1.25rem;
        }
        .check_plus_label
        {
            margin-left:15px;
        }
        @page { margin: 130px 30px; }

        #logos { position: fixed; 
                 left: 0px; 
                 top: -100px; 
                 right: 0px; 
                 height: 80px; 
                 /* background-color: orange;  */
                }

    </style>
</head>
    <body>
        <!--Header all page-->
        <div id="logos">
            <div class="bupa" >
                <img src="../public/assets/images/bupa_logo.jpg" height="60" width="60">
                <img style="float:right;" src="../public/assets/images/logo.png">
            </div>   
        </div>

        <!--SOW-->
        <div>
            <h1 class="text-center">Statement Of Work</h1>
            <?php echo $sow->headerDesc[0]->content; ?>
            <table>
                <tr>
                    <td class="header">Project Name</td>
                    <td>{{$sow->project_name}}</td>
                </tr>
                <tr>
                    <td class="header">Project Type</td>
                    <td>{{$sow->project_type->type}} </td>
                </tr>
                <tr>
                    <td class="header">Procuring Party</td>
                    <td>{{$sow->procuring_party->name}}</td>
                </tr>
                <tr>
                    <td class="header">Project Description</td>
                    <td><?php echo $sow->project_desc; ?></td>
                </tr>
                <tr>
                    <td class="header">Activities/Scope of work</td>
                    <td><?php echo $sow->act_scope_work; ?></td>
                </tr>
                <tr>
                    <td class="header">Skills and Technical Abilities</td>
                    <td><?php echo $sow->skills_tech_abilities; ?></td>
                </tr>
                <tr>
                    <td class="header">Infrastructure from Customer</td>
                    <td><?php echo $sow->infra_cust; ?></td>
                </tr>
                <tr>
                    <td class="header">Infrastructure from Supplier</td>
                    <td style="padding: 0px;"><?php echo $sow->infra_supp; ?></td>
                </tr>
                <tr>
                    <td class="header">Location</td>
                    <td>{{$sow->location->type}}</td>
                </tr>
                <tr>
                    <td class="header">Work Days/Work Hours/Work Holidays</td>
                    <td><?php echo $sow->work_days; ?></td>
                </tr>
                <tr>
                    <td class="header">Work Allocation</td>
                    <td><?php echo $sow->work_allocation; ?></td>
                </tr>
                <tr>
                    <td class="header">Progress Reporting</td>
                    <td><?php echo $sow->progress_reporting; ?></td>
                </tr>
                <tr>
                    <td class="header">Acceptance Criteria or Fulfilment of SoW*</td>
                    <td><?php echo $sow->work_days; ?></td>
                </tr>
                <tr>
                    <td class="header">SLAs Agreed</td>
                    <td><?php echo $sow->slas_agreed; ?></td>
                </tr>
                <tr>
                    <td class="header">Line Managers / Reporting To</td>
                    <td style="padding: 0px;">
                        <table>
                            <tr>
                                <td class="header">
                                    Customer Manager
                                </td>
                                <td>
                                    {{$sow->customerManager->name}}
                                </td>
                            </tr>
                            <tr>
                                <td class="header">
                                    Supplier Manager
                                </td>
                                <td>
                                    {{$sow->supplierManager->name}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @if($sow->project_type->type == 'FP')
                <tr>
                    <td class="header">Change Control (Applicable for Fixed Price)</td>
                    <td> <?php echo $sow->change_control ?></td>
                </tr>
                <tr>
                    <td class="header">Risks & Mitigation Plans (Applicable for Fixed Price)</td>
                    <td> <?php echo $sow->risk_mitigation_plans; ?></td>
                </tr>
                @endif
                <tr>
                    <td class="header">Extension (Applicable for T & M & FR)</td>
                    <td><?php echo $sow->extension; ?></td>
                </tr>
                <tr>
                    <td class="header">Cancellation / Delay / Early Termination</td>
                    <td>  <?php echo $sow->cancellation;?></td>
                </tr>
                <tr>
                    <td class="header">Applicability of Escrow for the deliverables</td>
                    <td>  <?php echo $sow->applicability_deliverables;?></td>
                </tr>
                <tr>
                    <td class="header">Price (in GBP) – excluding VAT</td>
                    <td><?php echo $sow->price; ?></td>
                </tr>
                <tr>
                    <td class="header">Overtime Working (Applicable only for T & M/FR)</td>
                    <td style="padding: 0px;"><?php echo $sow->overtime_working; ?></td>
                </tr>
                <tr>
                    <td class="header">Payments</td>
                    <td> <?php echo $sow->payments; ?></td>
                </tr>
                <tr>
                    <td class="header">Out of Pocket and Travel Expenses</td>
                    <td><?php echo $sow->out_pocket_travel_exp; ?></td>
                </tr>
                <tr>
                    <td class="header">Transition Back Arrangements</td>
                    <td> <?php echo $sow->trans_back_arr; ?></td>
                </tr>
                <tr>
                    <td class="header">Data Protection</td>
                    <td><?php echo $sow->data_protection;?></td>
                </tr>
            </table>
        <div>
        
        <!--Annexure-->
        <div style="page-break-before: always;">
            <h1 style="text-align:center;">Annexure</h1>
            <h3 style="text-align:center;">Annex 1 – Agreements and Scope of Bupa Personal Data Processing</h3>

                <table>
                <tr>
                <td class="header">Date of agreement</td>
                <td>{{$sow->agree_date}}</td>
                </tr>
                <tr>
                <td class="header">Party acting as controller</td>
                <td><?php echo $masters['party_cntlr'];?></td>
                </tr>
                <tr>
                <td class="header">Party acting as processor</td>
                <td><?php echo $masters['party_proc'];?></td>
                </tr>
                <tr>
                <td class="header">Duration of processing</td>
                <td><?php echo $masters['proc_duration'];?></td>
                </tr>
                <tr>
                <td class="header">Nature and purpose of processing</td>
                <td><?php echo $masters['proc_nature'];?></td>
                </tr>
                <tr>
                <td class="header">Categories of data subjects</td>
                <td>
                    Please select all of the categories of data subjects (individuals) who are subject to the processing:
                    <br>
                    
                    @foreach ($annexureAttributes['subject categories'] as $annexsubcat)

                        <?php 
                            if($annexsubcat->annexureValues->value == '1') 
                                $status = 'Checked';
                            else
                                $status = '';
                        ?>
                        <div class="check_plus_label">
                            <input type="checkbox" class="checks" {{$status}}>
                            <label>{{$annexsubcat['content']}}</label>  
                        </div>
                        <br>
                    @endforeach
                </td>
                </tr>
                <tr>
                <td class="header">Type of personal data and special categories of personal data</td>
                <td>
                Please select all of the types of personal data which are subject to the processing:
                <br><br>
                <b>Personal:</b>
                <br><br>
                    @foreach ($annexureAttributes["personal data"] as $annexPersonal)

                    <?php 
                            if($annexPersonal->annexureValues['value'] == '1') 
                                $status = 'Checked';
                            else
                                $status = '';
                        ?>
                        
                        <div class="check_plus_label">
                            <input type="checkbox" class="checks" {{$status}}>
                            <label>{{$annexPersonal['content']}}</label>
                        </div>  
                            <br>                  
                    @endforeach
    
                    Other Please list:
                    @if($sow->annex_personal_other == NULL)
                    _________________________________________
                    @else
                    {{$sow->annex_personal_other}}
                    @endif
                        
                </td>
                </tr>     
                <tr>
                <td class="header">Special categories:</td>
                <td>
                    @foreach ($annexureAttributes["special categories"] as $annexSpec)

                            <?php 
                            if($annexSpec->annexureValues->value == '1') 
                                $status = 'Checked';
                            else
                                $status = '';
                            ?>

                    <div class="check_plus_label">
                        <input type="checkbox" class="checks" {{$status}}>
                        {{$annexSpec['content']}}
                    </div>    
                        <br>                 
                    @endforeach
                </td>
                </tr>
                <tr>
                <td class="header">Other:</td>
                <td>
                @foreach ($annexureAttributes["other"] as $annexOther)

                            <?php 
                            if($annexOther->annexureValues->value == '1') 
                                $status = 'Checked';
                            else
                                $status = '';
                            ?>

                    <div class="check_plus_label">
                        <input type="checkbox" class="checks" {{$status}}>
                        {{$annexOther['content']}}
                    </div>    
                        <br>                 
                    @endforeach             
                </td>
                </tr>
                <tr>
                <td class="header">Authorised Processors</td>
                <td>
                    Please list:
                    @if($sow->authorised_processors == null)
                    _________________________________________
                    @else
                        {{$sow->authorised_processors}}
                    @endif
                    <br><br>  
                    Note: If not completed, then there will be deemed not to be any authorised processors.
                </td>
                </tr>
                </table>
        </div>
        
    </body>
</html>
    
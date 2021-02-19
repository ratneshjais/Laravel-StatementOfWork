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
        <!--Amendment-->
        <div>
            <h3 class="text-center">AMENDMENT TO ORIGINAL STATEMENT OF WORK</h3>
            <table>
                <tr>
                    <td class="text-center" style="border: none"><strong>Project Name ({{$sow->project_name}})</strong></td>
                </tr>
                <tr>
                    <td class="text-center" style="border: none"><strong>Effective From: {{$amendment->effective_from}}<strong></td>
                </tr>
                <tr>
                    <td class="text-center" style="border-bottom:1px solid;"><strong>Amendment #: Dated: {{$amendment->dated}}</strong></td>
                </tr>
                <tr>
                    <td style="border-right:none; padding:20px;border-left:none;height:10px;"><strong>This amendment is for {{$amendment->amendment_for}}</strong></td>
                </tr>
                <tr>
                    <table style="width:500px;border-collapse: collapse;padding:20px;">
                        <tr style="font-weight:bold;height:10px;padding:2px;background-color:gray;">
                            <td style="border:1px solid;">Role</td>
                            <td style="border:1px solid;">Original End Date</td>
                            <td style="border:1px solid;">Revised End Date</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid;">Total</td>
                            <td style="border:1px solid;">{{$amendment->original_end_date}}</td>
                            <td style="border:1px solid;">{{$amendment->revised_end_date}}</td>
                        </tr>
                    <table>
                </tr>
                <tr>
                    <td style="border: none;  padding:20px;"><strong>Per day Rate Applicable for the new- {{$amendment->rate}} GBP  {{$amendment->rate_vat}} Excluding VAT</strong></td>
                </tr>
                
                <tr>
                    <td style="border: none">
                        <table style="border-collapse: collapse;padding:20px;">
                            <tr>
                                <td style="border:1px solid;width:20%;"><strong>Data Protection:</strong></td>
                                <td style="border:1px solid;"><?php echo $amendment->data_protection; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr >
                    <td style="border: none;  padding-left:20px;">All other terms and conditions will remain same as mentioned in the original SOW.</td>
                </tr>

                <tr>
                    <td style="border: none">
                    <table style="border:1px solid; border-collapse: collapse;padding:20px;">
                            <tr>
                                <td rowspan="5" style=" border:1px solid; width:20%;">Authorisation</td>
                                <td  style="border:1px solid;">Bupa</td>
                                <td  style="border:1px solid;">Datamatics</td>
                            </tr>
                            <tr >
                                <td>CUSTOMER Authorised Signatory</td>
                                <td style="border-left:1px solid;">SUPPLIER Authorised Signatory</td>
                            </tr>
                            <tr>
                                <td style="height:150px;"></td>
                                <td style="border-left:1px solid;height:150px;"></td>
                            </tr>
                            
                            <tr>
                                <td>Signature:</td>
                                <td style="border-left:1px solid;">Signature:</td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td style="border-left:1px solid;">Date:</td>
                            </tr>

                        </table>
                    </td>
                </tr>
                   
            </table>
        <div>       
    </body>
</html>
    
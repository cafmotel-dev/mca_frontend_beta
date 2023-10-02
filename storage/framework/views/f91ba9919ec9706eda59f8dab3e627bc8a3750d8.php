<script src="<?php echo e(asset('asset/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script>
  $(document).ready(function ()
  {
    $('.phone_number').inputmask("(999) 999-9999");
    $('#datatable').DataTable();
  });
</script>

<!DOCTYPE html>
<html>
<head>
    <title>:: PDF ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <style>
table {
  width: 100%;
   border-collapse: collapse !important;
}

</style>
</head>

<body>

    <table width="1000" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Arial, Helvetica, sans-serif; color:#222;">
         
    <tr>
        <td width="50%" align="center" valign="top" style="font-weight:bold; font-size:12pt; padding:4px 0px 8px 0px;">
            <img src="https://mca.buzzclicker.com/uploads/logo//<?php echo e($companyLogo); ?>" height="55" alt=""/><br />
            Working Capital Application<br />
            <?php echo e($address_1); ?><br />
            <?php echo e($domain); ?>

        </td>
        <td align="right" valign="top" style="padding:4px 0px 0px 0px;">
            <table width="100%" cellspacing="0" cellpadding="0"   style="font-size:10pt; border:1px solid #333;">
                <tr>
                    <td style="padding:2px 0px 2px 10px; border-bottom:1px solid #333;">
                        <strong>Specialist: </strong> <?php echo e($assign_to_first_name); ?> <?php echo e($assign_to_last_name); ?>

                    </td>
                </tr>
                <tr>
                    <td style="padding:2px 0px 2px 10px; border-bottom:1px solid #333;">
                        <strong>Phone #:</strong><b class="phone_number"> <?php echo e($assign_to_mobile); ?></b>
                    </td>
                </tr>
                <tr>
                    <td style="padding:2px 0px 2px 10px; border-bottom:1px solid #333;">
                        <strong>Fax #:</strong> <!--_REPRESENTIVE_FAX_-->
                    </td>
                </tr>
                <tr>
                    <td style="padding:2px 0px 2px 10px;">
                        <strong>Email:</strong> <?php echo e($assign_to_email); ?>

                        <!-- _REPRESENTIVE__EMAIL_-->
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" valign="bottom" style="font-weight:bold; font-size:7pt; padding:5px 0px 5px 0px; border:1px solid #333;">BUSINESS INFORMATION</td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;">
                        <strong>Legal/Corporate Name:</strong>&nbsp;<?php echo e($legal_company_name); ?>

                    </td>
                    <td align="left" valign="middle" colspan="3" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>DBA:</strong>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;">
                        <strong>Physical Address:</strong>&nbsp;<?php echo e($address); ?>

                    </td>
                    <td width="18%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>City:</strong>&nbsp;<?php echo e($city); ?>

                    </td>
                    <td width="15%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>State: </strong>&nbsp;<?php echo e($state); ?>

                    </td>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Zip:</strong>&nbsp;
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="middle" width="33%" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;">
                        <strong>Telephone #:</strong>&nbsp;<?php echo e($phone); ?>

                    </td>
                    <td align="left" valign="middle" width="33%" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333; border-left:1px solid #333;">
                        <strong>Fax #:</strong>&nbsp;
                    </td>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333; border-left:1px solid #333;">
                        <strong>Federal Tax ID:</strong>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;">
                        <strong>Date Business Started:</strong>&nbsp;
                    </td>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Length of Ownership:</strong>&nbsp;
                    </td>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Website:</strong>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-bottom:1px solid #333;"><strong>Type of Entity (circle one):</strong>&nbsp;
                        <br/><strong>Sole Proprietorship&nbsp;&nbsp;&nbsp;&nbsp;Partnership&nbsp;&nbsp;&nbsp;&nbsp;Corporation&nbsp;&nbsp;&nbsp;&nbsp;LLC &nbsp;&nbsp;&nbsp;&nbsp;Other</strong>
                    </td>
                    <td align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Email Address:</strong>&nbsp;<?php echo e($email); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-bottom:1px solid #333;"><strong>Type of Business :</strong>&nbsp;</td> <!--_BUSINESS_TYPE-->
                    <td align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Product/Service Sold: </strong>&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;"><strong>Use of Proceeds:</strong>&nbsp;</td>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Requested Amount:</strong>&nbsp;</td>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Gross Annual Sales:</strong>&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>

   
    <tr>
        <td colspan="2" align="center" valign="bottom" style="font-weight:bold; font-size:7pt; padding:5px 0px 5px 0px; border-left:1px solid #333; border-right:1px solid #333;
                border-bottom:1px solid #333;">
            OWNER/OFFICER INFORMATION
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="35%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-bottom:1px solid #333;"><strong>Owner First Name:</strong> <?php echo e($first_name); ?> </td>
                    <td width="35%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Owner Last Name:</strong><?php echo e($last_name); ?></td>
                    <td width="15%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Ownership %:</strong> </td> <!--_OWNERSHIP_PERCENT_-->
                    <td align="left" valign="middle" style="padding:2px 0px 2px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Credit Score:</strong></td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="padding:6px 0px 6px 8px; border-bottom:1px solid #333;"><strong>Home Address:</strong></td>
                    <td align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>City:</strong> <?php echo e($city); ?></td> 
                    <td width="13%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>State:</strong> <?php echo e($state); ?></td>
                    <td align="left" valign="middle" style="padding:2px 0px 2px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Zip:</strong></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333;border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="26%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;"><strong>SSN:</strong>&nbsp;</td> <!--_SSN_-->
                    <td width="24%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333; border-left:1px solid #333;"><strong>Date of Birth:</strong>&nbsp; <?php echo e($dob); ?></td> <!-- _DOB_-->
                    <td width="20%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333; border-left:1px solid #333;"><strong>Home #:</strong>&nbsp;</td><!-- _HOME_#-->
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Cell #:</strong>&nbsp;</td><!--_CELL_#-->
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" valign="bottom" style="font-weight:bold; font-size:7pt; padding:5px 0px 5px 0px;
                     border-left:1px solid #333; border-right:1px solid #333; border-bottom:1px solid #333;">
            PARTNER INFORMATION (if owner/officer ownership % less than 50%)
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="35%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-bottom:1px solid #333;"><strong>Partner First Name:</strong></td>
                    <td width="35%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Partner Last Name:</strong></td>
                    <td  width="15%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Ownership %:</strong></td>
                    <td align="left" valign="middle" style="padding:2px 0px 2px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Credit Score:</strong></td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="padding:6px 0px 6px 8px; border-bottom:1px solid #333;"><strong>Home Address:</strong>&nbsp;</td>
                    <td align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>City:</strong>&nbsp;</td>
                    <td width="13%" align="left" valign="middle" style="padding:6px 0px 6px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>State:</strong>&nbsp;</td>
                    <td align="left" valign="middle" style="padding:2px 0px 2px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Zip:</strong>&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="26%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;"><strong>SSN:</strong>&nbsp;</td>
                    <td width="24%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333; border-left:1px solid #333;"><strong>Date of Birth:</strong>&nbsp;</td>
                    <td width="20%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333; border-left:1px solid #333;"><strong>Home #:</strong>&nbsp;</td>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Cell #:</strong>&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" valign="bottom" style="font-weight:bold; font-size:7pt; padding:5px 0px 5px 0px;
                     border-left:1px solid #333; border-right:1px solid #333; border-bottom:1px solid #333;">
            BUSINESS PROPERTY INFORMATION
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="35%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;"><strong>Business Landlord or Business Mortgage Bank:</strong>&nbsp;</td>
                    <td width="35%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Contact Name and/or Account #:</strong>&nbsp;
                    </td>
                    <td colspan="2" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;"><strong>Phone #:</strong>&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;"><strong>Own/Lease: (circle one):</strong>&nbsp;</td>
                    <td colspan="3" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Monthly Rent or Mortgage:</strong>&nbsp;
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" valign="bottom" style="font-weight:bold; font-size:7pt; padding:5px 0px 5px 0px;
                     border-left:1px solid #333; border-right:1px solid #333; border-bottom:1px solid #333;">
            CREDIT CARD INFORMATION
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="35%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;">
                        <strong>Credit Card Processing Terminal(s)/Software Model:</strong>&nbsp;
                    </td>
                    <td width="35%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Number of Terminals:</strong>&nbsp;
                    </td>
                    <td colspan="2" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Average Monthly Volume:</strong>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;"><strong>State of Incorporation:</strong>&nbsp;</td>
                    <td colspan="3" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>
                            Do you Accept: Visa/MasterCard Amex Discover Debit EBT Please circle all that apply.
                        </strong>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td width="35%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-bottom:1px solid #333;">
                        <strong>Prior/Current Working Capital / Funding (if applicable):</strong>&nbsp;
                    </td>
                    <td width="35%" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Balance:</strong>&nbsp;
                    </td>
                    <td colspan="2" align="left" valign="middle" style="padding:4px 0px 4px 8px; border-left:1px solid #333; border-bottom:1px solid #333;">
                        <strong>Underwriter Use OnlySplit Funds </strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" valign="bottom" style="font-weight:bold; font-size:7pt; padding:5px 0px 5px 0px;
                     border-left:1px solid #333; border-right:1px solid #333; border-bottom:1px solid #333;">
            BANK INFORMATION
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333; border-bottom:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px;"><strong>Previous Month Business Deposits</strong></td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px;"><strong>2 Months Ago Business Deposits</strong></td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px;"><strong>3 Months Ago Business Deposits</strong></td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px;"><strong>4 Months Ago Business Deposits</strong></td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-right:1px solid #333; border-top:1px solid #333;">&nbsp;</td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-right:1px solid #333; border-top:1px solid #333;">&nbsp;</td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-right:1px solid #333; border-top:1px solid #333;">&nbsp;</td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-top:1px solid #333;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333; border-bottom:1px solid #333;">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" valign="middle" style="padding:4px 8px 2px 8px;"><strong>Previous Month # Neg. Days</strong></td>
                    <td align="center" valign="middle" style="padding:4px 8px 2px 8px;"><strong>2 Months Ago # Neg. Days</strong></td>
                    <td align="center" valign="middle" style="padding:4px 8px 2px 8px;"><strong>3 Months Ago # Neg. Days</strong></td>
                    <td align="center" valign="middle" style="padding:4px 8px 2px 8px;"><strong>4 Months Ago # Neg. Days</strong></td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-right:1px solid #333; border-top:1px solid #333;">&nbsp;</td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-right:1px solid #333; border-top:1px solid #333;">&nbsp;</td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-right:1px solid #333; border-top:1px solid #333;">&nbsp;</td>
                    <td align="center" valign="middle" style="padding:2px 2px 2px 2px; border-top:1px solid #333;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:5pt; border-left:1px solid #333; border-right:1px solid #333; ">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding:2px 8px 2px 8px;">
                        <strong>
                            By signing below, each of the above listed business and business owner/officer (individually and collectively, "Applicant") certify that the Applicant is an owner of the above named business and that all information provided in the application is true and accurate. Applicant shall immediately notify <!--_DBA_ dba _COMPANY_NAME_ ("_COMPANY_NAME_") Bright Minds NY, INC dba Bright NY--> Bright Minds NY, INC dba Bright NY of any change in such information or financial condition. Applicant authorizes _COMPANY_NAME_ to share this application with each of its representatives, successors, assigns and designees ("Assignees") or any other parties that may be involved with the extension of credit pursuant to this application including those who offer commercial loans having daily repayment features or purchases of future receivables including Merchant Cash Advance transactions, including without limitation the application therefor (collectively, "Transactions ). Applicant further authorizes _COMPANY_NAME_ and all Assignees to request and receive any third party consumer or personal , business and investigative reports and other information about Applicant, including credit card processor statements and bank statements, from one or more consumer reporting agencies, such as TransUnion, Experian , and Equifax, and from other credit bureaus, banks, creditors  and other third parties. Applicant authorizes _COMPANY_NAME_ to transmit this form, along with any other foregoing information obtained in connection with this application, to any or all of the Assignees for the foregoing purpose. You also consent to the release, by any creditor or financial institution , of any information relating to any of you , to _COMPANY_NAME_ and to each of the Asignees, on its own behalf. Applicant waives and releases any claims against Recipients and any information-providers arising from any act or omission relating to the requesting, receiving or release of the information obtained in connection with this application.
                        </strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="top" style="font-weight:normal; font-size:7pt; border-left:1px solid #333; border-right:1px solid #333; __BOTTOM_BORDER__">
            <table width="1000" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding:2px 10px 2px 10px;">&nbsp; <?php if(!empty($signature_image)) { ?><img style="width: 200px;height: 100px;"  src="https://mca.buzzclicker.com/uploads/signature/<?php echo e($signature_image); ?>"> <?php }?></td>
                    <td style="padding:0px 10px 0px 10px;" valign="bottom">&nbsp;</td>
                    <td style="padding:2px 10px 2px 10px;">&nbsp;</td><!--_ESIGN2_-->
                    <td style="padding:0px 10px 0px 10px;" valign="bottom">&nbsp;</td>
                </tr>
                <tr>
                    <td style="padding:0px 10px 4px 10px;" width="30%" align="left" valign="top">
                        <table width="300" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="border-top:1px solid #333;"><strong><?php echo e($first_name); ?> <?php echo e($last_name); ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="22%" style="padding:0px 10px 4px 10px;" align="left" valign="top">
                        <table width="100" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="border-top:1px solid #333;"><strong>Date</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td  width="30%" style="padding:0px 10px 4px 10px;" align="left" valign="top">
                        <table width="300" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="border-top:1px solid #333;"><strong>Applicant’s Signature</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="22%" style="padding:0px 10px 4px 10px;">
                        <table width="100" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="border-top:1px solid #333;"><strong>Date</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                
            </table>
        </td>
    </tr>

    

</table>

</body>
</html><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/myPDF.blade.php ENDPATH**/ ?>
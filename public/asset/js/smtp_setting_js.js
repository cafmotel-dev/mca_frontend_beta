$("#mail_encryption").change(function ()
    {
        var mail_encryption = $("#mail_encryption").val();
        if (mail_encryption == 'SSL')
        {
            $("#mail_port").val('465');
        }
        else
        if (mail_encryption == "TLS")
        {
            $("#mail_port").val('587');
        }
    });
    $(document).on("click", ".checkSetting", function ()
    {
        var flag = 1;
        var mail_driver = $("#mail_driver").val();
        var mail_host = $("#mail_host").val();
        var mail_port = $("#mail_port").val();
        var mail_encryption = $("#mail_encryption").val();
        var mail_username = $("#mail_username").val();
        var mail_password = $("#mail_password").val();
        var from_email = $("#from_email").val();
        var from_name = $("#from_name").val();

        if (mail_driver == '')
        {
            $("#alert-errors").html("Please enter Driver");
            $("#alert-errors").show();
            $("#mail_driver").focus();
            flag = 0;
            return false;
        }
        else
        if (mail_host == '')
        {
            $("#alert-errors").html("Please enter Host");
            $("#alert-errors").show();
            $("#mail_host").focus();
            flag = 0;
            return false;
        }
        else
        if (mail_username == '')
        {
            $("#alert-errors").html("Please enter Username");
            $("#alert-errors").show();
            $("#mail_username").focus();
            flag = 0;
            return false;
        }
        else
        if (mail_password == '')
        {
            $("#alert-errors").html("Please enter Password");
            $("#alert-errors").show();
            $("#mail_password").focus();
            flag = 0;
            return false;
        }
        else
        if (mail_encryption == '')
        {
            $("#alert-errors").html("Please select Encryption");
            $("#alert-errors").show();
            $("#mail_encryption").focus();
            flag = 0;
            return false;
        }
        else
        if (mail_port == '')
        {
            $("#alert-errors").html("Please select Port");
            $("#alert-errors").show();
            $("#mail_port").focus();
            flag = 0;
            return false;
        } 

        if(flag == 1)
        {
            $("#loading").show();
        }


        $("#smtpResponce").show();
        var el = this;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/send-email/test/',
            data:
            {
                mail_driver: mail_driver,
                mail_host: mail_host,
                mail_username: mail_username,
                mail_password: mail_password,
                mail_encryption: mail_encryption,
                mail_port: mail_port,
                from_email: from_email,
                from_name: from_name
            },

            type: 'get',
            dataType:"json",
            success: function (response)
            {
                if (response.success)
                {
                    $('#loading').hide();
                    $(".checkSetting").attr("disabled", "disabled"); 
                    swal("Success!", "Email Setting worked. Save the setting and start using it", "success")
                }
                else
                {
                    $('#loading').hide();
                    swal("Warning!", "Email Setting not working. Configuration Setting Failed", "warning")
                    
                }
            }
        });
    });
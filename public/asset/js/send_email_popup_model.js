$('.btn_send_email').click(function ()
{
    var lead_id = $(this).attr('data-leadid');
    var toEmailId = $(this).attr('data-email');
    $("#toEmailId").val(toEmailId);
    $("#lead_id").val(lead_id);
    $("#responseMessage").html('');

    //Rest the template selection

    $('#templates option[value=""]').attr('selected','selected');
    $('#subject').val('');
    $('#multiple_labels').val('');
    $('#multiple_names').val('');
    $('#multiple_custom_names').val('');
    CKEDITOR.instances['editor1'].setData('');

    console.log("btn_send_email: " + toEmailId);

    $.ajax(
    {
        url: '/openMailModal',
        type: 'get',
        data:
        {
            lead_id: lead_id,
            toEmailId: toEmailId,
        },

        success: function (response)
        {
            templates_line = "<option value=''>Compose New</option>";
            for (var i = 0; i < response['email_templates'].length; i++)
            {
                var email_template = response['email_templates'][i];
                //alert(email_template);
                templates_line += "<option value='" + response['email_templates'][i]['id'] + "'>";
                templates_line += response['email_templates'][i]['template_name'];
                templates_line += "</option>";
            }

            $('#templates').html(templates_line);
            label_line = "<option value=''>Select to Insert</option>";
            for (var i = 0; i < response['labels'].length; i++)
            {
                var labels = response['labels'][i];
                label_line += "<option value='" + response['labels'][i]['id'] + "'>";
                //label_line += "<option value='[["+response['labels'][i]['title']+"]]'>";
                label_line += response['labels'][i]['title'];
                label_line += "</option>";
            }

            $('#multiple_labels').html(label_line);
            user_line = "<option value=''>Select to Insert</option>";
            for (var i = 0; i < response['user_column'].length; i++)
            {
                var user_column = response['user_column'][i];
                //alert(user_column);
                user_line += "<option value='[[" + user_column + "]]'>";
                user_line += user_column;
                user_line += "</option>";
            }
            $('#multiple_names').html(user_line);
        },

        error: function (xhr, status, error)
        {
            $("#responseMessage").html('<div class="alert alert-danger" id="alert-errors">'+xhr.responseText+'</div>');
        }
    });

    $('#sendMailModel').modal('show');
});


$(function ()
{
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
    CKEDITOR.config.height = 400;        // 500 pixels high.
    CKEDITOR.replace('editor1',
    {
        enterMode: CKEDITOR.ENTER_BR,
        filebrowserUploadMethod: 'form'
    });

    CKEDITOR.instances['editor1'].on('contentDom', function ()
    {
        this.document.on('click', function (event)
        {
            console.log('abh');
            $('#setBoxValue').html('');
        });
    });

    $("#multiple_labels").on('change', function ()
    {
        var label_name = $(this).val();
        var lead_id = $("#lead_id").val();
        var list_id = 0;

        $.ajax(
        {
            url: '/getLabelValue/' + label_name + '/' + list_id + '/' + lead_id,
            type: 'get',
            success: function (response)
            {
                var hidden_box = $('#setBoxValue').html();
                if (hidden_box == 'subject_box')
                {
                    var cursorPos = $('#subject').prop('selectionStart');
                    var v = $('#subject').val();
                    console.log(v);

                    var textBefore = v.substring(0, cursorPos);
                    var textAfter = v.substring(cursorPos, v.length);
                    $('#subject').val(textBefore + response + textAfter);
                }
                else
                {
                    for (var i in CKEDITOR.instances)
                    {
                        console.log(response);
                        CKEDITOR.instances[i].insertHtml(response);
                    }
                }
            }
        });
    });


    $("#multiple_names").on('change', function ()
    {
        console.log($(this).val());
        var sender_id = $(this).val();
        $.ajax(
        {
            url: '/getSenderValue/' + sender_id,
            type: 'get',
            success: function (response)
            {
                var hidden_box = $('#setBoxValue').html();
                if (hidden_box == 'subject_box')
                {
                    var cursorPos = $('#subject').prop('selectionStart');
                    var v = $('#subject').val();
                    console.log(v);
                    var textBefore = v.substring(0, cursorPos);
                    var textAfter = v.substring(cursorPos, v.length);
                    $('#subject').val(textBefore + response + textAfter);
                }
                else
                {
                    for (var i in CKEDITOR.instances)
                    {
                        CKEDITOR.instances[i].insertHtml(response);
                    }
                }
            }
        });
    });

    $("#multiple_custom_names").on('change', function ()
    {
        console.log($(this).val());
        var custom_id = $(this).val();
        $.ajax(
        {
            url: '/getCustomFieldValue/' + custom_id,
            type: 'get',
            success: function (response)
            {
                var hidden_box = $('#setBoxValue').html();
                if (hidden_box == 'subject_box')
                {
                    var cursorPos = $('#subject').prop('selectionStart');
                    var v = $('#subject').val();
                    console.log(v);

                    var textBefore = v.substring(0, cursorPos);
                    var textAfter = v.substring(cursorPos, v.length);
                    $('#subject').val(textBefore + response + textAfter);
                }
                else
                {
                    for (var i in CKEDITOR.instances)
                    {
                        CKEDITOR.instances[i].insertHtml(response);
                    }
                }
            }
        });
    });

    $("#templates").on('change', function ()
    {
        console.log("Template change called");
        var output = '';
        CKEDITOR.instances['editor1'].setData(output);

        var template_id = this.value;
        var lead_id = $("#lead_id").val();
        var list_id = '1';
        $.ajax(
        {
            url: '/getTemplate/' + template_id + '/' + list_id + '/' + lead_id,
            type: 'get',
            success: function(response)
            {
    $("#subject").removeClass('is-invalid');

                console.log(response);
                $("#subject").val(response['subject']);
                for (var i in CKEDITOR.instances)
                {
                    CKEDITOR.instances[i].insertHtml(response['template_html']);
                    var editor = CKEDITOR.instances[i];
                    editor.on('contentDom', function ()
                    {
                        var editable = editor.editable();
                        editable.attachListener(editable, 'click', function ()
                        {
                            console.log("click event");
                            $('#setBoxValue').html('');
                        });
                    });
                }
            }
        });
    });

    $('#subject').on('click', function ()
    {
        $('#setBoxValue').html('subject_box');
    });
});

$(document).on("click", ".send_mail", function ()
{

  var flag = 1;
  var toEmailId = $("#toEmailId").val();
  var lead_id = $("#lead_id").val();

  var subject = $("#subject").val();
  var editor1 = CKEDITOR.instances['editor1'].getData();
  if (toEmailId == '')
  {
    $("#alert-errors").html("Please enter Email");
    $("#alert-errors").show();
    $("#toEmailId").focus();
    flag = 0;
    return false;
  }
  else
  if (subject == '')
  {
    $("#subject").addClass('is-invalid');
    $("#subject").focus();
    flag = 0;
    return false;
  }
  else
  if (editor1 == '')
  {
    $("#editor_text").html("Please enter Content");
    $("#editor1").focus();
    flag = 0;
    return false;
  }

  if(flag == 1)
  {
    $("#loading").show();
    $('#sendMailModel').modal('hide');

  }

  $("#smtpResponce").show();
  var el = this;
  $.ajax(
  {
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/send-email/generic/',
    data:
    {
      toEmailId: toEmailId,
      subject: subject,
      editor1: editor1,
      lead_id:lead_id
    },

    type: 'get',
    dataType:"json",
    success: function (response)
    {
      if (response.success)
      {
        $('#loading').hide();
        $(".checkSetting").attr("disabled", "disabled"); 
        swal("Success!", "Email has been sent successfully", "success")
      }
      else
      {
        $('#loading').hide();
        swal("Warning!", "Email Setting not working. Configuration Setting Failed", "warning")
      }
    }
  });
});
function getExtension(min, max)
{
    return Math.floor(Math.random() * (max - min)) + min;
}

function getIvrUserId(min, max)
{
    return Math.floor(Math.random() * (max - min)) + min;
}

function getPassword()
{
    var length = 10,
    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
    retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i)
    {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}

$('.show_confirm').click(function(event)
{
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this record?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        }).then((willDelete)=>
        {
            if (willDelete)
            {
                form.submit();
                $('#loading').show();
            }
        }
    );
});


$(function()
{
    $("#datatable").on("change", ".toggle-class", function ()
    {
        $('#loading').show();
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id');             
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeUserStatus/'+user_id+'/'+status,
            success: function(data)
            {
                if(data.status == 'true')
                {
                    $('#loading').show();
                    console.log(data.success);
                    window.location.reload(1);
                }
                else{}
            }
    });
    })
})

function textPassword(x)
{
    $("#show_"+x).show();
    $("#hide_"+x).hide();
}

function textNormal(x)
{
    $("#show_"+x).hide();
    $("#hide_"+x).show();
}
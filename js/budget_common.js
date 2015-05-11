$(document).ready(function()
{
    $(document).ajaxStart(function()
    {
        $("#loading").show();
    });
    $(document).ajaxSuccess(function(event,xhr,options)
    {
        if(xhr.responseJSON)
        {
            if(xhr.responseJSON.content)
            {
                load_template(xhr.responseJSON.content);
            }

        }


    });
    $(document).ajaxComplete(function(event,xhr,options)
    {
        if(xhr.responseJSON)
        {
            if(xhr.responseJSON.page_url)
            {
                //window.history.pushState(null, "Search Results",xhr.responseJSON.page_url);
                window.history.replaceState(null, "Search Results",xhr.responseJSON.page_url);
            }

            //$("#loading").hide();
            $("#loading").hide();
            if(xhr.responseJSON.message)
            {
                animate_message(xhr.responseJSON.message);
            }
        }
    });
    $(document).ajaxError(function(event,xhr,options)
    {

        $("#loading").hide();

        animate_message("Server Error");

    });
    //binds form submission with ajax
    $(document).on("submit", "form", function(event)
    {
        if($(this).hasClass('external'))
        {
            return true;
        }
        event.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data, status)
            {

            },
            error: function (xhr, desc, err)
            {


            }
        });
    });
    //bind any anchor tag to ajax request
    $(document).on("click", "a", function(event)
    {

        if($(this).hasClass('external')||$(this).hasClass('ui-corner-all'))
        {
            return true;
        }
        event.preventDefault();
        $.ajax({
            url: $(this).attr("href"),
            type: 'POST',
            dataType: "JSON",
            success: function (data, status)
            {

            },
            error: function (xhr, desc, err)
            {
                console.log("error");

            }
        });

    });
    //bind save button to submit the form
    $(document).on("click", "#button_save", function(event)
    {
        $("#save_form").submit();

    });

    //load dashboard first time
    load_main_page();
    // binds form submission and fields to the validation engine



    //action for menu-item click
    $(document).on("click", ".main-menu-container .menu-item", function(event)
    {
        $.ajax({
            url: base_url+"dashboard/get_sub_menu/",
            type: 'POST',
            dataType: "JSON",
            data:{menu_id:$(this).attr("data-menu-id")},
            success: function (data, status)
            {

            },
            error: function (xhr, desc, err)
            {
                console.log("error");

            }
        });
        return false;

    });
    //action for submenu click
    $(document).on("click", ".sub-menu-container .menu-item", function(event)
    {
        $.ajax({
            url: $(this).attr("data-menu-link"),
            type: 'POST',
            dataType: "JSON",
            success: function (data, status)
            {

            },
            error: function (xhr, desc, err)
            {
                console.log("error");

            }
        });


    });


});
function load_main_page()
{
    $.ajax({
        url: location,
        type: 'POST',
        dataType: "JSON",
        success: function (data, status)
        {
            $.ajax({
                url: base_url+"home/sidebar/",
                type: 'POST',
                dataType: "JSON",
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");

                }
            });

        },
        error: function (xhr, desc, err)
        {
            console.log("error");

        }
    });
}
function load_template(content)
{
    for(i=0;i<content.length;i++)
    {
        $(content[i].id).html(content[i].html);
        //console.log(content[i].id);
        //console.log(content[i].html);
    }
}
function animate_message(message)
{
    $("#message").hide();
    $("#message").html(message);
    $('#message').slideToggle("slow").delay(3000).slideToggle("slow");
    //$('#message').toggle("slide",{direction:"right"},500);

}
//call this function
//first parameter will be this
//2nd parameter will be with # for id . for class
function display_browse_image(brose_bttion,display_id)
{
    if (brose_bttion.files && brose_bttion.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e)
        {
            $(display_id).attr('src', e.target.result);
        }

        reader.readAsDataURL(brose_bttion.files[0]);
    }
}


function turn_off_triggers()
{
    $(document).off("change", "#year");
    $(document).off("change", "#season_id");
    $(document).off("change", "#crop_id");
    $(document).off("change", "#crop_type_id");
    $(document).off("change", "#principal_id");
    $(document).off("change", "#variety_id");
    $(document).off("change", "#day_number");
    $(document).off("change", "#flowering_time");
    $(document).off("blur",".crop_ordering");//at crop list.
    $(document).off("change",'input[name="variety_type"]:radio');//at create_crop_variety
    $(document).off("change","#select_all_variety");//at general sample delivery
    $(document).off("change", ".browse_button");//data-15-image,setup-15-days
    $(document).off("change", "#number_of_fifteendays");//setup-15-days
    $(document).off("change", "#harvest_no");//setup-15-days
    $(document).off("change", "#fruit_image_type");//data_image_fruit
    $(document).off("change", "#fruit_image_type");//data_image_fruit
    $(document).off("click", "#variety_button");//trail analysis report
    $(document).off("click", "#load_report");//trail analysis report
    $(document).off("click", "#load_pdf");//trail analysis report
    $(document).off("click", ".full_text_report");//trail analysis report
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}
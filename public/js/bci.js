/**
 * Created by Nick on 23/05/16.
 */

$(document).ready(function(){

    $("#confirmationBox").hide();

    $(".docs").hide();

    $("#ratesdoc").slideDown("fast", function(){});

    $("#admin_tab").click(function(){
        $(".panels").hide();
        $("#administration").slideDown("fast", function(){});
    });

    $("#notification_tab").click(function(){
        $(".panels").hide();
        $("#notifications").slideDown("fast", function(){});
    });

    $("#registration_tab").click(function(){
        $(".panels").hide();
        $("#viewregistration").slideDown("fast", function(){});
    });

    $("#rates_tab").click(function(){
        $(".panels").hide();
        $("#ratespricesanalyses").slideDown("fast", function(){});
        $("#ratesdoc").slideDown("fast", function(){});
    });

    $("#estimates_tab").click(function(){
        $(".panels").hide();
        $("#estimate").slideDown("fast", function(){});
    });

    $("#history_tab").click(function(){
        $(".panels").hide();
        $("#history").slideDown("fast", function(){});
    });

    //$('[data-toggle="confirmation"]').confirmation();

    $('[data-toggle="confirmation"]').confirmation({
        href: function(elem){
            return $(elem).attr('href');
        }
    });

    $('#datetimepicker').datetimepicker();

    $.get("nodes", function(data, status){

        console.log(data);

        $('#tree').treeview({

            data: data,

            enableLinks: true,

            onNodeSelected: function(event, data) {

                $("#buildingtype").text(data.subtypeString);

            }

        });

    });

    $("#usr").change(function(){

        $("#area").text($("#usr").val());

        if ($("#usr").val().length > 0) {

            $('#area-container').removeClass('has-error');

            $('#area-container').removeClass('has-feedback');

        }

        if ($("#usr").val().length == 0) {

            $('#area-container').addClass('has-error');

            $('#area-container').addClass('has-feedback');

        }  //if not empty

    });

    $("#feet").change(function(){
        $("#units").text("ft");
    });

    $("#meters").change(function(){
        $("#units").text("m");
    });

    $("#ratesbtn").click(function(){
        $(".docs").hide();
        $("#ratesdoc").slideDown("fast", function(){});
    });

    $("#pricesbtn").click(function(){
        $(".docs").hide();
        $("#analysisdoc").slideDown("fast", function(){});
    });

    $("#analysisbtn").click(function(){
        $(".docs").hide();
        $("#pricesdoc").slideDown("fast", function(){});
    });

});

function setPrice (val, blurb, node_id) {

    $("#node_id").val(node_id);

    $("#priceholder").val(val);

    $("#blurbholder").val(blurb);

    if (val > 0) {

        $('#doEstimateBtn').removeClass('disabled');

        $('#doEstimateBtn').removeClass('disableClick');

        $("#confirmationBox").show();

    }

    if (val < 1) {

        $('#doEstimateBtn').addClass('disabled');

        $('#doEstimateBtn').addClass('disableClick');

        $("#confirmationBox").hide();

    }

    window.location.href = "#doEstimateBtn";

}

function doEstimate () {

    //$("input[type='button']").click(function(){
        var radioValue = $("input[name='units']:checked").val();
        //if(radioValue){
            //alert("Your are a - " + radioValue);
        //}
    //});

    var user_id = $("#user_id").val();

    var node_id = $("#node_id").val();

    var area = $("#usr").val();

    var areaMultiplier = 1;

    if (radioValue == "feet") areaMultiplier = 10.764;

    var price = $("#priceholder").val();

    var blurb = $("#blurbholder").val();

    var result = price * (area / areaMultiplier);

    var estimateText = numberWithCommas(result.toFixed(2))

    $("#subtypeBlurb").text(blurb);

    $("#calculatedEstimate").text(estimateText);

    $.post( "calculations/create", { area: area, units: radioValue, estimate: "$"+estimateText, user_id: user_id, node_id: node_id } );

}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


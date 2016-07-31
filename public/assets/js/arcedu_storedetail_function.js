$( document ).ready(function() {
    $('input.typeaheadSaleDetail').typeahead({
        onSelect: function(item) {
            console.log(item);
            var res = item.text.split(" || ");
            if(res.length >= 2){
                $("#hProductSelect").attr("data-id", item.value);
                $("#hProductSelect").attr("data-name", res[0]);
                $("#hProductSelect").attr("data-code", res[1]);
                $("#hProductSelect").attr("data-total", res[2]);
                $("#hProductSelect").attr("data-price", res[3]);
                $("#hProductSelect").attr("value", "1");

            }else{
                alert("Algo salio mal... ");
            }
        },
        ajax: {
            url: "/storedetail/findTypeAheadSale",
            timeout: 500,
            displayField: "name",
            valueField: "id",
            triggerLength: 3,
            dataType: "JSON",
            method: "get",
            loadingClass: "loading-circle",
            preDispatch: function (query){
                $("#hProductSelect").attr("data-id", null);
                $("#hProductSelect").attr("data-name", null);
                $("#hProductSelect").attr("data-code", null);
                $("#hProductSelect").attr("data-total", null);
                $("#hProductSelect").attr("data-price", null);
                $("#hProductSelect").attr("value", "");
                return {
                    search: query
                }
            },
            preProcess: function (data){
                //showLoadingMask(false);
                if (data.success === false) {
                    // Hide the list, there was some error
                    return false;
                }
                // We good!
                return data.source;
            }
        }
    });

    $('#movementModal').on('shown.bs.modal', function (e) {
        $("#iSearch").val("");
        $("#listProduct").empty();
    });
});
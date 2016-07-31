$( document ).ready(function() {
    $('input.typeahead').typeahead({
        onSelect: function(item) {
            console.log(item);
            var res = item.text.split(" || ");
            if(res.length == 2){
                $("#hProductSelect").attr("data-id", item.value);
                $("#hProductSelect").attr("data-name", res[0]);
                $("#hProductSelect").attr("data-code", res[1]);
                $("#hProductSelect").attr("value", "1");
            }else{
                alert("Algo salio mal... ");
            }
        },
        ajax: {
            url: "/store/findTypeAhead",
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

    $('input.typeaheadSale').typeahead({
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
            url: "/store/findTypeAheadSale",
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

function saveNewProduct(modelProduct, modal){
    //console.log(modelPaymentMonth);
    $.ajax({
        url: "/store/newProduct",
        //data: {'obj': modelo.toJSON()},
        data: modelProduct.toJSON(),
        type: "post",
        headers: {
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            modal.modal('hide');
            if($.isNumeric(data))
                alert("Se grabo correctamente");
            else
                alert("Hubo un error");
        }
    }).fail( function( jqXHR ) {
        if (jqXHR.status == 422)
        {
            var form = modal.find("#formNewProduct");
            $.each(jqXHR.responseJSON, function (key, value) {
                $(form).find('#'+key).addClass("error_input");
                $(form).find('.error_'+key).empty();
                $(form).find('.error_'+key).append(value);

            });
        }else{
            location.reload();
        }
    });
}

function saveEditProduct(modelProduct, modal){
    $.ajax({
        url: "/store/editProduct",
        //data: {'obj': modelo.toJSON()},
        data: modelProduct.toJSON(),
        type: "post",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            modal.modal('hide');
            if($.isNumeric(data))
                alert("Se grabo correctamente");
            else
                alert("Hubo un error");
        }
    }).fail( function( jqXHR ) {
        if (jqXHR.status == 422)
        {
            var form = modal.find("#formEditProduct");
            $.each(jqXHR.responseJSON, function (key, value) {
                $(form).find('#'+key).addClass("error_input");
                $(form).find('.error_'+key).empty();
                $(form).find('.error_'+key).append(value);

            });
        }else{
            location.reload();
        }
    });
}

function allProductOnList(){
    var id = $("#hProductSelect").attr("data-id");
    var name = $("#hProductSelect").attr("data-text");
    if($("#hProductSelect").attr("value") === "1"){
        addProductList(id, name);
    }else {
        alert("Producto No Valido para insertar");
    }
}

function addProductList(id, name){
    $("#hProductSelect").val("");
    $("#iSearch").val("");
    var html = "<li class='list-group-item arcedi_list_item' data-id='"+id+"' data-name='"+name+"'>";
    html += "<a href=''#' onclick='removeProduct(this); return false;' class='badge'><span class='glyphicon glyphicon-trash'></span></a>";
    html += name;
    html += "</li>";

    if(validAllProduct(id)){
        $("#listProduct").append(html);
    }else{
        setMessageError("Producto repetido!", "Por favor seleccione otro producto.")
    }


}

function validAllProduct(id){
    var valid = true;
    var list = $("#listProduct").find("li");

    $.each(list, function(index, value){
        if($(value).attr("data-id") === id){
            valid = false;
            return;
        }
    });

    return valid;
}

function removeProduct(link){
    $(link).parent().remove();
}

function actionComprar(button){
    var ids = getIdProductList($("#listProduct").find("li"));
    if(ids !== ""){
        //alert("enviar a comprar: "+ids+" | "+$(button).attr("data-url"));
        window.location = $(button).attr("data-url")+"/ "+ids;
    }else{
        setMessageError("Sin productos!", "Por favor escoger productos.");
    }
}

function getIdProductList(listLi){
    var ids="";
    $.each(listLi, function(index, value){
        ids += $(value).attr("data-id")+",";
    });

    return ids;
}

function setMessageError(title, message){
    $('#dAlertProductRecurrent').addClass("in");
    $('#dAlertProductRecurrent').find("p").empty();
    $('#dAlertProductRecurrent').find("p").append("<p><strong>"+title+"</strong> "+message+"</p>");
    $('#dAlertProductRecurrent').show(0).delay(4000).hide(0);
}

function openNodalAddProduct(){
    var value = $("#hProductSelect").val();
    if($("#hProductSelect").attr("data-id") === "" || $("#hProductSelect").attr("data-id") == undefined){
        $(".typeaheadSale").val("");
        alert("Seleccione Producto...");
    }else{
        $('#mAddProductBuy').modal('show');
    }
}

function addProductTable(table, id, name, code, quantity, price){
    if(validProductRow(table, id)){
        addProductTd(table, id, name, code, quantity, price);
        getTotalTable(table);
    }else{
        alert("El producto "+name+" ya esta en la lista");
    }
}

function addProductDeliveryTable(table, id, name, code, quantity){
    if(validProductRow(table, id)){
        addProductDeliveryTd(table, id, name, code, quantity);
    }else{
        alert("El producto "+name+" ya esta en la lista");
    }
}

function addProductTd(table, id, name, code, quantity, price){
    var html = "<tr>";

    html += "<td><input type='hidden' value='"+id+"' >"+name+"</td>";
    html += "<td>"+code+"</td>";
    html += "<td>"+quantity+"</td>";
    html += "<td>"+price+"</td>";
    html += "<td>"+(quantity * price).toFixed(2)+"</td>";
    html += "<td><a href='#' onclick='removeTrProduct(this)'><span class='glyphicon glyphicon-trash'></span></a></td>";
    html += "</tr>";

    $(table).find("tbody").append(html);
}

function addProductDeliveryTd(table, id, name, code, quantity){
    var html = "<tr>";
    html += "<td><input type='hidden' value='"+id+"' >"+name+"</td>";
    html += "<td>"+code+"</td>";
    html += "<td>"+quantity+"</td>";
    html += "<td><a href='#' onclick='removeTrProduct(this)'><span class='glyphicon glyphicon-trash'></span></a></td>";
    html += "</tr>";

    $(table).find("tbody").append(html);
}

function numRow(table){
    return $(table).find("tbody tr").length;
}

function removeTrProduct(link){
    $(link).parent().parent().remove();
    getTotalTable($("#tProducts"));
}

function validProductRow(table, id){
    var tr = $(table).find("tbody tr");
    var valid = true;
    $.each(tr, function(index, item){
        console.log($(item).first().find("input").val());
        if($(item).first().find("input").val() == id){
            valid = false;
            return;
        }
    });
    return valid;
}

function getTotalTable(table){
    var total = 0;
    var tr = $(table).find("tbody tr");

    $.each(tr, function(index, item){
        var aux = $(item).children().next().next().next().next().text();
        total += parseFloat(aux);
    });

    $("#sTotalProduct").empty();
    $("#sTotalProduct").append(total.toFixed(2));
}

function getProductsForCollection(table){
    var tr = $(table).find("tbody tr");

    var product;
    var collection = new ProductsMovement();

    $.each(tr, function(index, item){
        product = new   ProductMovement();
        //alert($(item).children().next().next().html());
        product.set("id", $(item).first().find("input").val());
        product.set("quantity", $(item).children().next().next().html());
        product.set("coste", $(item).children().next().next().next().html());

        collection.add(product);
    });

    return collection;
}

function saveBuy(){

    $.ajax({
        url: "/store/saveBuy",
        //data: {'obj': modelo.toJSON()},
        data: {'proveedor': $("#iProvider").val(),
            'nit': $("#iNit").val(),
            'numDoc': $("#iDoc").val(),
            'total': $("#sTotalProduct").text(),
            'dateBuy': $("#dtpDateBuy").data('date') ,
            'lista': JSON.stringify(getProductsForCollection($("#tProducts")))},
        type: "post",
        contentType: "application/json;charset=utf-8",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        //processData: false,
        success:function (data) {
            window.location = '/store';
            //alert(data);
        }
    })
}

function saveSale(){

    $.ajax({
        url: "/store/saveSale",
        //data: {'obj': modelo.toJSON()},
        data: {'detail': $("#iProvider").val(),
            'ci': $("#iCi").val(),
            'total': $("#sTotalProduct").text(),
            'dateSale': $("#dtpDateSale").data('date') ,
            'lista': JSON.stringify(getProductsForCollection($("#tProducts")))},
        type: "post",
        contentType: "application/json;charset=utf-8",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        //processData: false,
        success:function (data) {
            window.location = '/store';
            //alert(data);
        }
    })
}

function saveSaleDetail(){

    $.ajax({
        url: "/storedetail/saveSale",
        //data: {'obj': modelo.toJSON()},
        data: {'detail': $("#iProvider").val(),
            'ci': $("#iCi").val(),
            'total': $("#sTotalProduct").text(),
            'dateSale': $("#dtpDateSale").data('date') ,
            'lista': JSON.stringify(getProductsForCollection($("#tProducts")))},
        type: "post",
        contentType: "application/json;charset=utf-8",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            window.location = '/storedetail';
        }
    })
}

function saveDelivery(){

    $.ajax({
        url: "/store/saveDelivery",
        //data: {'obj': modelo.toJSON()},
        data: {'detail': $("#iProvider").val(),
            'ci': $("#iCi").val(),
            'dateDelivery': $("#dtpDateDelivery").data('date') ,
            'lista': JSON.stringify(getProductsForCollection($("#tProducts")))},
        type: "post",
        contentType: "application/json;charset=utf-8",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        //processData: false,
        success:function (data) {
            window.location = '/store';
            //alert(data);
        }
    })
}

function saveRefund(){

    $.ajax({
        url: "/store/saveRefund",
        //data: {'obj': modelo.toJSON()},
        data: {'detail': $("#iDetail").val(),
            'ci': $("#iCi").val(),
            'dateDelivery': $("#dtpDateDelivery").data('date') ,
            'lista': JSON.stringify(getProductsForCollection($("#tProducts")))},
        type: "post",
        contentType: "application/json;charset=utf-8",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        //processData: false,
        success:function (data) {
            window.location = '/store';
            //alert(data);
        }
    })
}

function setModelDetailBuy(id){
    $.ajax({
        url: "/store/getDetailButAjax",
        data: {'buy_id': id},
        type: "post",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            console.log(data);
            $("#pBuyName").empty();
            $("#pBuyName").append(data.buy.razon_social);

            $("#pBuyNit").empty();
            $("#pBuyNit").append(data.buy.nit);

            $("#pBuyDoc").empty();
            $("#pBuyDoc").append(data.buy.num_doc);

            $("#pBuyDate").empty();
            $("#pBuyDate").append(data.buy.date_buy);

            $("#pBuyTotal").empty();
            $("#pBuyTotal").append(data.buy.total);

            var html = "";
            $.each(data.buyDetail, function(index, item){
                html += "<tr>";
                html += "<td>"+item.name+"</td>"+"<td style='text-align: right;'>"+item.price+"</td>"+"<td style='text-align: right;'>"+item.amount+"</td>";
                html += "<td style='text-align: right;'>"+(item.price*item.amount).toFixed(2)+"</td>"+"<td style='text-align: right;'>"+item.available+"</td>"
                html += "</tr>";
            });

            $("#tProducts tbody").empty();
            $("#tProducts tbody").append(html);
        }
    });
}

function setModelDetailSale(id){
    $.ajax({
        url: "/store/getDetailSaleAjax",
        data: {'sale_id': id},
        type: "post",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            $("#pSaleCi").empty();
            $("#pSaleCi").append(data.sale.ci);

            $("#pSaleDate").empty();
            $("#pSaleDate").append(data.sale.date_sale);

            $("#pSaleDetail").empty();
            $("#pSaleDetail").append(data.sale.detail);

            $("#pSaleTotal").empty();
            $("#pSaleTotal").append(data.sale.total);

            var html = "";
            $.each(data.saleDetail, function(index, item){
                html += "<tr>";
                html += "<td>"+item.name+"</td>"+"<td style='text-align: right;'>"+item.price_sale+"</td>"+"<td style='text-align: right;'>"+item.amount+"</td>";
                html += "<td style='text-align: right;'>"+(item.price_sale*item.amount).toFixed(2)+"</td>";
                html += "</tr>";
            });

            $("#tProducts tbody").empty();
            $("#tProducts tbody").append(html);
        }
    });
}

function setModelDetailDelivery(id){
    $.ajax({
        url: "/store/getDetailDeliveryAjax",
        data: {'delivery_id': id},
        type: "post",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            $("#pSaleCi").empty();
            $("#pSaleCi").append(data.delivery.ci);

            $("#pSaleDate").empty();
            $("#pSaleDate").append(data.delivery.date_delivery);

            $("#pSaleDetail").empty();
            $("#pSaleDetail").append(data.delivery.detail);


            var html = "";
            $.each(data.deliveryDetail, function(index, item){
                html += "<tr>";
                html += "<td>"+item.name+"</td>"+"<td style='text-align: right;'>"+item.amount+"</td>";
                html += "</tr>";
            });

            $("#tProducts tbody").empty();
            $("#tProducts tbody").append(html);
        }
    });
}

function setModelDetailRefund(id){
    $.ajax({
        url: "/store/getDetailRefundAjax",
        data: {'refund_id': id},
        type: "post",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            $("#pRefundCi").empty();
            $("#pRefundCi").append(data.refund.ci);

            $("#pRefundDate").empty();
            $("#pRefundDate").append(data.refund.date_refund);

            $("#pRefundDetail").empty();
            $("#pRefundDetail").append(data.refund.detail);


            var html = "";
            $.each(data.refundDetail, function(index, item){
                html += "<tr>";
                html += "<td>"+item.name+"</td>"+"<td style='text-align: right;'>"+item.amount+"</td>";
                html += "</tr>";
            });

            $("#tProducts tbody").empty();
            $("#tProducts tbody").append(html);
        }
    });
}
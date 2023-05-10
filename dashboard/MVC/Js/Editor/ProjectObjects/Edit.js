
$(document).ready(function () {

    $('.Field_AI').each(function () {
        ChangeElementsOnClickAI(this);
    });

    $('.Field_AI').click(function () {
        ChangeElementsOnClickAI(this);
    });

    $('.Field_Pk').each(function () {
        ChangeElementsOnClickPK(this);
    });

    $('.Field_Pk').click(function () {
        ChangeElementsOnClickPK(this);
    });

    $('.Field_Unique').each(function () {
        ChangeElementsOnClickUnique(this);
    });

    $('.Field_Unique').click(function () {
        ChangeElementsOnClickUnique(this);
    });

    $('.Field_Null').each(function () {
        ChangeElementsOnClickNull(this);
    });

    $('.Field_Null').click(function () {
        ChangeElementsOnClickNull(this);
    });

});
            

function ConfirmDeleteField(Element){

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('data-url'),
        type: 'POST',
        cache: false,
        data : { 
            'data-field'        : Element.getAttribute('data-field'),
            'data-table'        : Element.getAttribute('data-table'),
            'data-projectname'  : Element.getAttribute('data-projectname'),
            'data-idfield'      : Element.getAttribute('data-idfield'),
        },
        success: function (data) {
            // Add to body
            $('body').append(data);
        }
    });

}

function DeleteField(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('data-url'),
        type: 'POST',
        cache: false,
        data : { 
            'data-field'        : Element.getAttribute('data-field'),
            'data-table'        : Element.getAttribute('data-table'),
            'data-projectname'  : Element.getAttribute('data-projectname'),
            'data-idfield'      : Element.getAttribute('data-idfield'),
        },
        success: function (data) {
            // Add to body
            var TrDelete = $('#Field_'+Element.getAttribute('data-idfield'));
            TrDelete.remove();

            $(".alert").each(function(){
                this.remove();
            });

            $('body').append(data);
        }
    });
}

function AlertInput_AddField(Element){

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('data-url') + "?Ctrl=Editor/ProjectObjects&Do=Edit&Action=AlertInput_AddField",
        type: 'POST',
        cache: false,
        data : {
            'data-table' : Element.getAttribute('data-table'),
            'data-projectname' : Element.getAttribute('data-projectname'),
        },
        success: function (data) {
            // Add to Body
            $('body').append(data);
        },
        error: function (data){
            alert(data);
        }
    });

}


function AddField(Element){

    var Father = Element.getAttribute('father');
    var input = Element.getAttribute('input');

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('data-url'),
        type: 'POST',
        cache: false,
        data : { 
            'data-projectname' : Element.getAttribute('data-projectname'),
            'data-field' : $('#'+input).val(),
            'data-table' : Element.getAttribute('data-table'),
        },
        success: function (data) {
            // Alert close
            $('#'+Father).remove();
            NoDisplayPageView($('#PageView_ProjectObjects'));
            
            var TrAdd = $('#Table_Fields').find('tbody');
            TrAdd.append(data);

        },
        error: function (data) {
            alert("Ups! Something went wrong");
        }
    }); 


}

function EditField(Element){

    var IdField = Element.getAttribute('data-idfield');

    var Name    = $('#Field_'+IdField+'_Name').val();
    var Type    = $('#Field_'+IdField+'_Type').val();
    var Length  = $('#Field_'+IdField+'_Length').val();
    var AI      = $('#Field_'+IdField+'_AI').attr('checked');
    var Default = $('#Field_'+IdField+'_Default').val();
    var Pk      = $('#Field_'+IdField+'_Pk').attr('checked');
    var Unique  = $('#Field_'+IdField+'_Unique').attr('checked');
    var Null    = $('#Field_'+IdField+'_Null').attr('checked');
    
    // else AI = 0;
    if (AI == 'checked') AI = 1;
    if (AI == undefined) AI = 0;

    if (Pk == 'checked') Pk = 1;
    if (Pk == undefined) Pk = 0;

    if (Unique == 'checked') Unique = 1;
    if (Unique == undefined) Unique = 0;

    if (Null == 'checked') Null = 1;
    if (Null == undefined) Null = 0;

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('data-url') + "?Ctrl=Editor/ProjectObjects&Do=Edit&Action=EditField",
        type: 'POST',
        cache: false,
        data : {
            'data-table'         : Element.getAttribute('data-table'),
            'data-projectname'   : Element.getAttribute('data-projectname'),
            'data-name'          : Name,
            'data-type'          : Type,
            'data-length'        : Length,
            'data-ai'            : AI,
            'data-default'        : Default,
            'data-pk'            : Pk,
            'data-unique'        : Unique,
            'data-null'          : Null,
        },
        success: function (data) {
            // Add to Body
            $('body').append(data);
        }
    });

}


function ChangeElementsOnClickAI(Element){

    var checked = false;

    if (Element.checked == true){
        checked = true;
    }

    var IdField = Element.getAttribute('IdField');

    var Field_Null      = $('#Field_'+IdField+'_Null');
    var Field_Unique    = $('#Field_'+IdField+'_Unique');

    if (checked == true){
        Field_Null.attr('disabled', 'disabled');
        Field_Unique.attr('disabled', 'disabled');
    }else{
        Field_Null.removeAttr('disabled');
        Field_Unique.removeAttr('disabled');
    }

}

function ChangeElementsOnClickPK(Element){

    var checked = false;

    if (Element.checked == true){
        checked = true;
    }

    var IdField = Element.getAttribute('IdField');
    var Field_Null      = $('#Field_'+IdField+'_Null');

    if (checked == true){
        Field_Null.attr('disabled', 'disabled');
    }else{
        Field_Null.removeAttr('disabled');
    }

}

function ChangeElementsOnClickUnique(Element){

    var checked = false;

    if (Element.checked == true){
        checked = true;
    }

    var IdField = Element.getAttribute('IdField');
    var Field_Null      = $('#Field_'+IdField+'_Null');

    if (checked == true){
        Field_Null.attr('disabled', 'disabled');
    }else{
        Field_Null.removeAttr('disabled');
    }

}

function ChangeElementsOnClickNull(Element){

    var checked = false;

    if (Element.checked == true){
        checked = true;
    }

    var IdField = Element.getAttribute('IdField');
    var Field_Unique    = $("#Field_"+IdField+"_Unique");
    var Field_Pk        = $("#Field_"+IdField+"_Pk");
    var Field_AI        = $("#Field_"+IdField+"_AI");

    if (checked == true){
        Field_Unique.attr('disabled', 'disabled');
        Field_Pk.attr('disabled', 'disabled');
        Field_AI.attr('disabled', 'disabled');
    }else{
        Field_Unique.removeAttr('disabled');
        Field_Pk.removeAttr('disabled');
        Field_AI.removeAttr('disabled');
    }


}
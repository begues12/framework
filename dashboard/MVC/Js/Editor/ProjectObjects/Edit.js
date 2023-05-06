
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
            

function DeleteField(Element){

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Action=DeleteField",
        type: 'POST',
        cache: false,
        data : { 
            'Field' : Element.getAttribute('Field'),
            'Table' : Element.getAttribute('Table'),
            'ProjectName' : Element.getAttribute('ProjectName'),
        },
        success: function (data) {
            // Add to body
            $('body').append(data);

            var TrDelete = $('#Field_'+Element.getAttribute('Id_Field'));
            TrDelete.remove();
        }
    });

}

function AddField(Element){

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Do=Edit&Action=AlertInput_AddField",
        type: 'POST',
        cache: false,
        data : {
            'Table' : Element.getAttribute('Table'),
            'ProjectName' : Element.getAttribute('ProjectName'),
        },
        success: function (data) {
            // Add to Body
            $('body').append(data);
        }
    });

}

function EditField(Element){

    var IdField = Element.getAttribute('IdField');

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
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Do=Edit&Action=EditField",
        type: 'POST',
        cache: false,
        data : {
            'Table'         : Element.getAttribute('Table'),
            'ProjectName'   : Element.getAttribute('ProjectName'),
            'Name'          : Name,
            'Type'          : Type,
            'Length'        : Length,
            'AI'            : AI,
            'Default'       : Default,
            'Pk'            : Pk,
            'Unique'        : Unique,
            'Null'          : Null,
        },
        success: function (data) {
            // Add to Body
            $('body').append(data);
        }
    });

}

function AjaxAddField(Element){

    var Father = Element.getAttribute('father');
    var input = Element.getAttribute('input');

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url'),
        type: 'POST',
        cache: false,
        data : { 
            'ProjectName' : Element.getAttribute('ProjectName'),
            'Field' : $('#'+input).val(),
            'Table' : Element.getAttribute('Table'),
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

function UpdateDataField(Element){

    var FormJson = $('#FormObjectEdit').serializeArray();
    var jsonData = JSON.stringify(FormJson);

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Action=UpdateDataField",
        type: 'POST',
        datatype: 'json',
        cache: false,
        data : { 
            // Get Form Data
            'XML_FILE' : Element.getAttribute('XML_FILE'),
            'Data' : jsonData,
        },
        success: function (data) {
            NoDisplayPageView($('#PageView_ProjectObjects'));
        }
    });
}

function AddRelation(Element){

}

function AddRelationButton(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Do=Edit&Action=AddRelation",
        type: 'POST',
        cache: false,
        data : { 
            'XML_FILE' : Element.getAttribute('XML_FILE'),
            'ProjectName' : Element.getAttribute('ProjectName'),
        },
        success: function (data) {
            NoDisplayPageView($('#PageView_ProjectObjects'));

            var TrAdd = $('#Table_Relations');
            TrAdd.append(data);
            
        }
    });  
}

function DeleteRelation(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Action=DeleteRelation",
        type: 'POST',
        cache: false,
        data : {
            'XML_FILE' : Element.getAttribute('XML_FILE'),
            'IdRelation' : Element.getAttribute('Id_Relation'),
        },
        success: function (data) {
            NoDisplayPageView($('#PageView_ProjectObjects'));

            var TrDelete = $('#Relations_Relation_'+Element.getAttribute('Id_Relation'));
            TrDelete.remove();
        }
    });

}

function ChangeRelationFKTable(Element){

    // Activate or disable FK Field option
    var FKTable = Element.value;

    var Relations_Relation = $('#Relations_Relation_'+Element.getAttribute('data-id')+'_FKField');
    // alert(Relations_Relation.attr('id'));
    // display none all options
    Relations_Relation.find('option').each(function () {
        $(this).css('display', 'none');
    });

    // display only options with FKTable value
    Relations_Relation.find('option').each(function () {
        if ($(this).attr('fkTable') == FKTable){
            $(this).css('display', 'block');
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
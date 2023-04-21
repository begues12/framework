
$(document).ready(function () {

    $('#Sidebar_PageView').on('click', function () {
        $.ajax({
            // Get attributes url
            url: this.getAttribute('Url'),
            type: 'POST',
            data : { 
                Ctrl : this.getAttribute('Ctrl'),
            },
            success: function (data) {
                NoDisplayPageView();
                $('#PageView_IFrame').contents().find('body').html(data);
                $('#PageView_IFrame').css('display', 'block');
            }
        });
    });

    $('#Sidebar_Objects').on('click', function () {
        LoadProjectObject(this);
    });

    // Sidebar_Files
    $('#Sidebar_Files').on('click', function () {
        $.ajax({
            // Get attributes url
            url: this.getAttribute('Url'),
            type: 'POST',
            data : { 
                ProjectName : this.getAttribute('ProjectName'),
                ProjectPath : this.getAttribute('ProjectPath')
            },
            success: function (data) {
                NoDisplayPageView();
                $('#PageView_ProjectFiles').html(data);
                $('#PageView_ProjectFiles').css( 'display', 'block');
            }
        });

    });

    $('#Sidebar_Config').on('click', function () {
        $.ajax({
            // Get attributes url
            url: this.getAttribute('Url'),
            type: 'POST',
            data : { 
                ProjectName : this.getAttribute('ProjectName'),
                ProjectPath : this.getAttribute('ProjectPath')
            },
            success: function (data) {
                NoDisplayPageView();
                $('#PageView_ProjectConfig').html(data);
                $('#PageView_ProjectConfig').css( 'display', 'block');
            }
        });

    });

});


function LoadProjectObject(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url'),
        type: 'POST',
        data : {
            ProjectName : Element.getAttribute('ProjectName'),
        },
        success: function (data) {
            NoDisplayPageView();
            $('#PageView_ProjectObjects').html(data);
            $('#PageView_ProjectObjects').css('display', 'block');
        }
    });
}

function FileBox(FileBox){
    $.ajax({
        // Get attributes url
        url: FileBox.getAttribute('Url'),
        type: 'POST',
        data : { 
            ProjectName : FileBox.getAttribute('ProjectName'),
            ProjectPath : FileBox.getAttribute('ProjectPath')
        },
        success: function (data) {
            NoDisplayPageView();
            $('#PageView_ProjectFiles').html(data);
            $('#PageView_ProjectFiles').css('display', 'block');
        }
    });
}

function AddObject(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url'),
        type: 'POST',
        data : { 
            ObjectName : ObjectName,
            ProjectName : ProjectName,
            ProjectPath : ProjectPath
        },
        success: function (data) {
            NoDisplayPageView();
            $('#PageView_ProjectObjects').html(data);
            $('#PageView_ProjectObjects').css('display', 'block');
        }
    });
}

function EditObject(FileBox){
    $.ajax({
        // Get attributes url
        url: FileBox.getAttribute('Url'),
        type: 'POST',
        data : { 
            ObjectPath : FileBox.getAttribute('ObjectPath'),
            ProjectName : FileBox.getAttribute('ProjectName'),
        },
        success: function (data) {
            NoDisplayPageView();
            $('#PageView_ProjectFiles').html(data);
            $('#PageView_ProjectFiles').css('display', 'block');
        }
    });
}

function NoDisplayPageView(Except = null){
    ///Display None all Elements in PageView class
    $(".PageView").each(function () {
        if (Except == null || Except.attr('id') == $(this).attr('id')){
            $(this).css('display', 'none');
        }
    });
}

function DeleteField(Element){

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Action=DeleteField",
        type: 'POST',
        data : { 
            'XML_FILE' : Element.getAttribute('XML_FILE'),
            'IdField' : Element.getAttribute('Id_Field'),
        },
        success: function (data) {
            NoDisplayPageView($('#PageView_ProjectObjects'));

            var TrDelete = $('#Fields_Field_'+Element.getAttribute('Id_Field'));
            TrDelete.remove();
        }
    });

}

function AddField(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Action=AddField",
        type: 'POST',
        data : { 
            'XML_FILE' : Element.getAttribute('XML_FILE'),
        },
        success: function (data) {
            NoDisplayPageView($('#PageView_ProjectObjects'));

            var TrAdd = $('#Table_Fields');
            TrAdd.append(data);
            
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

function EditField(Element){
    alert("Edit");
}

function AddRelation(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url') + "?Ctrl=Editor/ProjectObjects&Action=AddRelation",
        type: 'POST',
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
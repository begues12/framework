
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
        $.ajax({
                // Get attributes url
                url: this.getAttribute('Url'),
                type: 'POST',
                data : {
                    ProjectName : this.getAttribute('ProjectName'),
                },
                success: function (data) {
                    NoDisplayPageView();
                    $('#PageView_ProjectObjects').html(data);
                    $('#PageView_ProjectObjects').css('display', 'block');
                }
            });
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

            var TrDelete = $('#Field_'+Element.getAttribute('Id_Field'));
            TrDelete.remove();
        }
    });

}

function AddField(Element){
    alert("Add");   
}

function EditField(Element){
    alert("Edit");
}

function AddRelation(Element){
    alert("AddRelation");
}

function SubmitEditObject(Element){
    alert("SubmitEditObject");
}
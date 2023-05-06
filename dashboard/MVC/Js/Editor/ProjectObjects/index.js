
function ConfirmDelete(Element){

    // Ajax call to delete object
    $.ajax({
        url: Element.getAttribute("Url")+ "?Ctrl=Editor/ProjectObjects&Do=Index&Action=ConfirmDeleteObject",
        type: "POST",
        data: { 
            IdField : Element.getAttribute("IdField"),
            NameTable : Element.getAttribute("NameTable"),
            ProjectName : Element.getAttribute("ProjectName")
        },
        success: function (data) {
            $("body").append(data);
        },
        error: function (data) {
            alert("Error: " + data);
        }
    });

}

function DeleteObject(Element){

    var IdField = Element.getAttribute("data-idfield");

    $.ajax({
        url: Element.getAttribute("data-url")+ "?Ctrl=Editor/ProjectObjects&Do=Index&Action=DeleteObject",
        type: "POST",
        data: { 
            NameTable : Element.getAttribute("data-nametable"),
            ProjectName : Element.getAttribute("data-projectname")

        },
        success: function (data) {
            $("body").append(data);

            $("#Tr_Object_"+IdField).remove();

        },
        error: function (data) {
            alert("Error: " + data);
        }
    });

}

function EditObject(FileBox){
    $.ajax({
        // Get attributes url
        url: FileBox.getAttribute('Url'),
        type: 'POST',
        cache: false,
        data : { 
            ObjectPath : FileBox.getAttribute('ObjectPath'),
            ProjectName : FileBox.getAttribute('ProjectName'),
            Object: FileBox.getAttribute('Object'),
        },
        success: function (data) {
            NoDisplayPageView();
            $('#PageView_ProjectFiles').html(data);
            $('#PageView_ProjectFiles').css('display', 'block');
        }
    });
}

function ShowObject(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url'),
        type: 'POST',
        cache: false,
        data : { 
            ObjectPath : Element.getAttribute('ObjectPath'),
            ProjectName : Element.getAttribute('ProjectName'),
            Object: Element.getAttribute('Object'),
        },
        success: function (data) {
            NoDisplayPageView();
            $('#PageView_ProjectFiles').html(data);
            $('#PageView_ProjectFiles').css('display', 'block');
        }
    });
}
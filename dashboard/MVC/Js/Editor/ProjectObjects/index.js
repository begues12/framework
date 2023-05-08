function ConfirmDelete(Element){

    // Ajax call to delete object
    $.ajax({
        url: Element.getAttribute("data-url")+ "?Ctrl=Editor/ProjectObjects&Do=Index&Action=ConfirmDeleteObject",
        type: "POST",
        data: { 
            'data-idfield'      : Element.getAttribute("data-idfield"),
            'data-table'        : Element.getAttribute("data-table"),
            'data-projectname'  : Element.getAttribute("data-projectname")
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

    var data_idfield = Element.getAttribute("data-idfield");

    $.ajax({
        url: Element.getAttribute("data-url")+ "?Ctrl=Editor/ProjectObjects&Do=Index&Action=DeleteObject",
        type: "POST",
        data: { 
            'data-tablename'   : Element.getAttribute("data-nametable"),
            'data-projectname' : Element.getAttribute("data-projectname")

        },
        success: function (data) {
            $("body").append(data);

            $("#Tr_Object_"+data_idfield).remove();

        },
        error: function (data) {
            alert("Error: " + data);
        }
    });

}

function EditObject(Element){
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('data-url'),
        type: 'POST',
        cache: false,
        data : { 
            'data-table'        : Element.getAttribute('data-table'),
            'data-projectname'  : Element.getAttribute('data-projectname'),
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
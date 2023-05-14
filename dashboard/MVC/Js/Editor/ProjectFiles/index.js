function OpenFileBox(Element){

    $('#LoadSpinner').css('display', 'block');
 
    var data_filePath = Element.getAttribute("data-filepath");
    var data_absolutefilepath = Element.getAttribute("data-absolutepath");
    var InputUrl = $('#InputUrl');

    $.ajax({
        url: Element.getAttribute("data-url") + "?Ctrl=Editor/ProjectFiles&Do=OpenFile",
        type: "POST",
        cache: false,
        data: { 
            'data-filePath'     : data_filePath,
            'data-absolutepath' : data_absolutefilepath 
        },
        success: function (data) {
            SetUndo();
            NoDisplayFileView($('#FileView_ShowFiles'));
            $('#FileView_ShowFiles').html(data);
            InputUrl.val(Element.getAttribute("data-absolutepath"));
            $('#LoadSpinner').css('display', 'none');
        }
    });

}

function OpenDirBox(Element){

    var data_projecturl = Element.getAttribute("data-projecturl");
    var data_projectname = Element.getAttribute("data-projectname");

    $.ajax({
        url: Element.getAttribute("data-url") + "?Ctrl=Editor/ProjectFiles",
        type: "POST",
        cache: false,
        data: { 
            'data-projecturl'  : data_projecturl,
            'data-projectname' : data_projectname
        },
        success: function (data) {
            SetUndo();
            NoDisplayFileView($('#FileView_ShowFiles'));
            $('#FileView_ShowFiles').html(data);
            InputUrl.val(Element.getAttribute("data-projecturl"));
            $('#LoadSpinner').css('display', 'none');
        }
    });

}

function NoDisplayFileView(Except = null){
    ///Display None all Elements in PageView class
    $(".FileView").each(function () {
        if (Except == null || Except.attr('id') == $(this).attr('id')){
            $(this).css('display', 'none');
        }else{
            $('#'+Except.attr('id')).css('display', 'block');
        }
    });
}

function SetUndo(){

    var InputUrl = $('#InputUrl');
    var Url = InputUrl.val();

    // Quit last / in Url
    if(Url.substr(-1) == '/'){
        Url = Url.substr(0, Url.length - 1);
    }

    // Get last / in Url
    var lastSlash = Url.lastIndexOf("/");
    var newUrl = Url.substring(0, lastSlash);

    // Set new Url
    $('#InputUrl').val(newUrl);
}

function UndoButton(){

    $

}
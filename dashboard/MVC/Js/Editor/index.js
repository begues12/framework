
$(document).ready(function () {

    $('#Sidebar_PageView').on('click', function () {
        $('#LoadSpinner').css('display', 'block');

        $.ajax({
            // Get attributes url
            url: this.getAttribute('Url'),
            type: 'POST',
            cache: false,
            data : { 
                Ctrl : this.getAttribute('Ctrl'),
            },
            success: function (data) {
                SetColorSidebar_Button($('#Sidebar_PageView'));
                NoDisplayPageView();
                $('#PageView_IFrame').contents().find('body').html(data);
                $('#PageView_IFrame').css('display', 'block');
                $('#LoadSpinner').css('display', 'none');
            }
        });
    });

    $('#Sidebar_Objects').on('click', function () {
        LoadProjectObject(this);
    });

    // Sidebar_Files
    $('#Sidebar_Files').on('click', function () {
        $('#LoadSpinner').css('display', 'block');

        $.ajax({
            // Get attributes url
            url: this.getAttribute('data-url'),
            type: 'POST',
            cache: false,
            data : { 
                'data-projectname' : this.getAttribute('data-projectname'),
                'data-projecturl' : this.getAttribute('data-projecturl'),
            },
            success: function (data) {
                SetColorSidebar_Button($('#Sidebar_Files'));
                NoDisplayPageView();
                $('#PageView_ProjectFiles').html(data);
                $('#PageView_ProjectFiles').css( 'display', 'block');
                $('#LoadSpinner').css('display', 'none');

            }
        });

    });

    $('#Sidebar_Config').on('click', function () {
        $('#LoadSpinner').css('display', 'block');

        $.ajax({
            // Get attributes url
            url: this.getAttribute('Url'),
            type: 'POST',
            cache: false,
            data : { 
                ProjectName : this.getAttribute('ProjectName'),
                ProjectPath : this.getAttribute('ProjectPath')
            },
            success: function (data) {
                SetColorSidebar_Button($('#Sidebar_Config'));
                NoDisplayPageView();
                $('#PageView_ProjectConfig').html(data);
                $('#PageView_ProjectConfig').css( 'display', 'block');
                $('#LoadSpinner').css('display', 'none');
            }
        });

    });

});


function LoadProjectObject(Element){
    $('#LoadSpinner').css('display', 'block');

    $.ajax({
        // Get attributes url
        url: Element.getAttribute('data-url'),
        type: 'POST',
        cache: false,
        data : {
            'data-projectname' : Element.getAttribute('data-projectname'),
        },
        success: function (data) {
            SetColorSidebar_Button($('#Sidebar_Objects'));
            NoDisplayPageView();
            $('#PageView_ProjectObjects').html(data);
            $('#PageView_ProjectObjects').css('display', 'block');
            $('#LoadSpinner').css('display', 'none');
        }
    });
}


function AddObject(Element){
    $('#LoadSpinner').css('display', 'block');
    $.ajax({
        // Get attributes url
        url: Element.getAttribute('Url'),
        type: 'POST',
        cache: false,
        data : { 
            ObjectName : ObjectName,
            ProjectName : ProjectName,
            ProjectPath : ProjectPath
        },
        success: function (data) {
            NoDisplayPageView();
            $('#PageView_ProjectObjects').html(data);
            $('#PageView_ProjectObjects').css('display', 'block');
            $('#LoadSpinner').css('display', 'none');
        }
    });
}


function SetColorSidebar_Button(Element){
    // Set color for Sidebar Button
    $(".Sidebar_Button").each(function () {
        // Add background dark class
        $(this).addClass('bg-light');
        $(this).removeClass('bg-primary');

        $(this).css('color', 'black');
        
        if (Element.attr('id') == $(this).attr('id')){
            // Remove background dark class
            $(this).removeClass('bg-light');
            $(this).addClass('bg-primary');
            $(this).css('color', 'white');
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


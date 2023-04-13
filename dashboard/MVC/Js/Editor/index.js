
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
                $('#PageView_IFrame').contents().find('body').html(data);
                $('#PageView_IFrame').css('display', 'block');
                $('#PageView_ProjectFiles').css('display', 'none');
            }
        });
    });

    $('#Sidebar_Objects').on('click', function () {
        
        $.ajax({
            url: '/framework/Engine/Projects/asd/MVC/Objects/index.php',
            type: 'GET',
            success: function (data) {
                $('#PageView_IFrame').css('display', 'block');
                $('#PageView_ProjectFiles').css('display', 'none');
                $('#PageView_ProjectFiles').html(data);

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
                $('#PageView_IFrame').css('display', 'none');
                $('#PageView_ProjectFiles').html(data);
                $('#PageView_ProjectFiles').css( 'display', 'block');
            }
        });

    });

    $('.DirBox').on('click', function () {
        alert("asd");
        $.ajax({
            // Get attributes url
            url: this.getAttribute('Url'),
            type: 'POST',
            data : { 
                ProjectName : this.getAttribute('ProjectName'),
                ProjectPath : this.getAttribute('ProjectPath')
            },
            success: function (data) {
                $('#PageView_IFrame').css('display', 'none');
                $('#PageView_ProjectFiles').html(data);
                $('#PageView_ProjectFiles').css( 'display', 'block');
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
            $('#PageView_IFrame').css('display', 'none');
            $('#PageView_ProjectFiles').html(data);
            $('#PageView_ProjectFiles').css('display', 'block');
        }
    });
}
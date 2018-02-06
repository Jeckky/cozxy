/**
 * Created by npr on 6/4/2017 AD.
 */
var uploadCount = 0;

/**
 * Created by npr on 6/2/2018 Taninut.Bm.
 */


$('#page-messages-aside-nav-toggle').on('click', function () {
    $(this)[
            $('#page-messages-aside-nav').toggleClass('show').hasClass('show') ? 'addClass' : 'removeClass'
    ]('active');
});
$("#page-messages-new-to").select2({
    data: [{id: 0, text: 'rjang@example.com'}, {id: 1, text: 'mbortz@example.com'}, {id: 2, text: 'towens@example.com'}, {id: 3, text: 'dsteiner@example.com'}, ],
    tags: true,
    tokenSeparators: [',', ' ']
});
$('#page-messages-new-text').summernote({
    height: 200,
    toolbar: [
        ['parastyle', ['style']],
        ['fontstyle', ['fontname', 'fontsize']],
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
        ['history', ['undo', 'redo']],
        ['misc', ['codeview', 'fullscreen']],
        ['help', ['help']]
    ],
});


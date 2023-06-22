let fileupload = document.querySelector('#image');
fileupload.onchange=function(){
    uplaodImg(this);
};
function uplaodImg(image){
    let reader = new FileReader();
    let name = image.value;
    name = name.substring(name.lastIndexOf('\\')+1);
    reader.onload = (e)=>{
        // debugger;
        let preview = document.querySelector('#previewImg');
        preview.setAttribute('src',e.target.result);
        hide(preview);
        fadeIn2(preview,700);
    }
    reader.readAsDataURL(image.files[0]);
}

// edit profile
const btnE = document.querySelector('#btnEdit');
btnE.addEventListener('click',()=>{
    document.querySelector('#title').removeAttribute('disabled');
    document.querySelector('#sumber').removeAttribute('disabled');
    document.querySelector('#category_id').removeAttribute('disabled');
    document.querySelector('#body').removeAttribute('disabled');
    document.querySelector('#image').removeAttribute('disabled');
    CKEDITOR.replace('body',{
        toolbar: [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ]},
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'insert', items: [ 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'others', items: [ '-' ] }
    ],
    });
    btnE.setAttribute('disabled','');
    btnE.classList.remove('btn-primary');
    btnE.classList.add('btn-dark');
    document.querySelector('#btnS').classList.remove('d-none');
});

// edit profile
const btnE = document.querySelector('#btnEdit');
btnE.addEventListener('click',()=>{
    document.querySelector('#username').removeAttribute('disabled');
    document.querySelector('#email').removeAttribute('disabled');
    document.querySelector('#name').removeAttribute('disabled');
    btnE.setAttribute('disabled','');
    btnE.classList.remove('btn-primary');
    btnE.classList.add('btn-dark');
    document.querySelector('#btnS').classList.remove('d-none');
});

const myTable = document.querySelector('#tb-users');
let dataTable = new simpleDatatables.DataTable(myTable, {
    paging: true,
    perPage: 5,
    perPageSelect: [5, 10, 20],
    columns:[
        {select:[0,4,5],searchable:false}
    ],
});

document.querySelector('#resetData').addEventListener('click',()=>{
    document.querySelector('#addForm').reset();
    document.querySelector('#previewImg').setAttribute('src','');
});

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

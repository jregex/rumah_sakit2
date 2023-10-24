// edit profile company
const btnE = document.querySelector("#btnEdit");
btnE.addEventListener("click", () => {
    document.querySelector("#nama").removeAttribute("disabled");
    document.querySelector("#email").removeAttribute("disabled");
    document.querySelector("#profile").removeAttribute("disabled");
    document.querySelector("#lat").removeAttribute("disabled");
    document.querySelector("#long").removeAttribute("disabled");
    document.querySelector("#alamat").removeAttribute("disabled");
    document.querySelector("#desc").removeAttribute("disabled");
    btnE.setAttribute("disabled", "");
    btnE.classList.remove("btn-primary");
    btnE.classList.add("btn-dark");
    document.querySelector("#btnS").classList.remove("d-none");
});

let fileupload = document.querySelector("#profile");
fileupload.onchange = function () {
    uplaodImg(this);
};
function uplaodImg(image) {
    let reader = new FileReader();
    let name = image.value;
    name = name.substring(name.lastIndexOf("\\") + 1);
    reader.onload = (e) => {
        // debugger;
        let preview = document.querySelector("#previewImg");
        preview.setAttribute("src", e.target.result);
        hide(preview);
        fadeIn2(preview, 700);
    };
    reader.readAsDataURL(image.files[0]);
}

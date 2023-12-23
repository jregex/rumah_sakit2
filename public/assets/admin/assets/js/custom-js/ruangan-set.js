const myTable = document.querySelector("#tb-ruangan");
let dataTable = new simpleDatatables.DataTable(myTable, {
    paging: true,
    perPage: 5,
    perPageSelect: [5, 10, 20],
    columns: [{ select: [0, 4], searchable: false }],
});

document.querySelector("#resetData").addEventListener("click", () => {
    document.querySelector("#addForm").reset();
    document.querySelector("#previewImg").setAttribute("src", "");
});

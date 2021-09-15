function showConfirm(id){
    document.getElementById(id).classList.remove("d-none"); ;
}
function deleteConfirmed(id){
    location.href = "../../src/controler/deleteFornecedor.php?id=" + id;
}
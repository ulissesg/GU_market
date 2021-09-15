function showConfirm(id){
    document.getElementById(id).classList.remove("d-none"); 
}
function deleteConfirmed(id){
    location.href = "../../src/controler/deleteProduto.php?id=" + id;
    document.getElementById(id).classList.add("d-none"); 
}

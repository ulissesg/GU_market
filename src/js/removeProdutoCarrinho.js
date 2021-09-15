function showConfirm(id){
    document.getElementById(id).classList.remove("d-none"); ;
}
function deleteConfirmed(id){
    location.href = "../../src/controler/excluirProdutoCarrinho.php?id=" + id;
}
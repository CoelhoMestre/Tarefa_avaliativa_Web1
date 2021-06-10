function deletarProdutos(id, name){
    var resp = confirm(`Este produro será deletado, deseja confirmar?`);

   
    if(resp){
        window.location.href = `./apagar-produto.php?id=${id}`
    }
}
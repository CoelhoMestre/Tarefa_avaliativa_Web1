function deletarVendas(id){
    var resp = confirm(`Apagar venda `+id);

    if(resp){
        window.location.href = `./apagar-venda.php?id=${id}`
    }
}
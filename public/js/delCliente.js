function deletarClientes(id, name){
    var resp = confirm(`O resgistro do cliente será deletado`);

    
    if(resp){
        window.location.href = `./apagar-cliente.php?id=${id}`
    }
}
//Remoção de produtos
var removeLinks = document.getElementsByClassName('remove-link');
for (var i = 0; i < removeLinks.length; i++) {
  removeLinks[i].addEventListener('click', function(event) {
    event.preventDefault();
    var id = this.dataset.id;
    Swal.fire({
      title: 'Tem certeza que deseja remover esse produto?',
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '?page=1&action=remove&id=' + id;
      }
    })
  });
}

//Remoção de imagens
var removeLinks = document.getElementsByClassName('removeImage-link');
for (var i = 0; i < removeLinks.length; i++) {
  removeLinks[i].addEventListener('click', function(event) {
    event.preventDefault();
    var id = this.dataset.id;
    var prod = this.dataset.prod;
    Swal.fire({
      title: 'Tem certeza que deseja remover essa imagem?',
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '?page=5&id='+prod+'&action=removeImage&idImage=' + id;
      }
    })
  });
}

//Remoção de pedidos
var removeLinks = document.getElementsByClassName('removeOrder-link');
for (var i = 0; i < removeLinks.length; i++) {
  removeLinks[i].addEventListener('click', function(event) {
    event.preventDefault();
    var id = this.dataset.id;
    Swal.fire({
      title: 'Tem certeza que deseja remover esse pedido?',
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '?page=3&action=remove&id=' + id;
      }
    })
  });
}

//Remoção do carrinho
var removeLinks = document.getElementsByClassName('removeCar-link');
for (var i = 0; i < removeLinks.length; i++) {
  removeLinks[i].addEventListener('click', function(event) {
    event.preventDefault();
    var id = this.dataset.id;
    Swal.fire({
      title: 'Tem certeza que deseja remover esse produto do carrinho?',
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '?page=4&action=removeCar&id=' + id;
      }
    })
  });
}

function novaImagem(){

  var novaDiv = document.createElement("div");
  novaDiv.class = "form-group";
  // criar o elemento input
  var novoCampo = document.createElement("input");
  novoCampo.type = "file";
  novoCampo.name = "imagem[]"; // adicionar um nome ao campo para que ele possa ser enviado pelo formulário

  // criar o botão "Remover"
  var botaoRemover = document.createElement("button");
  botaoRemover.innerHTML = "Remover";
  botaoRemover.onclick = function() {
      novaDiv.remove(); // remover a div que contém o campo de texto e o botão "Remover"
  };

  // inserir o novo campo na div
  novaDiv.appendChild(novoCampo);
  novaDiv.appendChild(botaoRemover);

  // inserir a nova div na página
    var camposDiv = document.getElementById("imagens");
    camposDiv.appendChild(novaDiv);

}

//Abrir menu
function showMenuItems() {
  var x = document.getElementById("menu_itens");
  if (x.className === "menu_itens") {
    x.className += "_responsivo";
  } else {
    x.className = "menu_itens";
  }

  var mapaContainer = document.getElementById("container_mapa");
  if (mapaContainer.className === "container_mapa") {
    mapaContainer.className += "_menu-aberto";
  } else {
    mapaContainer.className = "container_mapa";
  }

}


//Media Query Handler
const mediaQuery = window.matchMedia("(min-width: 1200px)");

function handleMediaChange(event) {
    const menuItens = document.getElementById("menu_itens");
    const containerMapa = document.getElementById("container_mapa");
    var existe = [];
    
    if (menuItens) {
      existe.push("menuItens");
    }

    if (containerMapa) {
      existe.push("containerMapa");
    }

    if (event.matches) {
      if ((existe.indexOf("menuItens") > -1)) {
        menuItens.classList.add("menu_itens");
        menuItens.classList.remove("menu_itens_responsivo");
      }

      if ((existe.indexOf("containerMapa") > -1)) {
        containerMapa.classList.add("container_mapa");
        containerMapa.classList.remove("container_mapa_menu");
      }
    }
}

mediaQuery.addEventListener("change", handleMediaChange);
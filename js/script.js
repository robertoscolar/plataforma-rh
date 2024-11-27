//Abrir menu
function showMenuItems() {
  var x = document.getElementById("menu_itens");
  if (x.className === "menu_itens") {
    x.className += "_responsivo";
  } else {
    x.className = "menu_itens";
  }
}


//Media Query Handler
const mediaQuery = window.matchMedia("(min-width: 1200px)");

function handleMediaChange(event) {
    const element = document.getElementById("menu_itens");
    if (!element) {
      return;
    }

    if (event.matches) {
        element.classList.add("menu_itens");
        element.classList.remove("menu_itens_responsivo");
    }
}

mediaQuery.addEventListener("change", handleMediaChange);

handleMediaChange(mediaQuery);
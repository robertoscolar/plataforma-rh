// Variável de controle para verificar o estado do menu
let menuAberto = false;

// Abrir ou fechar o menu
function showMenuItems() {
  // Validar o bloqueio da rolagem com base no estado do menu
  if (!menuAberto) {
    document.body.style.overflow = 'hidden'; // Bloqueia a rolagem
  } else {
    document.body.style.overflow = 'auto'; // Restaura a rolagem
  }

  // Toggle do estado do menu
  menuAberto = !menuAberto;

  // Lógica para alternar as classes do menu
  var x = document.getElementById("menu_itens");
  
  if (menuAberto) {
    // Quando o menu for aberto, aplica a classe responsivo
    if (x.className === "menu_itens") {
      x.className += "_responsivo"; // Menu aberto
    }
    // Remover a classe "fechar" caso exista, para garantir a animação de entrada
    x.classList.remove('fechar');
  } else {
    // Quando o menu for fechado, aplica a animação de fadeOutOpacity
    x.classList.add('fechar'); // Adiciona a animação de fade-out
    // Após a animação de fade-out, remove a classe responsivo
    setTimeout(function() {
      x.className = "menu_itens"; // Menu fechado
    }, 500); // Tempo de duração da animação (500ms)
  }

  // Alteração da classe do mapa, se necessário
  var mapaContainer = document.getElementById("container_mapa");
  if (mapaContainer.className === "container_mapa") {
    mapaContainer.className += "_menu-aberto";
  } else {
    mapaContainer.className = "container_mapa";
  }

  console.log(menuAberto ? "Menu aberto" : "Menu fechado"); // Exibe no console se o menu foi aberto ou fechado
}

// Media Query Handler
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
    if (existe.indexOf("menuItens") > -1) {
      menuItens.classList.add("menu_itens");
      menuItens.classList.remove("menu_itens_responsivo");
    }

    if (existe.indexOf("containerMapa") > -1) {
      containerMapa.classList.add("container_mapa");
      containerMapa.classList.remove("container_mapa_menu");
    }
  }
}

mediaQuery.addEventListener("change", handleMediaChange);

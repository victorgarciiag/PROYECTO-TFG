// Seleccionamos con variables las diferentes etiquetas
const allContainerCart = document.querySelector(".products");
const containerBuyCart = document.querySelector(".card-items");
const priceTotal = document.querySelector(".price-total");
const amountProduct = document.querySelector(".count-product");

let buyThings = [];
let totalCard = 0;
let countProduct = 0;

// Funciones
loadEventListeners();

function loadEventListeners() {
  allContainerCart.addEventListener("click", addProduct);
  containerBuyCart.addEventListener("click", deleteProduct);
}

function addProduct(e) {
  e.preventDefault();
  if (e.target.classList.contains("btn-add-cart")) {
    console.log("Producto añadido al carrito");
    const selectProduct = e.target.parentElement;
    readTheContent(selectProduct);
  }
}

function deleteProduct(e) {
  if (e.target.classList.contains("delete-product")) {
    console.log("Producto eliminado del carrito");
    const deleteId = e.target.getAttribute("data-id");

    //Con ayuda de chatgpt: Busca el producto en el carrito y actualiza el total
    buyThings.forEach((value) => {
      if (value.id === deleteId) {
        let priceReduce = parseFloat(value.price) * parseFloat(value.amount); //Calculamos el precio que hace falta reducir
        totalCard = totalCard - priceReduce;
        totalCard = totalCard.toFixed(2);
      }
    });
    buyThings = buyThings.filter((product) => product.id !== deleteId);
    countProduct = Math.max(0, countProduct - 1); // Asegura que el contador no sea negativo
  }

  if (buyThings.length === 0) {
    priceTotal.innerHTML = 0;
    amountProduct.innerHTML = 0;
  }
  loadHtml();
}

function readTheContent(product) {
  const infoProduct = {
    image: product.querySelector("div img").src,
    title: product.querySelector(".title").textContent,
    price: product.querySelector("div p span").textContent,
    id: product.querySelector("a").getAttribute("data-id"),
    amount: 1,
  };

  totalCard = parseFloat(totalCard) + parseFloat(infoProduct.price);
  totalCard = totalCard.toFixed(2);

  const exist = buyThings.some((product) => product.id === infoProduct.id);
  if (exist) {
    const pro = buyThings.map((product) => {
      if (product.id === infoProduct.id) {
        product.amount++;
        return product;
      } else {
        return product;
      }
    });
    buyThings = [...pro];
  } else {
    buyThings = [...buyThings, infoProduct];
    countProduct++;
  }
  loadHtml();
  console.log(infoProduct);
}

function loadHtml() {
  clearHtml();
  buyThings.forEach((product) => {
    const { image, title, price, amount, id } = product;
    const row = document.createElement("div");
    row.classList.add("item");
    row.innerHTML = `
            <img src="${image}" alt="">
            <div class="item-content">
                <h5>${title}</h5>
                <h5 class="cart-price">${price}€</h5>
                <h6>Amount: ${amount}</h6>
            </div>
            <span class="delete-product" data-id="${id}">X</span>
        `;
    containerBuyCart.appendChild(row);
    priceTotal.innerHTML = totalCard;
    amountProduct.innerHTML = countProduct;
  });
}

function clearHtml() {
  containerBuyCart.innerHTML = "";
}

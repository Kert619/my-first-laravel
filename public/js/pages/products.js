const editButtons = document.querySelectorAll(".edit-product");
const btnAdd = document.querySelector(".btn-add");
const modal = document.querySelector("#products-modal");
const modalTitle = modal.querySelector(".modal-title");
const form = modal.querySelector("form");
const btnSave = form.querySelector(".btn-save");
const productNameInput = form.querySelector("#product-name");
const categoryInput = form.querySelector("#category");
const productPriceInput = form.querySelector("#product-price");
const productStocksInput = form.querySelector("#product-stocks");


btnAdd.addEventListener("click", function(){
    form.reset();
    const url = this.dataset.url;
    modalTitle.textContent = "ADD PRODUCT";
    btnSave.classList.remove("btn-success");
    btnSave.classList.add("btn-primary");
    btnSave.textContent = "Save Product";

    const existingMethodInput = form.querySelector('input[name="_method"]');
    if (existingMethodInput) {
        existingMethodInput.remove();
    }

    form.action = url;
})

editButtons.forEach((btn) => {
    btn.addEventListener("click", async function(){
        try {
            const url = this.dataset.url;
            const response = await fetch(url);
            const data = await response.json();

            if (!response.ok) {
                throw new Error("Failed to fetch product");
            }

            modalTitle.textContent = "UPDATE PRODUCT";
            btnSave.classList.add("btn-success");
            btnSave.classList.remove("btn-primary");
            btnSave.textContent = "Save Changes";

            productNameInput.value = data.product_name;
            productPriceInput.value = data.product_price;
            productStocksInput.value = data.product_stocks;

            const options = Array.from(categoryInput.options);
            for (let i = 0; i < options.length; i++) {
                if(options[i].label === data.category_name){
                    options[i].selected=true;
                    break;
                }
            }

            const html = "<input type='hidden' name='_method' value='PUT'/>";
            form.insertAdjacentHTML("beforeend", html);

            form.action = `/products/${data.id}`;
        } catch (error) {
            console.error(error);
        }
    });
})
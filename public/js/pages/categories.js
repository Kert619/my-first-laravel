const addCategory = document.querySelector(".btn-add");
const editButtons = document.querySelectorAll(".edit-category");
const modal = document.querySelector("#category-modal");
const categoryNameInput = modal.querySelector("#category-name");
const btnSave = modal.querySelector(".btn-save");
const modalTitle = modal.querySelector(".modal-title");
const form = modal.querySelector("form");

addCategory.addEventListener("click", function () {
    form.reset();
    modalTitle.textContent = "ADD CATEGORY";
    btnSave.textContent = "Save Category";
    btnSave.classList.add("btn-primary");
    btnSave.classList.remove("btn-success");
    const url = this.dataset.url;

    const existingMethodInput = form.querySelector('input[name="_method"]');
    if (existingMethodInput) {
        existingMethodInput.remove();
    }
    form.action = url;
});

editButtons.forEach((btn) => {
    btn.addEventListener("click", async function (e) {
        try {
            const url = this.dataset.url;
            console.log(url);
            const response = await fetch(url);
            const data = await response.json();

            if (!response.ok) {
                throw new Error("Failed to fetch category");
            }

            modalTitle.textContent = "UPDATE CATEGORY";
            categoryNameInput.value = data.category_name;
            btnSave.classList.remove("btn-primary");
            btnSave.classList.add("btn-success");
            btnSave.textContent = "Save Changes";

            const html = "<input type='hidden' name='_method' value='PUT'/>";
            form.insertAdjacentHTML("beforeend", html);

            form.action = `/categories/${data.id}`;
        } catch (error) {
            console.error(error);
        }
    });
});

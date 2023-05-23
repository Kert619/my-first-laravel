const addCategory = document.querySelector(".btn-add");
const editButtons = document.querySelectorAll(".edit-category");
const deleteButtons = document.querySelectorAll(".delete-category");
const modal = document.querySelector("#category-modal");
const deleteModal = document.querySelector("#delete-modal");
const categoryNameInput = modal.querySelector("#category-name");
const btnAction = modal.querySelector(".btn-action");
const modalTitle = modal.querySelector(".modal-title");
const form = modal.querySelector("form");

addCategory.addEventListener("click", function () {
    form.reset();
    modalTitle.textContent = "ADD CATEGORY";
    btnAction.textContent = "Save Category";
    btnAction.classList.add("btn-primary");
    btnAction.classList.remove("btn-success");
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
            btnAction.classList.remove("btn-primary");
            btnAction.classList.add("btn-success");
            btnAction.textContent = "Save Changes";

            const html = "<input type='hidden' name='_method' value='PUT'/>";
            form.insertAdjacentHTML("beforeend", html);

            form.action = `/categories/${data.id}`;
        } catch (error) {
            console.error(error);
        }
    });
});

deleteButtons.forEach((btn) => {
    btn.addEventListener("click", function(e){
        const url = this.dataset.url;
        deleteModal.querySelector("form").action = url;
    })
})

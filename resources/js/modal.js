function openModal(id) {
    const modal = document.getElementById(`modal-${id}`);
    if (modal) {
        modal.classList.remove("hidden");
        modal.classList.add("flex"); // Tailwindで中央寄せのためflexも
    }
}

function closeModal(id) {
    const modal = document.getElementById(`modal-${id}`);
    if (modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }
}

// グローバルに公開
window.openModal = openModal;
window.closeModal = closeModal;

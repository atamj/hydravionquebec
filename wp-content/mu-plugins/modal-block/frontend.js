document.addEventListener('DOMContentLoaded', (event) => {
    const modalButtons = document.querySelectorAll('.modal-block-open-button, .modal-close-button');
    const modalOverlays = document.querySelectorAll('.modal-overlay, .modal-overlay-img');

    modalButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const blockId = button.dataset.block;
            const modal = document.querySelector(`.modal[data-block="${blockId}"]`);
            modal.classList.toggle('modal-open');
        });
    });

    modalOverlays.forEach((modalOverlay) => {
        modalOverlay.addEventListener('click', (e) => {
            e.preventDefault();
            modalOverlay.closest('.modal').classList.remove('modal-open');
        });
    });
});

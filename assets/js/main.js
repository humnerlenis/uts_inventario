document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('#item-modal');
    const viewActions = document.querySelectorAll('.view-action');

    if (modal) {
        const closeModal = () => {
            modal.hidden = true;
            document.body.style.overflow = '';
        };

        viewActions.forEach((action) => {
            action.addEventListener('click', () => {
                const item = JSON.parse(action.dataset.item);

                modal.querySelectorAll('[data-detail]').forEach((detail) => {
                    const value = item[detail.dataset.detail];
                    detail.textContent = value === '' || value === null ? '-' : value;
                });

                modal.hidden = false;
                document.body.style.overflow = 'hidden';
                modal.querySelector('.modal-close').focus();
            });
        });

        modal.querySelectorAll('[data-modal-close]').forEach((closeButton) => {
            closeButton.addEventListener('click', closeModal);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.hidden) {
                closeModal();
            }
        });
    }

    const form = document.querySelector('.inventory-form');
    if (!form) {
        return;
    }

    form.addEventListener('submit', (event) => {
        const tipo = form.querySelector('#tipo')?.value.trim();
        const ubicacion = form.querySelector('#ubicacion')?.value.trim();
        const estado = form.querySelector('#estado')?.value.trim();

        if (!tipo || !ubicacion || !estado) {
            event.preventDefault();
            alert('Debe completar tipo, ubicación y estado del equipo.');
        }
    });
});

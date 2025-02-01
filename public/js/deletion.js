// Добавляет обработчик события удаления объекта в списке на странице
// containerId  - HTML элемент списка всех объектов
// deleteClass  - класс кнопки которая удаляет объект
// modalId      - ID модального окна подтверждения удаления
// confirmBtnId - ID кнопки подтверждения удаления
// prefix       - префикс ID объекта которого потребуется удалить из DOM
// onYes        - функция, которая выполнится если удаление подтвердится. В неё передастся formData, где есть
// параметр ID, удобно для отправки fetch
export function bind(containerId, deleteClass, modalId, confirmBtnId, prefix, onYes) {
    const container = document.getElementById(containerId);
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains(deleteClass)) {
            // Нажата кнопка удаления

            const id = e.target.dataset.id;

            // Привязать к кноке удаления в диалоге подтверждения функцию удаления
            const confirmBtn = document.getElementById(confirmBtnId);
            confirmBtn.onclick = function(e) {
                const formData = new FormData();
                formData.append("id", id);

                // Выполнить кастомную функцию удаления
                onYes(formData);
                
                // Удалить из DOM объект который удаляется
                document.getElementById(prefix + id).remove();
            };

            // Показать модальное окно подтверждения
            const myModal = new bootstrap.Modal("#" + modalId, {
                keyboard: true
            });
            myModal.show();
        }
    });
}

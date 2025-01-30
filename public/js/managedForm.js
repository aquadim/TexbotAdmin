const form = document.getElementById("form");
form.addEventListener("submit", async function(e) {
    e.preventDefault();

    // Запрос на API
    const r = await fetch(this.action, {
        body: new URLSearchParams(new FormData(this)),
        method: 'post'
    });

    // Обработка ответа
    const data = await r.json();
    if (!r.ok) {
        alert(data.message);
    } else {
        window.location.href = data.nowto;
    }
});
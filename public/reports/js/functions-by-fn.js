const formSettings = document.getElementById("settings");
const dataArea = document.getElementById("dataArea");

let currentFunctionId;

// Названия
// {id: название}
const functionNames = new Map();    // Названия видов функций
const groupNames = new Map();       // Названия групп

formSettings.addEventListener('submit', (e) => {
    const fd = new FormData(formSettings);
    currentFunctionId = fd.get("functionTypeId");
    fetch("/api/functions-usage-by-fn.php", {
        method: 'POST',
        body: fd
    }).then(async function(r) {
        const data = await r.json();
        updateChart(data);
    });
    e.preventDefault();
});

function updateChart(data) {
    const allTraces = [];
    const layout = {
        title: {
            text: "Использование функции " + functionNames.get(currentFunctionId)
        }
    };

    const config = {
        scrollZoom: true,
        locale: 'ru',
        responsive: true
    }

    // Проход по всем функциям
    Object.keys(data).forEach(groupId => {
        const info = data[groupId];
        
        const groupName = groupNames.get(groupId);
        const xValues = [];
        const yValues = [];

        // Проход по всем датам
        Object.keys(info).forEach(dateKey => {
            const dateObj = new Date(dateKey);
            const count = info[dateKey];

            xValues.push(dateObj);
            yValues.push(count);
        });

        const trace = {
            type: 'scatter',
            x: xValues,
            y: yValues,
            mode: 'lines+markers',
            name: groupName
        };

        allTraces.push(trace);
    });

    Plotly.newPlot(dataArea, allTraces, layout, config);
}

// Сбор всех видов функций
fetch("/api/all-function-types.php", {
    method: "POST"
}).then(async function(r) {
    const data = await r.json();
    const functionTypesSelect = document.getElementById("functionTypeId");
    data.forEach(ft => {
        functionNames.set(ft.id.toString(), ft.name);
        
        const opt = document.createElement("option");
        opt.textContent = ft.name;
        opt.value = ft.id;
        functionTypesSelect.append(opt);
    });
});

// Сбор всех имён групп
fetch("/api/all-groups.php", {
    method: "POST"
}).then(async function(r) {
    const data = await r.json();
    data.forEach(g => {
        groupNames.set(g.id.toString(), g.name);
    });
});
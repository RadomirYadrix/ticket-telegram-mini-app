<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Транспортный билет</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex_map.api_key') }}&lang=ru_RU"></script>
    <script src="{{ asset('js/yandex-map.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 10px; }
        .transport-list { margin-top: 20px; }
        .map { height: 300px; width: 100%; margin-top: 20px; }
    </style>
</head>
<body>
<h1>Заказ билетов</h1>

<div>
    <label>Тип транспорта:</label>
    <select id="transport-type">
        <option value="train">Поезд</option>
        <option value="bus">Автобус</option>
        <option value="river">Речной</option>
    </select>
    <button id="load-transports">Показать</button>
</div>

<div class="transport-list" id="transport-list"></div>

<div class="map" id="map"></div>

<script>
    // Инициализация карты
    ymaps.ready(function () {
        window.map = new ymaps.Map('map', {
            center: [55.7558, 37.6176],
            zoom: 10
        });
    });

    document.getElementById('load-transports').addEventListener('click', async () => {
        const type = document.getElementById('transport-type').value;
        const response = await fetch(`/api/transports?type=${type}`, {
            headers: { 'X-Init-Data': window.Telegram.WebApp.initData }
        });
        const data = await response.json();

        const list = document.getElementById('transport-list');
        list.innerHTML = '';
        data.forEach(t => {
            const el = document.createElement('div');
            el.innerHTML = `
                    <p>${t.name} (${t.from_location} → ${t.to_location})</p>
                    <p>${t.departure_at} → ${t.arrival_at} | ${t.price} руб.</p>
                    <button onclick="buyTicket(${t.id})">Купить</button>
                `;
            list.appendChild(el);
        });
    });

    async function buyTicket(id) {
        const response = await fetch('/api/tickets', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Init-Data': window.Telegram.WebApp.initData
            },
            body: JSON.stringify({ transport_id: id })
        });
        const result = await response.json();
        window.location.href = result.payment_url;
    }
</script>
</body>
</html>

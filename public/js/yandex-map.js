window.map = null;

function addPoint(lat, lng, title) {
    if (!window.map) return;
    const placemark = new ymaps.Placemark([lat, lng], {
        balloonContent: title
    });
    window.map.geoObjects.add(placemark);
}

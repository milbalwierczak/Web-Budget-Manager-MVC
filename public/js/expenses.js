document.getElementById('floatingCategory').addEventListener('change', async function() {
    const category = this.value;
    const encodedCategory = encodeURIComponent(category);

    try {
        const response = await fetch(`/api/limit/${encodedCategory}`);

        if (!response.ok) {
            throw new Error('Nie udało się pobrać danych.');
        }

        const data = await response.json();
        if(data == 0){
            document.getElementById('limit-info').textContent = 'Brak ustawionego limitu';
        } else {
            document.getElementById('limit-info').textContent = parseFloat(data).toFixed(2).replace('.', ',');
        }
    } catch (error) {
        console.error('Błąd:', error);
        document.getElementById('limit-info').textContent = 'Błąd ładowania limitu';
    }
});

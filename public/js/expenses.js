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

        if(document.getElementById("floatingDateExpense").value){
            const dateValue = document.getElementById("floatingDateExpense").value;
            const [day, month, year] = dateValue.split('-');
            const formattedDate = `${year}-${month}-${day}`;
            const date = new Date(formattedDate);

            try {
                const response = await fetch(`/api/limitSpent/${encodedCategory}/${date.toISOString().split('T')[0]}`);
        
                if (!response.ok) {
                    throw new Error('Nie udało się pobrać danych.');
                }
        
                const data = await response.json();
                document.getElementById('limit-spent').textContent = parseFloat(data || 0).toFixed(2).replace('.', ',');
                try {
                    const response = await fetch(`/api/limit/${encodedCategory}`);
            
                    if (!response.ok) {
                        throw new Error('Nie udało się pobrać danych.');
                    }
            
                    const data2 = await response.json();
                    if(data2 == 0){
                        document.getElementById('limit-left').textContent = 'Brak ustawionego limitu';
                        document.getElementById('limit-left').style.color = "black";
                    } else {
                        document.getElementById('limit-left').textContent = parseFloat(data2 - data).toFixed(2).replace('.', ',');
                        if(data2 - data > 0){
                            document.getElementById('limit-left').style.color = "limegreen";
                        } else if (data2 - data < 0) {
                            document.getElementById('limit-left').style.color = "red";
                        } else {                         
                            document.getElementById('limit-left').style.color = "black";
                        }
                    }
                } catch (error) {
                    console.error('Błąd:', error);
                    document.getElementById('limit-left').textContent = 'Błąd ładowania limitu';
                }
        
            } catch (error) {
                console.error('Błąd:', error);
                document.getElementById('limit-spent').textContent = 'Błąd ładowania limitu';
            }
        }
});

$('#floatingDateExpense').datepicker({
    format: "dd-mm-yyyy",
    maxViewMode: 0,
    language: "pl",
    todayHighlight: true
}).on('changeDate', async function(event) {
        if(document.getElementById("floatingCategory").value){
        const date = event.date;  // date zawiera obiekt Date
        const category = document.getElementById("floatingCategory").value;
        const encodedCategory = encodeURIComponent(category);

        try {
            const response = await fetch(`/api/limitSpent/${encodedCategory}/${date.toISOString().split('T')[0]}`);

            if (!response.ok) {
                throw new Error('Nie udało się pobrać danych.');
            }

            const data = await response.json();
            document.getElementById('limit-spent').textContent = parseFloat(data || 0).toFixed(2).replace('.', ',');
            try {
                const response = await fetch(`/api/limit/${encodedCategory}`);
        
                if (!response.ok) {
                    throw new Error('Nie udało się pobrać danych.');
                }
        
                const data2 = await response.json();
                if(data2 == 0){
                    document.getElementById('limit-left').textContent = 'Brak ustawionego limitu';
                    document.getElementById('limit-left').style.color = "black";
                } else {
                    document.getElementById('limit-left').textContent = parseFloat(data2 - data).toFixed(2).replace('.', ',');
                    if(data2 - data > 0){
                        document.getElementById('limit-left').style.color = "limegreen";
                    } else if (data2 - data < 0) {
                        document.getElementById('limit-left').style.color = "red";
                    } else {                         
                        document.getElementById('limit-left').style.color = "black";
                    }
                }
            } catch (error) {
                console.error('Błąd:', error);
                document.getElementById('limit-left').textContent = 'Błąd ładowania limitu';
            }

        } catch (error) {
            console.error('Błąd:', error);
            document.getElementById('limit-spent').textContent = 'Błąd ładowania limitu';
        }
    } else {        
        document.getElementById('limit-spent').textContent = 'Wybierz kategorie';
        document.getElementById('limit-left').textContent = 'Wybierz kategorie';
    }
});

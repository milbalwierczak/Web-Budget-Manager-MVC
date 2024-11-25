document.getElementById('floatingValue').addEventListener('focus', function() {
    const valueField = document.getElementById('floatingValue');
    const dateField = document.getElementById('floatingDate');
    
    if (!valueField.value) {
        const today = new Date();
        const formattedDate = `${String(today.getDate()).padStart(2, '0')}-${String(today.getMonth() + 1).padStart(2, '0')}-${today.getFullYear()}`;
        
        dateField.value = formattedDate;
    }
});

document.getElementById('floatingCategory').addEventListener('change', function() {
    if (this.value) {
        this.classList.add('has-value');
    } else {
        this.classList.remove('has-value');
    }
});

document.getElementById('floatingMethod').addEventListener('change', function() {
    if (this.value) {
        this.classList.add('has-value');
    } else {
        this.classList.remove('has-value');
    }
});





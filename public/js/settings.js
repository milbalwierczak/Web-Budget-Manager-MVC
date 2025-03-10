document.getElementById('flexCheckAddLimit').addEventListener('change', function() {
    const floatingLimit = document.getElementById('floatingLimitContainer');
    
    if (this.checked) {
        floatingLimit.style.display = 'block'; // Pokaż element
    } else {
        floatingLimit.style.display = 'none'; // Ukryj element
    }
});

document.getElementById('floatingExpenseCategory').addEventListener('change', function() {
    document.getElementById('floatingExpenseName').value = this.value;
});
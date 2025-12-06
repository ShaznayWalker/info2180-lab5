document.addEventListener('DOMContentLoaded', () => {
    const lookupButton = document.getElementById('lookup');
    const countryInput  = document.getElementById('country');
    const resultDiv     = document.getElementById('result');

    
    lookupButton.addEventListener('click', () => {
        const country = countryInput.value.trim();
        
        // Create XMLHttpRequest object
        const xhr = new XMLHttpRequest();
        
        // request completes
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // response from server
                resultDiv.innerHTML = xhr.responseText;
            }
        };
        
        const url = 'world.php?country=' + encodeURIComponent(country);
        
        xhr.open('GET', url, true);
        xhr.send();
    });
});
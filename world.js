// load
document.addEventListener('DOMContentLoaded', function() {
    // buttons
    const lookupButton = document.getElementById('lookup');
    const lookupCitiesButton = document.getElementById('lookupCities');
    
    // AJAX request
    function performLookup(lookupType) {
        // Get country name from input 
        const countryInput = document.getElementById('country');
        const country = countryInput.value;
        
        // result 
        const resultDiv = document.getElementById('result');
        
        const xhr = new XMLHttpRequest();
        
        // request completes
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // server response
                resultDiv.innerHTML = xhr.responseText;
            }
        };
        
        const url = 'world.php?country=' + encodeURIComponent(country) + 
                   '&lookup=' + lookupType;
        
        // Open and send the request
        xhr.open('GET', url, true);
        xhr.send();
    }
    
    // event listener for country lookup
    lookupButton.addEventListener('click', function() {
        performLookup('countries');
    });
    
    // event listener for cities lookup
    lookupCitiesButton.addEventListener('click', function() {
        performLookup('cities');
    });
});
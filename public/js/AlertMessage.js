let alertCount = 0; //Értesítés számláló id-hez

function showAlert(message, type) { // Generál egy értesítést
    alertCount++;
    let alertId = 'alert-' + alertCount; // Egyedi id

    // Megcsinálja a értesítés html-ét
    let alertHTML = `
        <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    $('#alertContainer').append(alertHTML);


    
    setTimeout(function() { // Automatikusan kitörli az értesítést 5mp után
        $('#' + alertId).alert('close');
    }, 5000);
}
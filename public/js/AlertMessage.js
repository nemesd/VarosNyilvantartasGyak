let alertCount = 0; //Értesítés számláló id-hez

// Generál egy értesítést
function showAlert(message, type = 'success') {
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


    // Automatikusan kitörli az értesítést 5mp után
    setTimeout(function() {
        $('#' + alertId).alert('close');
    }, 5000);
}
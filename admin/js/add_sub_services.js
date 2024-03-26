document.addEventListener('DOMContentLoaded', function() {
    // Get the container element
    var container = document.getElementById('sub-services-container');

    // Get the button element
    var addButton = document.getElementById('add-sub-service');

    // Add event listener for the button click
    addButton.addEventListener('click', function() {
        // Create a new row for sub service details
        var newRow = document.createElement('div');
        newRow.className = 'sub-service-row';
        newRow.innerHTML = `
            <div class="form">
                <label for="name">Name: </label>
                <input type="text" name="name[]" autocomplete="off" required>
            </div>
            <div class="form">
                <label for="cost">Cost (RM): </label>
                <input type="text" name="cost[]" autocomplete="off" required>
            </div>
        `;

        // Append the new row to the container
        container.appendChild(newRow);
    });
});
/**
 * Show the data from the JSon array inside the database browser table.
 *
 * @param {JSON} inputElement - The JSon array containing the records data.
 * @returns {void}
 */
function fmg_refreshBrowserTable(jsonString) {
    const tableHeader = document.getElementById('tableHeader');
    const tableBody = document.getElementById('tableBody');

    // Clear previous table content
    tableHeader.innerHTML = '';
    tableBody.innerHTML = '';

    try {
        const dataArray = JSON.parse(jsonString);

        if (!Array.isArray(dataArray) || dataArray.length === 0) {
            console.error("Parsed JSON is not an array or is empty.");
            // Optionally display a message to the user in the table or a separate element
            const cell = tableBody.insertRow().insertCell();
            cell.colSpan = 100; // A large enough number
            cell.textContent = "No data to display or invalid JSON format.";
            return;
        }

        // Get headers from the first object's keys
        const headers = Object.keys(dataArray[0]["fieldData"]);

        // Create table header row
        headers.forEach(headerText => {
            const headerCell = document.createElement('th');
            headerCell.textContent = headerText;
            tableHeader.appendChild(headerCell);
        });

        // Create table body rows
        dataArray.forEach(obj => {
            const row = tableBody.insertRow();
            headers.forEach(header => {
                const cell = row.insertCell();
                const cellValue = obj["fieldData"][header];

                // Handle cases where the value might be null or undefined
                cell.textContent = cellValue !== null && cellValue !== undefined ? cellValue : '';
            });
        });

    } catch (error) {
        console.error("Error parsing JSON string:", error);
        // Optionally display an error message to the user
        const cell = tableBody.insertRow().insertCell();
        cell.colSpan = 100; // A large enough number
        cell.textContent = "Error loading data: Invalid JSON format.";
    }
}
// Ensure all JS variables and functions start with fmg_browse_
var fmg_browse_openModalButton = document.getElementById('fmg_browse_trigger_button');
var fmg_browse_modalOverlay = document.getElementById('fmg_browse_modal_overlay');
// var fmg_browse_modalElement = document.getElementById('fmg_browse_modal'); // Not directly used for event handling now
var fmg_browse_closeModalButtonHeader = document.getElementById('fmg_browse_close_modal_button_header');
var fmg_browse_submitModalButton = document.getElementById('fmg_browse_submit_modal_button');

/**
 * @function fmg_browse_openModal
 * @description Displays the modal dialog and its backdrop.
 */
function fmg_browse_openModal() {
    if (fmg_browse_modalOverlay) {
        fmg_browse_modalOverlay.classList.add('fmg_browse_modal_visible');
    }
}

/**
 * @function fmg_browse_closeModal
 * @description Hides the modal dialog and its backdrop.
 */
function fmg_browse_closeModal() {
    if (fmg_browse_modalOverlay) {
        fmg_browse_modalOverlay.classList.remove('fmg_browse_modal_visible');
    }
}

/**
 * @function fmg_browse_handleSubmit
 * @description Handles the submit button click. Currently logs a message and closes the modal.
 */
function fmg_browse_handleSubmit() {
    console.log('FMG Browse: Submit button clicked');
    // Add actual submit logic here if needed
    fmg_browse_closeModal(); // Closes modal on submit for now
}

/**
 * @function fmg_browse_handleOverlayClick
 * @description Handles click events on the modal overlay. Closes the modal if the click is on the backdrop itself, not on the modal content.
 * @param {MouseEvent} event - The mouse click event.
 */
function fmg_browse_handleOverlayClick(event) {
    // Ensure event object is available (for older IEs, it might be window.event)
    var fmg_browse_event = event || window.event;
    var fmg_browse_target = fmg_browse_event.target || fmg_browse_event.srcElement;

    if (fmg_browse_target === fmg_browse_modalOverlay) {
        fmg_browse_closeModal();
    }
}

/**
 * @function fmg_browse_handleKeyDown
 * @description Handles keydown events on the document. Closes the modal if the Escape key is pressed and the modal is visible.
 * @param {KeyboardEvent} event - The keyboard event.
 */
function fmg_browse_handleKeyDown(event) {
    var fmg_browse_event = event || window.event;
    if (fmg_browse_event.key === 'Escape' || fmg_browse_event.keyCode === 27) { // keyCode for older browser compatibility
        if (fmg_browse_modalOverlay && fmg_browse_modalOverlay.classList.contains('fmg_browse_modal_visible')) {
            fmg_browse_closeModal();
        }
    }
}

/**
 * Show the data from the JSon array inside the database browser table.
 *
 * @param {JSON} jsonString - The JSon array containing the records data.
 * @returns {void}
 */
function fmg_refreshBrowserTable(jsonString) {
    const tableHeader = document.getElementById('tableHeader');
    const tableBody = document.getElementById('tableBody');
    const browserNavDiv = document.getElementById('browserNav');

    // Clear previous table content
    tableHeader.innerHTML = '';
    tableBody.innerHTML = '';

    try {
        const fullArray = JSON.parse(jsonString);
        const dataArray = fullArray['response']['data'];
        if (!Array.isArray(dataArray) || dataArray.length === 0) {
            console.error("Parsed JSON is not an array or is empty.");
            // Optionally display a message to the user in the table or a separate element
            const cell = tableBody.insertRow().insertCell();
            cell.colSpan = 100; // A large enough number
            cell.textContent = msg_nav_nodata;
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
        // Display an error message to the user
        const cell = tableBody.insertRow().insertCell();
        cell.colSpan = 100; // A large enough number
        cell.textContent = "";
    }
}
// Assign keydown handler to the document
// Using document.onkeydown can overwrite other existing onkeydown handlers.
var fmg_browse_previousOnKeyDown = document.onkeydown;
document.onkeydown = function (event) {
    if (fmg_browse_previousOnKeyDown) {
        fmg_browse_previousOnKeyDown(event);
    }
    fmg_browse_handleKeyDown(event);
};

/**
 * Send a POST request to the server to retreive a list of records from the
 * first page for a selected layout.
 *
 * This function performs the following actions:
 * 1. Retrieves values from input fields related to browser layout and sorting.
 * 2. Sends a POST request to "admin/browser.php?action=update" with these values.
 * 3. If the first request is successful, it calls `fmg_refreshBrowserTable()` with the response.
 * 4. Sends another POST request with the same values to "admin/browser.php?action=update_nav".
 * 5. If the second request is successful, it updates the content of the div with id "browserNav".
 * 
 * @returns {void}
 */
async function fmg_changeBrowserState(changeType) {

    if (changeType == "layout") {
        document.getElementById('fmg_browse_sort_field').value = "";
        document.getElementById('fmg_browse_sort_type').value = "ascend";
        document.getElementById('fmg_browse_records_offset').value = 1;
    }


    const browserNavDiv = document.getElementById('browserNav');
    const layout = document.getElementById('input_fmg_browse_layout')?.value;
    const sortField = document.getElementById('fmg_browse_sort_field')?.value;
    const sortType = document.getElementById('fmg_browse_sort_type')?.value;
    const recordsLimit = document.getElementById('fmg_browse_records_limit')?.value;
    if (changeType == "previous") {
        const recordsOffsetOldString = document.getElementById('fmg_browse_records_offset')?.value;
        const recordsOffsetOld = parseInt(recordsOffsetOldString, 10); // Convert to number
        // Ensure recordsLimit is also a number
        const numericRecordsLimit = parseInt(recordsLimit, 10);

        if (!isNaN(recordsOffsetOld) && !isNaN(numericRecordsLimit)) { // Check if conversion was successful
            let newOffset = recordsOffsetOld - numericRecordsLimit;
            if (newOffset < 1) {
                newOffset = 1;
            }
            document.getElementById('fmg_browse_records_offset').value = newOffset;
        } else {
            console.error("Error: recordsOffsetOld or recordsLimit is not a valid number.");
        }
    }

    if (changeType == "next") {
        const recordsOffsetOldString = document.getElementById('fmg_browse_records_offset')?.value;
        const recordsOffsetOld = parseInt(recordsOffsetOldString, 10); // Convert to number
        // Ensure recordsLimit is also a number
        const numericRecordsLimit = parseInt(recordsLimit, 10);

        if (!isNaN(recordsOffsetOld) && !isNaN(numericRecordsLimit)) { // Check if conversion was successful
            let newOffset = recordsOffsetOld + numericRecordsLimit;
            if (newOffset < 1) {
                newOffset = 1;
            }
            document.getElementById('fmg_browse_records_offset').value = newOffset;
        } else {
            console.error("Error: recordsOffsetOld or recordsLimit is not a valid number.");
        }
    }
    const recordsOffset = document.getElementById('fmg_browse_records_offset')?.value;

    // Clear previous table nav
    browserNavDiv.innerHTML = '<div class="browser-nav-left"><div class="loader"></div>' + msg_waiting + '</div>';

    // URLs for the POST request
    const updateUrl = 'admin/browser.php?action=update';

    // We'll use FormData to easily send the data as a POST request.
    const formData = new FormData();
    if (layout !== undefined) formData.append('fmg_browse_layout', layout);
    if (sortField !== undefined) formData.append('fmg_browse_sort_field', sortField);
    if (sortType !== undefined) formData.append('fmg_browse_sort_type', sortType);
    if (recordsLimit !== undefined) formData.append('fmg_browse_records_limit', recordsLimit);
    if (recordsOffset !== undefined) formData.append('fmg_browse_records_offset', recordsOffset);

    try {
        // Send POST request to update browser content
        console.log('Sending request to:', updateUrl);
        const responseUpdate = await fetch(updateUrl, {
            method: 'POST',
            body: formData
        });

        if (responseUpdate.ok) {
            const responseText = await responseUpdate.text();
            // If successful, call fmg_refreshBrowserTable
            if (typeof fmg_refreshBrowserTable === 'function') {
                fmg_refreshBrowserTable(responseText);    // Construct the HTML string using template literals for clarity
                const newHTML = `
                    <div class="browser-nav-left">
                        <div class="browser-nav-item">
                            <a target="_self" onclick="fmg_changeBrowserState('refresh')" class="fmg-ui-link">${msg_nav_refresh}</a>
                        </div>
                        <div class="browser-nav-item" style="margin-left: 10px;">
                            [ ${msg_nav_title} ] ${layout}
                        </div>
                    </div>
                    <div class="browser-nav-center">
                        <a target="_self" onclick="fmg_browse_openModal()" class="fmg-ui-link"> ${msg_nav_settings}</a>
                    </div>
                    <div class="browser-nav-right">
                        <div class="browser-nav-item">
                            <a target="_self" onclick="fmg_changeBrowserState('previous')" class="fmg-ui-link">&lt;&lt; ${msg_nav_previous}</a>
                        </div>
                        <div class="browser-nav-item">
                            ${parseInt(recordsOffset, 10)} - ${Math.floor(parseInt(recordsOffset, 10) + parseInt(recordsLimit, 10) - 1)}
                        </div>
                        <div class="browser-nav-item">
                            <a target="_self" onclick="fmg_changeBrowserState('next')" class="fmg-ui-link"> ${msg_nav_next} &gt;&gt;</a>
                        </div>
                    </div>
                    `;
                browserNavDiv.innerHTML = newHTML;
            }
        } else {
            //console.error('Update request failed:', responseUpdate.status, responseUpdate.statusText);
            browserNavDiv.innerHTML = msg_fail;
        }

    } catch (error) {
        //console.error('Error during update request:', error);
        browserNavDiv.innerHTML = msg_fail;
    }
}
// Ensure all JS variables and functions start with fmg_browse_
// When an id is assigned to an HTML element it automatically create a JS object
// But i am create these here just to avoid any guessing
// Maybe will rewrite it later

var fmg_browse_modalOverlay = document.getElementById('fmg_browse_modal_overlay');
var fmg_browse_closeModalButtonHeader = document.getElementById('fmg_browse_close_modal_button_header');
var fmg_browse_submitModalButton = document.getElementById('fmg_browse_submit_modal_button');

const browse_layoutselect_input = document.getElementById("input_fmg_browse_layout");
const browse_layoutselect_dropdown = document.getElementById("fmg_browse_layoutselect_list");
let browse_layoutselect_activeIndex = -1;
let browse_layoutselect_lastSelected = "";

var fmg_browse_filterOverlay = document.getElementById('fmg_browse_filter_overlay');
var fmg_browse_closeFilterButtonHeader = document.getElementById('fmg_browse_close_filter_button_header');
var fmg_browse_submitFilterButton = document.getElementById('fmg_browse_submit_filter_button');

var fmg_browse_fieldOverlay = document.getElementById('fmg_browse_field_overlay');
var fmg_browse_closeFieldButtonHeader = document.getElementById('fmg_browse_close_field_button_header');
var fmg_browse_submitFieldButton = document.getElementById('fmg_browse_submit_field_button');
var fmg_browse_field_id = document.getElementById('fmg_browse_edit_id');
var fmg_browse_field_name = document.getElementById('fmg_browse_edit_name');
var fmg_browse_field_value = document.getElementById('input_fmg_browse_edit_value');
var fmg_browse_field_disabled = document.getElementById('fmg_browse_field_disabled');
var fmg_browse_field_related_upload = document.getElementById('fmg_browse_field_related_upload');
var fmg_browse_uploadFieldButton = document.getElementById('fmg_browse_submit_field_upload');
var fmg_browse_downloadFieldButton = document.getElementById('fmg_browse_submit_field_download');

var fmg_browse_deleteOverlay = document.getElementById('fmg_browse_delete_overlay');
var fmg_browse_closeDeleteButtonHeader = document.getElementById('fmg_browse_close_delete_button_header');
var fmg_browse_submitDeleteButton = document.getElementById('fmg_browse_submit_delete_button');
var fmg_browse_delete_id = document.getElementById('fmg_browse_delete_id');

// SVG Icons
const fmg_browse_icon_file = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#005d76">
      <path d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 
        23.5-56.5T240-880h360l200 200v520q0 33-23.5 
        56.5T720-80H240Zm0-80h480v-480H560v-160H240v640Z" />
    </svg>
  `;

const fmg_browse_icon_delete = '<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#005d76"><path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/></svg>'


/**
 * @function fmg_browse_openFilter
 * @description Displays the modal dialog and its backdrop.
 */
function fmg_browse_openFilter() {
    if (fmg_browse_filterOverlay) {
        fmg_browse_filterOverlay.classList.add('fmg_browse_filter_visible');
    }
}

/**
 * @function fmg_browse_closeFilter
 * @description Hides the modal dialog and its backdrop.
 */
function fmg_browse_closeFilter() {
    if (fmg_browse_filterOverlay) {
        fmg_browse_filterOverlay.classList.remove('fmg_browse_filter_visible');
    }
}

/**
 * @function fmg_browse_filterSubmit
 * @description Handles the submit button click. Currently logs a message and closes the modal.
 */
function fmg_browse_filterSubmit() {
    console.log('FMG Browse: Submit button clicked');
    fmg_browse_closeFilter(); // Closes modal on submit for now

    fmg_changeBrowserState('refresh');
}

/**
 * @function fmg_browse_closeField
 * @description Hides the modal dialog and its backdrop.
 */
function fmg_browse_closeField() {
    if (fmg_browse_fieldOverlay) {
        fmg_browse_fieldOverlay.classList.remove('fmg_browse_field_visible');
    }
}

/**
 * @function fmg_browse_fieldSubmit
 * @description Handles the submit button click. Currently logs a message and closes the modal.
 */
async function fmg_browse_fieldSubmit() {
    console.log('FMG Browse: Submit button clicked');
    fmg_browse_closeField(); // Closes modal on submit for now

    const layout = document.getElementById('input_fmg_browse_layout')?.value;

    // URLs for the POST request
    const updateUrl = 'admin/browser.php?action=update_field';
    // We'll use FormData to easily send the data as a POST request.
    const formData = new FormData();
    formData.append('fmg_browse_edit_layout', layout);
    formData.append('fmg_browse_edit_id', fmg_browse_field_id.value);
    formData.append('fmg_browse_edit_name', fmg_browse_field_name.value);
    formData.append('fmg_browse_edit_value', fmg_browse_field_value.value);

    try {
        // Send POST request to update the field
        console.log('Sending request to:', updateUrl);
        const responseUpdate = await fetch(updateUrl, {
            method: 'POST',
            body: formData
        });

        if (responseUpdate.ok) {
            const responseText = await responseUpdate.text();
            // If successful, call fmg_changeBrowserState
            if (typeof fmg_changeBrowserState === 'function') {
                fmg_showMessage(msg_edit_success, "success");
                fmg_changeBrowserState('refresh');
            }
        } else {
            //console.error('Update request failed:', responseUpdate.status, responseUpdate.statusText);
            fmg_showMessage(msg_edit_fail, "danger");
        }

    } catch (error) {
        //console.error('Error during update request:', error);
        fmg_showMessage(msg_edit_fail, "danger");
    }

}

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
    fmg_browse_closeModal(); // Closes modal on submit for now

    document.getElementById('fmg_browse_sort_field').value =
        document.getElementById('input_fmg_browse_option_sort_field')?.value || '';

    document.getElementById('fmg_browse_sort_type').value =
        document.getElementById('input_fmg_browse_option_sort_type')?.value || '';

    document.getElementById('fmg_browse_records_limit').value =
        document.getElementById('input_fmg_browse_option_limit')?.value || '';

    document.getElementById('fmg_browse_records_offset').value =
        document.getElementById('input_fmg_browse_option_offset')?.value || '';

    fmg_changeBrowserState('refresh');
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
    const browserNavDiv = document.getElementById('browserNav'); // Maybe will be used later

    try {
        const dataArray = jsonString['response']['data'];
        const schemeArray = jsonString['response']['scheme'];
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

        // Get the options container and clear its content
        const inputElement = document.getElementById('input_fmg_browse_option_sort_field');
        const optionsContainer = inputElement?.parentElement?.querySelector('.fmg-ui-field-options');
        const filterInputElement = document.getElementById('input_fmg_browse_option_search_field');
        const filterOptionsContainer = filterInputElement?.parentElement?.querySelector('.fmg-ui-field-options');
        if (optionsContainer) {
            optionsContainer.innerHTML = ''; // Clear existing options
        }

        // Create the row actions header
        const headerActionsCell = document.createElement('th');
        headerActionsCell.textContent = msg_actions_header;
        tableHeader.appendChild(headerActionsCell);

        // Create table header row and populate options
        headers.forEach(headerText => {
            // Create and append <th> to the table header
            const headerCell = document.createElement('th');
            headerCell.textContent = headerText;
            tableHeader.appendChild(headerCell);

            // Also create and append a <div> for each headerText into the sort options container
            if (optionsContainer) {
                const optionDiv = document.createElement('div');
                optionDiv.textContent = headerText;
                optionsContainer.appendChild(optionDiv);
            }

            // Also create and append a <div> for each headerText into the filter options container
            if (filterOptionsContainer) {
                const filterOptionDiv = document.createElement('div');
                filterOptionDiv.textContent = headerText;
                filterOptionsContainer.appendChild(filterOptionDiv);
            }
        });

        // Create table body rows
        dataArray.forEach(obj => {
            const row = tableBody.insertRow();
            row.setAttribute('data-id', obj["recordId"]);

            // Add row options cell
            const cellOptions = row.insertCell();
            cellOptions.innerHTML = "<div  style=\" display: block; width: fit-content;\" onclick=\"fmg_browse_deleteRecord(" + obj["recordId"] + ")\" title=\"" + msg_delete_button + "\">" + fmg_browse_icon_delete + "</div>";

            headers.forEach(header => {
                const cell = row.insertCell();
                const cellValue = obj["fieldData"][header];
                const cellType = schemeArray[header]["type"]; // To decide if it can be updated or not
                const cellCategory = schemeArray[header]["result"]; // How the data will be viewed by the user

                // Handle cases where the value might be null or undefined or a container
                if (cellCategory == "container") {
                    if (cellValue !== "") {
                        cell.innerHTML = fmg_browse_icon_file;
                    } else {
                        cell.textContent = "";
                    }
                } else {
                    cell.textContent = cellValue !== null && cellValue !== undefined ? cellValue : '';
                }

                // Add click event listener to execute the edit / view script
                cell.addEventListener('dblclick', function (event) {
                    const rowId = row.getAttribute('data-id');
                    fmg_browse_editField(event, header, rowId, cellType, cellCategory);
                });
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

    // Reset browser settings in case on layout change
    if (changeType == "layout") {
        document.getElementById('input_fmg_browse_option_search_field').value = "";
        document.getElementById('input_fmg_browse_option_search_value').value = "";
        document.getElementById('fmg_browse_sort_field').value = "";
        document.getElementById('fmg_browse_sort_type').value = "ascend";
        document.getElementById('fmg_browse_records_offset').value = 1;
    }

    const tableHeader = document.getElementById('tableHeader');
    const tableBody = document.getElementById('tableBody');
    const browserNavDiv = document.getElementById('browserNav');
    const layout = document.getElementById('input_fmg_browse_layout')?.value;
    const sortField = document.getElementById('fmg_browse_sort_field')?.value;
    const sortType = document.getElementById('fmg_browse_sort_type')?.value;
    const recordsLimit = document.getElementById('fmg_browse_records_limit')?.value;

    // Clear previous table content
    tableHeader.innerHTML = '';
    tableBody.innerHTML = '';

    const searchField = document.getElementById('input_fmg_browse_option_search_field')?.value;
    const searchValue = document.getElementById('input_fmg_browse_option_search_value')?.value;
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
    if (searchField !== undefined) formData.append('fmg_browse_records_searchField', searchField);
    if (searchValue !== undefined) formData.append('fmg_browse_records_searchValue', searchValue);
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
                const fullArray = JSON.parse(responseText);
                fmg_refreshBrowserTable(fullArray);    // Construct the HTML string using template literals for clarity
                // Preparing pagination
                var previousArrouwHTML = "";
                var nextArrouwHTML = "";
                const rowsRetrned = fullArray['response']['dataInfo']["returnedCount"];
                const rowsFound = fullArray['response']['dataInfo']["foundCount"];
                if (parseInt(recordsOffset, 10) == 1) {
                    previousArrouwHTML = `<svg xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="#999999"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>`;
                } else {
                    previousArrouwHTML = `<svg target="_self" onclick="fmg_changeBrowserState('previous')" xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="#005d76"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>`;
                }
                if ((Math.floor(parseInt(recordsOffset, 10) + parseInt(rowsRetrned, 10) - 1)) == parseInt(rowsFound, 10)) {
                    nextArrouwHTML = `<svg xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="#999999"><path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z"/></svg>`;
                } else {
                    nextArrouwHTML = `<svg target="_self" onclick="fmg_changeBrowserState('next')" xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="#005d76"><path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z"/></svg>`;
                }
                const newHTML = `
                    <div class="browser-nav-left">
                        <div class="browser-nav-item" title="${msg_nav_refresh}">
                            <svg  target="_self" onclick="fmg_changeBrowserState('refresh')" xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="#005d76"><path d="M480-192q-120 0-204-84t-84-204q0-120 84-204t204-84q65 0 120.5 27t95.5 72v-99h72v240H528v-72h131q-29-44-76-70t-103-26q-90 0-153 63t-63 153q0 90 63 153t153 63q84 0 144-55.5T693-456h74q-9 112-91 188t-196 76Z"/></svg>
                        </div>
                        <div class="browser-nav-item" title="${msg_nav_filter}">
                            <svg target="_self" onclick="fmg_browse_openFilter()" xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="#005d76"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                        </div>
                        <div class="browser-nav-item" title="${msg_nav_settings}">
                            <svg target="_self" onclick="fmg_browse_openModal()" xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="#005d76"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                        </div>
                        <div class="browser-nav-item" style="margin-left: 10px;">
                            [ ${msg_nav_title} ]
                        </div>
                    </div>
                    <div class="browser-nav-right">
                        <div class="browser-nav-item">
                            ${parseInt(recordsOffset, 10)} - ${Math.floor(parseInt(recordsOffset, 10) + parseInt(rowsRetrned, 10) - 1)} [ ${parseInt(rowsFound, 10)} ]
                        </div>
                        <div class="browser-nav-item" title="${msg_nav_previous}">
                            ${previousArrouwHTML}
                        </div>
                        <div class="browser-nav-item" title="${msg_nav_next}">
                            ${nextArrouwHTML}
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

/**
 * Open and prepare the modal for editing a field.
 * @description Displays the modal dialog and its backdrop.
 * @param {JSON} jsonString - The JSon array containing the records data.
 * @returns {void}
 */

// 
function fmg_browse_editField(event, fieldName, recordId, cellType, cellCategory) {
    var clickedCell = event.currentTarget || event.target;
    var cellText = clickedCell.innerText;

    // Open and prepare the modal here
    console.log(fieldName + " and the id is: " + recordId);
    console.log("Cell type/category: " + cellType + "/" + cellCategory)

    if (fmg_browse_fieldOverlay) {
        fmg_browse_fieldOverlay.classList.add('fmg_browse_field_visible');
    }
    fmg_browse_field_id.value = recordId;
    fmg_browse_field_name.value = fieldName;
    fmg_browse_field_value.value = cellText;

    fmg_browse_field_related_upload.classList.add('fmg_browse_field_hide');
    fmg_browse_field_disabled.classList.add('fmg_browse_field_hide');
    fmg_browse_submitFieldButton.classList.remove('fmg_browse_field_hide');
    fmg_browse_downloadFieldButton.classList.add('fmg_browse_field_hide');
    fmg_browse_uploadFieldButton.classList.add('fmg_browse_field_hide');

    // Uneditable field
    if (cellType !== "normal") {
        fmg_browse_submitFieldButton.classList.add('fmg_browse_field_hide');
        fmg_browse_field_disabled.classList.remove('fmg_browse_field_hide');
    }

    // Container field
    if (cellCategory == "container") {
        fmg_browse_submitFieldButton.classList.add('fmg_browse_field_hide');
        fmg_browse_uploadFieldButton.classList.remove('fmg_browse_field_hide');
        if (cellType !== "normal") {
            fmg_browse_uploadFieldButton.classList.add('fmg_browse_field_hide');
            fmg_browse_field_disabled.classList.remove('fmg_browse_field_hide');
        }
        if (fieldName.includes("::")) {
            fmg_browse_uploadFieldButton.classList.add('fmg_browse_field_hide');
            fmg_browse_field_related_upload.classList.remove('fmg_browse_field_hide');
        }
        if (clickedCell.innerHTML !== "") {
            fmg_browse_field_value.value = msg_edit_file_contain;
            fmg_browse_downloadFieldButton.classList.remove('fmg_browse_field_hide');
        } else {
            fmg_browse_field_value.value = msg_edit_file_empty;
        }
    }
}

/**
 * Open and prepare the modal for deleting a record.
 * @description Displays the modal dialog and its backdrop.
 * @param {JSON} jsonString - The JSon array containing the records data.
 * @returns {void}
 */
function fmg_browse_deleteRecord(recordId) {
    // Open and prepare the modal here
    console.log("Delete the id: " + recordId);
    if (fmg_browse_fieldOverlay) {
        fmg_browse_deleteOverlay.classList.add('fmg_browse_delete_visible');
    }
    fmg_browse_delete_id.value = recordId;
}

/**
 * @function fmg_browse_closeDelete
 * @description Hides the modal dialog and its backdrop.
 */
function fmg_browse_closeDelete() {
    if (fmg_browse_deleteOverlay) {
        fmg_browse_deleteOverlay.classList.remove('fmg_browse_delete_visible');
    }
}

/**
 * @function fmg_browse_deleteSubmit
 * @description Handles the submit button click. Currently logs a message and closes the modal.
 */
async function fmg_browse_deleteSubmit() {
    console.log('FMG Browse: Submit button for delete clicked');
    fmg_browse_closeDelete(); // Closes modal on submit for now

    const layout = document.getElementById('input_fmg_browse_layout')?.value;

    // URLs for the POST request
    const updateUrl = 'admin/browser.php?action=delete_record';
    // We'll use FormData to easily send the data as a POST request.
    const formData = new FormData();
    formData.append('fmg_browse_delete_layout', layout);
    formData.append('fmg_browse_delete_id', fmg_browse_delete_id.value);

    try {
        // Send POST request to update the field
        console.log('Sending request to:', updateUrl);
        const responseUpdate = await fetch(updateUrl, {
            method: 'POST',
            body: formData
        });

        if (responseUpdate.ok) {
            const responseText = await responseUpdate.text();
            // If successful, call fmg_changeBrowserState
            if (typeof fmg_changeBrowserState === 'function') {
                fmg_showMessage(msg_delete_success, "success");
                fmg_changeBrowserState('refresh');
            }
        } else {
            //console.error('Update request failed:', responseUpdate.status, responseUpdate.statusText);
            fmg_showMessage(msg_delete_fail, "danger");
        }

    } catch (error) {
        //console.error('Error during update request:', error);
        fmg_showMessage(msg_delete_fail, "danger");
    }

}


/**
 * @function fmg_browse_fieldDownload
 * @description Handles the download button click. Currently logs a message and closes the modal.
 */
async function fmg_browse_fieldDownload() {
    console.log('FMG Browse: Download button clicked');
    fmg_browse_downloadFieldButton.classList.add('fmg_browse_field_hide');
    fmg_browse_uploadFieldButton.classList.add('fmg_browse_field_hide');
    fmg_browse_field_value.value = msg_download_wait;

    const layout = document.getElementById('input_fmg_browse_layout')?.value;

    // URLs for the POST request
    const updateUrl = 'admin/browser.php?action=download_field';
    // We'll use FormData to easily send the data as a POST request.
    const formData = new FormData();
    formData.append('fmg_browse_edit_layout', layout);
    formData.append('fmg_browse_edit_id', fmg_browse_field_id.value);
    formData.append('fmg_browse_edit_name', fmg_browse_field_name.value);

    try {
        // Send POST request to update the field
        console.log('Sending request to:', updateUrl);
        const responseUpdate = await fetch(updateUrl, {
            method: 'POST',
            body: formData
        });

        if (responseUpdate.ok) {
            const responseText = await responseUpdate.text();
            // If successful, call fmg_changeBrowserState
            fmg_browse_closeField(); // Closes modal on submit for now
            if (typeof fmg_changeBrowserState === 'function') {
                fmg_showMessage(msg_download_success, "success");
                //fmg_changeBrowserState('refresh'); // TEMPORARY PAUSED FOR TESTING
            }
        } else {
            //console.error('Update request failed:', responseUpdate.status, responseUpdate.statusText);
            fmg_browse_closeField(); // Closes modal on submit for now
            fmg_showMessage(msg_download_fail, "danger");
        }

    } catch (error) {
        //console.error('Error during update request:', error);
        fmg_browse_closeField(); // Closes modal on submit for now
        fmg_showMessage(msg_download_fail, "danger");
    }

}


function browse_layoutselect_renderDropdown(filter = "") {
    browse_layoutselect_dropdown.innerHTML = "";
    const filtered = browse_layoutselect_options.filter(opt =>
        opt.toLowerCase().includes(filter.toLowerCase())
    );

    if (filtered.length === 0) {
        browse_layoutselect_dropdown.style.display = "none";
        return;
    }

    filtered.forEach((opt, index) => {
        const div = document.createElement("div");
        div.textContent = opt;
        div.className = "fmg_browse_layoutselect_item";
        if (index === browse_layoutselect_activeIndex) div.classList.add("active");
        div.onclick = () => browse_layoutselect_selectOption(opt);
        browse_layoutselect_dropdown.appendChild(div);
    });
    browse_layoutselect_positionDropdown();
    browse_layoutselect_dropdown.style.display = "block";
}

function browse_layoutselect_selectOption(opt) {
    browse_layoutselect_input.value = opt;
    browse_layoutselect_lastSelected = opt;
    browse_layoutselect_dropdown.style.display = "none";
    fmg_changeBrowserState('layout');
    browse_layoutselect_activeIndex = -1;
}

// Open dropdown on click
browse_layoutselect_input.addEventListener("click", () => {
    browse_layoutselect_input.removeAttribute("readonly");
    browse_layoutselect_input.value = "";
    browse_layoutselect_activeIndex = -1;
    browse_layoutselect_renderDropdown();
});

// Filter options as user types
browse_layoutselect_input.addEventListener("input", (e) => {
    browse_layoutselect_activeIndex = -1;
    browse_layoutselect_renderDropdown(e.target.value);
});

// Keyboard navigation
browse_layoutselect_input.addEventListener("keydown", (e) => {
    const items = browse_layoutselect_dropdown.querySelectorAll(".fmg_browse_layoutselect_item");
    if (browse_layoutselect_dropdown.style.display === "block" && items.length > 0) {
        if (e.key === "ArrowDown") {
            e.preventDefault();
            browse_layoutselect_activeIndex = (browse_layoutselect_activeIndex + 1) % items.length;
            browse_layoutselect_updateActive(items);
        } else if (e.key === "ArrowUp") {
            e.preventDefault();
            browse_layoutselect_activeIndex = (browse_layoutselect_activeIndex - 1 + items.length) % items.length;
            browse_layoutselect_updateActive(items);
        } else if (e.key === "Enter") {
            e.preventDefault();
            if (browse_layoutselect_activeIndex >= 0) {
                browse_layoutselect_selectOption(items[browse_layoutselect_activeIndex].textContent);
            }
        }
    }
});

function browse_layoutselect_updateActive(items) {
    items.forEach((item, i) => {
        item.classList.toggle("active", i === browse_layoutselect_activeIndex);
    });
    if (items[browse_layoutselect_activeIndex]) {
        items[browse_layoutselect_activeIndex].scrollIntoView({ block: "nearest" });
    }
}

// Close dropdown on outside click
document.addEventListener("click", (e) => {
    if (!e.target.closest(".fmg_browse_layoutselect_container")) {
        browse_layoutselect_dropdown.style.display = "none";
        if (!browse_layoutselect_options.includes(browse_layoutselect_input.value)) {
            browse_layoutselect_input.value = browse_layoutselect_lastSelected;
            if (!browse_layoutselect_lastSelected) {
                browse_layoutselect_input.setAttribute("placeholder", msg_nav_layoutselect);
            }
        }
        browse_layoutselect_input.setAttribute("readonly", true);
    }
});

function browse_layoutselect_positionDropdown() {
    const rect = browse_layoutselect_input.getBoundingClientRect();
    browse_layoutselect_dropdown.style.top = rect.bottom + "px";
    browse_layoutselect_dropdown.style.left = rect.left + "px";
    browse_layoutselect_dropdown.style.width = rect.width + "px";
}
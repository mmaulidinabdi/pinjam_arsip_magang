import './bootstrap';

import 'flowbite';

// Import Simple DataTables

// // Wait for the DOM to load
// document.addEventListener("DOMContentLoaded", () => {
//     // Initialize the DataTable
//     const table = new DataTable("#export-table");

//     // Add export functionality
//     document.getElementById("export-csv").addEventListener("click", () => {
//         table.export({
//             type: "csv",
//             download: true,
//         });
//     });
// });
// import 'simple-datatables/dist/style.css';
import { DataTable } from 'simple-datatables';

document.addEventListener('DOMContentLoaded', () => {
    const searchTable = document.getElementById('search-table');
    if (searchTable) {
        const dataTable = new DataTable(searchTable, {
            searchable: true,
            sortable: false,
        });
    }
});

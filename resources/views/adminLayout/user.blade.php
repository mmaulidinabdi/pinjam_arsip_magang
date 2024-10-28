@extends('adminLayout.adminLayout')

@section('peminjamLayout')

<div class=" font-bold">
    <h2 class="text-xl">
        User
    </h2>
    <br>
</div>
<table id="filter-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center ">
                    Nama User
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Alamat
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Email
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    No telp
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    KTP

                </span>
            </th>
            <th>
                <span class="flex items-center">
                    status
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
        </tr>
    </thead>

    <tbody>
    <tr>
        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Muhammad Azhar Sadikin</td>
        <td>IMB 123 1999</td>
        <td>25 september 2024</td>
        <td>di proses</td>
        <td>
            <a href="{{ asset('storage/ktp/imb_1_1999.pdf') }}" target="_blank" class="text-blue-600 hover:underline">
                Lihat File PDF
            </a>
        </td>
        <td>
            <button type="button" onclick="changeButtonText(this)"
                class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                PERIKSA
            </button>
            <button type="button" onclick="toggleRejectionReason(this)"
                class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                ditolak
            </button>
        </td>
    </tr>
    <!-- Hidden rejection reason row -->
    <tr class="rejection-reason" style="display: none;">
    <td colspan="6">
        <textarea placeholder="Alasan ditolak..." class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white"></textarea>
        <button type="button" 
            class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Konfirmasi
        </button>
    </td>
</tr>

    <tr>
        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Muhammad Azhar Sadikin</td>
        <td>IMB 123 1999</td>
        <td>25 september 2024</td>
        <td>di proses</td>
        <td>
            <a href="{{ asset('storage/ktp/imb_1_1999.pdf') }}" target="_blank" class="text-blue-600 hover:underline">
                Lihat File PDF
            </a>
        </td>
        <td>
            <button type="button" onclick="changeButtonText(this)"
                class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                PERIKSA
            </button>
            <button type="button" onclick="toggleRejectionReason(this)"
                class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                ditolak
            </button>
        </td>
    </tr>
    <!-- Hidden rejection reason row -->
    <tr class="rejection-reason" style="display: none;">
    <td colspan="6">
        <textarea placeholder="Alasan ditolak..." class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white"></textarea>
        <button type="button" 
            class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Konfirmasi
        </button>
    </td>
</tr>

    <tr>
        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Muhammad Azhar Sadikin</td>
        <td>IMB 123 1999</td>
        <td>25 september 2024</td>
        <td>di proses</td>
        <td>
            <a href="{{ asset('storage/ktp/imb_1_1999.pdf') }}" target="_blank" class="text-blue-600 hover:underline">
                Lihat File PDF
            </a>
        </td>
        <td>
            <button type="button" onclick="changeButtonText(this)"
                class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                PERIKSA
            </button>
            <button type="button" onclick="toggleRejectionReason(this)"
                class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                ditolak
            </button>
        </td>
    </tr>
    <!-- Hidden rejection reason row -->
    <tr class="rejection-reason" style="display: none;">
    <td colspan="6">
        <textarea placeholder="Alasan ditolak..." class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white"></textarea>
        <button type="button" 
            class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Konfirmasi
        </button>
    </td>
</tr>

</tbody>
    
</table>

<script>
    if (document.getElementById("filter-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#filter-table", {
            tableRender: (_data, table, type) => {
                if (type === "print") {
                    return table;
                }
                const tHead = table.childNodes[0];
                const filterHeaders = {
                    nodeName: "TR",
                    attributes: {
                        class: "search-filtering-row"
                    },
                    childNodes: tHead.childNodes[0].childNodes.map((_th, index) => {

                        if (index >= tHead.childNodes[0].childNodes.length - 2) {
                            return { nodeName: "TH" };
                        }
                        return {
                            nodeName: "TH",
                            childNodes: [
                                {
                                    nodeName: "INPUT",
                                    attributes: {
                                        class: "datatable-input",
                                        type: "search",
                                        "data-columns": "[" + index + "]"
                                    }
                                }
                            ]
                        };
                    })
                };
                tHead.childNodes.push(filterHeaders);
                return table;
            }
        });
    }

    function changeButtonText(button) {
    // Change the text and disable the "PERIKSA" button
    button.textContent = "DI ACC";
    button.disabled = true;
    button.classList.remove("bg-gray-700", "hover:bg-gray-900");
    button.classList.add("bg-green-500");

    // Find the "ditolak" button in the same row and hide it
    const row = button.closest("tr"); // Get the current row
    const rejectButton = row.querySelector('button[onclick="toggleRejectionReason(this)"]'); // Find the "ditolak" button
    if (rejectButton) {
        rejectButton.style.display = "none"; // Hide the "ditolak" button
    }
}


    function toggleRejectionReason(button) {
        // Find the next sibling row, which is the rejection reason row
        const rejectionRow = button.closest("tr").nextElementSibling;

        // Toggle the display property
        if (rejectionRow.style.display === "none" || rejectionRow.style.display === "") {
            rejectionRow.style.display = "table-row";  // Show the rejection reason row
        } else {
            rejectionRow.style.display = "none";       // Hide the rejection reason row
        }
    }
</script>

@endsection
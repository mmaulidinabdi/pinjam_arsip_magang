import "./bootstrap";

import "flowbite";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

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
import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", () => {
    const searchTable = document.getElementById("search-table");
    if (searchTable) {
        const dataTable = new DataTable(searchTable, {
            searchable: true,
            sortable: false,
        });
    }
});

// Chart
import Chart from "chart.js/auto";

let barChart, donutChart; // Deklarasi variabel untuk menyimpan instans chart

const initCharts = () => {
    // Cek dan hapus instans chart bar sebelumnya jika ada
    if (barChart) {
        barChart.destroy();
    }

    // Inisialisasi ulang bar chart
    const ctx = document.getElementById("myChart").getContext("2d");
    barChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [
                {
                    label: "# of Votes",
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56",
                        "#4BC0C0",
                        "#9966FF",
                        "#FF9F40",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    // Cek dan hapus instans donut chart sebelumnya jika ada
    if (donutChart) {
        donutChart.destroy();
    }

    // Inisialisasi ulang donut chart
    const donut = document.getElementById("donutChart").getContext("2d");
    donutChart = new Chart(donut, {
        type: "doughnut",
        data: {
            labels: ["Red", "Blue", "Yellow"],
            datasets: [
                {
                    data: [300, 50, 100],
                    backgroundColor: [
                        "rgb(255, 99, 132)",
                        "rgb(54, 162, 235)",
                        "rgb(255, 205, 86)",
                    ],
                    hoverOffset: 4,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        },
    });
};

// Inisialisasi chart saat halaman pertama kali dimuat
initCharts();

// Inisialisasi ulang chart saat jendela diubah ukurannya
window.addEventListener("resize", () => {
    initCharts();
});



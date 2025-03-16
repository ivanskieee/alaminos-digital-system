
// Toggle dropdown menu visibility
function toggleMenu(button) {
    let menu = button.nextElementSibling;
    let allMenus = document.querySelectorAll('.hidden');

    // Close all other dropdowns
    allMenus.forEach(m => {
        if (m !== menu) m.classList.add('hidden');
    });

    // Toggle current menu
    menu.classList.toggle('hidden');
}

// Navigate to the user page
function goToPage(page) {
    window.location.href = "<?php echo base_url('conAdmin/'); ?>" + page;
}


// Close dropdown when clicking outside
document.addEventListener('click', function (event) {
    let menus = document.querySelectorAll('.hidden');
    menus.forEach(menu => {
        if (!menu.parentElement.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
});
// Function to download the chart
function downloadChart(button) {
    // Hanapin ang canvas na nasa parehong div
    let canvas = button.closest('.relative').parentElement.querySelector('canvas');

    if (!canvas) {
        alert("No chart found!");
        return;
    }

    // Convert canvas to data URL
    let image = canvas.toDataURL("image/png");

    // Create a download link
    let link = document.createElement('a');
    link.href = image;
    link.download = canvas.id + ".png"; // Gamitin ang ID ng canvas bilang filename
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}



function exportAsPDF(button) {
    // Hanapin ang canvas o table na nasa parehong div
    let parentDiv = button.closest('.relative').parentElement;
    let canvas = parentDiv.querySelector('canvas');
    let table = parentDiv.querySelector('table');

    // Create a new window for the printable content
    let printWindow = window.open('', '', 'width=800,height=600');

    // Add basic styles
    printWindow.document.write('<html><head><title>Export PDF</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { font-family: Arial, sans-serif; text-align: center; }');
    printWindow.document.write('canvas { max-width: 100%; height: auto; }');
    printWindow.document.write('table { border-collapse: collapse; width: 100%; margin-top: 20px; }');
    printWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
    printWindow.document.write('</style></head><body>');

    // Add content based on what is found
    if (canvas) {
        let image = canvas.toDataURL("image/png");
        printWindow.document.write('<h2>Chart Export</h2>');
        printWindow.document.write('<img src="' + image + '" style="max-width: 100%;">');
    } else if (table) {
        printWindow.document.write('<h2>Data Export</h2>');
        printWindow.document.write(table.outerHTML);
    } else {
        printWindow.document.write('<h2>No content available for export</h2>');
    }

    // Close document
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    // Wait for the content to load before printing
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 500);
}

sortTable = (table, columnToSortBy, dataObject) => {
    // Verwijder de rijen in de tabel.
    const tableBody = $(table).find('tbody').first();
    tableBody.find('tr').remove();

    const tournaments = dataObject['tournaments'];

    if (tournaments === undefined) {
        throw new Error("Er zijn geen toernooien opgehaald.");
    }

    $.each(tournaments, (index, tournament) => {
        tableBody
            .append($('<tr></tr>')
                .append($('<td></td>')
                    .text(tournament.id))
                .append($('<td></td>')
                    .text(tournament.name))
                .append($('<td></td>')
                    .text(tournament.description)
                )
            );
    });

    const orderToSortBy = dataObject.orderToSortBy;
    // Switch de volgorde van sorteren voor de opgegeven kolom.
    columnToSortBy.dataset.sortOrder = (orderToSortBy === 'asc') ? 'desc' : 'asc';
};

getTournamentsData = (table, columnToSortBy) => {
    const currentPageUrl = new URL(window.location.href);
    const pageNumber = currentPageUrl.searchParams.get('pageNumber');

    jQuery.ajax({
        // TODO: Moet de requestUrl in de table?
        url: table.dataset.requestUrl,
        method: 'GET',
        contentType: 'application/json',
        data: {
            'orderToSortBy': columnToSortBy.dataset.sortOrder,
            'columnToSortBy': columnToSortBy.dataset.columnName,
            'pageNumber': pageNumber
        }
    })
        .done(dataObject => sortTable(table, columnToSortBy, dataObject))
        .fail(() => console.warn('Er is iets foutgegaan bij het ophalen van de tournaments.'));
};

$(document).ready(function () {
    (addClickListeners => {
        // Vraag alle tables op waarop gesorteerd moet kunnen worden.
        const sortableTables = Array.from(document.querySelectorAll('table.sortable'));

        // Itereer over alle tables.
        sortableTables.forEach(table => {
            const tableHead = table.tHead;
            const firstTableHeadRow = tableHead.rows[0];
            const sortableColumns = Array.from(firstTableHeadRow.querySelectorAll('th[data-sortable="true"]'));

            console.log(sortableColumns);

            // Itereer over alle columns in de tableHead en voeg een clicklistener toe.
            sortableColumns.forEach(column => column.addEventListener('click', () => getTournamentsData(table, column)));
        });

    })();
});
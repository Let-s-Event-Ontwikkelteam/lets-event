<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;

class SortController extends Controller
{
    private $defaultSortOrder = 'asc';
    private $defaultSortColumn = 'name';
    private $defaultPageNumber = 1;

    private $maxResultsPerPage = 10;

    public function sortCollection(Request $request)
    {
        $requestSortOrder = $request->get('sortOrder');
        $requestSortColumn = $request->get('sortColumn');
        $requestPageNumber = $request->get('pageNumber');

        $sortOrder = $requestSortOrder
            // Zorg ervoor dat de sortOrder alleen de waarde 'asc' of 'desc' kan hebben.
            ? ($requestSortOrder != 'asc' && $requestSortOrder != 'desc')
                ? $this->defaultSortOrder
                : $requestSortOrder
            : $this->defaultSortOrder;

        $sortColumn = $requestSortColumn
            // Check of er op deze column gesorteerd mag worden.
            ? (array_search($requestSortColumn, Tournament::$sortableFields) > -1)
                ? $requestSortColumn
                : $this->defaultSortColumn
            : $this->defaultSortColumn;

        $tournamentsSortedByColumn = Tournament::orderBy($sortColumn, $sortOrder)->get();
        $totalAmountOfPages = ceil($tournamentsSortedByColumn->count() / $this->maxResultsPerPage);

        $currentPageNumber = $requestPageNumber
            // Check of het paginanummer van het type numeric is.
            ? (is_numeric($requestPageNumber))
                // Check of het paginanummer groter is dan 0.
                ? ($requestPageNumber > 0)
                    // Check of het paginanummer groter is dan het totale aantal pagina's.
                    ? ($requestPageNumber > $totalAmountOfPages)
                        ? $totalAmountOfPages
                        : intval($requestPageNumber)
                    : $this->defaultPageNumber
                : $this->defaultPageNumber
            : $this->defaultPageNumber;

        $tournamentsSortedAndPaginated = $tournamentsSortedByColumn
            ->forPage($currentPageNumber, $this->maxResultsPerPage);

        return [
            'tournaments' => $tournamentsSortedAndPaginated,
            'orderToSortBy' => $sortOrder,
            'columnToSortBy' => $sortColumn,
            'currentPageNumber' => $currentPageNumber,
            'totalAmountOfPages' => $totalAmountOfPages,
        ];
    }
}

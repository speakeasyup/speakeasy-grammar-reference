/**
 * Speak Easy Grammar Reference - Search Functionality
 */

(function($) {
    'use strict';

    const searchInput = $('#segrammar-search-input');
    const searchResults = $('#segrammar-search-results');
    let searchTimeout;

    /**
     * Perform AJAX search
     */
    function performSearch(query) {
        if (query.length < 2) {
            searchResults.empty();
            return;
        }

        $.ajax({
            url: seGrammarAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'segrammar_search',
                query: query,
                nonce: seGrammarAjax.nonce
            },
            success: function(response) {
                if (response.success) {
                    displayResults(response.data);
                } else {
                    searchResults.html('<p class="error">Error performing search</p>');
                }
            },
            error: function() {
                searchResults.html('<p class="error">Error performing search</p>');
            }
        });
    }

    /**
     * Display search results
     */
    function displayResults(results) {
        searchResults.empty();

        if (results.length === 0) {
            searchResults.html('<div class="no-results">No results found</div>');
            return;
        }

        const html = results.map(function(result) {
            const url = window.location.origin + '/grammar/' + result.slug;
            return '<a href="' + url + '" class="search-result-item">' +
                   '<strong>' + escapeHtml(result.title) + '</strong>' +
                   '<small>' + escapeHtml(result.category) + '</small>' +
                   '</a>';
        }).join('');

        searchResults.html(html);
    }

    /**
     * Escape HTML special characters
     */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    /**
     * Toggle sidebar on mobile
     */
    $(document).on('click', '.segrammar-toggle-sidebar', function() {
        $('.segrammar-sidebar').toggleClass('active');
    });

    /**
     * Search input event listener
     */
    searchInput.on('keyup', function() {
        const query = $(this).val().trim();

        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            performSearch(query);
        }, 300);
    });

    /**
     * Close search results when clicking outside
     */
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.segrammar-search').length) {
            searchResults.empty();
        }
    });
})(
 jQuery
);

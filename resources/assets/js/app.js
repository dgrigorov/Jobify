"use strict";

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
require('bootstrap-select');

$(function() {
    var baseUrl = window.appBaseUrl;
   
    $('.job-form .job-publish').on('click', function(e) {
        let jobId = $(e.currentTarget).closest('.job-form').data('jobid');
        $.ajax({
            url: `${appBaseUrl}/jobs/${jobId}/publish`,
            method: 'POST'
        })
        .done(function() {
            $(e.currentTarget).remove();
        })
        .fail(function() {
            // TODO: fix
            alert('ERROR');
        });
    });

    $('.job-form .job-delete').on('click', function(e) {
        let jobId = $(e.currentTarget).closest('.job-form').data('jobid');
        $.ajax({
            url: `${appBaseUrl}/jobs/${jobId}/delete`,
            method: 'POST'
        })
        .done(function() {
            document.location.href = appBaseUrl;
        })
        .fail(function() {
            // TODO: fix
            alert('ERROR');
        });
    });

    $('.job-search').on('click', function(e) {
        let searchText = $('.job-search-input').val();
        $.ajax({
            url: `${appBaseUrl}/jobs/search`,
            method: 'POST',
            data: {
                searchText: searchText,
            }
        })
        .done(function(html) {
            $('.job-list').replaceWith(html);
        })
        .fail(function() {
            // TODO: fix
            alert('ERROR');
        });
    });
});
(function ($, window) {
    'use strict';

    var overlaySelector = '#global-loading-overlay';
    var loadingTimer = null;
    var overlayDelayMs = 350;
    var defaultMessage = 'Procesando...';

    function getOverlay() {
        return $(overlaySelector);
    }

    function setOverlayMessage(message) {
        var $overlay = getOverlay();
        $overlay.find('.loading-text').text(message || defaultMessage);
    }

    function showOverlay(message) {
        setOverlayMessage(message);
        getOverlay().addClass('active');
    }

    function hideOverlay() {
        getOverlay().removeClass('active');
    }

    function ensureTableOverlay($table) {
        if (!$table || !$table.length) {
            return null;
        }

        var $wrapper = $table.closest('.table-loading');
        if (!$wrapper.length) {
            $table.wrap('<div class="table-loading"></div>');
            $wrapper = $table.closest('.table-loading');
        }

        var $overlay = $wrapper.find('.loading-overlay--table');
        if (!$overlay.length) {
            $overlay = $(
                '<div class="loading-overlay--table" aria-live="polite" aria-busy="true">' +
                    '<div class="loading-overlay__content">' +
                        '<div class="loading-spinner"></div>' +
                        '<div class="loading-text">Cargando tabla...</div>' +
                    '</div>' +
                '</div>'
            );
            $wrapper.append($overlay);
        }

        return $overlay;
    }

    function showTableOverlay($table, message) {
        var $overlay = ensureTableOverlay($table);
        if (!$overlay) {
            return;
        }
        if (message) {
            $overlay.find('.loading-text').text(message);
        }
        $overlay.addClass('active');
    }

    function hideTableOverlay($table) {
        var $overlay = ensureTableOverlay($table);
        if (!$overlay) {
            return;
        }
        $overlay.removeClass('active');
    }

    function setButtonLoading($button) {
        if (!$button || !$button.length || $button.hasClass('is-loading')) {
            return;
        }

        var originalHtml = $button.html();
        if (!$button.data('originalHtml')) {
            $button.data('originalHtml', originalHtml);
        }

        var loadingText = $button.data('loading-text') || $button.data('loadingText');
        if (!loadingText) {
            loadingText = "<i class='fa fa-spinner fa-spin'></i><span class='btn-text'>Procesando...</span>";
        }

        $button
            .addClass('is-loading')
            .prop('disabled', true)
            .html(loadingText);
    }

    function resetButtonLoading($button) {
        if (!$button || !$button.length) {
            return;
        }

        var originalHtml = $button.data('originalHtml');
        if (originalHtml) {
            $button.html(originalHtml);
        }
        $button.removeClass('is-loading').prop('disabled', false);
    }

    function resetFormButtons($form) {
        $form.find('button[type="submit"], input[type="submit"]').each(function () {
            resetButtonLoading($(this));
        });
        $form.data('hisSubmitting', false);
    }

    function handleFormSubmit(event) {
        var $form = $(this);

        if (event.isDefaultPrevented && event.isDefaultPrevented()) {
            return;
        }

        if ($form.data('hisSubmitting')) {
            event.preventDefault();
            return false;
        }

        $form.data('hisSubmitting', true);

        var $buttons = $form.find('button[type="submit"], input[type="submit"]');
        $buttons.each(function () {
            setButtonLoading($(this));
        });

        showOverlay($form.data('loadingMessage') || defaultMessage);
    }

    function handleAjaxStart() {
        if (loadingTimer) {
            clearTimeout(loadingTimer);
        }
        loadingTimer = setTimeout(function () {
            showOverlay(defaultMessage);
        }, overlayDelayMs);
    }

    function handleAjaxStop() {
        if (loadingTimer) {
            clearTimeout(loadingTimer);
            loadingTimer = null;
        }
        hideOverlay();
    }

    function handleAjaxError(event, xhr, settings, thrownError) {
        if (thrownError === 'timeout') {
            hideOverlay();
            if (typeof window.errorMsg === 'function') {
                window.errorMsg('La solicitud tardó demasiado. Intente nuevamente.');
            }
        }
    }

    window.HISLoading = {
        show: showOverlay,
        hide: hideOverlay,
        showTable: showTableOverlay,
        hideTable: hideTableOverlay,
        resetButtons: resetFormButtons,
        resetButton: resetButtonLoading
    };

    $(function () {
        $.ajaxSetup({
            timeout: 90000
        });
        $(document).on('submit', 'form[method="post"], form[method="POST"]', handleFormSubmit);
        $(document).on('ajaxStart', handleAjaxStart);
        $(document).on('ajaxStop', handleAjaxStop);
        $(document).on('ajaxError', handleAjaxError);
    });
})(jQuery, window);

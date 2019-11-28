export default {
  init() {
    // JavaScript to be fired on all pages
    $('.js-menu-toggle').click(function(e) {
      e.preventDefault();

      $(document.documentElement).toggleClass('main-menu-open');
    });

    $('.search-bar-toggle').click(function(e) {
      e.preventDefault();

      $('.search-bar input').focus();

      $(document.documentElement).toggleClass('search-bar-open');
    });

    // Expand menu item
    $('.js-toggle-menu-item').click(function() {
      $(this).toggleClass('active').siblings('ul').slideToggle();
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

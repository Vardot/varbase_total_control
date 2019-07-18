/**
 * @file
 * Behaviors for the Varbase Total Control Dashboard masonry.
 */

(function ($, _, Drupal, drupalSettings) {
  'use strict';

  Drupal.behaviors.varbaseTotalControlMasonry = {
    attach: function (context, settings) {
      var $options = new Object();
      $options.gutter = 0;
      $options.isFitWidth = true;
      $options.isResizeBound = true;
      $options.itemSelector = '.masonry-item';
      $options.transitionDuration = '500mx';

      $('.vtc-dashboard-masonry').masonry($options);
    }
  };
})(window.jQuery, window._, window.Drupal, window.drupalSettings);

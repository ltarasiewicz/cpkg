    (function($) {
        $.fn.sortItemsInContainer = function(itemsSelector) {

            // Recursively sort DOM elements - highest priority on top
            var positionElements = function($items, $container) {
                if (0 === $items.length) {
                    return;
                }
                var $highestEle = findHighestElement($items);

                $container.append($highestEle);
                $items = $items.not($highestEle);

                return positionElements($items, $container);

            };

            // Find DOM element with highest priority
            var findHighestElement = function($items) {

                var firstItem = $items.get(0);
                var $highest = $(firstItem);

                $.each($items, function() {
                    var $current = $(this);
                    if ($current.data('priority') > $highest.data('priority')) {
                        $highest = $current;
                    }
                });

                return $highest;
            };

            return this.each(function() {
                var $container = $(this);
                var $itemsToSort = $container.children(itemsSelector);
                positionElements($itemsToSort, $container);
            });
        };
    })(jQuery);
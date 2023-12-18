<?php
    function getNextBorrowState($currentStatus) {
        $states = ['pending','accepted', 'delivered', 'picked-up', 'returned', 'archived'];

        $currentIndex = array_search($currentStatus, $states);

        // Check if the current status is in the sequence
        if ($currentIndex !== false) {
            // Calculate the index of the next state, considering it's a circular sequence
            $nextIndex = ($currentIndex + 1) % count($states);

            // Return the next state
            return $states[$nextIndex];
        }

        // Return null if the current status is not in the sequence
        return null;
    }

?>
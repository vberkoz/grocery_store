<?php

/**
 * Class Pagination
 */
class Pagination
{
    /**
     * @var int Max number of pagination links
     */
    private $max = 10;

    /**
     * @var string Url key
     */
    private $index = 'page';

    /**
     * @var int Current page number
     */
    private $current_page;

    /**
     * @var int Records total number
     */
    private $total;

    /**
     * @var int Records per page
     */
    private $limit;

    /**
     * Pagination constructor.
     * @param int $total        Records total number
     * @param int $currentPage  Current page number
     * @param int $limit        Records number per page
     * @param int $index        Url key
     */
    public function __construct($total, $currentPage, $limit, $index) {
        $this->total = $total;
        $this->limit = $limit;
        $this->index = $index;
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    /**
     * Displays links
     * @return string
     */
    public function get() {
        $links = null;
        $limits = $this->limits();

        $html = '<nav aria-label="Page navigation"><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active">
                                <a href="#" class="page-link">' . $page . '</a>
                           </li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)) {
            if ($this->current_page > 1) $links = $this->generateHtml(1, '&#10094;') . $links;
            if ($this->current_page < $this->amount) $links .= $this->generateHtml($this->amount, '&#10095;');
        }

        $html .= $links . '</ul></nav>';

        return $html;
    }

    /**
     * Generates link html code
     * @param int $page     Page number
     * @param null $text
     * @return string       Link html code
     */
    private function generateHtml($page, $text = null) {
        if (!$text) $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        return '<li class="page-item">
                    <a href="' . $currentURI . $this->index . $page . '" class="page-link">' . $text . '</a>
                </li>';
    }

    /**
     * Calculates start, end values
     * @return array
     */
    private function limits() {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;

        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return array($start, $end);
    }

    /**
     * Sets current page
     * @param $currentPage
     */
    private function setCurrentPage($currentPage) {
        $this->current_page = $currentPage;

        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) $this->current_page = $this->amount;
        } else {
            $this->current_page = 1;
        }
    }

    /**
     * Calculates pages total number
     * @return float Pages number
     */
    private function amount() {
        return ceil($this->total / $this->limit);
    }

}
<?php

namespace Core\Services\HTML;

use Core\Services\Globals\Globals;

class Paging
{
    /**
     * Paging of the past SQL statement
     * @param int $limit number of elements returned per page
     * @param string $queryString ex:'post.index'
     * @param object $table table involved
     * @param string $statement
     * @param null|array $attributes
     * @return array with the \compat function | !! use \extract to retrieve variables
     */
    public static function generate(int $limit, string $queryString, object $table, string $statement, ?array $attributes = \null): array
    {
        $globals = new Globals;

        // retrieves the page number
        preg_match('/\d*$/', $globals->getSERVER('QUERY_STRING'), $page);

        $rows = \lcfirst($table->table . 's');

        $nbRows = $table->countRows($statement, $attributes);
        $nbPages = \ceil($nbRows / $limit);
        $page = !empty($page[0]) && $page[0] <= $nbPages ? $page[0] : 1;

        // add the offest to the base SQL statement
        $$rows = $table->offset($statement, $attributes, $limit, $page);
        // manages the disabling of the previous and following btn
        $previous = $page <= 1 ? ' disabled' : \null;
        $next = $page >= $nbPages ? ' disabled' : \null;

        \ob_start();
?>
        <nav class="paging" aria-label="Page navigation">
            <ul class="pagination">
                <?php if (empty($previous)) : ?>
                    <li class="page-item<?= $previous ?>">
                        <a class="page-link" href="?p=<?= $queryString; ?><?= '.' . ($page - 1); ?>">&laquo;</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                    <li class="page-item <?= $i == $page ? ' active' : null; ?>" <?= $i == $page ? ' arria-current="page"' : null ?>>
                        <a class="page-link" href="?p=<?= $queryString; ?><?= '.' . $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if (empty($next)) : ?>
                    <li class="page-item<?= $next ?>">
                        <a class="page-link" href="?p=<?= $queryString; ?><?= '.' . ($page + 1); ?>">&raquo;</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
<?php
        $paging = \ob_get_clean();

        return compact($rows, 'paging');
    }
}

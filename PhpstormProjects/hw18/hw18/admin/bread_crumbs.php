<?php
function breadcrumbs (array $items) {
    $html = <<< HTML
    <div class = "container">
        <div class="col-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    ___CONTENT___
                </ol>
            </nav>
        </div>
    </div>
HTML;

$content =[];
$counter = count($items) - 1;
foreach ($items as $index => $item) {
    if ($counter !== $index) {
        $content[] = "<li class=\"breadcrumb-item\"><a href=\"{$item['href']}\">{$item['title']}</a></li>";
    }
    else {
        $content[] = "<li class=\"breadcrumb-item active\" aria-current=\"page\">{$item['title']}</li>";
    }
}
$content = implode('',$content);
$html = str_replace('___CONTENT___',$content, $html);
return $html;
}